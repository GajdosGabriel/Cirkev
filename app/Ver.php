<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Ver
 *
 * @mixin \Eloquent
 */
class Ver extends Model
{
    protected $fillable = [ 'slug' ];


    public $timestamps = false;
}
