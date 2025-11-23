@extends('storefront.layouts.app')

@section('title', $page->title)
@section('meta-description', $page->meta_description)

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <!-- Breadcrumbs -->
        <x-storefront.breadcrumbs :items="[
            ['label' => $page->title, 'url' => '#']
        ]" />

        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                {{ $page->title }}
            </h1>
        </div>

        <!-- Page Content -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 md:p-12">
            <div class="prose max-w-none {{ app()->getLocale() === 'ar' ? 'text-right' : 'text-left' }}">
                {!! nl2br(e($page->content)) !!}
            </div>
        </div>

        <!-- Back to Home -->
        <div class="mt-8 text-center">
            <a href="{{ route('home') }}"
               class="inline-flex items-center px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-lg transition-colors">
                <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                {{ __('storefront.back_to_store') }}
            </a>
        </div>
    </div>
</div>
@endsection
