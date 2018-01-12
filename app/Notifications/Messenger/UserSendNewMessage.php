<?php

namespace App\Notifications\Messenger;

use App\Messenger;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserSendNewMessage extends Notification
{
    use Queueable;

    protected $message;
    public function __construct(Messenger $message)
    {
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            ->subject( $this->message->owner->fullName . ', Vám zaslal správu')
            ->greeting('Dobrý deň,')
            ->line($this->message->body)
            ->line('Správa bola zaslaná prostretníctvom CirkevOnline.sk - Kresťanský portál.')
            ->action('Odpovedať na správu', url('/'))
            ->line('Ďakujeme že na otázku skoro odpoviete!');
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
            //
        ];
    }
}
