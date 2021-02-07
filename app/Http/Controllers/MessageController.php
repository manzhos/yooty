<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Message;
use App\Models\Meta;
use App\Models\Science;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Null_;


class MessageController extends Controller
{

    public function index(Request $request)
    {
        if($request->has('science_tags')){
            $science=Science::find($request->science_tags);
            //dd($science->science_name);
            $messages = $science->message;
            //dd($messages);
        }else{
            $messages = Message::all();
        }
        return view('messages', compact('messages'));
    }


    public function create()
    {
        $science_tags = json_encode(Science::all());
        $education_tags = json_encode(Education::all());

        return view('messages.create', compact('science_tags','education_tags'));
    }

    public function create2()
    {
        return view('messages.create-2');
    }

    public function create3(Request $request)
    {
        // update cost data record
        DB::table('message_meta')->where('message_id', '=', $request->messaage_id)->update([
            'date_end' => $request->datelimite,
            'cost' => $request->Budget,
            'quick_delivery' => $request->Livraison,
            'best_professor' => $request->meilleurs,
            'contact_online' => $request->professeurs,
            'horaire'        => $request->horaire,
            'responsive_professor' => $request->reactifs,
        ]);

        $message = $request->messaage_id;

        $cost = $request->Budget;
        if($request->Livraison == 'on') { $cost += 3; }
        if($request->meilleurs == 'on') { $cost += 3; }
        if($request->professeurs == 'on') { $cost += 3; }
        if($request->reactifs == 'on') { $cost += 3; }

        $data = [
            'cost' => $cost,
            'message_id'  => $request->messaage_id,
            'pk' => env('STRIPE_KEY')
        ];

        //final return to PAY
        return view('messages.create-3')->with($data);

        //test return without PAY
        //return view ('messages.successful');
    }


