<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PostNotification extends Notification
{
    use Queueable;

    public $type, $post;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($type, $post)
    {
        $this->type = $type;
        $this->post = $post;
        $this->user_name = $post->user->name;

        $this->subjects = [
            'post.published' => "A new Charger - $this->charger_code is assigned to you",
            'post.rejected' => "Your Charger - $this->charger_code is detached",
            'post.sold' => "Your Charger - $this->charger_code is updated",
        ];

        $this->messages = [
            'post.approved' => "Dear Owner $this->user_name, A new charger is assigned to you. Charger - $this->charger_code",
            'post.rejected' => "Dear Owner $this->user_name, Your charger - $this->charger_code is detached from you.For further information visit your Massive Account",
            'post.sold' => "Dear Owner $this->user_name, Your charger - $this->charger_code details has been updated.For further information visit your Massive Account",
        ];
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
            ->line("Dear $this->user_name")
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
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
