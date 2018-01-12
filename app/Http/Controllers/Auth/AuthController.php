<?php

namespace App\Http\Controllers\Auth;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use App\User;
use Socialite;




class AuthController extends Controller
{


    /**
     * Redirect the user to the Social Provider authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($service)
    {
        return Socialite::driver($service)->redirect();
    }

    /**
     * Obtain the user information from GitHub, Facebook and other.
     *
     * @return Response
     */
    public function handleProviderCallback(Request $request, $service)
    {
        $oauth_user = Socialite::driver($service)->user();

        if (!$user = User::whereEmail($oauth_user->email)->first())
        {
            // get last word from FB
            $secondword = explode(' ', $oauth_user->name);
            $user = User::create([
                'lastName' => strtok($oauth_user->name, " "),
                'firstName' => array_pop($secondword),
                'email' => $oauth_user->email,
//              'avatar' => $oauth_user->avatar_original,
                'password' => bcrypt('registracnyformularheslo'),
                'verified' => 1
            ]);

            Auth::login($user);

            return redirect('/');
        }

        Auth::login($user, false);

        if($user->disabled)
        {
            Auth::logout();
            flash()->error('Váš účet je blokovaný! Kontaktujte administrátora');
            return redirect('/login');
        }

        return redirect('/#');
    }
}

//$mojeId = 10210330432153356;