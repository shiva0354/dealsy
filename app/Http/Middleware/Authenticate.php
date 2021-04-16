<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    private $guards;

    protected function unauthenticated($request, array $guards)
    {
        $this->guards = $guards;
        parent::unauthenticated($request, $guards);
    }

    protected function redirectTo($request)
    {
        // if (!$request->expectsJson()) {
        //     $guard = $this->guards[0] ?? null;
        //     return $guard ? route("$guard.login") : route('login');
        // }

        $guard = $this->guards[0] ?? null;
        return $guard ? route("$guard.login") : route('login');
    }
}
