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
        
        <style>
            /* Dark Mode for Guest Layout */
            [data-theme="dark"] body {
                background-color: #000000 !important;
                color: #ffffff !important;
            }
            
            [data-theme="dark"] .bg-gray-100 {
                background-color: #000000 !important;
            }
            
            [data-theme="dark"] .bg-white {
                background-color: #1a1a1a !important;
                color: #ffffff !important;
                border-color: #333333 !important;
            }
            
            [data-theme="dark"] .text-gray-900 {
                color: #ffffff !important;
            }
            
            [data-theme="dark"] .text-gray-500 {
                color: #cccccc !important;
            }

            [data-theme="dark"] .shadow-md {
                box-shadow: 0 2px 5px rgba(0, 0, 0, 0.5) !important;
            }

            /* Auth Form Elements */
            [data-theme="dark"] input,
            [data-theme="dark"] button,
            [data-theme="dark"] a {
                background-color: #2a2a2a !important;
                color: #ffffff !important;
                border-color: #444444 !important;
            }

            [data-theme="dark"] input:focus,
            [data-theme="dark"] button:hover {
                background-color: #3a3a3a !important;
                border-color: #555555 !important;
            }

            [data-theme="dark"] .text-blue-600 {
                color: #66b3ff !important;
            }

            [data-theme="dark"] .bg-blue-600 {
                background-color: #0056b3 !important;
            }

            [data-theme="dark"] .bg-blue-600:hover {
                background-color: #004085 !important;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased" data-theme="light">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
        
        <script>
            // Initialize theme on page load for guest layout
            function initializeGuestTheme() {
                const savedTheme = localStorage.getItem('theme');
                if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.body.setAttribute('data-theme', 'dark');
                } else {
                    document.body.setAttribute('data-theme', 'light');
                }
            }
            
            // Run theme initialization when DOM is fully loaded
            document.addEventListener('DOMContentLoaded', initializeGuestTheme);
        </script>
    </body>
</html>
