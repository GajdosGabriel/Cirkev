<?php

namespace App\Notifications\user;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserWelcomeEmail extends Notification
{
    use Queueable;


    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $user;
    public function __construct(User $user)
    {
        $this->user = $user;
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
            ->subject($this->user->firstName. ', účet je overený || cirkevonline.sk'  )
            ->greeting('Vitajte na palube.')
            ->line('<h2>Potvrdzujeme overenie registrácie na portály <a href="' . url('/'). '">Cirkevonline.sk</a></h2>')
            ->action('Zobraziť svoj profil', route('user.edit', [$this->user->id, $this->user->slug]) )
            ->salutation('S pozdravom,')
            ->line('administrátor webu.');
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
            'USER' => $this->user->firstName,
            'TODO' => 'Vytvorený profil',
            'LINK' => $this->user->id. '/'. $this->user->slug,
        ];
    }
}
