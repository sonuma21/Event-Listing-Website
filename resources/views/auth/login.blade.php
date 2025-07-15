<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="flex items-center justify-center font-bold mt-4 text-xl ">
            <a href="/">
                Event छ ??
            </a>
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" placeholder="Enter your email address"
                :value="old('email')" icon="envelope" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" name="password" type="password" placeholder="Enter your password"
                icon="lock" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Forgot Password -->
        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm  hover:text-[var(--link)] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <div class="flex justify-center mt-4">
            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>

        <!-- Google Login -->



        <!-- Sign Up Link -->
        <div class="flex justify-between text-sm items-center mt-4">
             <a href="{{ route('google.login') }}" class="hover:underline"><i class="fab fa-google mr-2"></i>Login with Google</a>

            <a href="/register" class="text-blue-600  hover:underline">Don't have an account?</a>
        </div>
    </form>
</x-guest-layout>
