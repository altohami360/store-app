<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\CartService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request, CartService $cartService): RedirectResponse
    {
        // Save the current locale and session ID before regenerating session
        $currentLocale = session('locale') ?? $request->cookie('locale') ?? config('app.locale');
        $oldSessionId = session()->getId();

        $request->authenticate();

        $request->session()->regenerate();

        // Restore the locale after session regeneration
        session(['locale' => $currentLocale]);

        // Merge guest cart items to user account
        $cartService->mergeGuestCart($oldSessionId);

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Save the current locale before invalidating session
        $currentLocale = session('locale') ?? $request->cookie('locale') ?? config('app.locale');

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Restore the locale in the new session and ensure cookie is set
        session(['locale' => $currentLocale]);

        return redirect('/')->cookie('locale', $currentLocale, 525600); // 1 year
    }
}
