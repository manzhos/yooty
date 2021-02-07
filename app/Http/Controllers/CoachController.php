<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Meta;
use App\Models\Science;
use App\Models\User;
use App\Models\Coach;
use App\Models\Usermeta;
use App\Models\Userprof;
use App\Notifications;
use App\Events\IamYourCoach;
use App\Notifications\beMyCoach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Stripe\Charge;
use Stripe\Stripe;

class CoachController extends Controller
{
    use Notifiable;

    public function search()
    {
        $science_tags = json_encode(Science::all());
        $education_tags = json_encode(Education::all());

        return view('search-coach', compact('science_tags','education_tags'));
    }

    public function list(Request $request)
    {
        //selecting all for education request
        $user_education_ids = Userprof::where('education_id', $request->education)->pluck('user_id');

        //selecting all for science request
        $user_science_ids = Userprof::where('science_id', $request->science)->pluck('user_id');

        //selecting all prof particulier
        $user_profs_ids = Usermeta::where('prof', 'yes')->pluck('user_id');

        //select duration
        $duration = $request->duration;

        $users = User::all()->whereIn('id',$user_profs_ids)->whereIn('id',$user_education_ids)->whereIn('id',$user_science_ids);
        $userprof_ids = Userprof::where('science_id', $request->science)->where('education_id', $request->education)->get();

        return view('messages.coachlist', compact('users','duration', 'userprof_ids'));
    }

    public function apply(Request $request)
    {
        // define who is student
        $student = Auth::user();

        //check student payment data
        if ($student->stripe_id === null){
            return redirect()->route('profiles.payment-detail', array('user' => Auth::user()))->with('message', 'Pour vous abonner, veuillez enregistrer vos données de paiement et réessayer.');
        } else {
            if (isset($request->user)) {
                foreach ($request->user as $user) {
                    // check for subscription
                    if (null !== Coach::where('coach_id', $user)->where('student_id', Auth::user()->id)->get()) {
                        // if the subscription is new, create it
                        $coach = new Coach();
                        $coach->student_id = Auth::user()->id;
                        // define who selected as coach
                        $coach->coach_id = $user;
                        $coach->duration = $request->duration;

                        $userprof_id = Userprof::where('user_id', $user)->whereIn('id', $request->userprof_ids)->pluck('id')->implode('');
                        //dd($userprof_id);
                        $coach->userprof_id = $userprof_id;

                        $coach->save();

                        $data = [];
                        array_push($data, [$student, $request->duration, $userprof_id]);

                        // sending the notification to user selected as coach
                        $user_be_coach = User::findOrFail($user);
                        $user_be_coach->notify(new beMyCoach(json_encode($data)));
                    } else {
                        //
                    }
                }
                return view('messages.coachapply');
            } else {
                return view('messages.coachreapply');
            }
        }
    }

    public function readytocoach(Request $request)
    {
        //dd($request->id, $request->duration, $request->userprof_id);
        $student = User::findOrFail($request->id);
        $coach = Auth::user();
        $coach_pair = Coach::find($request->coach_pair_id);
        $coach_pair->coach_ready = 'yes';
        $coach_pair->save();
        $mess = json_encode($coach);
        $file = json_decode($mess ,true);
        $file += ['student' => $student->id];
        $mess = json_encode($file);

        //Charge the payment from the student
        Stripe::setApiKey(env('STRIPE_SECRET'));

        if($request->duration === 'week') {
            $amount = Userprof::find($request->userprof_id)->tarif_week*100;
        } elseif ($request->duration === 'month') {
            $amount = Userprof::find($request->userprof_id)->tarif_month*100;
        } else {
            return back()->with('error', 'we have an error');
        }

        Charge::create(array(
            "amount" => $amount, // amount in cents
            "currency" => env('STRIPE_CURRENCY'),
            "customer" => $student->stripe_id
        ));

        //dd('YOU have payment');

        event(new IamYourCoach($mess));
        return view('messages.readytocoach', compact('student'));
    }

    public function notcoach(Request $request)
    {
        $student = User::findOrFail($request->id);
        $user = Auth::user();

        Coach::find($request->coach_pair_id)->delete();

        $mess = json_encode($user);
        $file = json_decode($mess ,true);
        $file += ['student' => $student->id];
        $mess = json_encode($file);
        //event(new IamNotYourCoach($mess));

        $students = [];

        //separate into students and professors
        if($user->meta()->pluck('prof')->implode('') === 'yes'){
            //the user is prof
            $students_pair = Coach::where('coach_id', $user->id)->where('coach_ready', 'thinks')->get();
            foreach($students_pair as $student_pair){
                array_push($students, [User::find($student_pair->student_id), $student_pair->duration, $student_pair->userprof_id]);
            }

            return view('profiles.subscription', compact('user', 'students'));
        }
        else{
            //the user is student

            $students_pair = Coach::where('student_id', $user->id)->where('coach_ready', 'thinks')->get();
            foreach($students_pair as $student_pair){
                array_push($students, [User::find($student_pair->coach_id), $student_pair->duration, $student_pair->userprof_id]);
            }

            return view('profiles.subscription', compact('user', 'students'));
        }
    }
}
