<?php

namespace App\Notifications\Events;

use App\EventSubscription;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserWasSubscribeToEvent extends Notification
{
    use Queueable;

    protected $eventSubscription;
    public function __construct(EventSubscription $eventSubscription)
    {
        $this->eventSubscription = $eventSubscription;
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
                    ->subject($this->eventSubscription->event->title . ' | Prihlásil sa ' . $this->eventSubscription->user->fullName)
                    ->line( '<strong>' . $this->eventSubscription->user->fullName . '</strong> sa prihlásil na podujatie. ' . $this->eventSubscription->event->title)
                    ->action('Zoznam prihlásených', url( $this->eventSubscription->user->id .'/' . $this->eventSubscription->user->slug. '/akcie/admin'))
                    ->line('Používate skvelý publikačný nástroj!');
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
