<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request and set the locale based on the user's cookie and database.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = null;

        if (isset($_COOKIE['language_code'])) {
            $locale = $_COOKIE['language_code'];
        } else if (Auth::check()) {
            $userLangauge = Auth::user()->language;

            if ($userLangauge) {
                $locale = $userLangauge;
            }
        }

        App::setLocale($locale ?? config('app.locale'));

        return $next($request);
    }
}
