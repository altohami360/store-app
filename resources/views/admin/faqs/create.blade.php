@extends('admin.layouts.app')

@section('title', __('admin.create_faq'))
@section('page-title', __('admin.create_faq'))

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">{{ __('admin.faq_information') }}</h3>
        </div>

        <form action="{{ route('admin.faqs.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <!-- Question (English) -->
            <div>
                <label for="question_en" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.question_en') }} <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="question[en]"
                       id="question_en"
                       value="{{ old('question.en') }}"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('question.en') border-red-500 @enderror">
                @error('question.en')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Question (Arabic) -->
            <div>
                <label for="question_ar" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.question_ar') }} <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="question[ar]"
                       id="question_ar"
                       value="{{ old('question.ar') }}"
                       required
                       dir="rtl"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('question.ar') border-red-500 @enderror">
                @error('question.ar')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Answer (English) -->
            <div>
                <label for="answer_en" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.answer_en') }} <span class="text-red-500">*</span>
                </label>
                <textarea name="answer[en]"
                          id="answer_en"
                          rows="5"
                          required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('answer.en') border-red-500 @enderror">{{ old('answer.en') }}</textarea>
                @error('answer.en')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Answer (Arabic) -->
            <div>
                <label for="answer_ar" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.answer_ar') }} <span class="text-red-500">*</span>
                </label>
                <textarea name="answer[ar]"
                          id="answer_ar"
                          rows="5"
                          required
                          dir="rtl"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('answer.ar') border-red-500 @enderror">{{ old('answer.ar') }}</textarea>
                @error('answer.ar')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Order -->
            <div>
                <label for="order" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.order') }}
                </label>
                <input type="number"
                       name="order"
                       id="order"
                       value="{{ old('order', 0) }}"
                       min="0"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('order') border-red-500 @enderror">
                @error('order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">{{ __('admin.lower_number_appears_first') }}</p>
            </div>

            <!-- Active Status -->
            <div class="flex items-center">
                <input type="checkbox"
                       name="is_active"
                       id="is_active"
                       value="1"
                       {{ old('is_active', true) ? 'checked' : '' }}
                       class="h-4 w-4 text-amber-500 focus:ring-amber-500 border-gray-300 rounded">
                <label for="is_active" class="{{ app()->getLocale() === 'ar' ? 'mr-2' : 'ml-2' }} block text-sm font-medium text-gray-700">
                    {{ __('admin.active') }}
                </label>
            </div>

            <!-- Submit Buttons -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.faqs.index') }}"
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                    {{ __('admin.cancel') }}
                </a>
                <button type="submit"
                        class="px-4 py-2 text-sm font-medium text-white bg-amber-500 rounded-lg hover:bg-amber-600 transition">
                    {{ __('admin.create') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
