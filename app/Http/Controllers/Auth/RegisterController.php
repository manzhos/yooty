<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\Usermeta;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use \Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/profile';//RouteServiceProvider::HOME;

    /*
    protected function redirectTo()
    {
        return Request::session()->get('url.intended') && '/profile';
    }
    */

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name'      => ['required', 'string', 'max:255'],
            'surname'   => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'  => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        // create avatar from Initials
        $avatar_source = file_get_contents('uploads/avatars/Avatar.svg');
        $name = $data['name'];
        $surname = $data['surname'];
        $letters = $name[0].$surname[0];

        $avatar_source = str_replace('YT', $letters, $avatar_source);

        $gen_avatar = md5($letters).'.svg';
        file_put_contents('uploads/avatars/'.$gen_avatar, $avatar_source);

        // create new User
        $create = User::create([
            'name'      => $name,
            'surname'   => $surname,
            'email'     => $data['email'],
            'password'  => Hash::make($data['password']),
        ]);

        // add genarated from initials the avatar
        DB::table('users')->where('id','=',$create->id)->update(['avatar' => $gen_avatar,]);

        Usermeta::create([
            'user_id' => $create->id,
            'prof' => 'no',
        ]);

        Role::create([
            'user_id' => $create->id,
            'role' => 'user',
        ]);

        return $create;

    }
}
