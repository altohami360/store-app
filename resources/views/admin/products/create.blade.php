@extends('admin.layouts.app')

@section('title', __('admin.create_product'))
@section('page-title', __('admin.create_product'))

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">{{ __('admin.product_information') }}</h3>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
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
                          rows="4"
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
                          rows="4"
                          dir="rtl"
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('description.ar') border-red-500 @enderror">{{ old('description.ar') }}</textarea>
                @error('description.ar')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.category') }} <span class="text-red-500">*</span>
                </label>
                <select name="category_id"
                        id="category_id"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('category_id') border-red-500 @enderror">
                    <option value="">{{ __('admin.select_category') }}</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pricing -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Price -->
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('admin.price') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="number"
                           name="price"
                           id="price"
                           value="{{ old('price') }}"
                           step="0.01"
                           min="0"
                           required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('price') border-red-500 @enderror">
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Compare at Price -->
                <div>
                    <label for="compare_at_price" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('admin.compare_at_price') }}
                    </label>
                    <input type="number"
                           name="compare_at_price"
                           id="compare_at_price"
                           value="{{ old('compare_at_price') }}"
                           step="0.01"
                           min="0"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('compare_at_price') border-red-500 @enderror">
                    @error('compare_at_price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Cost -->
                <div>
                    <label for="cost" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('admin.cost') }}
                    </label>
                    <input type="number"
                           name="cost"
                           id="cost"
                           value="{{ old('cost') }}"
                           step="0.01"
                           min="0"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('cost') border-red-500 @enderror">
                    @error('cost')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Inventory -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- SKU -->
                <div>
                    <label for="sku" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('admin.sku') }}
                    </label>
                    <input type="text"
                           name="sku"
                           id="sku"
                           value="{{ old('sku') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('sku') border-red-500 @enderror">
                    @error('sku')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Barcode -->
                <div>
                    <label for="barcode" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('admin.barcode') }}
                    </label>
                    <input type="text"
                           name="barcode"
                           id="barcode"
                           value="{{ old('barcode') }}"
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('barcode') border-red-500 @enderror">
                    @error('barcode')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Quantity -->
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('admin.quantity') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="number"
                           name="quantity"
                           id="quantity"
                           value="{{ old('quantity', 0) }}"
                           min="0"
                           required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('quantity') border-red-500 @enderror">
                    @error('quantity')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <!-- Featured Image -->
            <div>
                <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.featured_image') }}
                </label>
                <input type="file"
                       name="featured_image"
                       id="featured_image"
                       accept="image/*"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('featured_image') border-red-500 @enderror">
                @error('featured_image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">{{ __('admin.upload_images') }}</p>
            </div>

            <!-- Status Checkboxes -->
            <div class="grid grid-cols-2 gap-6">
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

                <!-- Featured Status -->
                <div>
                    <label for="is_featured" class="block text-sm font-medium text-gray-700 mb-2">
                        {{ __('admin.featured') }}
                    </label>
                    <label class="flex items-center cursor-pointer">
                        <input type="checkbox"
                               name="is_featured"
                               id="is_featured"
                               value="1"
                               {{ old('is_featured', false) ? 'checked' : '' }}
                               class="rounded border-gray-300 text-amber-500 focus:ring-amber-500 {{ app()->getLocale() === 'ar' ? 'ml-2' : 'mr-2' }}">
                        <span class="text-sm text-gray-700">{{ __('admin.featured') }}</span>
                    </label>
                </div>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.products.index') }}"
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
