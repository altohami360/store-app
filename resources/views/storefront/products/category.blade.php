@extends('storefront.layouts.app')

@section('title', $category->name)

@section('content')
<div class="container mx-auto px-4 py-3">
    <!-- Category Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-8">
        @if($category->image)
        <div class="flex items-center gap-6">
            <img src="{{ Storage::url($category->image) }}"
                 alt="{{ $category->name }}"
                 class="w-24 h-24 object-cover rounded-lg">
            <div>
                <h1 class="text-3xl font-bold mb-2">{{ $category->name }}</h1>
                @if($category->description)
                <p class="text-gray-600">{{ $category->description }}</p>
                @endif
            </div>
        </div>
        @else
        <div>
            <h1 class="text-3xl font-bold mb-2">{{ $category->name }}</h1>
            @if($category->description)
            <p class="text-gray-600">{{ $category->description }}</p>
            @endif
        </div>
        @endif
    </div>

    <!-- Products Count -->
    <div class="mb-6">
        <p class="text-gray-600">{{ $products->total() }} {{ __('storefront.products') }}</p>
    </div>

    <!-- Products Grid -->
    @if($products->isEmpty())
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
            </svg>
            <h3 class="mt-2 text-sm font-medium text-gray-900">{{ __('storefront.no_products_found') }}</h3>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($products as $product)
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition">
                <a href="{{ route('products.show', $product->slug) }}">
                    @if($product->featured_image)
                    <img src="{{ Storage::url($product->featured_image) }}"
                         alt="{{ $product->name }}"
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
                        <a href="{{ route('products.show', $product->slug) }}" class="hover:text-blue-600">
                            {{ $product->name }}
                        </a>
                    </h3>

                    <div class="flex items-center justify-between mb-3">
                        <p class="text-lg font-bold text-blue-600">${{ number_format($product->price, 2) }}</p>
                        @if($product->in_stock)
                            <span class="text-xs text-green-600 font-semibold">{{ __('storefront.in_stock') }}</span>
                        @else
                            <span class="text-xs text-red-600 font-semibold">{{ __('storefront.out_of_stock') }}</span>
                        @endif
                    </div>

                    @if($product->in_stock)
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                            {{ __('storefront.add_to_cart') }}
                        </button>
                    </form>
                    @else
                    <button disabled class="w-full bg-gray-300 text-gray-500 py-2 rounded cursor-not-allowed">
                        {{ __('storefront.out_of_stock') }}
                    </button>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
