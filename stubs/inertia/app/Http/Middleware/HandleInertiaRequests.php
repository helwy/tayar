<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
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

        return [
            ...parent::share($request),
            'ziggy' => fn () => [
                ...(new Ziggy)->toArray(),
                'location' => $request->url(),
            ],
            'current_locale' => $locale ?? config('app.locale'),
            'available_locales' => config('jetstream.available_locales'),
        ];
    }
}
