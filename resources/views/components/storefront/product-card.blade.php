@props(['product'])

<div class="group relative bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100">
    <!-- Product Image -->
    <a href="{{ route('products.show', $product->slug) }}" class="block relative overflow-hidden aspect-square bg-gray-100">
        @if($product->featured_image)
            <img src="{{ Storage::url($product->featured_image) }}"
                 alt="{{ $product->name }}"
                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
        @else
            <div class="w-full h-full flex items-center justify-center">
                <svg class="w-20 h-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
        @endif

        <!-- Badges -->
        <div class="absolute top-3 ltr:left-3 rtl:right-3 flex flex-col gap-2">
            @if($product->is_featured)
                <span class="bg-yellow-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                    {{ __('storefront.featured') }}
                </span>
            @endif
            @if($product->compare_at_price && $product->compare_at_price > $product->price)
                @php
                    $discount = round((($product->compare_at_price - $product->price) / $product->compare_at_price) * 100);
                @endphp
                <span class="bg-red-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                    -{{ $discount }}%
                </span>
            @endif
        </div>

        <!-- Quick Actions -->
        <div class="absolute bottom-3 ltr:right-3 rtl:left-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            <button class="bg-white text-gray-700 p-2.5 rounded-full shadow-lg hover:bg-blue-600 hover:text-white transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                </svg>
            </button>
        </div>
    </a>

    <!-- Product Info -->
    <div class="p-4">
        <!-- Category -->
        <p class="text-xs text-gray-500 uppercase tracking-wide mb-2">
            {{ $product->category->name }}
        </p>

        <!-- Product Name -->
        <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors">
            <a href="{{ route('products.show', $product->slug) }}">
                {{ $product->name }}
            </a>
        </h3>

        <!-- Price -->
        <div class="flex items-baseline gap-2 mb-4">
            <span class="text-2xl font-bold text-blue-600">
                ${{ number_format($product->price, 2) }}
            </span>
            @if($product->compare_at_price && $product->compare_at_price > $product->price)
                <span class="text-sm text-gray-400 line-through">
                    ${{ number_format($product->compare_at_price, 2) }}
                </span>
            @endif
        </div>

        <!-- Stock Status -->
        @if($product->in_stock)
            <div class="flex items-center text-sm text-green-600 mb-3">
                <svg class="w-4 h-4 ltr:mr-1 rtl:ml-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                {{ __('storefront.in_stock') }}
            </div>
        @else
            <div class="flex items-center text-sm text-red-600 mb-3">
                <svg class="w-4 h-4 ltr:mr-1 rtl:ml-1" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                {{ __('storefront.out_of_stock') }}
            </div>
        @endif

        <!-- Add to Cart Button -->
        <form action="{{ route('cart.add') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="quantity" value="1">
            <button type="submit"
                    @if(!$product->in_stock) disabled @endif
                    class="w-full bg-blue-600 text-white py-2.5 rounded-lg font-semibold hover:bg-blue-700 transition-colors duration-200 disabled:bg-gray-300 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                </svg>
                {{ __('storefront.add_to_cart') }}
            </button>
        </form>
    </div>
</div>
