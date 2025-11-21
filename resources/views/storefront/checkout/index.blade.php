@extends('storefront.layouts.app')

@section('title', __('storefront.checkout'))

@section('content')
<div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold mb-8">{{ __('storefront.checkout') }}</h1>

    <form action="{{ route('checkout.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Checkout Form -->
            <div class="lg:col-span-2">
                <!-- Customer Information -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-bold mb-4">{{ __('storefront.billing_details') }}</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('storefront.name') }} *
                            </label>
                            <input type="text"
                                   name="customer_name"
                                   id="customer_name"
                                   value="{{ old('customer_name', Auth::user()->name) }}"
                                   required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('customer_name') border-red-500 @enderror">
                            @error('customer_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('storefront.email') }} *
                            </label>
                            <input type="email"
                                   name="customer_email"
                                   id="customer_email"
                                   value="{{ old('customer_email', Auth::user()->email) }}"
                                   required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('customer_email') border-red-500 @enderror">
                            @error('customer_email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('storefront.phone') }} *
                            </label>
                            <input type="tel"
                                   name="customer_phone"
                                   id="customer_phone"
                                   value="{{ old('customer_phone') }}"
                                   required
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('customer_phone') border-red-500 @enderror">
                            @error('customer_phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Shipping Address -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h2 class="text-xl font-bold mb-4">{{ __('storefront.shipping_details') }}</h2>

                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label for="shipping_address" class="block text-sm font-medium text-gray-700 mb-1">
                                {{ __('storefront.address') }} *
                            </label>
                            <textarea name="shipping_address"
                                      id="shipping_address"
                                      rows="3"
                                      required
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('shipping_address') border-red-500 @enderror">{{ old('shipping_address') }}</textarea>
                            @error('shipping_address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="shipping_city" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('storefront.city') }} *
                                </label>
                                <input type="text"
                                       name="shipping_city"
                                       id="shipping_city"
                                       value="{{ old('shipping_city') }}"
                                       required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('shipping_city') border-red-500 @enderror">
                                @error('shipping_city')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="shipping_state" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('storefront.state') }}
                                </label>
                                <input type="text"
                                       name="shipping_state"
                                       id="shipping_state"
                                       value="{{ old('shipping_state') }}"
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="shipping_zip" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('storefront.zip') }} *
                                </label>
                                <input type="text"
                                       name="shipping_zip"
                                       id="shipping_zip"
                                       value="{{ old('shipping_zip') }}"
                                       required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('shipping_zip') border-red-500 @enderror">
                                @error('shipping_zip')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="shipping_country" class="block text-sm font-medium text-gray-700 mb-1">
                                    {{ __('storefront.country') }} *
                                </label>
                                <input type="text"
                                       name="shipping_country"
                                       id="shipping_country"
                                       value="{{ old('shipping_country') }}"
                                       required
                                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('shipping_country') border-red-500 @enderror">
                                @error('shipping_country')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                                Order Notes (Optional)
                            </label>
                            <textarea name="notes"
                                      id="notes"
                                      rows="3"
                                      placeholder="Notes about your order, e.g. special notes for delivery"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">{{ old('notes') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div>
                <div class="bg-white rounded-lg shadow-md p-6 sticky top-4">
                    <h2 class="text-xl font-bold mb-4">{{ __('storefront.order_summary') }}</h2>

                    <!-- Cart Items -->
                    <div class="mb-4 max-h-64 overflow-y-auto">
                        @foreach($cartItems as $item)
                        <div class="flex gap-3 mb-3 pb-3 border-b">
                            <div class="flex-shrink-0">
                                @if($item->product->featured_image)
                                <img src="{{ Storage::url($item->product->featured_image) }}"
                                     alt="{{ $item->product->name }}"
                                     class="w-16 h-16 object-cover rounded">
                                @endif
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-sm">{{ $item->product->name }}</h4>
                                <p class="text-sm text-gray-600">Qty: {{ $item->quantity }}</p>
                                <p class="text-sm font-semibold">${{ number_format($item->product->price * $item->quantity, 2) }}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Totals -->
                    <div class="space-y-2 mb-4">
                        <div class="flex justify-between">
                            <span class="text-gray-600">{{ __('storefront.subtotal') }}</span>
                            <span class="font-semibold">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">{{ __('storefront.shipping') }}</span>
                            <span class="font-semibold">${{ number_format($shipping, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">{{ __('storefront.tax') }}</span>
                            <span class="font-semibold">${{ number_format($tax, 2) }}</span>
                        </div>
                        <div class="border-t pt-2 flex justify-between text-lg">
                            <span class="font-bold">{{ __('storefront.total') }}</span>
                            <span class="font-bold text-blue-600">${{ number_format($total, 2) }}</span>
                        </div>
                    </div>

                    <!-- Payment Method -->
                    <div class="mb-4 p-3 bg-gray-50 rounded">
                        <p class="text-sm text-gray-600 mb-2">{{ __('storefront.payment_method') }}</p>
                        <p class="font-semibold">Stripe (Placeholder)</p>
                        <p class="text-xs text-gray-500 mt-1">Payment processing will be integrated in production</p>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg hover:bg-blue-700 font-semibold text-lg">
                        {{ __('storefront.place_order') }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
