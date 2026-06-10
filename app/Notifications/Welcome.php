<?php

namespace  App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;

class Welcome extends Notification
{
    use Queueable;
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function via($notifiable)
    {
        return ['firebase','database'];
    }

    public function toFirebase($notifiable)
    {
        return (new FirebaseMessage)
        ->withTitle('اهلا بك في عائلتنا 👋')
        ->withBody(' نرحب بك لانضمامك أصبحت جزء منا مرحباً بك ')
            ->withPriority('high')->asNotification([$this->data['fcm_token']]);
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'اهلا بك في عائلتنا ',
            'url' => '',
        ];
    }
}
