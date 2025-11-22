@extends('admin.layouts.app')

@section('title', __('admin.edit_order'))
@section('page-title', __('admin.edit_order'))

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">{{ __('admin.order') }} #{{ $order->order_number }}</h3>
        </div>

        <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.status') }} <span class="text-red-500">*</span>
                </label>
                <select name="status"
                        id="status"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('status') border-red-500 @enderror">
                    <option value="pending" {{ old('status', $order->status) === 'pending' ? 'selected' : '' }}>
                        {{ __('admin.order_status_pending') }}
                    </option>
                    <option value="processing" {{ old('status', $order->status) === 'processing' ? 'selected' : '' }}>
                        {{ __('admin.order_status_processing') }}
                    </option>
                    <option value="shipped" {{ old('status', $order->status) === 'shipped' ? 'selected' : '' }}>
                        {{ __('admin.order_status_shipped') }}
                    </option>
                    <option value="delivered" {{ old('status', $order->status) === 'delivered' ? 'selected' : '' }}>
                        {{ __('admin.order_status_delivered') }}
                    </option>
                    <option value="cancelled" {{ old('status', $order->status) === 'cancelled' ? 'selected' : '' }}>
                        {{ __('admin.order_status_cancelled') }}
                    </option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Notes -->
            <div>
                <label for="notes" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.notes') }}
                </label>
                <textarea name="notes"
                          id="notes"
                          rows="4"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('notes') border-red-500 @enderror">{{ old('notes', $order->notes) }}</textarea>
                @error('notes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Order Summary -->
            <div class="border-t border-gray-200 pt-6">
                <h4 class="text-sm font-semibold text-gray-900 mb-4">{{ __('admin.order_summary') }}</h4>
                <dl class="space-y-2">
                    <div class="flex justify-between text-sm">
                        <dt class="text-gray-600">{{ __('admin.customer') }}:</dt>
                        <dd class="text-gray-900 font-medium">{{ $order->customer_name }}</dd>
                    </div>
                    <div class="flex justify-between text-sm">
                        <dt class="text-gray-600">{{ __('admin.total') }}:</dt>
                        <dd class="text-gray-900 font-bold">{{ number_format($order->total, 2) }} {{ __('storefront.sar') }}</dd>
                    </div>
                    <div class="flex justify-between text-sm">
                        <dt class="text-gray-600">{{ __('admin.items') }}:</dt>
                        <dd class="text-gray-900">{{ $order->orderItems->count() }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.orders.index') }}"
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                    {{ __('admin.cancel') }}
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-lg shadow-sm transition">
                    {{ __('admin.update') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
