<?php

namespace App\Notifications;

use App\Models\Offer;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Kutia\Larafirebase\Messages\FirebaseMessage;

class NewOrder extends Notification
{
    use Queueable;

    protected $title;
    protected $message;
    protected $data;
    /**
     * Create a new notification instance.
     */
    public function __construct($data)
    {
        $order = Order::find($data['offer_id']);
        $customerName = $order->customer->name;

        $this->data = $data;

        $this->message =  '  لقد تم اضافة  طلب  جديد في' . '('.$customerName.')';

        $this->title ='🎉 ' . 'طلب جديد' . ' 🎉' ;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail','firebase','database'];
    }

        public function toFirebase($notifiable)
    {
        return (new FirebaseMessage)
            ->withTitle($this->title)
            ->withBody($this->message)
            ->withPriority('high')->asNotification([$this->data['fcm_token']]);
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->greeting($this->title)
            ->subject($this->title)
            ->line($this->message);
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' =>  $this->title,
            'message' =>  $this->message,
            'status' => 2,
            'order_id' => $this->data['order_id']
        ];
    }
}
