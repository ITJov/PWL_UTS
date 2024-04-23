<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="wrapper">
        <div class="logo">
            <img width="400px" src="{{asset('dist/img/marnat_lagi.png')}}" alt="">
        </div>
        <div class="text-center mt-4 name">
            MORNING
        </div>

        <form method="POST" action="{{ route('login') }}" class="p-3 mt-3">
            @csrf
            <div class="form-field d-flex align-items-center">
                <span class="far fa-user"></span>
                <x-text-input  type="text" id="name" name="name" :value="old('email')" class="block mt-1 w-full"
                               required autofocus  placeholder="Username"/>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>
            <div class="form-field d-flex align-items-center">
                <span class="fas fa-key"></span>
                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              placeholder="Password"
                              required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>
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
    </div>
</x-guest-layout>
