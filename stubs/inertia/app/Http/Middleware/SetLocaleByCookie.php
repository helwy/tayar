<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleByCookie
{
    /**
     * Handle an incoming request and set the locale based on the user's cookie.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (isset($_COOKIE['language_code'])) {
            App::setLocale($_COOKIE['language_code']);
        } else {
            App::setLocale(config('app.locale'));
        }

        return $next($request);
    }
}
