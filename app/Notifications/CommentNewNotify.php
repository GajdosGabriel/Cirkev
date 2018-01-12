<?php

namespace App\Notifications;

use App\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CommentNewNotify extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $comment;
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Nový komentár ' . $this->comment->post->title)
            ->greeting('Dobrý deň')
                    ->line('Pod váš článok pribudol nový komentár. <h3>' . $this->comment->user->firstName . ' píše:</h3>')
                    ->line($this->comment->body)
                    ->action('Zobraziť komentár', url('/', $this->comment->post->slug) . '/#comment-' . $this->comment->id)
                    ->line('Ďakujeme že odpoviete na komentár!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'USER' => $this->comment->user->firstName,
            'TODO' => 'Nový komentár ' . str_limit($this->comment->post->title, 30),
            'LINK' => $this->comment->post->slug,
        ];
    }
}
