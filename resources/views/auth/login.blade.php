<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
        <div class="mt-4">
            <a href="{{ route('google.login') }}"
            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M21.6 12.2c0-.7-.1-1.4-.2-2h-9v3.8h5.5c-.3 1.3-1 2.4-2 3.1v2.6h3.2c1.9-1.8 3-4.5 3-7.5z"
                        fill="#4285F4" />
                    <path
                        d="M12.4 22c2.7 0 4.9-.9 6.5-2.4l-3.2-2.6c-.9.6-2 1-3.3 1-2.5 0-4.6-1.7-5.4-4.1H3.7v2.6C5.3 19.9 8.6 22 12.4 22z"
                        fill="#34A853" />
                    <path
                        d="M7 13.9c-.2-.6-.3-1.3-.3-1.9s.1-1.3.3-1.9V7.5H3.7C3.1 8.8 2.8 10.3 2.8 12s.3 3.2.9 4.5L7 13.9z"
                        fill="#FBBC05" />
                    <path
                        d="M12.4 5.2c1.5 0 2.8.5 3.9 1.5l2.9-2.9C17.2 1.8 14.9 1 12.4 1 8.6 1 5.3 3.1 3.7 6l3.3 2.6c.7-2.3 2.8-4 5.4-4z"
                        fill="#EA4335" />
                </svg>
                Login with Google
            </a>
        </div>

    </form>
</x-guest-layout>
