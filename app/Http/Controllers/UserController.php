<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\Education;
use App\Models\Message;
use App\Models\Science;
use App\Models\Testimonial;
use App\Models\User;
use App\Models\Userprof;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    public function update_avatar(Request $request)
    {
        // Handle the user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();

            $img = Image::make($avatar);
            // resize the image so that the largest side fits within the limit; the smaller
            // side will be scaled to maintain the original aspect ratio
            $img->resize(510, null, function ($constraint) {
                $constraint->aspectRatio();
                //$constraint->upsize();
            });
            $img->crop(500, 500);
            $img->save( public_path('/uploads/avatars/' . $filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        $user->fresh();
        return view('profiles.change-avatar', array('user' => Auth::user()));
    }

    public function update_avatar_mob(Request $request)
    {
        // Handle the user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();

            $img = Image::make($avatar);
            // resize the image so that the largest side fits within the limit; the smaller
            // side will be scaled to maintain the original aspect ratio
            $img->resize(510, 510, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->crop(500, 500);
            $img->save( public_path('/uploads/avatars/' . $filename));

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }
        $user->fresh();
        return view('profiles.info', array('user' => Auth::user()));
    }

    public function info()
    {
        $education_tags = Education::all();
        $user = Auth::user();
        return view('profiles.info', compact('user', 'education_tags'));
    }

    public function compte()
    {
        $user = Auth::user();

        $education_tags = Education::all();
        $science_tags = Science::all();
        $user = Auth::user();
        $skills = Userprof::where('user_id', '=', $user->id)->get();
        return view('profiles.mob.compte', compact('user', 'education_tags', 'science_tags', 'skills'));
    }

    public function publicprofile($id, Request $request)
    {
        $assist = 'no';
        $message_id = 0;
        $user = User::whereId($id)->firstOrFail();

        if($request->has('assistance')){
            $assist = $request->assistance;
        }

        if($request->has('message_id')) {
            $message_id = $request->message_id;
        }
stu
        if($request->has('path')){
            $backpath = $request->path;
        }
        else{
            $backpath = 0;
        }

        return view('profiles.publicprofile', compact('user', 'id', 'assist', 'message_id', 'backpath'));
    }

    public function change_avatar()
    {
        return view('profiles.change-avatar', array('user' => Auth::user()));
    }

    public function minibio()
    {
        return view('profiles.minibio', array('user' => Auth::user()));
    }

    public function skills()
    {
        $user = Auth::user();

        $education_tags = Education::all();
        $science_tags = Science::all();
        $user = Auth::user();
        $skills = Userprof::where('user_id', '=', $user->id)->get();

        return view('profiles.skills', compact('user', 'education_tags', 'science_tags', 'skills'));
    }

    public function prof(Request $request)
    {
        $user = Auth::user();

        $education_tags = Education::all();
        $science_tags = Science::all();
        $skills = Userprof::where('user_id', '=', $user->id)->get();

        if(Coach::where('coach_id', '=', $user->id)->where('coach_ready', '=', 'yes')->count() > 0){
            // you have a subscription
            return redirect()->back()->with('error-message', 'Vous ne pouvez pas changer de statut si vous avez un abonnement.');
        }else{
            if($request->prof == 'on') {
                $user->meta->prof = 'yes';
            }else{
                $user->meta->prof = 'no';
            }
            $user->meta->save();

            return redirect()->route('profiles.skills')->with(compact('user', 'education_tags', 'science_tags', 'skills'));
        }

    }

    public function addskill(Request $request)
    {
        if( $request->science == null
            || $request->education == null
            /*|| $request->tarif_week < 0
            || $request->tarif_week === null
            || $request->tarif_month < 0
            || $request->tarif_month === null*/ )
        {

            return redirect()->back()->with('error-message', 'Vous devez fixer le Matiére et le Niveau ainsi que le prix par semaine et par mois.');

        }else{
            $user = Auth::user();

            $education_tags = Education::all();
            $science_tags = Science::all();
            $skills = Userprof::where('user_id', '=', $user->id)->get();

            if($request->tarif_week < 0 || $request->tarif_week === null){ $tarif_week = 0; }
            else{ $tarif_week = $request->tarif_week; }

            if($request->tarif_month < 0 || $request->tarif_month === null){ $tarif_month = 0; }
            else{ $tarif_month = $request->tarif_month; }

            $user->userprof()->create([
                'user_id'       => $user->id,
                'science_id'    => $request->science,
                'education_id'  => $request->education,
                'tarif_week'    => $tarif_week,
                'tarif_month'   => $tarif_month,
            ]);

            return redirect()->route('profiles.skills')->with(compact('user', 'education_tags', 'science_tags', 'skills'));
        }

    }

    public function delskill(Request $request)
    {
        $user = Auth::user();

        if(Coach::where('coach_id', '=', $user->id)->where('coach_ready', '=', 'yes')->where('userprof_id', '=', $request->skill_id)->count() > 0){
            // you have a subscription for this skill
            return redirect()->back()->with('error-message', 'Мous ne pouvez pas supprimer une compétence si vous avez un abonnement pour celle-ci.');
        }else {
            Userprof::find($request->skill_id)->delete();

            $education_tags = Education::all();
            $science_tags = Science::all();
            $skills = Userprof::where('user_id', '=', $user->id)->get();

            return redirect()->route('profiles.skills')->with(compact('user', 'education_tags', 'science_tags', 'skills'));
        }
    }

    public function edittariffs(Request $request)
    {
        Userprof::find($request->id)->update([
            'tarif_week'  => $request->tarif_week,
            'tarif_month' => $request->tarif_month,
        ]);
        //$skills->fresh();
        return redirect()->back();
    }


    public function instructor()
    {
        return view('profiles.instructor', array('user' => Auth::user()));
    }

    public function subscription()
    {
        $user = Auth::user();
        $students = [];

        //separate into students and professors
        if($user->meta()->pluck('prof')->implode('') === 'yes'){
            //the user is prof
            $students_pair = Coach::where('coach_id', $user->id)->where('coach_ready', 'thinks')->get();
            foreach($students_pair as $student_pair){
                array_push($students, [User::find($student_pair->student_id), $student_pair->duration, $student_pair->userprof_id, $student_pair->id]);
            }

            return view('profiles.subscription', compact('user', 'students'));
        }
        else{
            //the user is student
            $students_pair = Coach::where('student_id', $user->id)->where('coach_ready', 'thinks')->get();
            foreach($students_pair as $student_pair){
                array_push($students, [User::find($student_pair->coach_id), $student_pair->duration, $student_pair->userprof_id, $student_pair->id]);
            }

            return view('profiles.subscription', compact('user', 'students'));
        }

    }

    public function subscription_request()
    {
        $user = Auth::user();
        $students = [];

        //separate into students and professors
        if($user->meta()->pluck('prof')->implode('') === 'yes'){
            //the user is prof
            $students_pair = Coach::where('coach_id', $user->id)->where('coach_ready', 'yes')->get();
            foreach($students_pair as $student_pair){
                array_push($students, [User::find($student_pair->student_id), $student_pair->duration, $student_pair->userprof_id, $student_pair->id]);
            }

            return view('profiles.subscription-request', compact('user', 'students'));
        }
        else{
            //the user is student
            $students_pair = Coach::where('student_id', $user->id)->where('coach_ready', 'yes')->get();
            foreach($students_pair as $student_pair){
                array_push($students, [User::find($student_pair->coach_id), $student_pair->duration, $student_pair->userprof_id, $student_pair->id]);
            }

            return view('profiles.subscription-request', compact('user', 'students'));
        }
    }

    public function notice_left()
    {
        $user = Auth::user();
        return view('profiles.notice-left', compact('user'));
    }

    public function notice_receive()
    {
        $user = Auth::user();
        return view('profiles.notice-receive', compact('user'));
    }

    public function payment_detail()
    {
        return view('profiles.payment-detail', array('user' => Auth::user()));
    }

    public function payment_history()
    {
        return view('profiles.payment-history', array('user' => Auth::user()));
    }

    public function change_pass()
    {
        return view('profiles.change-pass', array('user' => Auth::user()));
    }

    public function change_userpass(Request $request, $id)
    {

        $user = User::find($id);

        $request->validate([
           'new_pass' => 'required',
           'new_pass' => 'required|confirmed',
        ]);

        if( ! Hash::check( $request->old_pass, $user->password ))
        {
            return back()->with('error', 'Wrong old password.');
        }else{
            $user->update([
                'password' => Hash::make($request->new_pass),
            ]);

            return redirect()->route('profiles.change-pass')->with('message', 'Mot de passe mis à jour avec succès.');
        }

    }

    public function faq()
    {
        return view('profiles.faq', array('user' => Auth::user()));
    }

    public function privacy_policy()
    {
        return view('profiles.privacy-policy', array('user' => Auth::user()));
    }


    public function testimonial()
    {
        return view('profiles.testimonial', array('user' => Auth::user()));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //validate
        $this->validate($request, [
            'name' => 'required',
            'email'  => 'required',
        ]);

        $user = User::find($request->id);

        //store
        $user->update($request->all());
        //store metadata
        if($user->meta()->count())
        {
            $user->meta()->update($request->only('phone'));
        }else
        {
            $user->meta()->create($request->only('phone'));
        }

        //redirect
        return redirect()->route('profiles.info',$user->id)->with('message', 'Informations personnelles mises à jour.');
    }

    public function update_minibio(Request $request)
    {
        $user = Auth::user();
        if($user->meta()->count())
        {
            //dd('update');
            $user->meta()->update($request->only('minibio'));
        }else
        {
            //dd('create');
            $user->meta()->create($request->only('minibio'));
        }

        //redirect
        return redirect()->route('profiles.minibio', array('user' => Auth::user()))->with('message', 'Minibio a été mis à jour.');
    }

}
