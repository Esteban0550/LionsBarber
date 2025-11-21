<x-guest-layout>
    <div class="mb-6">
        <h1 class="text-3xl md:text-4xl font-bold text-neutral-900 dark:text-neutral-100 mb-2">
            Iniciar Sesión
        </h1>
        <p class="text-sm text-neutral-600 dark:text-neutral-400">
            Ingresa a tu cuenta de LionsBarber
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="mb-2" />
            <x-text-input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="mb-2" />

            <x-text-input id="password"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-neutral-300 dark:border-neutral-600 text-amber-600 dark:text-amber-400 shadow-sm focus:ring-amber-500 dark:bg-neutral-700" name="remember">
                <span class="ms-2 text-sm text-neutral-600 dark:text-neutral-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between mt-6">
            <a href="{{ route('welcome') }}" class="inline-flex items-center px-4 py-2 bg-neutral-200 dark:bg-neutral-700 border border-transparent rounded-lg font-semibold text-sm text-neutral-700 dark:text-neutral-300 tracking-wide hover:bg-neutral-300 dark:hover:bg-neutral-600 focus:bg-neutral-300 dark:focus:bg-neutral-600 active:bg-neutral-400 dark:active:bg-neutral-500 focus:outline-none focus:ring-2 focus:ring-neutral-500 focus:ring-offset-2 dark:focus:ring-offset-neutral-800 transition ease-in-out duration-150">
                {{ __('Cancelar') }}
            </a>

            <x-primary-button class="ml-auto">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
