<?php

namespace App;

use App\Notifications\Events\EventWasCreated;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Notifications\Notifiable;

/**
 * App\Event
 *
 * @property-read mixed $date_start
 * @property-read mixed $is_subscribed_to
 * @property-read mixed $rich_text
 * @property-read mixed $subscribed_for_record
 * @property-read mixed $subscribed_to_event
 * @property-read mixed $time_start
 * @property-read mixed $wants_record
 * @property-read \App\Image $image
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-write mixed $body
 * @property-write mixed $title
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\EventSubscription[] $subscriptions
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Event activeEventsList()
 * @mixin \Eloquent
 */
class Event extends Model
{
    use Notifiable;

    protected $guarded = [];


    public function scopeActiveEventsList($query)
    {
        return $query->where('dateStart', '>', Carbon::now()->subHours(2))->wherePublished(1)->orderBy('dateStart','asc');
    }


    public function image()
    {
        return $this->hasOne(Image::class);
    }

    // Author of event
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucfirst($value);
        $this->attributes['slug']  = str_slug($value);
    }

    public function setBodyAttribute($value)
    {
        $this->attributes['body'] = cleanBody($value);

    }

    public function getRichTextAttribute()
    {
        return htmlspecialchars_decode ( add_paragraphs( filter_url( e($this->body)) ) );
    }

    public function displayStatus()
    {
        if( $this->dateStart > Carbon::now())
        {
            return true;
        }
    }

    public function getDateStartAttribute($value)
    {
        return Carbon::parse($value);
//        $toto = \Carbon\Carbon::parse($value);

//        return  localized_date( 'j. l F a ', $toto );
    }

    public function getTimeStartAttribute($value)
    {
        return  Carbon::parse($value);
    }


    public function subscriptions() {
        return $this->hasMany(EventSubscription::class);
    }


//    public function subscribe( $userId = null) {
//        if( ! $this->subscriptions()->where('user_id', $userId ?: auth()->id() )->exists()) {
//            return  $this->subscriptions()->create(['user_id' => $userId ?: auth()->id(), 'record' => request('record') ?: null ]);
//
//        }
//    }

    public function getIsSubscribedToAttribute() {
        return $this->subscriptions()->where('user_id', auth()->id())->where('registration', 1)->exists();
    }

    public function getWantsRecordAttribute() {
        return $this->subscriptions()->where('user_id', auth()->id())->where('record', 1)->exists();
    }

    public function getSubscribedToEventAttribute() {
        return $this->subscriptions()->where('record', null)->get();
    }

    public function getSubscribedForRecordAttribute() {
        return $this->subscriptions()->where('record', 1)->get();
    }







}