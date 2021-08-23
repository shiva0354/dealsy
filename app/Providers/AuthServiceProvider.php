<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Post;
use App\Models\PostImage;
use App\Models\PostVideo;
use App\Policies\PostImagePolicy;
use App\Policies\PostPolicy;
use App\Policies\PostVideoPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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

        Gate::define('perform_seo', function ($admin) {
            return ($admin instanceof Admin && ($admin->role == 'SUPER ADMIN' || $admin->role == 'SEO AGENT')) ? Response::allow() : Response::deny('You are not authorize to perform seo related tasks.');
        });

        Gate::define('super_admin', function ($admin) {
            return ($admin instanceof Admin && $admin->role == 'SUPER ADMIN') ? Response::allow() : Response::deny('You are not authorize to see this.');
        });
    }
}
