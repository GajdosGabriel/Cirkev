<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Group
 *
 * @property-write mixed $name
 * @mixin \Eloquent
 */
class Group extends Model
{
    protected $fillable = [ 'slug', 'name', 'id' ];

    public function posts() {

        return $this->hasMany ('App\Post')->orderBy('created_at', 'desc');
    }



    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug']  = str_slug($value);
        $this->attributes['name'] = ucfirst($value);
    }
}
