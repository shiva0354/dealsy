<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (isset($_COOKIE['lang'])) {
            App::setLocale($_COOKIE['lang']);
        } else {
            App::setLocale('en');
        }
        return $next($request);
    }
}
