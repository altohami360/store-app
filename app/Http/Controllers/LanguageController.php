<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function switch(Request $request)
    {
        $locale = $request->input('locale', 'en');

        if (in_array($locale, ['en', 'ar'])) {
            // Store in both session and cookie for persistence
            session(['locale' => $locale]);

            return redirect()->back()->cookie('locale', $locale, 525600); // 1 year
        }

        return redirect()->back();
    }
}
