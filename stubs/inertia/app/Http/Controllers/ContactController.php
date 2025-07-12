<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class ContactController extends Controller
{
    /**
     * Display the contact page.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Inertia::render('ContactPage', [
            'app_name' => config('app.name'),
            'contact_email' => config('app.contact_email'),
            'github' => config('app.github_repo'),
            'linkedin' => config('app.linkedin'),
            'mastodon' => config('app.mastodon'),
            'bluesky' => config('app.bluesky'),
            'threads' => config('app.threads'),
            'twitter' => config('app.twitter'),
        ]);
    }
}
