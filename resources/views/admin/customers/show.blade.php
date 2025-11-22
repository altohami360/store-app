@extends('admin.layouts.app')

@section('title', __('admin.customer_details'))
@section('page-title', __('admin.customer_details'))

@section('content')
<div class="space-y-6">
    <!-- Customer Information -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
            <h3 class="text-lg font-semibold text-gray-900">{{ __('admin.customer_information') }}</h3>
            <a href="{{ route('admin.customers.edit', $customer) }}"
               class="inline-flex items-center px-4 py-2 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-lg shadow-sm transition">
                <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                {{ __('admin.edit') }}
            </a>
        </div>

        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">{{ __('admin.name') }}</label>
                <div class="flex items-center">
                    <div class="w-12 h-12 rounded-full bg-amber-500 flex items-center justify-center text-white font-semibold text-lg {{ app()->getLocale() === 'ar' ? 'ml-3' : 'mr-3' }}">
                        {{ substr($customer->name, 0, 1) }}
                    </div>
                    <p class="text-base font-medium text-gray-900">{{ $customer->name }}</p>
                </div>
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">{{ __('admin.email') }}</label>
                <p class="text-base text-gray-900">{{ $customer->email }}</p>
            </div>

            <!-- Phone -->
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">{{ __('admin.phone') }}</label>
                <p class="text-base text-gray-900">{{ $customer->phone ?? '-' }}</p>
            </div>

            <!-- Joined Date -->
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">{{ __('admin.joined') }}</label>
                <p class="text-base text-gray-900">{{ $customer->created_at->format('Y-m-d H:i') }}</p>
            </div>

            <!-- Total Orders -->
            <div>
                <label class="block text-sm font-medium text-gray-500 mb-1">{{ __('admin.total_orders') }}</label>
                <p class="text-base text-gray-900">{{ $customer->orders->count() }}</p>
            </div>
        </div>
    </div>

    <!-- Orders History -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">{{ __('admin.order_history') }}</h3>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('admin.order_number') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('admin.date') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('admin.total') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('admin.status') }}
                        </th>
                        <th scope="col" class="px-6 py-3 text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} text-xs font-medium text-gray-500 uppercase tracking-wider">
                            {{ __('admin.actions_label') }}
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($customer->orders as $order)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $order->order_number }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $order->created_at->format('Y-m-d H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ number_format($order->total, 2) }} {{ __('admin.currency') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusColors = [
                                        'pending' => 'bg-yellow-100 text-yellow-800',
                                        'processing' => 'bg-blue-100 text-blue-800',
                                        'shipped' => 'bg-purple-100 text-purple-800',
                                        'delivered' => 'bg-green-100 text-green-800',
                                        'cancelled' => 'bg-red-100 text-red-800',
                                    ];
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ __('admin.'.$order->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('admin.orders.show', $order) }}"
                                   class="text-amber-600 hover:text-amber-900 transition">
                                    {{ __('admin.view') }}
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                                </svg>
                                <p class="mt-2 text-sm font-medium">{{ __('admin.no_orders_found') }}</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Back Button -->
    <div class="flex justify-start">
        <a href="{{ route('admin.customers.index') }}"
           class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
            {{ __('admin.back_to_list') }}
        </a>
    </div>
</div>
@endsection
