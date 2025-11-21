@if(isset($isAdminContext) && $isAdminContext)
    <x-admin-layout>
        <div class="max-w-6xl mx-auto p-6 md:p-8 lg:p-12">
            <div class="mb-8">
                <h1 class="text-4xl md:text-5xl font-bold text-neutral-900 dark:text-neutral-100 mb-4">
                    Perfil
                </h1>
                <p class="text-lg text-neutral-600 dark:text-neutral-400">
                    Gestiona la información de tu cuenta
                </p>
            </div>

            <div class="space-y-6">
                <div class="p-6 md:p-8 bg-white dark:bg-neutral-800 shadow-lg rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-6 md:p-8 bg-white dark:bg-neutral-800 shadow-lg rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-6 md:p-8 bg-white dark:bg-neutral-800 shadow-lg rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

                <!-- Cerrar Sesión -->
                <div class="p-6 md:p-8 bg-white dark:bg-neutral-800 shadow-lg rounded-lg">
                    <div class="max-w-xl">
                        <section class="space-y-6">
                            <header>
                                <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                                    {{ __('Cerrar Sesión') }}
                                </h2>

                                <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                                    {{ __('Cierra tu sesión actual de forma segura.') }}
                                </p>
                            </header>

                            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                                @csrf

                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-neutral-600 dark:bg-neutral-700 border border-transparent rounded-lg font-semibold text-sm text-white tracking-wide hover:bg-neutral-700 dark:hover:bg-neutral-600 focus:bg-neutral-700 dark:focus:bg-neutral-600 active:bg-neutral-800 dark:active:bg-neutral-500 focus:outline-none focus:ring-2 focus:ring-neutral-500 focus:ring-offset-2 dark:focus:ring-offset-neutral-800 transition ease-in-out duration-150">
                                    {{ __('Cerrar Sesión') }}
                                </button>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </x-admin-layout>
@else
    <x-user-layout>
        <div class="max-w-6xl mx-auto p-6 md:p-8 lg:p-12">
            <div class="mb-8">
                <h1 class="text-4xl md:text-5xl font-bold text-neutral-900 dark:text-neutral-100 mb-4">
                    Perfil
                </h1>
                <p class="text-lg text-neutral-600 dark:text-neutral-400">
                    Gestiona la información de tu cuenta
                </p>
            </div>

            <div class="space-y-6">
                <div class="p-6 md:p-8 bg-white dark:bg-neutral-800 shadow-lg rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <div class="p-6 md:p-8 bg-white dark:bg-neutral-800 shadow-lg rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <div class="p-6 md:p-8 bg-white dark:bg-neutral-800 shadow-lg rounded-lg">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

                <!-- Cerrar Sesión -->
                <div class="p-6 md:p-8 bg-white dark:bg-neutral-800 shadow-lg rounded-lg">
                    <div class="max-w-xl">
                        <section class="space-y-6">
                            <header>
                                <h2 class="text-lg font-medium text-neutral-900 dark:text-neutral-100">
                                    {{ __('Cerrar Sesión') }}
                                </h2>

                                <p class="mt-1 text-sm text-neutral-600 dark:text-neutral-400">
                                    {{ __('Cierra tu sesión actual de forma segura.') }}
                                </p>
                            </header>

                            <form method="POST" action="{{ route('logout') }}" class="mt-6">
                                @csrf

                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-neutral-600 dark:bg-neutral-700 border border-transparent rounded-lg font-semibold text-sm text-white tracking-wide hover:bg-neutral-700 dark:hover:bg-neutral-600 focus:bg-neutral-700 dark:focus:bg-neutral-600 active:bg-neutral-800 dark:active:bg-neutral-500 focus:outline-none focus:ring-2 focus:ring-neutral-500 focus:ring-offset-2 dark:focus:ring-offset-neutral-800 transition ease-in-out duration-150">
                                    {{ __('Cerrar Sesión') }}
                                </button>
                            </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </x-user-layout>
@endif
