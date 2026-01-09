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

    </form>
    <hr class="my-6">

    <div class="text-center text-sm text-gray-500 mb-4">
        Or login with
    </div>

    <div class="space-y-3">
        <a href="{{ url('/auth/google') }}"
        class="flex items-center justify-center w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm bg-white text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
            <svg class="w-5 h-5 mr-4" viewBox="0 0 48 48">
                <path fill="#EA4335" d="M24 9.5c3.54 0 6.7 1.22 9.2 3.6l6.9-6.9C35.9 2.4 30.4 0 24 0 14.6 0 6.5 5.4 2.6 13.3l8.1 6.3C12.6 13 17.8 9.5 24 9.5z"/>
                <path fill="#4285F4" d="M46.1 24.5c0-1.6-.1-2.8-.4-4H24v8.1h12.7c-.3 2-1.7 5-4.8 7l7.4 5.7c4.3-4 6.8-9.9 6.8-16.8z"/>
                <path fill="#FBBC05" d="M10.7 28.9c-.5-1.4-.8-2.9-.8-4.4s.3-3 .8-4.4l-8.1-6.3C.9 17 .2 20.4.2 24s.7 7 2.4 10.2l8.1-6.3z"/>
                <path fill="#34A853" d="M24 48c6.4 0 11.8-2.1 15.7-5.7l-7.4-5.7c-2 1.4-4.7 2.4-8.3 2.4-6.2 0-11.4-4.1-13.3-9.7l-8.1 6.3C6.5 42.6 14.6 48 24 48z"/>
            </svg>
            Continue with Google
        </a>
        </br>
        <a href="{{ url('/auth/facebook') }}"
        class="flex items-center justify-center w-full px-4 py-2 rounded-md shadow-md
                bg-[#1877F2] font-medium
                hover:bg-[#166FE5]
                focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1877F2]
                opacity-100">
            <svg class="w-5 h-5 mr-4 fill-white" viewBox="0 0 24 24">
                <path d="M22.675 0h-21.35C.597 0 0 .597 0 1.326v21.348C0 23.403.597 24 1.326 24h11.495v-9.294H9.691v-3.622h3.13V8.413c0-3.1 1.893-4.788 4.659-4.788 1.325 0 2.464.099 2.796.143v3.24h-1.918c-1.504 0-1.796.715-1.796 1.763v2.31h3.587l-.467 3.622h-3.12V24h6.116C23.403 24 24 23.403 24 22.674V1.326C24 .597 23.403 0 22.675 0z"/>
            </svg>
            Continue with Facebook
        </a>

    </div>

</x-guest-layout>
