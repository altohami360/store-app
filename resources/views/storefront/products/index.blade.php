@extends('storefront.layouts.app')

@section('title', __('storefront.products'))

@section('content')
<div class="bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Breadcrumbs -->
        <x-storefront.breadcrumbs :items="[
            ['label' => __('storefront.products'), 'url' => '#']
        ]" />

        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                {{ __('storefront.products') }}
            </h1>
            <p class="text-gray-600">
                @if(request('search'))
                    {{ __('storefront.search_results_for') }} "{{ request('search') }}"
                @elseif(request('category'))
                    {{ __('storefront.browsing_category') }}
                @else
                    {{ __('storefront.browse_all_products') }}
                @endif
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Filters -->
            <aside class="w-full lg:w-80 flex-shrink-0">
                <!-- Mobile Filter Toggle -->
                <div class="lg:hidden mb-4">
                    <button
                        x-data
                        @click="$dispatch('toggle-filters')"
                        class="w-full bg-white border border-gray-300 rounded-lg px-4 py-3 flex items-center justify-between hover:bg-gray-50 transition-colors">
                        <span class="font-semibold flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path>
                            </svg>
                            {{ __('storefront.filters') }}
                        </span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                </div>

                <!-- Filters Container -->
                <div
                    x-data="{ open: false }"
                    @toggle-filters.window="open = !open"
                    :class="{ 'hidden': !open }"
                    class="lg:block space-y-6">

                    <!-- Search Filter -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            {{ __('storefront.search') }}
                        </h3>
                        <form method="GET" action="{{ route('products.index') }}">
                            @if(request('category'))
                                <input type="hidden" name="category" value="{{ request('category') }}">
                            @endif
                            @if(request('sort'))
                                <input type="hidden" name="sort" value="{{ request('sort') }}">
                            @endif
                            <div class="relative">
                                <input type="text"
                                       name="search"
                                       value="{{ request('search') }}"
                                       placeholder="{{ __('storefront.search_products') }}"
                                       class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                <svg class="absolute left-3 top-3.5 w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <button type="submit" class="w-full mt-3 bg-blue-600 text-white py-2.5 rounded-lg hover:bg-blue-700 transition-colors font-semibold">
                                {{ __('storefront.search') }}
                            </button>
                        </form>
                    </div>

                    <!-- Categories Filter -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            {{ __('storefront.categories') }}
                        </h3>
                        <ul class="space-y-1">
                            <li>
                                <a href="{{ route('products.index', array_filter(['search' => request('search'), 'sort' => request('sort')])) }}"
                                   class="group flex items-center justify-between px-3 py-2.5 rounded-lg transition-all {{ !request('category') ? 'bg-blue-50 text-blue-700 font-semibold' : 'hover:bg-gray-50 text-gray-700' }}">
                                    <span>{{ __('storefront.all_products') }}</span>
                                    @if(!request('category'))
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                        </svg>
                                    @endif
                                </a>
                            </li>
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('products.index', array_filter(['category' => $category->id, 'search' => request('search'), 'sort' => request('sort')])) }}"
                                       class="group flex items-center justify-between px-3 py-2.5 rounded-lg transition-all {{ request('category') == $category->id ? 'bg-blue-50 text-blue-700 font-semibold' : 'hover:bg-gray-50 text-gray-700' }}">
                                        <span>{{ $category->name }}</span>
                                        @if(request('category') == $category->id)
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        @else
                                            <span class="text-xs text-gray-500 bg-gray-100 px-2 py-1 rounded-full">
                                                {{ $category->products_count }}
                                            </span>
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <!-- Clear Filters -->
                    @if(request()->has('search') || request()->has('category') || request()->has('sort'))
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                            <a href="{{ route('products.index') }}" class="flex items-center justify-center gap-2 text-red-600 hover:text-red-700 font-semibold transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                {{ __('storefront.clear_filters') }}
                            </a>
                        </div>
                    @endif
                </div>
            </aside>

            <!-- Products Grid -->
            <main class="flex-1">
                <!-- Toolbar -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4 mb-6">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <!-- Results Count -->
                        <div class="flex items-center gap-2">
                            <span class="text-gray-900 font-semibold">{{ $products->total() }}</span>
                            <span class="text-gray-600">{{ __('storefront.products_found') }}</span>
                        </div>

                        <!-- Sort Dropdown -->
                        <div class="flex items-center gap-3">
                            <label for="sort" class="text-sm text-gray-600 whitespace-nowrap">
                                {{ __('storefront.sort_by') }}:
                            </label>
                            <form method="GET" action="{{ route('products.index') }}" id="sortForm" class="flex-1">
                                @if(request('category'))
                                    <input type="hidden" name="category" value="{{ request('category') }}">
                                @endif
                                @if(request('search'))
                                    <input type="hidden" name="search" value="{{ request('search') }}">
                                @endif
                                <select name="sort"
                                        id="sort"
                                        onchange="document.getElementById('sortForm').submit()"
                                        class="w-full sm:w-auto border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>
                                        {{ __('storefront.latest') }}
                                    </option>
                                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>
                                        {{ __('storefront.price_low_high') }}
                                    </option>
                                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>
                                        {{ __('storefront.price_high_low') }}
                                    </option>
                                    <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>
                                        {{ __('storefront.name_a_z') }}
                                    </option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Products -->
                @if($products->isEmpty())
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                        <svg class="mx-auto h-24 w-24 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                        </svg>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('storefront.no_products_found') }}</h3>
                        <p class="text-gray-600 mb-6">{{ __('storefront.try_different_filters') }}</p>
                        <x-storefront.button href="{{ route('products.index') }}" variant="outline">
                            {{ __('storefront.clear_filters') }}
                        </x-storefront.button>
                    </div>
                @else
                    <!-- Products Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 mb-8">
                        @foreach($products as $product)
                            <div class="animate-fade-in" style="animation-delay: {{ ($loop->index % 9) * 0.05 }}s">
                                <x-storefront.product-card :product="$product" />
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <x-storefront.pagination :paginator="$products" />
                @endif
            </main>
        </div>
    </div>
</div>
@endsection
