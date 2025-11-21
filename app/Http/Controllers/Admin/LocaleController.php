<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class LocaleController extends Controller
{
    /**
     * Switch the application locale for the admin panel.
     */
    public function switch(string $locale): RedirectResponse
    {
        // Validate locale is supported
        if (in_array($locale, ['en', 'ar'])) {
            // Store locale in session
            session(['locale' => $locale]);

            // Set application locale for current request
            app()->setLocale($locale);
        }

        return redirect()->back();
    }
}
