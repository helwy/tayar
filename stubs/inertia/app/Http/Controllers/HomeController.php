<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display the admin home page.
     *
     * @param Request $request
     * @return \Inertia\Response
     */
    public function index(Request $request): \Inertia\Response
    {
        return Inertia::render('Welcome', [
            'app_name' => config('app.name'),
            'github' => config('app.github_repo'),
        ]);
    }
}
