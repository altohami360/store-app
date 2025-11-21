<footer class="bg-gray-900 text-gray-300 mt-16">
    <!-- Main Footer -->
    <div class="container mx-auto px-4 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- About Section -->
            <div>
                <h3 class="text-white text-lg font-bold mb-4">{{ config('app.name', 'E-Store') }}</h3>
                <p class="text-sm mb-4">
                    {{ __('storefront.footer_about_text') }}
                </p>
                <!-- Social Media -->
                <div class="flex gap-3">
                    <a href="#" class="bg-gray-800 hover:bg-blue-600 p-2 rounded-full transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"></path>
                        </svg>
                    </a>
                    <a href="#" class="bg-gray-800 hover:bg-blue-400 p-2 rounded-full transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"></path>
                        </svg>
                    </a>
                    <a href="#" class="bg-gray-800 hover:bg-pink-600 p-2 rounded-full transition-colors">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h3 class="text-white text-lg font-bold mb-4">{{ __('storefront.quick_links') }}</h3>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-white transition-colors">{{ __('storefront.home') }}</a>
                    </li>
                    <li>
                        <a href="{{ route('products.index') }}" class="hover:text-white transition-colors">{{ __('storefront.products') }}</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-white transition-colors">{{ __('storefront.about_us') }}</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-white transition-colors">{{ __('storefront.contact_us') }}</a>
                    </li>
                </ul>
            </div>

            <!-- Customer Service -->
            <div>
                <h3 class="text-white text-lg font-bold mb-4">{{ __('storefront.customer_service') }}</h3>
                <ul class="space-y-2 text-sm">
                    <li>
                        <a href="#" class="hover:text-white transition-colors">{{ __('storefront.shipping_info') }}</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-white transition-colors">{{ __('storefront.returns') }}</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-white transition-colors">{{ __('storefront.faq') }}</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-white transition-colors">{{ __('storefront.privacy_policy') }}</a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-white transition-colors">{{ __('storefront.terms_conditions') }}</a>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h3 class="text-white text-lg font-bold mb-4">{{ __('storefront.newsletter') }}</h3>
                <p class="text-sm mb-4">{{ __('storefront.newsletter_text') }}</p>
                <form class="flex gap-2">
                    <input type="email"
                           placeholder="{{ __('storefront.enter_email') }}"
                           class="flex-1 px-4 py-2 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Payment Methods -->
    <div class="border-t border-gray-800">
        <div class="container mx-auto px-4 py-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-sm">{{ __('storefront.secure_payment') }}</p>
                <div class="flex items-center gap-4 opacity-75">
                    <svg class="h-8" viewBox="0 0 50 32" fill="none">
                        <rect width="50" height="32" rx="4" fill="#1434CB"/>
                        <text x="25" y="20" text-anchor="middle" fill="white" font-weight="bold" font-size="12">VISA</text>
                    </svg>
                    <svg class="h-8" viewBox="0 0 50 32" fill="none">
                        <rect width="50" height="32" rx="4" fill="#EB001B"/>
                        <circle cx="20" cy="16" r="10" fill="#FF5F00" opacity="0.7"/>
                        <circle cx="30" cy="16" r="10" fill="#F79E1B" opacity="0.7"/>
                    </svg>
                    <svg class="h-8" viewBox="0 0 50 32" fill="none">
                        <rect width="50" height="32" rx="4" fill="#0079C1"/>
                        <text x="25" y="20" text-anchor="middle" fill="white" font-weight="bold" font-size="10">PayPal</text>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Bar -->
    <div class="border-t border-gray-800">
        <div class="container mx-auto px-4 py-4">
            <div class="flex flex-col md:flex-row items-center justify-between gap-2 text-sm">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. {{ __('storefront.all_rights_reserved') }}</p>
                <p class="text-gray-400">{{ __('storefront.made_with_love') }}</p>
            </div>
        </div>
    </div>
</footer>
