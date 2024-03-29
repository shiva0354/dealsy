<?php

namespace App\Providers;

use App\Events\PostEvent;
use App\Events\PostMessageEvent;
use App\Listeners\PostEventListener;
use App\Listeners\PostMessageEventListener;
use App\Models\Category;
use App\Observers\CategoryObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        PostEvent::class => [
            PostEventListener::class,
        ],
        PostMessageEvent::class => [
            PostMessageEventListener::class,
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
    }
}
