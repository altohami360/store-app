@extends('storefront.layouts.app')

@section('title', __('storefront.faqs'))

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <!-- Breadcrumbs -->
        <x-storefront.breadcrumbs :items="[
            ['label' => __('storefront.faqs'), 'url' => '#']
        ]" />

        <!-- Page Header -->
        <div class="mb-12 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                {{ __('storefront.frequently_asked_questions') }}
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                {{ __('storefront.find_answers_to_common_questions') ?? 'Find answers to common questions about our products and services' }}
            </p>
        </div>

        <!-- FAQs Accordion -->
        <div class="max-w-4xl mx-auto">
            @forelse($faqs as $faq)
                <div class="mb-4" x-data="{ open: {{ $loop->first ? 'true' : 'false' }} }">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                        <!-- Question -->
                        <button @click="open = !open"
                                class="w-full px-6 py-4 flex items-center justify-between text-{{ app()->getLocale() === 'ar' ? 'right' : 'left' }} hover:bg-gray-50 transition-colors">
                            <span class="text-lg font-semibold text-gray-900 {{ app()->getLocale() === 'ar' ? 'ml-4' : 'mr-4' }}">
                                {{ $faq->question }}
                            </span>
                            <svg class="w-6 h-6 text-amber-500 flex-shrink-0 transform transition-transform duration-200"
                                 :class="{ 'rotate-180': open }"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Answer -->
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 transform -translate-y-2"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="px-6 pb-6 text-gray-700 leading-relaxed border-t border-gray-100"
                             style="display: none;">
                            <div class="pt-4">
                                {{ $faq->answer }}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-12 text-center">
                    <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ __('storefront.no_faqs_found') }}</h3>
                    <p class="text-gray-600 mb-6">{{ __('storefront.check_back_later') ?? 'Check back later for frequently asked questions' }}</p>
                    <a href="{{ route('home') }}"
                       class="inline-flex items-center px-6 py-3 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-lg transition-colors">
                        <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        {{ __('storefront.back_to_store') }}
                    </a>
                </div>
            @endforelse
        </div>

        <!-- Contact Section -->
        @if($faqs->count() > 0)
            <div class="max-w-4xl mx-auto mt-12">
                <div class="bg-gradient-to-r from-amber-500 to-amber-600 rounded-xl shadow-lg p-8 text-center text-white">
                    <h3 class="text-2xl font-bold mb-3">{{ __('storefront.still_have_questions') ?? 'Still have questions?' }}</h3>
                    <p class="text-amber-50 mb-6">{{ __('storefront.contact_support_team') ?? 'Our support team is here to help you' }}</p>
                    <a href="{{ route('home') }}#contact"
                       class="inline-flex items-center px-6 py-3 bg-white text-amber-600 font-semibold rounded-lg hover:bg-gray-50 transition-colors shadow-lg">
                        <svg class="w-5 h-5 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        {{ __('storefront.contact_us') }}
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
