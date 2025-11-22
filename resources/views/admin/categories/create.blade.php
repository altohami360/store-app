@extends('admin.layouts.app')

@section('title', __('admin.create_category'))
@section('page-title', __('admin.create_category'))

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">{{ __('admin.category_information') }}</h3>
        </div>

        <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            @csrf

            <!-- Name (English) -->
            <div>
                <label for="name_en" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.name_en') }} <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="name[en]"
                       id="name_en"
                       value="{{ old('name.en') }}"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('name.en') border-red-500 @enderror">
                @error('name.en')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Name (Arabic) -->
            <div>
                <label for="name_ar" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.name_ar') }} <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="name[ar]"
                       id="name_ar"
                       value="{{ old('name.ar') }}"
                       required
                       dir="rtl"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('name.ar') border-red-500 @enderror">
                @error('name.ar')
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
            </div>

            <!-- Description (English) -->
            <div>
                <label for="description_en" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.description_en') }}
                </label>
                <textarea name="description[en]"
                          id="description_en"
                          rows="3"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('description.en') border-red-500 @enderror">{{ old('description.en') }}</textarea>
                @error('description.en')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Description (Arabic) -->
            <div>
                <label for="description_ar" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.description_ar') }}
                </label>
                <textarea name="description[ar]"
                          id="description_ar"
                          rows="3"
                          dir="rtl"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('description.ar') border-red-500 @enderror">{{ old('description.ar') }}</textarea>
                @error('description.ar')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Parent Category -->
            <div>
                <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.parent_category') }}
                </label>
                <select name="parent_id"
                        id="parent_id"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('parent_id') border-red-500 @enderror">
                    <option value="">{{ __('admin.no_parent') }}</option>
                    @foreach($parentCategories as $parent)
                        <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                            {{ $parent->name }}
                        </option>
                    @endforeach
                </select>
                @error('parent_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.image') }}
                </label>
                <input type="file"
                       name="image"
                       id="image"
                       accept="image/*"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('image') border-red-500 @enderror">
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">{{ __('admin.upload_images') }}</p>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <!-- Sort Order -->
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('admin.sort_order') }}
                    </label>
                    <input type="number"
                           name="sort_order"
                           id="sort_order"
                           value="{{ old('sort_order', 0) }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('sort_order') border-red-500 @enderror">
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Active Status -->
                <div>
                    <label for="is_active" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('admin.status') }}
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox"
                               name="is_active"
                               id="is_active"
                               value="1"
                               {{ old('is_active', true) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-amber-500 focus:ring-amber-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}">
                        <span class="text-sm text-gray-700">{{ __('admin.active') }}</span>
                    </label>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.categories.index') }}"
                   class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                    {{ __('admin.cancel') }}
                </a>
                <button type="submit"
                        class="px-6 py-2 bg-amber-500 hover:bg-amber-600 text-white font-medium rounded-lg shadow-sm transition">
                    {{ __('admin.create') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
