<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', __('admin.admin_panel'))</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="bg-gray-100 font-sans antialiased" x-data="{ sidebarOpen: false }">
    <div class="h-screen overflow-hidden flex">
        <!-- Sidebar -->
        <aside class="fixed inset-y-0 {{ app()->getLocale() === 'ar' ? 'right-0 lg:right-auto lg:left-0' : 'left-0' }} z-50 w-64 bg-gradient-to-b from-gray-900 to-gray-800 transform transition-transform duration-300 ease-in-out lg:relative lg:translate-x-0 flex flex-col {{ app()->getLocale() === 'ar' ? 'lg:order-first' : '' }}"
               :class="sidebarOpen ? 'translate-x-0' : '{{ app()->getLocale() === 'ar' ? 'translate-x-full lg:translate-x-0' : '-translate-x-full lg:translate-x-0' }}'">

            <!-- Logo -->
            <div class="flex items-center justify-between h-16 px-4 bg-gray-900 border-b border-gray-700 flex-shrink-0">
                <div class="flex items-center">
                    <div class="bg-amber-500 p-2 rounded-lg">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <span class="{{ app()->getLocale() === 'ar' ? 'mr-3' : 'ml-3' }} text-lg font-bold text-white">{{ __('admin.admin_panel') }}</span>
                </div>
                <!-- Close button for mobile -->
                <button @click="sidebarOpen = false" class="lg:hidden p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-2 py-4 space-y-1 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-700 scrollbar-track-gray-800">
                <!-- Dashboard -->
                <a href="{{ route('admin.dashboard') }}"
                   @click="sidebarOpen = false"
                   class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-amber-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    {{ __('admin.dashboard') }}
                </a>

                <!-- Shop Section -->
                <div class="pt-4">
                    <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        {{ __('admin.shop') }}
                    </p>

                    <!-- Categories -->
                    <a href="{{ route('admin.categories.index') }}"
                       @click="sidebarOpen = false"
                       class="flex items-center px-4 py-3 mt-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-amber-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        {{ __('admin.categories') }}
                    </a>

                    <!-- Products -->
                    <a href="{{ route('admin.products.index') }}"
                       @click="sidebarOpen = false"
                       class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-amber-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        {{ __('admin.products') }}
                    </a>

                    <!-- Orders -->
                    <a href="{{ route('admin.orders.index') }}"
                       @click="sidebarOpen = false"
                       class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.orders.*') ? 'bg-amber-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        {{ __('admin.orders') }}
                    </a>

                    <!-- Customers -->
                    <a href="{{ route('admin.customers.index') }}"
                       @click="sidebarOpen = false"
                       class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.customer.*') ? 'bg-amber-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        {{ __('admin.customers') }}
                    </a>
                </div>

                <!-- Management Section -->
                <div class="pt-4">
                    <p class="px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        {{ __('admin.management') }}
                    </p>

                    <!-- Users -->
                    <a href="{{ route('admin.users.index') }}"
                       @click="sidebarOpen = false"
                       class="flex items-center px-4 py-3 mt-2 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.users.*') ? 'bg-amber-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        {{ __('admin.users') }}
                    </a>

                    <!-- FAQs -->
                    <a href="{{ route('admin.faqs.index') }}"
                       @click="sidebarOpen = false"
                       class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.faqs.*') ? 'bg-amber-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ __('admin.faqs') }}
                    </a>

                    <!-- Pages -->
                    <a href="{{ route('admin.pages.index') }}"
                       @click="sidebarOpen = false"
                       class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.pages.*') ? 'bg-amber-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        {{ __('admin.pages') }}
                    </a>

                    <!-- Settings -->
                    <a href="{{ route('admin.settings.index') }}"
                       @click="sidebarOpen = false"
                       class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-amber-500 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        {{ __('admin.settings') }}
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Overlay for mobile -->
        <div x-show="sidebarOpen"
             @click="sidebarOpen = false"
             x-transition:enter="transition-opacity ease-linear duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition-opacity ease-linear duration-300"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 z-40 bg-gray-600 bg-opacity-75 lg:hidden"
             style="display: none;"></div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col min-w-0 h-screen {{ app()->getLocale() === 'ar' ? 'lg:order-last' : '' }}">
            <!-- Top Navigation -->
            <header class="bg-white shadow-sm border-b border-gray-200 flex-shrink-0">
                <div class="flex items-center justify-between h-16 px-4 sm:px-6 lg:px-8">
                    <!-- Mobile menu button -->
                    <button @click="sidebarOpen = !sidebarOpen"
                            class="lg:hidden p-2 rounded-md text-gray-600 hover:text-gray-900 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-amber-500 {{ app()->getLocale() === 'ar' ? 'order-3' : 'order-1' }}">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>

                    <!-- Page Title -->
                    <h1 class="text-xl font-semibold text-gray-900 hidden sm:block flex-1 {{ app()->getLocale() === 'ar' ? 'text-right order-1' : 'text-left order-2' }}">
                        @yield('page-title', __('admin.dashboard'))
                    </h1>

                    <!-- Right Side Navigation -->
                    <div class="flex items-center {{ app()->getLocale() === 'ar' ? 'gap-4 order-2' : 'gap-4 order-3' }}">
                        <!-- Language Switcher -->
                        <div class="flex {{ app()->getLocale() === 'ar' ? 'gap-2 flex-row-reverse' : 'gap-2' }}">
                            <a href="{{ route('admin.locale.switch', 'en') }}"
                               class="px-3 py-1 rounded-md text-sm font-medium {{ app()->getLocale() === 'en' ? 'bg-amber-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition">
                                EN
                            </a>
                            <a href="{{ route('admin.locale.switch', 'ar') }}"
                               class="px-3 py-1 rounded-md text-sm font-medium {{ app()->getLocale() === 'ar' ? 'bg-amber-500 text-white' : 'bg-gray-100 text-gray-700 hover:bg-gray-200' }} transition">
                                عربي
                            </a>
                        </div>

                        <!-- User Menu -->
                        <div x-data="{ open: false }" class="relative">
                            <button @click="open = !open"
                                    class="flex items-center px-3 py-2 rounded-lg hover:bg-gray-100 transition {{ app()->getLocale() === 'ar' ? 'gap-2 flex-row-reverse' : 'gap-2' }}">
                                <div class="w-8 h-8 rounded-full bg-amber-500 flex items-center justify-center text-white font-semibold">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                                <span class="text-sm font-medium text-gray-700 hidden md:block">{{ auth()->user()->name }}</span>
                                <svg class="w-4 h-4 text-gray-600 {{ app()->getLocale() === 'ar' ? 'rotate-0' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <!-- Dropdown Menu -->
                            <div x-show="open"
                                 @click.away="open = false"
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="transform opacity-0 scale-95"
                                 x-transition:enter-end="transform opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-75"
                                 x-transition:leave-start="transform opacity-100 scale-100"
                                 x-transition:leave-end="transform opacity-0 scale-95"
                                 class="absolute {{ app()->getLocale() === 'ar' ? 'left-0' : 'right-0' }} mt-2 w-48 rounded-lg shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50"
                                 style="display: none;">
                                <div class="py-1">
                                    <a href="{{ route('home') }}"
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                        {{ __('storefront.visit_store') }}
                                    </a>
                                    <form method="POST" action="{{ route('admin.logout') }}">
                                        @csrf
                                        <button type="submit"
                                                class="w-full px-4 py-2 text-sm text-red-600 hover:bg-gray-100 transition {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                                            {{ __('admin.logout') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div x-data="{ show: true }"
                             x-show="show"
                             x-init="setTimeout(() => show = false, 5000)"
                             class="mb-4 p-4 rounded-lg bg-green-50 border border-green-200">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-600 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <p class="text-sm text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div x-data="{ show: true }"
                             x-show="show"
                             x-init="setTimeout(() => show = false, 5000)"
                             class="mb-4 p-4 rounded-lg bg-red-50 border border-red-200">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-red-600 {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                                </svg>
                                <p class="text-sm text-red-800">{{ session('error') }}</p>
                            </div>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    @stack('scripts')
</body>
</html>
