<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="@yield('meta_description', __('storefront.site_description'))">

    <title>@yield('title') - {{ config('app.name', 'E-Commerce Store') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Custom Styles -->
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }

        /* Custom Animations */
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slide-in-left {
            from {
                opacity: 0;
                transform: translateX(-20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slide-in-right {
            from {
                opacity: 0;
                transform: translateX(20px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }

        .animate-slide-in-left {
            animation: slide-in-left 0.4s ease-out;
        }

        .animate-slide-in-right {
            animation: slide-in-right 0.4s ease-out;
        }

        /* Smooth Scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* Line Clamp Utility */
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Aspect Ratio */
        .aspect-square {
            aspect-ratio: 1 / 1;
        }

        /* Backdrop Blur Support */
        @supports (backdrop-filter: blur(10px)) {
            .backdrop-blur {
                backdrop-filter: blur(10px);
            }
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50 text-gray-900 antialiased">
    <!-- Skip to main content (Accessibility) -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-blue-600 text-white px-4 py-2 rounded-lg z-50">
        Skip to main content
    </a>

    <!-- Header -->
    <x-storefront.header />

    <!-- Flash Messages -->
    @if(session('success') || session('error') || session('warning') || session('info'))
        <div class="container mx-auto px-4 mt-6">
            @if(session('success'))
                <x-storefront.alert type="success">
                    {{ session('success') }}
                </x-storefront.alert>
            @endif

            @if(session('error'))
                <x-storefront.alert type="error">
                    {{ session('error') }}
                </x-storefront.alert>
            @endif

            @if(session('warning'))
                <x-storefront.alert type="warning">
                    {{ session('warning') }}
                </x-storefront.alert>
            @endif

            @if(session('info'))
                <x-storefront.alert type="info">
                    {{ session('info') }}
                </x-storefront.alert>
            @endif
        </div>
    @endif

    <!-- Main Content -->
    <main id="main-content" class="min-h-screen">
        @yield('content')
    </main>

    <!-- Back to Top Button -->
    <button
        x-data="{ show: false }"
        x-show="show"
        @scroll.window="show = window.pageYOffset > 300"
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        x-transition
        class="fixed bottom-6 ltr:right-6 rtl:left-6 bg-blue-600 hover:bg-blue-700 text-white p-3 rounded-full shadow-lg transition-all duration-300 z-40"
        aria-label="Back to top">
        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>

    <!-- Footer -->
    <x-storefront.footer />

    @stack('scripts')
</body>
</html>
