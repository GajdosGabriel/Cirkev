<?php

namespace App\Listeners;

use App\Events\PostVisitedNotification;
use App\Mail\Posts\NotificationArticleReading;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PostVisitedListener
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
     * @param  PostVisitedNotification  $event
     * @return void
     */
    public function handle(PostVisitedNotification $event)
    {
        //Counting show post view
        \DB::table('posts')->where('id', $event->post->id)->increment('count_view');

        //Sending notification email about article reading
        if ( $event->post->count_view == 103 || $event->post->count_view == 305 || $event->post->count_view == 605 || $event->post->count_view == 1005
            AND $event->post->user->send_email == 1 )
        {
            \Mail::to($event->post->user)->send(new NotificationArticleReading($event->post));
        }
    }
}
