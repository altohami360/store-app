@extends('admin.layouts.app')

@section('title', __('admin.create_page'))
@section('page-title', __('admin.create_page'))

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">{{ __('admin.page_information') }}</h3>
        </div>

        <form action="{{ route('admin.pages.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <!-- Title (English) -->
            <div>
                <label for="title_en" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.title_en') }} <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="title[en]"
                       id="title_en"
                       value="{{ old('title.en') }}"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('title.en') border-red-500 @enderror">
                @error('title.en')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Title (Arabic) -->
            <div>
                <label for="title_ar" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.title_ar') }} <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="title[ar]"
                       id="title_ar"
                       value="{{ old('title.ar') }}"
                       required
                       dir="rtl"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('title.ar') border-red-500 @enderror">
                @error('title.ar')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Slug -->
            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.slug') }} <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="slug"
                       id="slug"
                       value="{{ old('slug') }}"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('slug') border-red-500 @enderror">
                @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">{{ __('admin.slug_example') ?? 'Example: shipping-information' }}</p>
            </div>

            <!-- Content (English) -->
            <div>
                <label for="content_en" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.content_en') }} <span class="text-red-500">*</span>
                </label>
                <textarea name="content[en]"
                          id="content_en"
                          rows="10"
                          required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('content.en') border-red-500 @enderror">{{ old('content.en') }}</textarea>
                @error('content.en')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content (Arabic) -->
            <div>
                <label for="content_ar" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.content_ar') }} <span class="text-red-500">*</span>
                </label>
                <textarea name="content[ar]"
                          id="content_ar"
                          rows="10"
                          required
                          dir="rtl"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('content.ar') border-red-500 @enderror">{{ old('content.ar') }}</textarea>
                @error('content.ar')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Meta Description (English) -->
            <div>
                <label for="meta_description_en" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.meta_description_en') }}
                </label>
                <textarea name="meta_description[en]"
                          id="meta_description_en"
                          rows="2"
                          maxlength="500"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('meta_description.en') border-red-500 @enderror">{{ old('meta_description.en') }}</textarea>
                @error('meta_description.en')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Meta Description (Arabic) -->
            <div>
                <label for="meta_description_ar" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.meta_description_ar') }}
                </label>
                <textarea name="meta_description[ar]"
                          id="meta_description_ar"
                          rows="2"
                          maxlength="500"
                          dir="rtl"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('meta_description.ar') border-red-500 @enderror">{{ old('meta_description.ar') }}</textarea>
                @error('meta_description.ar')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
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
                <a href="{{ route('admin.pages.index') }}"
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
