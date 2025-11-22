@extends('storefront.layouts.app')

@section('title', __('storefront.shopping_cart'))

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-8">{{ __('storefront.shopping_cart') }}</h1>

    @if($cartItems->isEmpty())
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <svg class="mx-auto h-16 w-16 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ __('storefront.cart_empty') }}</h3>
            <p class="text-gray-600 mb-6">{{ __('storefront.start_adding_products') }}</p>
            <a href="{{ route('products.index') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                {{ __('storefront.continue_shopping') }}
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @foreach($cartItems as $item)
                    <div class="p-6 border-b last:border-b-0 flex gap-4">
                        <!-- Product Image -->
                        <div class="flex-shrink-0">
                            @if($item->product->featured_image)
                            <img src="{{ Storage::url($item->product->featured_image) }}"
                                 alt="{{ $item->product->name }}"
                                 class="w-24 h-24 object-cover rounded">
                            @else
                            <div class="w-24 h-24 bg-gray-200 rounded flex items-center justify-center">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            @endif
                        </div>

                        <!-- Product Details -->
                        <div class="flex-1">
                            <h3 class="font-semibold text-lg mb-1">
                                <a href="{{ route('products.show', $item->product->slug) }}" class="hover:text-blue-600">
                                    {{ $item->product->name }}
                                </a>
                            </h3>
                            <p class="text-sm text-gray-600 mb-2">{{ $item->product->category->name }}</p>
                            <p class="text-lg font-bold text-blue-600">${{ number_format($item->product->price, 2) }}</p>
                        </div>

                        <!-- Quantity & Actions -->
                        <div class="flex flex-col items-end justify-between">
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </form>

                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <input type="number"
                                       name="quantity"
                                       value="{{ $item->quantity }}"
                                       min="1"
                                       max="{{ $item->product->quantity }}"
                                       class="w-16 px-2 py-1 border border-gray-300 rounded text-center"
                                       onchange="this.form.submit()">
                            </form>

                            <p class="font-semibold">${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    <a href="{{ route('products.index') }}" class="text-blue-600 hover:underline">
                        ← {{ __('storefront.continue_shopping') }}
                    </a>
                </div>
            </div>

            <!-- Order Summary -->
            <div>
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h2 class="text-xl font-bold mb-4">{{ __('storefront.order_summary') }}</h2>

                    <div class="space-y-3 mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">{{ __('storefront.subtotal') }}</span>
                            <span class="font-semibold">${{ number_format($total, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">{{ __('storefront.shipping') }}</span>
                            <span class="font-semibold">$10.00</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">{{ __('storefront.tax') }}</span>
                            <span class="font-semibold">${{ number_format($total * 0.1, 2) }}</span>
                        </div>
                        <div class="border-t pt-3 flex justify-between text-lg">
                            <span class="font-bold">{{ __('storefront.total') }}</span>
                            <span class="font-bold text-blue-600">${{ number_format($total + 10 + ($total * 0.1), 2) }}</span>
                        </div>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="block w-full bg-blue-600 text-white text-center py-3 rounded-lg hover:bg-blue-700 font-semibold">
                        {{ __('storefront.proceed_to_checkout') }}
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
