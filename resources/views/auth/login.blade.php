<x-guest-layout>

    <x-slot name="logo">
        <div class="text-center mb-6">
            <h2 class="text-3xl font-bold text-white shadow-md">
                Laptop Management
            </h2>
            <p class="text-sm text-gray-200 mt-2 shadow-sm">
                Welcome back! Please enter your details.
            </p>
        </div>
    </x-slot>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            
            <div class="flex mt-1 border border-gray-300 rounded-md shadow-sm overflow-hidden focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
                <span class="inline-flex items-center px-3 bg-white text-gray-500">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                    </svg>
                </span>
                <x-text-input id="email" 
                              class="block w-full flex-1 border-0 focus:ring-0 rounded-none" 
                              type="email" 
                              name="email" 
                              :value="old('email')" 
                              required autofocus autocomplete="username" 
                              placeholder="example@gmail.com" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <div class="flex mt-1 border border-gray-300 rounded-md shadow-sm overflow-hidden focus-within:border-indigo-500 focus-within:ring-1 focus-within:ring-indigo-500">
                <span class="inline-flex items-center px-3 bg-white text-gray-500">
                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </span>
                <x-text-input id="password" 
                              class="block w-full flex-1 border-0 focus:ring-0 rounded-none"
                              type="password"
                              name="password"
                              required autocomplete="current-password" 
                              placeholder="••••••••" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 transition duration-150 ease-in-out" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100">
            <div>
                @if (Route::has('password.request'))
                    <a class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition duration-150 ease-in-out" href="{{ route('password.request') }}">
                        {{ __('Forgot password?') }}
                    </a>
                @endif
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('register') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900 transition duration-150 ease-in-out">
                    Register
                </a>

                <x-primary-button class="ms-3 bg-indigo-600 hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 shadow-lg transform transition hover:-translate-y-0.5">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </div>
    </form>
</x-guest-layout>