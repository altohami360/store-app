@extends('storefront.layouts.app')

@section('title', 'Order Confirmation')

@section('content')
<div class="container mx-auto px-4">
    <div class="max-w-3xl mx-auto">
        <!-- Success Message -->
        <div class="bg-green-50 border border-green-200 rounded-lg p-6 mb-8 text-center">
            <svg class="mx-auto h-16 w-16 text-green-500 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <h1 class="text-3xl font-bold text-green-800 mb-2">Order Placed Successfully!</h1>
            <p class="text-green-700">Thank you for your order. We've received it and will process it shortly.</p>
        </div>

        <!-- Order Details -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold mb-4">Order Details</h2>

            <div class="grid grid-cols-2 gap-4 mb-6">
                <div>
                    <p class="text-sm text-gray-600">{{ __('storefront.order_number') }}</p>
                    <p class="font-semibold">{{ $order->order_number }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Date</p>
                    <p class="font-semibold">{{ $order->created_at->format('M d, Y') }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">{{ __('storefront.order_status') }}</p>
                    <p class="font-semibold capitalize">{{ $order->status }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Total</p>
                    <p class="font-semibold text-blue-600">${{ number_format($order->total, 2) }}</p>
                </div>
            </div>

            <!-- Customer Info -->
            <div class="border-t pt-4 mb-6">
                <h3 class="font-semibold mb-3">Customer Information</h3>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600">Name</p>
                        <p>{{ $order->customer_name }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Email</p>
                        <p>{{ $order->customer_email }}</p>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Phone</p>
                        <p>{{ $order->customer_phone }}</p>
                    </div>
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="border-t pt-4">
                <h3 class="font-semibold mb-3">{{ __('storefront.shipping_details') }}</h3>
                <p>{{ $order->shipping_address }}</p>
                <p>{{ $order->shipping_city }}, {{ $order->shipping_state }} {{ $order->shipping_zip }}</p>
                <p>{{ $order->shipping_country }}</p>
            </div>
        </div>

        <!-- Order Items -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold mb-4">Order Items</h2>

            <div class="space-y-4">
                @foreach($order->items as $item)
                <div class="flex gap-4 pb-4 border-b last:border-b-0">
                    <div class="flex-shrink-0">
                        @if($item->product->featured_image)
                        <img src="{{ Storage::url($item->product->featured_image) }}"
                             alt="{{ $item->product_name }}"
                             class="w-20 h-20 object-cover rounded">
                        @else
                        <div class="w-20 h-20 bg-gray-200 rounded flex items-center justify-center">
                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <h4 class="font-semibold">{{ $item->product_name }}</h4>
                        <p class="text-sm text-gray-600">SKU: {{ $item->product_sku }}</p>
                        <p class="text-sm text-gray-600">Quantity: {{ $item->quantity }}</p>
                    </div>
                    <div class="text-right">
                        <p class="font-semibold">${{ number_format($item->total, 2) }}</p>
                        <p class="text-sm text-gray-600">${{ number_format($item->price, 2) }} each</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="border-t mt-4 pt-4 space-y-2">
                <div class="flex justify-between">
                    <span class="text-gray-600">{{ __('storefront.subtotal') }}</span>
                    <span class="font-semibold">${{ number_format($order->subtotal, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">{{ __('storefront.shipping') }}</span>
                    <span class="font-semibold">${{ number_format($order->shipping, 2) }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">{{ __('storefront.tax') }}</span>
                    <span class="font-semibold">${{ number_format($order->tax, 2) }}</span>
                </div>
                <div class="flex justify-between text-lg border-t pt-2">
                    <span class="font-bold">{{ __('storefront.total') }}</span>
                    <span class="font-bold text-blue-600">${{ number_format($order->total, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Actions -->
        <div class="text-center">
            <a href="{{ route('home') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 mr-2">
                Continue Shopping
            </a>
            <a href="{{ route('products.index') }}" class="inline-block bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300">
                Browse Products
            </a>
        </div>
    </div>
</div>
@endsection
