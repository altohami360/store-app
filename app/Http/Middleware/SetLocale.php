<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check locale priority: session > cookie > config default
        $locale = session('locale') ?? $request->cookie('locale') ?? config('app.locale');

        // Validate locale
        if (in_array($locale, ['en', 'ar'])) {
            app()->setLocale($locale);

            // If locale is from cookie but not in session, set it in session
            if (!session()->has('locale') && $request->cookie('locale')) {
                session(['locale' => $locale]);
            }
        }

        return $next($request);
    }
}
