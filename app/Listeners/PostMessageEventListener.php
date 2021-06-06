<?php

namespace App\Listeners;

use App\Events\PostMessageEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostMessageEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PostMessageEvent  $event
     * @return void
     */
    public function handle(PostMessageEvent $event)
    {
        //
    }
}
