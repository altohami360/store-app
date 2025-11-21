@props([
    'variant' => 'primary', // primary, secondary, outline, ghost, danger
    'size' => 'md', // sm, md, lg
    'href' => null,
    'type' => 'button',
    'icon' => null,
])

@php
$baseClasses = 'inline-flex items-center justify-center font-semibold transition-all duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed';

$variants = [
    'primary' => 'bg-blue-600 text-white hover:bg-blue-700 focus:ring-blue-500 shadow-sm hover:shadow-md',
    'secondary' => 'bg-gray-600 text-white hover:bg-gray-700 focus:ring-gray-500 shadow-sm hover:shadow-md',
    'outline' => 'border-2 border-blue-600 text-blue-600 hover:bg-blue-50 focus:ring-blue-500',
    'ghost' => 'text-gray-700 hover:bg-gray-100 focus:ring-gray-500',
    'danger' => 'bg-red-600 text-white hover:bg-red-700 focus:ring-red-500 shadow-sm hover:shadow-md',
];

$sizes = [
    'sm' => 'px-3 py-1.5 text-sm rounded-md',
    'md' => 'px-4 py-2.5 text-base rounded-lg',
    'lg' => 'px-6 py-3 text-lg rounded-lg',
];

$classes = $baseClasses . ' ' . $variants[$variant] . ' ' . $sizes[$size];
@endphp

@if($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            <svg class="w-5 h-5 {{ $slot->isNotEmpty() ? 'ltr:mr-2 rtl:ml-2' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                {!! $icon !!}
            </svg>
        @endif
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
        @if($icon)
            <svg class="w-5 h-5 {{ $slot->isNotEmpty() ? 'ltr:mr-2 rtl:ml-2' : '' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                {!! $icon !!}
            </svg>
        @endif
        {{ $slot }}
    </button>
@endif
