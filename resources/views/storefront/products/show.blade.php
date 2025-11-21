@extends('storefront.layouts.app')

@section('title', $product->name)

@section('content')
<div class="container mx-auto px-4 py-3">
    <!-- Breadcrumb -->
    <nav class="mb-6 text-sm">
        <ol class="flex items-center space-x-2">
            <li><a href="{{ route('home') }}" class="text-blue-600 hover:underline">{{ __('storefront.home') }}</a></li>
            <li class="text-gray-400">/</li>
            <li><a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">{{ __('storefront.products') }}</a></li>
            <li class="text-gray-400">/</li>
            <li><a href="{{ route('category.show', $product->category->slug) }}" class="text-blue-600 hover:underline">{{ $product->category->name }}</a></li>
            <li class="text-gray-400">/</li>
            <li class="text-gray-600">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        <!-- Product Images -->
        <div>
            <div class="bg-white rounded-lg shadow-md overflow-hidden mb-4">
                @if($product->featured_image)
                <img src="{{ Storage::url($product->featured_image) }}"
                     alt="{{ $product->name }}"
                     class="w-full h-96 object-cover">
                @else
                <div class="w-full h-96 bg-gray-200 flex items-center justify-center">
                    <svg class="w-24 h-24 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                </div>
                @endif
            </div>

            <!-- Additional Images -->
            @if($product->images->isNotEmpty())
            <div class="grid grid-cols-4 gap-2">
                @foreach($product->images as $image)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ Storage::url($image->image_path) }}"
                         alt="{{ $product->name }}"
                         class="w-full h-24 object-cover cursor-pointer hover:opacity-75">
                </div>
                @endforeach
            </div>
            @endif
        </div>

        <!-- Product Info -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>

            <div class="mb-4">
                <a href="{{ route('category.show', $product->category->slug) }}" class="text-blue-600 hover:underline">
                    {{ $product->category->name }}
                </a>
            </div>

            <!-- Price -->
            <div class="mb-6">
                <div class="flex items-baseline gap-3">
                    <span class="text-3xl font-bold text-blue-600">${{ number_format($product->price, 2) }}</span>
                    @if($product->compare_at_price)
                        <span class="text-xl text-gray-500 line-through">${{ number_format($product->compare_at_price, 2) }}</span>
                        <span class="bg-red-100 text-red-800 text-sm font-semibold px-2 py-1 rounded">
                            Save {{ round((($product->compare_at_price - $product->price) / $product->compare_at_price) * 100) }}%
                        </span>
                    @endif
                </div>
            </div>

            <!-- Availability -->
            <div class="mb-6">
                <div class="flex items-center gap-2">
                    <span class="font-semibold">{{ __('storefront.availability') }}:</span>
                    @if($product->in_stock)
                        <span class="text-green-600 font-semibold">{{ __('storefront.in_stock') }} ({{ $product->quantity }} available)</span>
                    @else
                        <span class="text-red-600 font-semibold">{{ __('storefront.out_of_stock') }}</span>
                    @endif
                </div>
                <div class="mt-2">
                    <span class="text-sm text-gray-600">{{ __('storefront.sku') }}: {{ $product->sku }}</span>
                </div>
            </div>

            <!-- Add to Cart -->
            @if($product->in_stock)
            <form action="{{ route('cart.add') }}" method="POST" class="mb-6">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">

                <div class="flex gap-4 items-center mb-4">
                    <label for="quantity" class="font-semibold">{{ __('storefront.quantity') }}:</label>
                    <input type="number"
                           name="quantity"
                           id="quantity"
                           value="1"
                           min="1"
                           max="{{ $product->quantity }}"
                           class="w-20 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                </div>

                <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 transition font-semibold text-lg">
                    {{ __('storefront.add_to_cart') }}
                </button>
            </form>
            @else
            <div class="mb-6">
                <button disabled class="w-full bg-gray-300 text-gray-500 py-3 rounded-lg cursor-not-allowed font-semibold text-lg">
                    {{ __('storefront.out_of_stock') }}
                </button>
            </div>
            @endif

            <!-- Description -->
            @if($product->description)
            <div class="border-t pt-6">
                <h3 class="text-lg font-semibold mb-3">{{ __('storefront.description') }}</h3>
                <div class="text-gray-700 prose">
                    {{ $product->description }}
                </div>
            </div>
            @endif
        </div>
    </div>

    <!-- Related Products -->
    @if($relatedProducts->isNotEmpty())
    <section class="mb-12">
        <h2 class="text-2xl font-bold mb-6">Related Products</h2>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
            @foreach($relatedProducts as $relatedProduct)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <a href="{{ route('products.show', $relatedProduct->slug) }}">
                    @if($relatedProduct->featured_image)
                    <img src="{{ Storage::url($relatedProduct->featured_image) }}"
                         alt="{{ $relatedProduct->name }}"
                         class="w-full h-48 object-cover">
                    @else
                    <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    @endif
                </a>

                <div class="p-4">
                    <h3 class="font-semibold mb-2">
                        <a href="{{ route('products.show', $relatedProduct->slug) }}" class="hover:text-blue-600">
                            {{ $relatedProduct->name }}
                        </a>
                    </h3>
                    <p class="text-lg font-bold text-blue-600">${{ number_format($relatedProduct->price, 2) }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif
</div>
@endsection
