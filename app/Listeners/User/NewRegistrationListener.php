<?php

namespace App\Listeners\User;

use App\Events\User\NewRegistrationEmail;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewRegistrationListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewRegistrationEmail  $event
     * @return void
     */
    public function handle(NewRegistrationEmail $event)
    {
        $user = $event->user;

//        Darček knihy na stiahnutie

        \Mail::send('emails.userCreateNotification',
            array(
                'user' => $user,
                'email' => $user->email

            ), function($message) use ($user)
            {
                $message->from('admin@cirkevonline.sk');
                $message->to($user->email, 'Admin')
//                        ->bcc('gajdosgabo@gmail.com', 'Admin')
                    ->subject('Darček kresťanských kníh za registráciu od Cirkev-Online.sk', $user->firstname);
            });
    }
}
