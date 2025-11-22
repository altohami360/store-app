@extends('admin.layouts.app')

@section('title', __('admin.create_setting'))
@section('page-title', __('admin.create_setting'))

@section('content')
<div class="max-w-4xl">
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-900">{{ __('admin.setting_information') }}</h3>
        </div>

        <form action="{{ route('admin.settings.store') }}" method="POST" class="p-6 space-y-6">
            @csrf

            <!-- Key -->
            <div>
                <label for="key" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.key') }} <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="key"
                       id="key"
                       value="{{ old('key') }}"
                       required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('key') border-red-500 @enderror">
                @error('key')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Type -->
            <div>
                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.type') }} <span class="text-red-500">*</span>
                </label>
                <select name="type"
                        id="type"
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('type') border-red-500 @enderror">
                    <option value="string" {{ old('type') === 'string' ? 'selected' : '' }}>String</option>
                    <option value="integer" {{ old('type') === 'integer' ? 'selected' : '' }}>Integer</option>
                    <option value="boolean" {{ old('type') === 'boolean' ? 'selected' : '' }}>Boolean</option>
                    <option value="json" {{ old('type') === 'json' ? 'selected' : '' }}>JSON</option>
                </select>
                @error('type')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Value -->
            <div>
                <label for="value" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.value') }} <span class="text-red-500">*</span>
                </label>
                <textarea name="value"
                          id="value"
                          rows="3"
                          required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('value') border-red-500 @enderror">{{ old('value') }}</textarea>
                @error('value')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                <p class="mt-1 text-sm text-gray-500">{{ __('admin.setting_value_help') }}</p>
            </div>

            <!-- Group -->
            <div>
                <label for="group" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ __('admin.group') }}
                </label>
                <input type="text"
                       name="group"
                       id="group"
                       value="{{ old('group', 'general') }}"
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent @error('group') border-red-500 @enderror">
                @error('group')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.settings.index') }}"
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