    public function store(Request $request)
    {
        //validate
        $this->validate($request, [
            'science' => 'required',
            'education' => 'required',
            'subject' => 'required',
            'message'  => 'required|min:10',
//          'g-recaptcha-response' => 'required|captcha'
        ]);

        //store message
        $message = new Message($request->except(['file']));
        $message->user_id = Auth::user()->id;
        $message->save();

        //store tags for message
        $message->sciences()->attach($request->science);
        $message->education()->attach($request->education);

        //store images and files for message
        $files = $request->file('file');

        if($files)
        {
            foreach ($files as $file)
            {

                $filename = 'yooty_' . time() . '_' . $file->getClientOriginalName();
                $img = Image::make($file);
                // resize the image so that the largest side fits within the limit; the smaller
                // side will be scaled to maintain the original aspect ratio
                $img->resize(2400, 2400, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $img->save( public_path('/storage/uploads/' . $filename));

                $media = $message->media()->create([
                    'message_id' => $request->message_id,
                    'file_name' => $filename,
                ]);

            }
        }

        //prepare record in DB for payment data for this message
        DB::table('message_meta')->insert([
           'message_id' => $message->id,
        ]);

        //redirect with id record for insert payments data
        return view('messages.create-2')->with('message_id', $message->id);
    }


    public function show($id)
    {
        $message = Message::find($id);
        return view('messages.single',compact('id','message'));;
    }


    public function edit($id)
    {
        $science_tags = Science::all();
        $education_tags = Education::all();
        $message = Message::find($id);
        return view('messages.edit',compact('message','id', 'science_tags', 'education_tags'));
    }

    public function delimage(Request $request)
    {

        DB::table('media_messages')->where('id',$request->image_id)->delete();

        return back()->with('message', 'Image supprimée');
    }


    public function update(Request $request)
    {
        $message = Message::find($request->id);
        //$science = $message->sciences->pluck('science_name');
        if($request->science){
            DB::table('message_science')->where('message_id', $request->id)->delete();
            DB::table('message_science')->insert([
                'message_id' => $request->id,
                'science_id' => $request->science,
            ]);
        }
        if($request->education){
            DB::table('education_message')->where('message_id', $request->id)->delete();
            DB::table('education_message')->insert([
                'education_id' => $request->education,
                'message_id' => $request->id,
            ]);
        }

//      validate
        $this->validate($request, [
            'subject'  => 'required',
            'science' => 'required',
            'education' => 'required',
            'message'  => 'required|min:10',
        ]);

        //store
        $message->update($request->all());


        //store images and files for message
        $files = $request->file('file');

        if($files)
        {
            foreach ($files as $file)
            {

                $filename = 'yooty_' . time() . '_' . $file->getClientOriginalName();
                Image::make($file)->save( public_path('/storage/uploads/' . $filename));

                $media = $message->media()->create([
                    'message_id' => $request->message_id,
                    'file_name' => $filename,
                ]);

            }
        }

        //redirect
        return redirect()->route('messages.show',$message->id)->with('message', 'Annonce mise à jour.');
    }


    public function destroy(Request $request)
    {
        $message = Message::find($request->message_id);

        // delete all comments for message
        DB::table('comments')->where('message_id', '=', $message->id)->delete();
        // and delete message
        $message->delete();

        //$messages = Message::all()->paginate(50);
        //return view('messages', compact('messages'))->with('message', 'Annonce supprimée.');

        return back()->with('message', 'Annonce supprimée.');
    }



    /*   ===   SEARCH   ===   */

    public function search(Request $request)
    {

        if($request->has('science') or $request->has('education') or $request->has('time_expiring') or $request->has('no_offers')){
            //filter time expiring
            if($request->time_expiring)
            {
                $date_exp = Carbon::today()->addDays(1);
                $dt_exps = DB::table('message_meta')->where('date_end', '<', $date_exp)->pluck('message_id');
                $checked_time_expiring = 'checked';
            }else{
                $dt_exps = DB::table('message_meta')->pluck('message_id');
                $checked_time_expiring = 'unchecked';
            }

            //filter time expiring
            if($request->no_offers)
            {
                $offer_ids = DB::table('message_user')->pluck('message_id');
                $checked_nooffers = 'checked';
            }else{
                $offer_ids = [];
                $checked_nooffers = 'unchecked';
            }

            //// checking the Id's for selected filters of messages
            // cheking for science
            if($request->science) {
                $science_ids = DB::table('message_science')->whereIn('science_id', $request->science)->pluck('message_id');
                $checked_science = $request->science; //save the selected position for next view
            }else{
                $science_ids = DB::table('message_science')->pluck('message_id');
                $checked_science = [];
            }

            // cheking for education level
            if($request->education) {
                $education_ids = DB::table('education_message')->whereIn('education_id', $request->education)->pluck('message_id');
                $checked_education = $request->education; //save the selected position for next view
            }else{
                $education_ids = DB::table('education_message')->pluck('message_id');
                $checked_education = [];
            }

            //selecting paid messages
            $paid_ids = DB::table('payments')->where('payment_status','=', 'succeeded')->pluck('message_id');

            // select the messages
            $messages = Message::join('message_meta','messages.id','=','message_meta.message_id')->whereIn('messages.id',$paid_ids)->whereIn('messages.id', $science_ids)->whereIn('messages.id',$education_ids)->whereIn('messages.id',$dt_exps)->whereNotIn('messages.id', $offer_ids)->where('message_meta.cost','!=',null)->orderby('message_meta.cost', 'desc')->orderby('messages.created_at', 'desc')->paginate(50);

            $users = User::all();
            $educations = Education::all();
            $sciences = Science::all();

        }else{

            $users = User::all();
            $educations = Education::all();
            $sciences = Science::all();
            $checked_science = [];
            $checked_education = [];
            $checked_time_expiring = 'unchecked';
            $checked_nooffers = 'unchecked';

            //selecting paid messages
            $paid_ids = DB::table('payments')->where('payment_status','=', 'succeeded')->pluck('message_id');

            //$messages = Message::whereIn('id',$paid_ids)->orderBy('id')->get();
            $messages = Message::join('message_meta','messages.id','=','message_meta.message_id')->whereIn('messages.id',$paid_ids)->where('message_meta.cost','!=',null)->orderby('message_meta.cost', 'desc')->orderby('messages.created_at', 'desc')->paginate(50);
            //dd($messages);

        }

        return view('search-messages', compact('messages', 'users','checked_science','educations','checked_education','sciences','checked_time_expiring','checked_nooffers'));
    }


}
