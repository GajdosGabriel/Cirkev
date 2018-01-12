<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use League\Flysystem\Exception;
use Illuminate\Http\Request;



class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    protected $loginPath = '/login';
    protected $redirectAfterLogout = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
        \Session::put('backUrl', \URL::previous());
    }


    public function redirectTo()
    {
        return \Session::get('backUrl') ? \Session::get('backUrl') :   $this->redirectTo;
    }

        // Logout User if user is disabled.
    protected function authenticated(Request $request, $user)
    {
        if( $user->disabled)
        {
            $this->guard()->logout();
            flash()->error('Váš účet je blokovaný! Kontaktujte administrátora');
            return redirect('/login');
        }
    }



}
