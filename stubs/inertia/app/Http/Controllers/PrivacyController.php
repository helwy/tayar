<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class PrivacyController extends Controller
{
    /**
     * Display the privacy policy page.
     *
     * @return Response
     */
    public function index(): Response
    {
        $locale = app()->getLocale();
        return Inertia::render('Privacy/' . $locale, [
            'app_name' => config('app.name'),
            'contact_email' => config('app.contact_email'),
        ]);
    }
}
