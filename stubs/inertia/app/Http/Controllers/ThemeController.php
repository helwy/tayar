<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ThemeController extends Controller
{
    /**
     * Update the user's preferred theme.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $user->dark_theme = $request->input('theme') === 'dark';
            $user->save();
        }
        return response()->json(['status' => 'success']);
    }
}
