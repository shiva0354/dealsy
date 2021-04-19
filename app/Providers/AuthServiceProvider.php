<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\PostImage;
use App\Models\PostVideo;
use App\Policies\PostImagePolicy;
use App\Policies\PostPolicy;
use App\Policies\PostVideoPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        Post::class => PostPolicy::class,
        PostImage::class => PostImagePolicy::class,
        PostVideo::class => PostVideoPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
