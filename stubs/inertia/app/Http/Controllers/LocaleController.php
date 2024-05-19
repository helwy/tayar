<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
    /**
     * Update the user's preferred language.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $user->language = $request->input('locale');
            $user->save();
        }
        return response()->json(['status' => 'success']);
    }
}
