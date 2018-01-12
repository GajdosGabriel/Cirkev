<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;


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
    protected $redirectTo = '/';

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
        if( env('APP_ENV') === 'production' ) {
            $requiredcaptcha = 'required|captcha';
        }else{
            $requiredcaptcha = '';
        }
            return Validator::make($data, [
                'firstName' => 'required|max:50',
                'lastName' => 'required|max:50',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6|confirmed',
                // 'iamHuman' => 'required|integer|between:5,5',
               'g-recaptcha-response' => $requiredcaptcha
            ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'email' => $data['email'],
            'slug' => str_slug($data['firstName'] . '-' . $data['lastName']),
            'password' => bcrypt($data['password']),
        ]);
    }


        // Override function from RegistersUsers trait. LogOut after registration.
    protected function registered(Request $request, $user)
    {

        //  $this->guard()->logout();
        //
        //   return redirect('/login')->withInfo('Please verify your email');
    }

}
