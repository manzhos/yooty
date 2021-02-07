<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    protected $redirectTo = '/home';

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        //$socialUser = Socialite::driver($provider)->user();



        //dd($user['first_name']);

        switch($provider){
            case 'facebook':
                $driver = Socialite::driver('facebook')
                    ->fields([
                        'first_name',
                        'last_name',
                        'email'
                        //'profile_pic'
                    ]);
                // retrieve the user
                $socialUser = $driver->user();
                $first_name = $socialUser['first_name'];
                $last_name =  $socialUser['last_name'];
                break;

            case 'google':
                $socialUser = Socialite::driver('google')->user();
                $first_name = $socialUser['given_name'];
                $last_name =  $socialUser['family_name'];
                break;

/*
            case 'snapchat':
                $socialUser = Socialite::driver('snapchat')->user();
                $first_name = $socialUser['display_name'];
                $last_name =  $socialUser['display_name'];
                break;
*/

            // Also add more provider option e.g. linkedin, twitter etc.

            default:
                $first_name = $socialUser->getName();
                $last_name = $socialUser->getName();
        }

        $user = User::where('email', $socialUser->getEmail())->first();

        if (!$user) {
            $user = User::create([
                'name'    => $first_name,
                'surname' => $last_name,
                'email'   => $socialUser->getEmail(),
                //'avatar' => $socialUser->getAvatar()
            ]);
        }

        // login the user
        Auth::login($user, true);

        //return redirect($this->redirectTo);
        return redirect()->route('profiles.info',$user);

    }

}
