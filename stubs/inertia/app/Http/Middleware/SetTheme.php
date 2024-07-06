<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class SetTheme
{
    /**
     * Handle an incoming request and set the theme based on the user's cookie and database.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $locale = null;

        if (isset($_COOKIE['dark_theme'])) {
            $darkTheme = $_COOKIE['dark_theme'];
        } else if (Auth::check()) {
            $userTheme = Auth::user()->dark_theme;

            if (isset($userTheme) && !$userTheme) {
                $darkTheme = 'light';
            }
        }

        App()->dark_theme = $darkTheme ?? 'dark';

        return $next($request);
    }
}
