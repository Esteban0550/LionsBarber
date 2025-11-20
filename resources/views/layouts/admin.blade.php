<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <style>
            [x-cloak] {
                display: none !important;
            }
            
            /* Smooth transitions for interactive elements */
            button, a, input, select, textarea {
                transition-property: color, background-color, border-color, text-decoration-color, fill, stroke, opacity, box-shadow, transform;
                transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
                transition-duration: 150ms;
            }
            
            /* Focus styles */
            *:focus-visible {
                outline: 2px solid currentColor;
                outline-offset: 2px;
            }
            
            /* Scrollbar styling */
            ::-webkit-scrollbar {
                width: 8px;
                height: 8px;
            }
            
            ::-webkit-scrollbar-track {
                background: transparent;
            }
            
            ::-webkit-scrollbar-thumb {
                background: #d1d5db;
                border-radius: 4px;
            }
            
            ::-webkit-scrollbar-thumb:hover {
                background: #9ca3af;
            }
            
            .dark ::-webkit-scrollbar-thumb {
                background: #4b5563;
            }
            
            .dark ::-webkit-scrollbar-thumb:hover {
                background: #6b7280;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div x-data="{ showSidebar: false }" class="relative flex w-full flex-col md:flex-row">

            <!-- This allows screen readers to skip the sidebar and go directly to the main content. -->
            <a class="sr-only" href="#main-content">skip to the main content</a>

            <!-- dark overlay for when the sidebar is open on smaller screens  -->
            <div x-cloak x-show="showSidebar" class="fixed inset-0 z-10 bg-neutral-950/10 backdrop-blur-xs md:hidden" aria-hidden="true" x-on:click="showSidebar = false" x-transition.opacity></div>

            <nav x-cloak class="fixed left-0 z-20 flex h-svh w-60 shrink-0 flex-col bg-neutral-100 p-4 transition-transform duration-300 md:w-64 md:translate-x-0 md:relative dark:bg-neutral-800" x-bind:class="showSidebar ? 'translate-x-0' : '-translate-x-60'" aria-label="sidebar navigation">

                <!-- logo  -->
                <a href="{{ route('admin.dashboard') }}" class="ml-2 mb-4 w-fit flex items-center gap-2">
                    <span class="sr-only">homepage</span>
                    <img src="{{ asset('images/lion-logo.svg') }}" alt="LionsBarber Logo" class="h-12 w-auto dark:invert" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <span class="text-2xl font-bold text-neutral-900 dark:text-neutral-100 hidden">{{ config('app.name', 'LionsBarber') }}</span>
                </a>

                <!-- search  -->
                <div class="relative my-4 flex w-full max-w-xs flex-col gap-1 text-neutral-600 dark:text-neutral-400">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2" class="absolute left-2 top-1/2 size-5 -translate-y-1/2 text-neutral-600/50 dark:text-neutral-400/50" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                    </svg>
                    <input type="search" class="w-full rounded-none bg-white px-2 py-1.5 pl-9 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:bg-neutral-950/50 dark:focus-visible:outline-white" name="search" aria-label="Search" placeholder="Search"/>
                </div>

                <!-- sidebar links  -->
                <div class="flex flex-col gap-2 overflow-y-auto pb-6">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center rounded-none gap-2 px-2 py-1.5 text-sm font-medium {{ request()->routeIs('admin.dashboard') ? 'bg-black/10 text-neutral-900 dark:bg-white/10 dark:text-neutral-100' : 'text-neutral-600 hover:bg-black/5 hover:text-neutral-900 dark:text-neutral-400 dark:hover:bg-white/5 dark:hover:text-neutral-100' }} underline-offset-2 focus-visible:underline focus:outline-hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0" aria-hidden="true">
                            <path d="M15.5 2A1.5 1.5 0 0 0 14 3.5v13a1.5 1.5 0 0 0 1.5 1.5h1a1.5 1.5 0 0 0 1.5-1.5v-13A1.5 1.5 0 0 0 16.5 2h-1ZM9.5 6A1.5 1.5 0 0 0 8 7.5v9A1.5 1.5 0 0 0 9.5 18h1a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 10.5 6h-1ZM3.5 10A1.5 1.5 0 0 0 2 11.5v5A1.5 1.5 0 0 0 3.5 18h1A1.5 1.5 0 0 0 6 16.5v-5A1.5 1.5 0 0 0 4.5 10h-1Z"/>
                        </svg>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('admin.users') }}" class="flex items-center rounded-none gap-2 px-2 py-1.5 text-sm font-medium {{ request()->routeIs('admin.users*') ? 'bg-black/10 text-neutral-900 dark:bg-white/10 dark:text-neutral-100' : 'text-neutral-600 hover:bg-black/5 hover:text-neutral-900 dark:text-neutral-400 dark:hover:bg-white/5 dark:hover:text-neutral-100' }} underline-offset-2 focus-visible:underline focus:outline-hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0" aria-hidden="true">
                            <path d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.23 1.23 0 0 0 .41 1.412A9.957 9.957 0 0 0 10 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 0 0-13.074.003Z"/>
                        </svg>
                        <span>Usuarios</span>
                        @if(request()->routeIs('admin.users*'))
                            <span class="sr-only">active</span>
                        @endif
                    </a>

                    <a href="{{ route('profile.edit') }}" class="flex items-center rounded-none gap-2 px-2 py-1.5 text-sm font-medium text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-400 dark:hover:bg-white/5 dark:hover:text-neutral-100">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.84 1.804A1 1 0 0 1 8.82 1h2.36a1 1 0 0 1 .98.804l.331 1.652a6.993 6.993 0 0 1 1.929 1.115l1.598-.54a1 1 0 0 1 1.186.447l1.18 2.044a1 1 0 0 1-.205 1.251l-1.267 1.113a7.047 7.047 0 0 1 0 2.228l1.267 1.113a1 1 0 0 1 .206 1.25l-1.18 2.045a1 1 0 0 1-1.187.447l-1.598-.54a6.993 6.993 0 0 1-1.929 1.115l-.33 1.652a1 1 0 0 1-.98.804H8.82a1 1 0 0 1-.98-.804l-.331-1.652a6.993 6.993 0 0 1-1.929-1.115l-1.598.54a1 1 0 0 1-1.186-.447l-1.18-2.044a1 1 0 0 1 .205-1.251l1.267-1.114a7.05 7.05 0 0 1 0-2.227L1.821 7.773a1 1 0 0 1-.206-1.25l1.18-2.045a1 1 0 0 1 1.187-.447l1.598.54A6.992 6.992 0 0 1 7.51 3.456l.33-1.652ZM10 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd"/>
                        </svg>
                        <span>Configuración</span>
                    </a>
                </div>

                <!-- Profile Menu  -->
                <div x-data="{ menuIsOpen: false }" class="mt-auto" x-on:keydown.esc.window="menuIsOpen = false">
                    <button type="button" class="flex w-full items-center rounded-none gap-2 p-2 text-left text-neutral-600 hover:bg-black/5 hover:text-neutral-900 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black dark:text-neutral-400 dark:hover:bg-white/5 dark:hover:text-neutral-100 dark:focus-visible:outline-white" x-bind:class="menuIsOpen ? 'bg-black/10 dark:bg-white/10' : ''" aria-haspopup="true" x-on:click="menuIsOpen = ! menuIsOpen" x-bind:aria-expanded="menuIsOpen">
                        <div class="size-8 rounded-none bg-neutral-300 dark:bg-neutral-700 flex items-center justify-center">
                            <span class="text-sm font-medium text-neutral-700 dark:text-neutral-300">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-sm font-bold text-neutral-900 dark:text-neutral-100">{{ Auth::user()->name }}</span>
                            <span class="w-32 overflow-hidden text-ellipsis text-xs md:w-36" aria-hidden="true">{{ Auth::user()->email }}</span>
                            <span class="sr-only">profile settings</span>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2" class="ml-auto size-4 shrink-0 -rotate-90 md:rotate-0" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5"/>
                        </svg>
                    </button>  

                    <!-- menu -->
                    <div x-cloak x-show="menuIsOpen" class="absolute bottom-20 right-6 z-20 -mr-1 w-48 divide-y divide-neutral-300 bg-white dark:divide-neutral-700 dark:bg-neutral-950 rounded-none md:-right-44 md:bottom-4" role="menu" x-on:click.outside="menuIsOpen = false" x-on:keydown.down.prevent="$focus.wrap().next()" x-on:keydown.up.prevent="$focus.wrap().previous()" x-transition="" x-trap="menuIsOpen">
                        <div class="flex flex-col py-1.5">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-2 py-1.5 text-sm font-medium text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-400 dark:hover:bg-white/5 dark:hover:text-neutral-100" role="menuitem">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0" aria-hidden="true">
                                    <path d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.23 1.23 0 0 0 .41 1.412A9.957 9.957 0 0 0 10 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 0 0-13.074.003Z"/>
                                </svg>
                                <span>Perfil</span>
                            </a>
                        </div>

                        <div class="flex flex-col py-1.5">
                            <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-2 py-1.5 text-sm font-medium text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-400 dark:hover:bg-white/5 dark:hover:text-neutral-100" role="menuitem">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.84 1.804A1 1 0 0 1 8.82 1h2.36a1 1 0 0 1 .98.804l.331 1.652a6.993 6.993 0 0 1 1.929 1.115l1.598-.54a1 1 0 0 1 1.186.447l1.18 2.044a1 1 0 0 1-.205 1.251l-1.267 1.113a7.047 7.047 0 0 1 0 2.228l1.267 1.113a1 1 0 0 1 .206 1.25l-1.18 2.045a1 1 0 0 1-1.187.447l-1.598-.54a6.993 6.993 0 0 1-1.929 1.115l-.33 1.652a1 1 0 0 1-.98.804H8.82a1 1 0 0 1-.98-.804l-.331-1.652a6.993 6.993 0 0 1-1.929-1.115l-1.598.54a1 1 0 0 1-1.186-.447l-1.18-2.044a1 1 0 0 1 .205-1.251l1.267-1.114a7.05 7.05 0 0 1 0-2.227L1.821 7.773a1 1 0 0 1-.206-1.25l1.18-2.045a1 1 0 0 1 1.187-.447l1.598.54A6.992 6.992 0 0 1 7.51 3.456l.33-1.652ZM10 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd"/>
                                </svg>
                                <span>Configuración</span>
                            </a>
                        </div>

                        <div class="flex flex-col py-1.5">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="flex w-full items-center gap-2 px-2 py-1.5 text-sm font-medium text-neutral-600 underline-offset-2 hover:bg-black/5 hover:text-neutral-900 focus-visible:underline focus:outline-hidden dark:text-neutral-400 dark:hover:bg-white/5 dark:hover:text-neutral-100" role="menuitem">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 0 1 5.25 2h5.5A2.25 2.25 0 0 1 13 4.25v2a.75.75 0 0 1-1.5 0v-2a.75.75 0 0 0-.75-.75h-5.5a.75.75 0 0 0-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 0 0 .75-.75v-2a.75.75 0 0 1 1.5 0v2A2.25 2.25 0 0 1 10.75 18h-5.5A2.25 2.25 0 0 1 3 15.75V4.25Z" clip-rule="evenodd"/>
                                        <path fill-rule="evenodd" d="M6 10a.75.75 0 0 1 .75-.75h9.546l-1.048-.943a.75.75 0 1 1 1.004-1.114l2.5 2.25a.75.75 0 0 1 0 1.114l-2.5 2.25a.75.75 0 1 1-1.004-1.114l1.048-.943H6.75A.75.75 0 0 1 6 10Z" clip-rule="evenodd"/>
                                    </svg>
                                    <span>Cerrar Sesión</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- main content  -->
            <div id="main-content" class="h-svh w-full overflow-y-auto bg-white dark:bg-neutral-950">
                <!-- Top Header with Logo -->
                <header class="sticky top-0 z-10 bg-white dark:bg-neutral-950 border-b border-neutral-200 dark:border-neutral-800 px-4 py-3">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                            <img src="{{ asset('images/lion-logo.svg') }}" alt="LionsBarber Logo" class="h-10 w-auto dark:invert" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            <span class="text-xl font-bold text-neutral-900 dark:text-neutral-100 hidden">{{ config('app.name', 'LionsBarber') }}</span>
                            <span class="text-lg font-semibold text-neutral-700 dark:text-neutral-300">LionsBarber</span>
                            <span class="text-sm text-neutral-500 dark:text-neutral-400">Admin</span>
                        </a>
                    </div>
                </header>
                
                <!-- Page Content -->
                <div class="p-4">
                    {{ $slot }}
                </div>
            </div>

            <!-- toggle button for small screen  -->
            <button x-cloak class="fixed right-4 top-4 z-20 rounded-full bg-black p-4 md:hidden text-neutral-100 dark:bg-white dark:text-black" x-on:click="showSidebar = ! showSidebar">
                <svg x-show="showSidebar" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-5" aria-hidden="true">
                    <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                </svg>
                <svg x-show="! showSidebar" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-5" aria-hidden="true">
                    <path d="M0 3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm5-1v12h9a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1zM4 2H2a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h2z"/>
                </svg>
                <span class="sr-only">sidebar toggle</span>
            </button>
        </div>
    </body>
</html>

