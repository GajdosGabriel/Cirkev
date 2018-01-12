<?php
/**
 * Created by PhpStorm.
 * User: Gabriel
 * Date: 26.12.2017
 * Time: 15:37
 */

namespace App\Repositories;


use App\User;

class UserRepository
{

    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll()
    {
        return $this->user->all();
    }

    public function getUser($id,$slug)
    {
        $user = $this->user->whereId($id)->firstOrFail();
        if ($user->slug != $slug) return abort(404);
        return $user;
    }


}