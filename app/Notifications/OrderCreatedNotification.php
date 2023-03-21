<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderCreatedNotification extends Notification
{
    use Queueable;
    protected $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail',"database"];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $addr = $this->order->billingAdress;
        return (new MailMessage)
                    ->subject("new Order #".$this->order->numder)
                    ->greeting("Hi {$notifiable->name},")
                    ->line(" A new order #{$this->order->numder} created by {$addr->first_name} from {$addr->country}")
                    ->action('View Order', url('/dashbord'))
                    ->line('Thank you for using DaStore!');
    }

    public function toDatabase($notifiable)
    {
        $addr = $this->order->billingAdress;
        return 
        [
            "body" => " A new order #{$this->order->numder} created by {$addr->first_name} from {$addr->country}",
            "icon" => "fas fa-file",
            "url" => url("/dashboard"),
            "order_id" => $this->order->id
        ];
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
