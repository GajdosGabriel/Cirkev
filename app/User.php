<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Presenters;
use App\Notifications\User\VerificationUserEmail;


/**
 * App\User
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Contact[] $contacts
 * @property-read \App\Denomination $denomination
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Event[] $events
 * @property-read mixed $created_at
 * @property-read mixed $fullname
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Post[] $posts
 * @property-write mixed $first_name
 * @property-write mixed $last_name
 * @mixin \Eloquent
 */
class User extends Authenticatable
{
    use Notifiable, Presenters\UserPresenter;

    protected $guarded = ['id'];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email'
    ];


    protected static function boot() {
        parent::boot();

//        static::saved(function($user)
//        {
//            $user->createTokenRecord();
//        });

    }

    public function denomination ()
    {
        return $this->belongsTo('App\Denomination')->orderBy('id', 'desc');
    }

    public function posts()
    {
        return $this->hasMany('App\Post')->orderBy('created_at', 'desc');
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function messengers()
    {
        return $this->hasMany(Messenger::class, 'requested_user');
    }

    public function messenger()
    {
        return $this->hasMany(Messenger::class);
    }

    public function verifications()
    {
        return $this->hasMany(UserVerification::class);
    }


    public function getCreatedAtAttribute( $value )
    {
        return localized_date('j. M Y', $value);
    }


    public function setFirstNameAttribute($value)
    {
        $this->attributes['firstName'] = ucfirst($value);
        $this->attributes['slug'] = str_slug($this->firstName . '-'. $this->lastName);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['lastName'] = ucfirst($value);
    }

    public function getFullnameAttribute()
    {
        return $this->firstName . ' '. $this->lastName;
    }

    public function isAdmin()
    {
//        return $this->roles === 'admin';

        return in_array($this->email, ['gajdosgabo@gmail.com']);
    }


//----------------------- User Verification -------------------------
    public function createTokenRecord()
    {

        $token = $this->verifications()->create([
            'token' => bin2hex(random_bytes(32)),
            'email' => $this->email
        ]);
//        $this->sendTokenEmail($token);
    }
//-----------------------End User Verification -------------------------



}
