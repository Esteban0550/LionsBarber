<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('images/pngggggggg12345 (1).png') }}">

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
            
            :root {
                /* Light Theme */
                --color-surface: #fafaf9;
                --color-surface-alt: #e7e5e4;
                --color-on-surface: #292524;
                --color-on-surface-strong: #000000;
                --color-primary: #f59e0b;
                --color-on-primary: #000000;
                --color-secondary: #1c1917;
                --color-on-secondary: #fafaf9;
                --color-outline: #d6d3d1;
                --color-outline-strong: #2563eb;

                /* Shared Colors */
                --color-info: #0284c7;
                --color-on-info: #f1f5f9;
                --color-success: #16a34a;
                --color-on-success: #ffffff;
                --color-warning: #f59e0b;
                --color-on-warning: #0f172a;
                --color-danger: #dc2626;
                --color-on-danger: #f1f5f9;

                /* Border Radius */
                --radius-radius: 0;
            }

            .dark {
                /* Dark Theme */
                --color-surface: #0c0a09;
                --color-surface-alt: #1c1917;
                --color-on-surface: #d6d3d1;
                --color-on-surface-strong: #ffffff;
                --color-primary: #fbbf24;
                --color-on-primary: #000000;
                --color-secondary: #44403c;
                --color-on-secondary: #ffffff;
                --color-outline: #44403c;
                --color-outline-strong: #3b82f6;
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

            <nav x-cloak @click="if (window.innerWidth < 768 && ($event.target.tagName === 'A' || $event.target.closest('a'))) showSidebar = false" class="fixed left-0 z-20 flex h-svh w-60 shrink-0 flex-col bg-neutral-100 p-4 transition-transform duration-300 md:w-64 md:translate-x-0 md:relative dark:bg-neutral-800" x-bind:class="showSidebar ? 'translate-x-0' : '-translate-x-60'" aria-label="sidebar navigation">

                <!-- logo  -->
                <a href="{{ route('welcome') }}" class="mb-4 w-full flex items-center justify-center">
                    <span class="sr-only">homepage</span>
                    <img src="{{ asset('images/pngggggggg12345 (1).png') }}" alt="LionsBarber Logo" class="h-12 w-auto object-contain">
                </a>

                <!-- search  -->
                <div class="relative my-4 flex w-full max-w-xs flex-col gap-1 text-neutral-600 dark:text-neutral-400">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke="currentColor" fill="none" stroke-width="2" class="absolute left-2 top-1/2 size-5 -translate-y-1/2 text-neutral-600/50 dark:text-neutral-400/50" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                    </svg>
                    <input type="search" class="w-full rounded-none bg-white px-2 py-1.5 pl-9 text-sm focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black disabled:cursor-not-allowed disabled:opacity-75 dark:bg-neutral-950/50 dark:focus-visible:outline-white" name="search" aria-label="Search" placeholder="Search"/>
                </div>

                <!-- sidebar links -->
                <div class="flex flex-col gap-2 overflow-y-auto pb-6">
                    <a href="{{ route('welcome') }}" class="flex items-center rounded-lg gap-2 px-3 py-2 text-sm font-medium {{ request()->routeIs('welcome') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-lg' : 'text-neutral-600 hover:bg-gradient-to-r hover:from-amber-50 hover:to-amber-100 hover:text-amber-700 dark:text-neutral-400 dark:hover:bg-amber-900/20 dark:hover:text-amber-300' }} underline-offset-2 focus-visible:underline focus:outline-hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0" aria-hidden="true">
                            <path fill-rule="evenodd" d="M9.293 2.293a1 1 0 0 1 1.414 0l7 7A1 1 0 0 1 17 11h-1v6a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1v-3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-6H3a1 1 0 0 1-.707-1.707l7-7Z" clip-rule="evenodd"/>
                        </svg>
                        <span>Inicio</span>
                    </a>
                    <a href="{{ route('barberos') }}" class="flex items-center rounded-lg gap-2 px-3 py-2 text-sm font-medium {{ request()->routeIs('barberos') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-lg' : 'text-neutral-600 hover:bg-gradient-to-r hover:from-amber-50 hover:to-amber-100 hover:text-amber-700 dark:text-neutral-400 dark:hover:bg-amber-900/20 dark:hover:text-amber-300' }} underline-offset-2 focus-visible:underline focus:outline-hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0" aria-hidden="true">
                            <path d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.23 1.23 0 0 0 .41 1.412A9.957 9.957 0 0 0 10 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 0 0-13.074.003Z"/>
                        </svg>
                        <span>Barberos</span>
                    </a>
                    <a href="{{ route('citas') }}" class="flex items-center rounded-lg gap-2 px-3 py-2 text-sm font-medium {{ request()->routeIs('citas') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-lg' : 'text-neutral-600 hover:bg-gradient-to-r hover:from-amber-50 hover:to-amber-100 hover:text-amber-700 dark:text-neutral-400 dark:hover:bg-amber-900/20 dark:hover:text-amber-300' }} underline-offset-2 focus-visible:underline focus:outline-hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.75 2a.75.75 0 0 1 .75.75V4h7v-.25A.75.75 0 0 1 14.25 3h2.5a.75.75 0 0 1 .75.75v12.5a.75.75 0 0 1-.75.75h-13a.75.75 0 0 1-.75-.75v-9a.75.75 0 0 1 .75-.75H4V4.75A.75.75 0 0 1 4.75 4h.5V2.75A.75.75 0 0 1 5.75 2Zm-1.5 4.5v8h12.5v-8H4.25ZM6 10a.75.75 0 0 1 .75-.75h6.5a.75.75 0 0 1 0 1.5h-6.5A.75.75 0 0 1 6 10Zm.75 2.25a.75.75 0 0 0 0 1.5h3.5a.75.75 0 0 0 0-1.5h-3.5Z" clip-rule="evenodd"/>
                        </svg>
                        <span>Citas</span>
                    </a>
                    <a href="{{ route('cortes-cabello') }}" class="flex items-center rounded-lg gap-2 px-3 py-2 text-sm font-medium {{ request()->routeIs('cortes-cabello') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-lg' : 'text-neutral-600 hover:bg-gradient-to-r hover:from-amber-50 hover:to-amber-100 hover:text-amber-700 dark:text-neutral-400 dark:hover:bg-amber-900/20 dark:hover:text-amber-300' }} underline-offset-2 focus-visible:underline focus:outline-hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 1a4.5 4.5 0 0 0-4.5 4.5V9H5a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-.5V5.5A4.5 4.5 0 0 0 10 1Zm3 8V5.5a3 3 0 1 0-6 0V9h6Z" clip-rule="evenodd"/>
                        </svg>
                        <span>Cortes de Cabello</span>
                    </a>
                    <a href="{{ route('menu') }}" class="flex items-center rounded-lg gap-2 px-3 py-2 text-sm font-medium {{ request()->routeIs('menu') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-lg' : 'text-neutral-600 hover:bg-gradient-to-r hover:from-amber-50 hover:to-amber-100 hover:text-amber-700 dark:text-neutral-400 dark:hover:bg-amber-900/20 dark:hover:text-amber-300' }} underline-offset-2 focus-visible:underline focus:outline-hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0" aria-hidden="true">
                            <path fill-rule="evenodd" d="M2 4.75A.75.75 0 0 1 2.75 4h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 4.75ZM2 10a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 10Zm0 5.25a.75.75 0 0 1 .75-.75h14.5a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd"/>
                        </svg>
                        <span>Menú</span>
                    </a>
                    <a href="{{ route('nosotros') }}" class="flex items-center rounded-lg gap-2 px-3 py-2 text-sm font-medium {{ request()->routeIs('nosotros') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-lg' : 'text-neutral-600 hover:bg-gradient-to-r hover:from-amber-50 hover:to-amber-100 hover:text-amber-700 dark:text-neutral-400 dark:hover:bg-amber-900/20 dark:hover:text-amber-300' }} underline-offset-2 focus-visible:underline focus:outline-hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0" aria-hidden="true">
                            <path d="M10 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM6 5a2 2 0 1 1-4 0 2 2 0 0 1 4 0ZM1 13a5 5 0 0 1 10 0v2a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1v-2ZM16 6a2 2 0 1 0-4 0 2 2 0 0 0 4 0ZM19 10a1 1 0 0 0-1 1v1a2 2 0 0 1-2 2h-1a1 1 0 0 0 0 2h1a4 4 0 0 0 4-4v-1a1 1 0 0 0-1-1Z"/>
                        </svg>
                        <span>Nosotros</span>
                    </a>
                </div>

                <!-- Quick Actions Section -->
                @auth
                <div class="mt-6 pt-6 border-t border-neutral-200 dark:border-neutral-700">
                    <p class="text-xs font-semibold text-neutral-500 dark:text-neutral-400 uppercase tracking-wider mb-3 px-3">
                        Acciones Rápidas
                    </p>
                    <div class="flex flex-col gap-2">
                        <a href="{{ route('citas') }}" class="flex items-center rounded-lg gap-2 px-3 py-2 text-sm font-medium text-neutral-600 hover:bg-gradient-to-r hover:from-amber-50 hover:to-amber-100 hover:text-amber-700 dark:text-neutral-400 dark:hover:bg-amber-900/20 dark:hover:text-amber-300 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4 shrink-0" aria-hidden="true">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 0 0 0-1.5h-3.25V5Z" clip-rule="evenodd"/>
                            </svg>
                            <span>Agendar Cita</span>
                        </a>
                        <a href="{{ route('barberos') }}" class="flex items-center rounded-lg gap-2 px-3 py-2 text-sm font-medium text-neutral-600 hover:bg-gradient-to-r hover:from-amber-50 hover:to-amber-100 hover:text-amber-700 dark:text-neutral-400 dark:hover:bg-amber-900/20 dark:hover:text-amber-300 transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4 shrink-0" aria-hidden="true">
                                <path d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.23 1.23 0 0 0 .41 1.412A9.957 9.957 0 0 0 10 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 0 0-13.074.003Z"/>
                            </svg>
                            <span>Ver Barberos</span>
                        </a>
                    </div>
                </div>
                @endauth

                <!-- Profile/Login Button -->
                <div class="mt-auto pt-6 border-t border-neutral-200 dark:border-neutral-700">
                    @auth
                        <a href="{{ route('profile.edit') }}" class="flex w-full items-center rounded-lg gap-2 px-3 py-2 text-sm font-medium {{ request()->routeIs('profile.*') ? 'bg-gradient-to-r from-amber-500 to-amber-600 text-white shadow-lg' : 'text-neutral-600 hover:bg-gradient-to-r hover:from-amber-50 hover:to-amber-100 hover:text-amber-700 dark:text-neutral-400 dark:hover:bg-amber-900/20 dark:hover:text-amber-300' }} underline-offset-2 focus-visible:underline focus:outline-hidden transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0" aria-hidden="true">
                                <path d="M10 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6ZM3.465 14.493a1.23 1.23 0 0 0 .41 1.412A9.957 9.957 0 0 0 10 18c2.31 0 4.438-.784 6.131-2.1.43-.333.604-.903.408-1.41a7.002 7.002 0 0 0-13.074.003Z"/>
                            </svg>
                            <span>Mi Perfil</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}" class="mt-2">
                            @csrf
                            <button type="submit" class="flex w-full items-center rounded-lg gap-2 px-3 py-2 text-sm font-medium text-neutral-600 hover:bg-gradient-to-r hover:from-red-50 hover:to-red-100 hover:text-red-700 dark:text-neutral-400 dark:hover:bg-red-900/20 dark:hover:text-red-300 transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 0 1 5.25 2h5.5A2.25 2.25 0 0 1 13 4.25v2a.75.75 0 0 1-1.5 0v-2a.75.75 0 0 0-.75-.75h-5.5a.75.75 0 0 0-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 0 0 .75-.75v-2a.75.75 0 0 1 1.5 0v2A2.25 2.25 0 0 1 10.75 18h-5.5A2.25 2.25 0 0 1 3 15.75V4.25Z" clip-rule="evenodd"/>
                                    <path fill-rule="evenodd" d="M6 10a.75.75 0 0 1 .75-.75h9.546l-1.048-.943a.75.75 0 1 1 1.004-1.114l2.5 2.25a.75.75 0 0 1 0 1.114l-2.5 2.25a.75.75 0 1 1-1.004-1.114l1.048-.943H6.75A.75.75 0 0 1 6 10Z" clip-rule="evenodd"/>
                                </svg>
                                <span>Cerrar Sesión</span>
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="flex w-full items-center rounded-lg gap-2 px-3 py-2 text-sm font-medium text-neutral-600 hover:bg-gradient-to-r hover:from-amber-50 hover:to-amber-100 hover:text-amber-700 dark:text-neutral-400 dark:hover:bg-amber-900/20 dark:hover:text-amber-300 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-black dark:focus-visible:outline-white transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 shrink-0" aria-hidden="true">
                                <path fill-rule="evenodd" d="M3 4.25A2.25 2.25 0 0 1 5.25 2h5.5A2.25 2.25 0 0 1 13 4.25v2a.75.75 0 0 1-1.5 0v-2a.75.75 0 0 0-.75-.75h-5.5a.75.75 0 0 0-.75.75v11.5c0 .414.336.75.75.75h5.5a.75.75 0 0 0 .75-.75v-2a.75.75 0 0 1 1.5 0v2A2.25 2.25 0 0 1 10.75 18h-5.5A2.25 2.25 0 0 1 3 15.75V4.25Z" clip-rule="evenodd"/>
                                <path fill-rule="evenodd" d="M6 10a.75.75 0 0 1 .75-.75h9.546l-1.048-.943a.75.75 0 1 1 1.004-1.114l2.5 2.25a.75.75 0 0 1 0 1.114l-2.5 2.25a.75.75 0 1 1-1.004-1.114l1.048-.943H6.75A.75.75 0 0 1 6 10Z" clip-rule="evenodd"/>
                            </svg>
                            <span>Iniciar Sesión</span>
                        </a>
                    @endauth
                </div>
            </nav>

            <!-- main content  -->
            <div id="main-content" class="h-svh w-full overflow-y-auto bg-white dark:bg-neutral-950">
                <!-- Top Header with Logo -->
                <header class="sticky top-0 z-10 bg-white dark:bg-neutral-950 border-b border-neutral-200 dark:border-neutral-800 px-4 py-3">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('welcome') }}" class="flex items-center">
                            <img src="{{ asset('images/lion-logo.svg') }}" alt="LionsBarber Logo" class="h-10 w-auto dark:invert" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                            <span class="text-xl font-bold text-neutral-900 dark:text-neutral-100 hidden">{{ config('app.name', 'LionsBarber') }}</span>
                        </a>
                    </div>
                </header>
                
                <!-- Breadcrumb -->
                <nav class="bg-white dark:bg-neutral-950 border-b border-neutral-200 dark:border-neutral-800 px-4 py-3" aria-label="Breadcrumb">
                    <ol class="flex items-center space-x-2 text-sm">
                        <li>
                            <a href="{{ route('welcome') }}" class="flex items-center text-neutral-500 hover:text-neutral-700 dark:text-neutral-400 dark:hover:text-neutral-200 transition-colors">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                                </svg>
                                <span>Inicio</span>
                            </a>
                        </li>
                        @php
                            $routeNames = [
                                'barberos' => 'Barberos',
                                'citas' => 'Citas',
                                'cortes-cabello' => 'Cortes de Cabello',
                                'menu' => 'Menú',
                                'nosotros' => 'Nosotros',
                                'welcome' => 'Inicio',
                            ];
                            $currentRouteName = request()->route()->getName();
                            $currentPageName = $routeNames[$currentRouteName] ?? ($breadcrumb ?? 'Página');
                        @endphp
                        @if(!request()->routeIs('welcome'))
                            <li>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-neutral-400 mx-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    <span class="text-neutral-700 dark:text-neutral-300 font-medium">{{ $currentPageName }}</span>
                                </div>
                            </li>
                        @endif
                    </ol>
                </nav>
                
                <!-- Page Content -->
                <div class="w-full">
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

