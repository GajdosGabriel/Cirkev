<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 06.01.2018
 * Time: 17:46
 */

namespace App\Services;

use App\UserVerification;
use App\Notifications\User\UserWelcomeEmail;
use App\Notifications\User\VerificationUserEmail;

class UserToken
{
    protected $userVerification;
    protected $tokenRow;

    public function __construct(UserVerification $userVerification)
    {
        $this->userVerification = $userVerification;
    }



    public function getToken($email, $token)
    {
        $this->tokenRow  = $this->userVerification->where('email', $email)->first();

        $this->checkOrginalLink($token);
    }

    public function getUser()
    {
        if (!$this->tokenRow) abort(403);
        return $this->tokenRow->user;
    }

    protected function checkOrginalLink($token)
    {
        if( $token != $this->tokenRow->token) abort('403', 'Link nie je autentický.');
        $this->updateStatus();
    }

    protected function updateStatus()
    {
        $this->tokenRow->update(['verified' => true]);
        $this->tokenRow->user->update(['verified' => true]);

        $this->tokenRow->user->notify(new UserWelcomeEmail($this->tokenRow->user));

        $this->publishedPosts();
    }

    protected function publishedPosts()
    {
        $this->tokenRow->user->posts->where('created_at','>', $this->tokenRow->createdAt)
            ->each->update(['published' => true]);
    }


////////////////////////////////////////////////////////////////


    public function checkIfEmailExist($email)
    {
        $this->userVerification->whereEmail($email)->exists() ? $this->findByEmail($email) : $this->createTokenRecord($email);
    }


    protected function findByEmail($email)
    {
        $this->tokenRow = $this->userVerification->whereEmail($email)->first();

        $this->updateUserStatus();
    }


    public function createTokenRecord($email)
    {
        $this->tokenRow = $this->userVerification->create([
            'token' => bin2hex(random_bytes(32)),
            'email' => $email,
            'user_id' => auth()->user()->id
        ]);
        $this->updateUserStatus();
    }

    protected function updateUserStatus()
    {
        $this->tokenRow->user->update(['verified' => $this->tokenRow->verified]);
        $this->sendTokenEmail();
    }


    protected function sendTokenEmail()
    {
        if($this->tokenRow->verified == null){
            $this->tokenRow->user->notify(new VerificationUserEmail($this->tokenRow));
        }
    }

}
