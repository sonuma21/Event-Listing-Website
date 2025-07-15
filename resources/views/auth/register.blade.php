<x-guest-layout>

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="flex items-center justify-center font-bold py-4 text-xl ">
            <a href="/">
                Event छ ??
            </a>
        </div>
        <!-- Name -->
        <div class="">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" placeholder="Enter your name"
                icon="user" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class=" mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" placeholder="Enter your email address"
                icon="envelope" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class=" mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" placeholder="Enter your password"
                icon="lock" name="password" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class=" mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" placeholder="Confirm your password"
                icon="lock" type="password" name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class=" flex items-center justify-center mt-4">
            <x-primary-button>
                {{ __('Register') }}
            </x-primary-button>
        </div>


        <div class=" flex items-center justify-between mt-4">
            <a href="{{ route('google.login') }}" class="text-slate-600 hover:underline">
              <i class="fab fa-google mr-2"></i>  {{ __('Register with Google') }}
            </a>
            <a class="text-blue-600 hover:underline" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>
    </form>
</x-guest-layout>
