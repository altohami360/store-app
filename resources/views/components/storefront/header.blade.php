<!-- Top Bar -->
<div class="bg-gray-900 text-white py-2">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center text-sm">
            <div class="flex items-center gap-4">
                <a href="mailto:support@example.com" class="hover:text-blue-400 transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    support@example.com
                </a>
                <span class="hidden md:block text-gray-400">|</span>
                <span class="hidden md:block text-gray-300">{{ __('storefront.free_shipping_over_100') }}</span>
            </div>
            <div class="flex items-center gap-4">
                <!-- Language Switcher -->
                <form action="{{ route('language.switch') }}" method="POST" class="inline">
                    @csrf
                    <input type="hidden" name="locale" value="{{ app()->getLocale() === 'en' ? 'ar' : 'en' }}">
                    <button type="submit" class="hover:text-blue-400 transition-colors flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h12M9 3v2m1.048 9.5A18.022 18.022 0 016.412 9m6.088 9h7M11 21l5-10 5 10M12.751 5C11.783 10.77 8.07 15.61 3 18.129"></path>
                        </svg>
                        {{ app()->getLocale() === 'en' ? 'العربية' : 'English' }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Main Header -->
<header class="bg-white shadow-md sticky top-0 z-50" x-data="{ mobileMenuOpen: false, searchOpen: false }">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between py-4">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-blue-600 hover:text-blue-700 transition-colors">
                    <span class="flex items-center gap-2">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z"></path>
                        </svg>
                        <span class="hidden sm:block">{{ config('app.name', 'E-Store') }}</span>
                    </span>
                </a>
            </div>

            <!-- Desktop Search -->
            <div class="hidden lg:flex flex-1 max-w-2xl mx-8">
                <x-storefront.search-bar :value="request('search')" />
            </div>

            <!-- Right Icons -->
            <div class="flex items-center gap-4">
                <!-- Mobile Search Toggle -->
                <button @click="searchOpen = !searchOpen" class="lg:hidden text-gray-700 hover:text-blue-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>

                <!-- User Menu -->
                @auth
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center gap-2 text-gray-700 hover:text-blue-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="hidden md:block">{{ Auth::user()->name }}</span>
                            <svg class="w-4 h-4 hidden md:block" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open"
                             @click.away="open = false"
                             x-transition
                             class="absolute ltr:right-0 rtl:left-0 mt-2 w-48 bg-white rounded-lg shadow-lg py-2 border border-gray-200">
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-gray-700 hover:bg-blue-50 transition-colors">
                                {{ __('storefront.profile') }}
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-blue-50 transition-colors">
                                    {{ __('storefront.logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600 transition-colors flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path>
                        </svg>
                        <span class="hidden md:block">{{ __('storefront.login') }}</span>
                    </a>
                @endauth

                <!-- Cart Icon -->
                <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-blue-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                    @php
                        $cartCount = app(\App\Services\CartService::class)->getCount();
                    @endphp
                    @if($cartCount > 0)
                        <span class="absolute -top-2 -right-2 bg-blue-600 text-white text-xs font-bold rounded-full w-5 h-5 flex items-center justify-center">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                <!-- Mobile Menu Toggle -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-gray-700 hover:text-blue-600 transition-colors">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                    <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Search Bar -->
        <div x-show="searchOpen" x-transition class="lg:hidden pb-4">
            <x-storefront.search-bar :value="request('search')" />
        </div>

        <!-- Navigation -->
        <nav class="hidden lg:flex border-t border-gray-200 py-3">
            <ul class="flex items-center gap-8">
                <li>
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors {{ request()->routeIs('home') ? 'text-blue-600' : '' }}">
                        {{ __('storefront.home') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors {{ request()->routeIs('products.*') ? 'text-blue-600' : '' }}">
                        {{ __('storefront.products') }}
                    </a>
                </li>
                @php
                    $categories = \App\Models\Category::active()->parent()->orderBy('sort_order')->limit(5)->get();
                @endphp
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route('category.show', $category->slug) }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>

    <!-- Mobile Menu -->
    <div x-show="mobileMenuOpen"
         x-transition
         class="lg:hidden border-t border-gray-200 bg-white">
        <nav class="container mx-auto px-4 py-4">
            <ul class="space-y-3">
                <li>
                    <a href="{{ route('home') }}" class="block py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors {{ request()->routeIs('home') ? 'text-blue-600' : '' }}">
                        {{ __('storefront.home') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.index') }}" class="block py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors {{ request()->routeIs('products.*') ? 'text-blue-600' : '' }}">
                        {{ __('storefront.products') }}
                    </a>
                </li>
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route('category.show', $category->slug) }}" class="block py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors">
                            {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </div>
</header>
