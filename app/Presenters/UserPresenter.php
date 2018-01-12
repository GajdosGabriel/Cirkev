<?php

namespace App\Presenters;


trait UserPresenter
{

    //    ------------------ Start of  Path -------------------------
    public function userSmallPictureUrl()
    {
        return 'users/' . $this->id . '/' . 'small-'. $this->avatar;
    }


    public function userPictureUrl()
    {
        return 'users/' . $this->id . '/' . $this->avatar;
    }

//    ------------------ End of Path -------------------------







}