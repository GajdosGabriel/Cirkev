<?php

namespace App\Listeners;

use App\Events\CommentNewNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CommentNewNotificationListener
//    implements ShouldQueue
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
     * @param  CommentNewNotification  $event
     * @return void
     */
    public function handle(CommentNewNotification $event)
    {
        $comment = $event->comment;

        \Mail::send ('emails.CommentNewNot',
            $data = array(
                'comment' => $comment,
                'userEmail'=> $comment->user->email,
                'userName'=> $comment->user->firstName
            ), function($message) use($data)
            {
                $message->from('admin@cirkevonline.sk', 'Cirkev-Online');
                $message->to( $data['userEmail'], $data['userName'])->subject('Váš článok bol komentovaný');
            });

    }
}
