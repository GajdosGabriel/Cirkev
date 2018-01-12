<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Denomination
 *
 * @property-read \App\User $user
 * @mixin \Eloquent
 */
class Denomination extends Model
{
    public function user ()
    {
        return $this->belongsTo('App\User');
    }
}
