<?php

namespace App\Listeners;

use App\Events\PostMessageEvent;
use App\Notifications\UserMessageNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostMessageEventListener implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param  PostMessageEvent  $event
     * @return void
     */
    public function handle(PostMessageEvent $event)
    {
        $message = $event->message;
        $user = $message->post->user;
        $user->notify(new UserMessageNotification($message->post));
    }
}
