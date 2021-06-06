<?php

namespace App\Listeners;

use App\Events\PostEvent;
use App\Notifications\PostNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostEventListener implements ShouldQueue
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
     * @param  PostEvent  $event
     * @return void
     */
    public function handle(PostEvent $event)
    {
        $type = $event->type;
        $post = $event->post;
        $user = $post->user;
        $user->notify(new PostNotification($type, $post));
    }
}
