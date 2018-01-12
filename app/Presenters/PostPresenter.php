<?php

namespace App\Presenters;


trait PostPresenter
{

    public function postShow()
    {
        return 'post/' . $this->id . '/'. $this->slug;
    }

    public function postDelete()
    {
        return 'post/' . $this->id . '/'. $this->slug . '/delete';
    }

    public function postEdit()
    {
        return 'post/' . $this->id . '/'. $this->slug . '/edit';
    }

    //    ------------------ Path to Images -------------------------
    public function videoImageUrl()
    {
        return 'posts/' . $this->id . '/' . $this->slug . '.jpg';
    }

    public function pictureUrl()
    {
        return 'posts/' . $this->id . '/' . 'small-'. $this->picture;
    }

    public function userPictureUrl()
    {
        return 'users/' . $this->user->id . '/' . $this->user->avatar;
    }
//    ------------------ End of Path -------------------------




}