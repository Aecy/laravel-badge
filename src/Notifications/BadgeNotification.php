<?php

namespace Aecy\Badge\Notifications;

use Aecy\Badge\Badge;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BadgeNotification extends Notification
{
    use Queueable;

    private $badge;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Badge $badge)
    {
        $this->badge = $badge;
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
                ->line("You've unlocked the Badge : {$this->badge->name}")
                ->action("Delete the Badge", url('/'))
                ->line('Thank you for using the package of @aecyMV');
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
            'name' => $this->badge->name
        ];
    }

    public static function toString($data)
    {
        return 'You have unlocked the badge : ' . $data['name'];
    }
}
