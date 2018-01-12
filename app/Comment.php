<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id', 'user_id', 'body'
    ];

    public function user() {

        return $this->belongsTo('App\User');
    }

    public function post() {

        return $this->belongsTo('App\Post');
    }

    public function comments () {

        return $this->belongsTo('App\Post')->withCount('favorites');
    }

    public function favorites() {
        return $this->morphMany(Favorite::class, 'favorited');
    }

    public function favorite() {

        if( ! $this->favorites()->where(['user_id' => auth()->id()])->exists()) {
        $this->favorites()->create(['user_id' => auth()->id()]);
        }

    }

    public function isFavorited() {

        return $this->favorites()->where('user_id', auth()->id())->exists();

    }





}
