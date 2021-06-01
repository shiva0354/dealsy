<?php

namespace App\Http\Middleware;

use App;
use Closure;
use Illuminate\Http\Request;

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
        $locale =  isset($_COOKIE['lang'] ) ? $_COOKIE['lang'] : app()->config->get('app.fallback_locale');
        if (!in_array($locale, ['en', 'hi'])) {
            App::setLocale(app()->config->get('app.fallback_locale'));
            return $next($request);
        }
        App::setLocale($locale);
        return $next($request);
    }
}
