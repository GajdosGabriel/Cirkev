<?php

namespace App\Http\Controllers;

use App\Services\UserToken;
use App\User;
use Illuminate\Http\Request;
use App\Notifications\UserNewRegistration;
use Illuminate\Notifications\Notifiable;




class UserVerificationController extends Controller
{
    use Notifiable;

    /**
     * @var UserToken
     */
    protected $userToken;

    public function __construct(UserToken $userToken)
    {
        $this->userToken = $userToken;
    }


    public function verify($email,$token)
    {
        $this->userToken->getToken($email, $token);

        flash()->success('Účet je overený, ďakujeme.');

        \Auth::login($this->userToken->getUser());
        return redirect('/');
    }




    public function resend($email)
    {

        $this->userToken->checkIfEmailExist($email);

        flash()->success('Email vám bol zaslaný.');
        return redirect('/');
    }





}


