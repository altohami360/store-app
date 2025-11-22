<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('admin.login') }} - {{ __('admin.admin_panel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-gradient-to-br from-amber-50 to-orange-100 dark:from-gray-900 dark:to-gray-800">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
        <!-- Language Switcher -->
        <div class="absolute top-4 {{ app()->getLocale() === 'ar' ? 'left-4' : 'right-4' }}">
            <div class="flex gap-2">
                <a href="{{ route('admin.locale.switch', 'en') }}"
                   class="px-3 py-1 rounded-md text-sm font-medium {{ app()->getLocale() === 'en' ? 'bg-amber-500 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }} transition">
                    EN
                </a>
                <a href="{{ route('admin.locale.switch', 'ar') }}"
                   class="px-3 py-1 rounded-md text-sm font-medium {{ app()->getLocale() === 'ar' ? 'bg-amber-500 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }} transition">
                    عربي
                </a>
            </div>
        </div>

        <!-- Logo -->
        <div class="mb-6">
            <div class="flex items-center justify-center">
                <div class="bg-amber-500 p-3 rounded-xl shadow-lg">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
            </div>
            <h2 class="mt-4 text-center text-3xl font-bold text-gray-900">
                {{ __('admin.admin_panel') }}
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                {{ __('admin.sign_in_continue') }}
            </p>
        </div>

        <!-- Login Card -->
        <div class="w-full sm:max-w-md">
            <div class="bg-white shadow-xl rounded-2xl overflow-hidden">
                <div class="px-8 py-10">
                    <!-- Session Status -->
                    @if (session('status'))
                        <div class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200">
                            <p class="text-sm text-green-800">{{ session('status') }}</p>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf

                        <!-- Email Address -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('admin.email') }}
                            </label>
                            <input id="email"
                                   type="email"
                                   name="email"
                                   value="{{ old('email') }}"
                                   required
                                   autofocus
                                   autocomplete="username"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mt-6">
                            <label for="password" class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('admin.password') }}
                            </label>
                            <input id="password"
                                   type="password"
                                   name="password"
                                   required
                                   autocomplete="current-password"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent transition @error('password') border-red-500 @enderror">
                            @error('password')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Remember Me -->
                        <div class="mt-6 flex items-center justify-between">
                            <label class="flex items-center">
                                <input type="checkbox"
                                       name="remember"
                                       class="rounded border-gray-300 text-amber-500 focus:ring-amber-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}">
                                <span class="text-sm text-gray-600">{{ __('admin.remember_me') }}</span>
                            </label>
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-8">
                            <button type="submit"
                                    class="w-full bg-gradient-to-r from-amber-500 to-orange-500 hover:from-amber-600 hover:to-orange-600 text-white font-semibold py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
                                {{ __('admin.login') }}
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Footer -->
                <div class="px-8 py-4 bg-gray-50 border-t border-gray-200">
                    <p class="text-xs text-center text-gray-500">
                        &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
