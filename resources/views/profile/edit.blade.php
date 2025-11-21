@extends('storefront.layouts.app')

@section('title', __('storefront.profile'))

@section('content')
<div class="bg-gray-50 py-12">
    <div class="container mx-auto px-4">
        <!-- Breadcrumbs -->
        <x-storefront.breadcrumbs :items="[
            ['label' => __('storefront.profile'), 'url' => '#']
        ]" />

        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                {{ __('storefront.my_account') }}
            </h1>
            <p class="text-gray-600">{{ __('storefront.manage_account_settings') }}</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Sidebar Navigation -->
            <aside class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 sticky top-24">
                    <div class="flex items-center gap-4 mb-6 pb-6 border-b">
                        <div class="w-16 h-16 bg-blue-600 rounded-full flex items-center justify-center text-white text-2xl font-bold">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900">{{ Auth::user()->name }}</h3>
                            <p class="text-sm text-gray-600">{{ Auth::user()->email }}</p>
                        </div>
                    </div>

                    <nav class="space-y-1">
                        <a href="#profile-info"
                           class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            {{ __('storefront.profile_information') }}
                        </a>
                        <a href="#password"
                           class="flex items-center gap-3 px-4 py-3 rounded-lg text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            {{ __('storefront.change_password') }}
                        </a>
                        <a href="#delete-account"
                           class="flex items-center gap-3 px-4 py-3 rounded-lg text-red-600 hover:bg-red-50 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                            {{ __('storefront.delete_account') }}
                        </a>
                    </nav>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="lg:col-span-2 space-y-6">
                <!-- Update Profile Information -->
                <div id="profile-info" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">
                            {{ __('storefront.profile_information') }}
                        </h2>
                        <p class="text-gray-600">
                            {{ __('storefront.update_profile_info') }}
                        </p>
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-6">
                        @csrf
                        @method('patch')

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                {{ __('storefront.name') }}
                            </label>
                            <input id="name"
                                   type="text"
                                   name="name"
                                   value="{{ old('name', $user->name) }}"
                                   required
                                   autofocus
                                   autocomplete="name"
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('name') border-red-500 @enderror">
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                                {{ __('storefront.phone_number') }}
                            </label>
                            <input id="phone"
                                   type="tel"
                                   name="phone"
                                   value="{{ old('phone', $user->phone) }}"
                                   required
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('phone') border-red-500 @enderror">
                            @error('phone')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                {{ __('storefront.email') }}
                            </label>
                            <input id="email"
                                   type="email"
                                   name="email"
                                   value="{{ old('email', $user->email) }}"
                                   required
                                   autocomplete="username"
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('email') border-red-500 @enderror">
                            @error('email')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <div class="mt-3">
                                    <p class="text-sm text-gray-800">
                                        {{ __('storefront.your_email_unverified') }}
                                        <button form="send-verification" class="underline text-sm text-blue-600 hover:text-blue-700">
                                            {{ __('storefront.resend_verification') }}
                                        </button>
                                    </p>

                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 font-medium text-sm text-green-600">
                                            {{ __('storefront.verification_sent') }}
                                        </p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <!-- Save Button -->
                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 font-semibold transition-all shadow-sm hover:shadow-md">
                                {{ __('storefront.save_changes') }}
                            </button>

                            @if (session('status') === 'profile-updated')
                                <p class="text-sm text-green-600 font-medium animate-fade-in">
                                    {{ __('storefront.saved') }}
                                </p>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Update Password -->
                <div id="password" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 md:p-8">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-2">
                            {{ __('storefront.update_password') }}
                        </h2>
                        <p class="text-gray-600">
                            {{ __('storefront.ensure_secure_password') }}
                        </p>
                    </div>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-6">
                        @csrf
                        @method('put')

                        <!-- Current Password -->
                        <div>
                            <label for="current_password" class="block text-sm font-semibold text-gray-700 mb-2">
                                {{ __('storefront.current_password') }}
                            </label>
                            <input id="current_password"
                                   type="password"
                                   name="current_password"
                                   autocomplete="current-password"
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('current_password', 'updatePassword') border-red-500 @enderror">
                            @error('current_password', 'updatePassword')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- New Password -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                {{ __('storefront.new_password') }}
                            </label>
                            <input id="password"
                                   type="password"
                                   name="password"
                                   autocomplete="new-password"
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all @error('password', 'updatePassword') border-red-500 @enderror">
                            @error('password', 'updatePassword')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                                {{ __('storefront.confirm_password') }}
                            </label>
                            <input id="password_confirmation"
                                   type="password"
                                   name="password_confirmation"
                                   autocomplete="new-password"
                                   class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                        </div>

                        <!-- Save Button -->
                        <div class="flex items-center gap-4">
                            <button type="submit" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 font-semibold transition-all shadow-sm hover:shadow-md">
                                {{ __('storefront.update_password') }}
                            </button>

                            @if (session('status') === 'password-updated')
                                <p class="text-sm text-green-600 font-medium animate-fade-in">
                                    {{ __('storefront.saved') }}
                                </p>
                            @endif
                        </div>
                    </form>
                </div>

                <!-- Delete Account -->
                <div id="delete-account" class="bg-white rounded-xl shadow-sm border border-red-200 p-6 md:p-8">
                    <div class="mb-6">
                        <h2 class="text-2xl font-bold text-red-900 mb-2">
                            {{ __('storefront.delete_account') }}
                        </h2>
                        <p class="text-gray-600">
                            {{ __('storefront.delete_account_warning') }}
                        </p>
                    </div>

                    <button
                        x-data=""
                        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
                        class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 font-semibold transition-all shadow-sm hover:shadow-md">
                        {{ __('storefront.delete_account') }}
                    </button>

                    <!-- Delete Confirmation Modal -->
                    <div
                        x-data="{ show: false }"
                        x-on:open-modal.window="$event.detail === 'confirm-user-deletion' ? show = true : null"
                        x-on:close-modal.window="show = false"
                        x-show="show"
                        class="fixed inset-0 z-50 overflow-y-auto"
                        style="display: none;">

                        <!-- Backdrop -->
                        <div x-show="show"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0"
                             x-transition:enter-end="opacity-100"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100"
                             x-transition:leave-end="opacity-0"
                             class="fixed inset-0 bg-gray-900 bg-opacity-75"
                             @click="show = false"></div>

                        <!-- Modal -->
                        <div class="flex items-center justify-center min-h-screen px-4">
                            <div x-show="show"
                                 x-transition:enter="transition ease-out duration-300"
                                 x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                 x-transition:leave="transition ease-in duration-200"
                                 x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                 class="bg-white rounded-2xl shadow-xl max-w-lg w-full p-8 relative">

                                <h3 class="text-2xl font-bold text-gray-900 mb-4">
                                    {{ __('storefront.confirm_account_deletion') }}
                                </h3>

                                <p class="text-gray-600 mb-6">
                                    {{ __('storefront.confirm_deletion_message') }}
                                </p>

                                <form method="post" action="{{ route('profile.destroy') }}" class="space-y-6">
                                    @csrf
                                    @method('delete')

                                    <div>
                                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                                            {{ __('storefront.password') }}
                                        </label>
                                        <input id="password"
                                               type="password"
                                               name="password"
                                               placeholder="{{ __('storefront.password') }}"
                                               class="block w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-red-500 transition-all @error('password', 'userDeletion') border-red-500 @enderror">
                                        @error('password', 'userDeletion')
                                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="flex items-center gap-4">
                                        <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 font-semibold transition-all">
                                            {{ __('storefront.delete_account') }}
                                        </button>

                                        <button type="button"
                                                @click="show = false"
                                                class="bg-gray-200 text-gray-700 px-6 py-3 rounded-lg hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 font-semibold transition-all">
                                            {{ __('storefront.cancel') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
</div>

<!-- Verification Email Form (Hidden) -->
@if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
    <form id="send-verification" method="post" action="{{ route('verification.send') }}" style="display: none;">
        @csrf
    </form>
@endif
@endsection
