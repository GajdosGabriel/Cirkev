<?php

namespace App;

use App\Notifications\CommentNewNotify;
use App\Notifications\PostWasUpdated;
use Illuminate\Database\Eloquent\Model;

/**
 * App\PostSubscription
 *
 * @property-read \App\Post $post
 * @property-read \App\User $user
 * @mixin \Eloquent
 */
class PostSubscription extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function notify($comment) {
        $this->user->notify(new CommentNewNotify($comment));
    }
}
