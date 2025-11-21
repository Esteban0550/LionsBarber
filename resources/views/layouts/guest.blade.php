<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Alpine.js -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <!-- SweetAlert2 -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        
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
        </style>
    </head>
    <body class="font-sans antialiased bg-white dark:bg-neutral-950">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-white dark:bg-neutral-950">
            <div>
                <a href="/">
                    <img src="{{ asset('images/pngggggggg12345 (1).png') }}" alt="LionsBarber Logo" class="w-20 h-20 object-contain">
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-neutral-800 shadow-lg rounded-lg overflow-hidden">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
