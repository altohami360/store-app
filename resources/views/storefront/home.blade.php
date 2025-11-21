@extends('storefront.layouts.app')

@section('title', __('storefront.home'))

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-r from-blue-600 to-blue-800 text-white overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="container mx-auto px-4 py-20 relative">
        <div class="grid md:grid-cols-2 gap-12 items-center">
            <!-- Hero Content -->
            <div class="animate-slide-in-left">
                <h1 class="text-5xl md:text-6xl font-bold mb-6 leading-tight">
                    Welcome to {{ config('app.name') }}
                </h1>
                <p class="text-xl mb-8 text-blue-100">
                    Discover amazing products at unbeatable prices. Shop now and enjoy fast, free shipping on orders over $100.
                </p>
                <div class="flex flex-wrap gap-4">
                    <x-storefront.button href="{{ route('products.index') }}" size="lg">
                        <svg class="w-5 h-5 ltr:mr-2 rtl:ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path>
                        </svg>
                        Shop Now
                    </x-storefront.button>
                    <x-storefront.button href="#categories" variant="outline" size="lg" class="!text-white !border-white hover:!bg-white/10">
                        Browse Categories
                    </x-storefront.button>
                </div>
            </div>

            <!-- Hero Image/Illustration -->
            <div class="animate-slide-in-right hidden md:block">
                <div class="relative">
                    <div class="absolute inset-0 bg-blue-500 rounded-full blur-3xl opacity-30 animate-pulse"></div>
                    <svg class="relative w-full h-auto" viewBox="0 0 500 500" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="250" cy="250" r="200" fill="white" opacity="0.1"/>
                        <path d="M250 100L300 200H200L250 100Z" fill="white" opacity="0.2"/>
                        <rect x="200" y="200" width="100" height="150" rx="10" fill="white" opacity="0.3"/>
                        <circle cx="250" cy="275" r="30" fill="white" opacity="0.4"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Wave Separator -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg class="w-full h-16 md:h-24" viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
            <path d="M0,50 C240,100 480,0 720,50 C960,100 1200,0 1440,50 L1440,100 L0,100 Z" fill="rgb(249, 250, 251)"/>
        </svg>
    </div>
</section>

<!-- Features Section -->
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="flex items-start gap-4 p-6 rounded-xl hover:bg-gray-50 transition-colors">
                <div class="flex-shrink-0 w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-2">Quality Guarantee</h3>
                    <p class="text-gray-600 text-sm">All products are verified for quality and authenticity</p>
                </div>
            </div>

            <!-- Feature 2 -->
            <div class="flex items-start gap-4 p-6 rounded-xl hover:bg-gray-50 transition-colors">
                <div class="flex-shrink-0 w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-2">Fast Delivery</h3>
                    <p class="text-gray-600 text-sm">Get your orders delivered quickly and safely</p>
                </div>
            </div>

            <!-- Feature 3 -->
            <div class="flex items-start gap-4 p-6 rounded-xl hover:bg-gray-50 transition-colors">
                <div class="flex-shrink-0 w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center text-purple-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-lg mb-2">{{ __('storefront.secure_payment') }}</h3>
                    <p class="text-gray-600 text-sm">Your payment information is always secure</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="flex items-center justify-between mb-10">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                    {{ __('storefront.featured_products') }}
                </h2>
                <p class="text-gray-600">Discover our handpicked selection of premium products</p>
            </div>
            <x-storefront.button href="{{ route('products.index') }}" variant="outline">
                View All
                <svg class="w-5 h-5 ltr:ml-2 rtl:mr-2 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </x-storefront.button>
        </div>

        <!-- Products Grid -->
        @if($featuredProducts->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($featuredProducts as $product)
                    <div class="animate-fade-in" style="animation-delay: {{ $loop->index * 0.1 }}s">
                        <x-storefront.product-card :product="$product" />
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                </svg>
                <p class="text-gray-500">No featured products available</p>
            </div>
        @endif
    </div>
</section>

<!-- Categories Section -->
<section id="categories" class="py-16 bg-gray-100">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">
                Shop by Category
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Browse through our wide range of categories to find exactly what you need
            </p>
        </div>

        <!-- Categories Grid -->
        @if($categories->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($categories as $category)
                    <a href="{{ route('category.show', $category->slug) }}"
                       class="group relative bg-white rounded-xl overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 animate-fade-in"
                       style="animation-delay: {{ $loop->index * 0.1 }}s">
                        <!-- Category Image -->
                        <div class="relative h-48 bg-gradient-to-br from-blue-400 to-blue-600 overflow-hidden">
                            @if($category->image)
                                <img src="{{ Storage::url($category->image) }}"
                                     alt="{{ $category->name }}"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <svg class="w-20 h-20 text-white opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1H8a3 3 0 00-3 3v1.5a1.5 1.5 0 01-3 0V6z" clip-rule="evenodd"></path>
                                        <path d="M6 12a2 2 0 012-2h8a2 2 0 012 2v2a2 2 0 01-2 2H2h2a2 2 0 002-2v-2z"></path>
                                    </svg>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                        </div>

                        <!-- Category Info -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                                {{ $category->name }}
                            </h3>
                            @if($category->description)
                                <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                    {{ $category->description }}
                                </p>
                            @endif
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">
                                    {{ $category->products_count }} {{ __('storefront.products') }}
                                </span>
                                <span class="text-blue-600 font-semibold flex items-center gap-1 group-hover:gap-2 transition-all">
                                    Explore
                                    <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                </svg>
                <p class="text-gray-500">No categories available</p>
            </div>
        @endif
    </div>
</section>

<!-- Call to Action Section -->
<section class="py-20 bg-gradient-to-r from-purple-600 to-blue-600 text-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-5xl font-bold mb-6">
            Ready to Start Shopping?
        </h2>
        <p class="text-xl mb-8 text-purple-100 max-w-2xl mx-auto">
            Join thousands of satisfied customers and discover amazing products today
        </p>
        <div class="flex flex-wrap gap-4 justify-center">
            @guest
                <x-storefront.button href="{{ route('register') }}" size="lg" class="!bg-white !text-purple-600 hover:!bg-gray-100">
                    {{ __('storefront.register') }}
                </x-storefront.button>
            @endguest
            <x-storefront.button href="{{ route('products.index') }}" variant="outline" size="lg" class="!text-white !border-white hover:!bg-white/10">
                Shop Now
            </x-storefront.button>
        </div>
    </div>
</section>
@endsection
