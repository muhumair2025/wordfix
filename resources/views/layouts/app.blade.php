<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @php
            $meta = \App\Helpers\MetaHelper::getCurrentMeta();
            $seoSettings = \App\Helpers\MetaHelper::getSeoSettings();
        @endphp
        
        <title>@yield('title', $meta['title'])</title>
        <meta name="description" content="@yield('description', $meta['description'])">
        <meta name="keywords" content="@yield('keywords', $meta['keywords'])">
        
        <!-- Favicon -->
        @if($seoSettings['favicon_uploaded'] && $seoSettings['favicon_path'])
            <link rel="icon" type="image/x-icon" href="{{ $seoSettings['favicon_path'] }}">
            <link rel="shortcut icon" type="image/x-icon" href="{{ $seoSettings['favicon_path'] }}">
            <link rel="apple-touch-icon" href="{{ $seoSettings['favicon_path'] }}">
        @else
            <link rel="icon" type="image/x-icon" href="/favicon.ico">
        @endif
        
        <!-- Search Engine Verification -->
        @if(!empty($seoSettings['google_site_verification']))
            <meta name="google-site-verification" content="{{ $seoSettings['google_site_verification'] }}">
        @endif
        @if(!empty($seoSettings['bing_site_verification']))
            <meta name="msvalidate.01" content="{{ $seoSettings['bing_site_verification'] }}">
        @endif
        @if(!empty($seoSettings['yandex_site_verification']))
            <meta name="yandex-verification" content="{{ $seoSettings['yandex_site_verification'] }}">
        @endif
        @if(!empty($seoSettings['pinterest_site_verification']))
            <meta name="p:domain_verify" content="{{ $seoSettings['pinterest_site_verification'] }}">
        @endif
        
        <!-- Open Graph Meta Tags -->
        <meta property="og:title" content="@yield('title', $meta['title'])">
        <meta property="og:description" content="@yield('description', $meta['description'])">
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:site_name" content="WordFix">
        
        <!-- Twitter Card Meta Tags -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:title" content="@yield('title', $meta['title'])">
        <meta name="twitter:description" content="@yield('description', $meta['description'])">
        
        <!-- Custom Head Tags -->
        @if(!empty($seoSettings['custom_head_tags']))
            {!! $seoSettings['custom_head_tags'] !!}
        @endif

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <!-- Tailwind CSS -->
        <script src="https://cdn.tailwindcss.com"></script>
        
        <!-- Alpine.js with Collapse Plugin -->
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        
        <!-- Vite Assets -->
        @vite(['resources/js/app.js'])
        
        <!-- High Contrast Professional Dark Mode -->
        <style>
            /* Alpine.js x-cloak directive to prevent flickering */
            [x-cloak] { display: none !important; }
            
            /* High Contrast Dark Mode - Perfect Text Visibility */
            
            /* Dark Mode Base */
            [data-theme="dark"] {
                color-scheme: dark;
            }

            /* Body & Main Background - Pure Black */
            [data-theme="dark"] body {
                background-color: #000000 !important;
                color: #ffffff !important;
            }

            [data-theme="dark"] main {
                background-color: #000000 !important;
                color: #ffffff !important;
            }

            /* Navigation - Dark Gray */
            [data-theme="dark"] nav,
            [data-theme="dark"] .navbar {
                background-color: #1a1a1a !important;
                border-bottom: 1px solid #333333 !important;
            }

            /* All Text - Pure White for Maximum Contrast */
            [data-theme="dark"] *,
            [data-theme="dark"] p,
            [data-theme="dark"] span,
            [data-theme="dark"] div,
            [data-theme="dark"] li,
            [data-theme="dark"] a,
            [data-theme="dark"] label {
                color: #ffffff !important;
            }

            /* Headings - Pure White */
            [data-theme="dark"] h1, 
            [data-theme="dark"] h2, 
            [data-theme="dark"] h3, 
            [data-theme="dark"] h4, 
            [data-theme="dark"] h5, 
            [data-theme="dark"] h6 {
                color: #ffffff !important;
            }

            /* Links - Bright Blue for Visibility */
            [data-theme="dark"] a {
                color: #66b3ff !important;
            }

            [data-theme="dark"] a:hover {
                color: #99ccff !important;
            }

            /* Cards & Panels - Dark Gray */
            [data-theme="dark"] .bg-white,
            [data-theme="dark"] .bg-gray-50,
            [data-theme="dark"] .bg-gray-100,
            [data-theme="dark"] .bg-gray-200 {
                background-color: #1a1a1a !important;
                border: 1px solid #333333 !important;
                color: #ffffff !important;
            }

            /* Fix White Containers */
            [data-theme="dark"] .bg-white.rounded-lg,
            [data-theme="dark"] .bg-white.shadow-md,
            [data-theme="dark"] .bg-white.border,
            [data-theme="dark"] .rounded-lg.shadow-md {
                background-color: #1a1a1a !important;
                border-color: #333333 !important;
                color: #ffffff !important;
            }

            /* Tool Container Specific */
            [data-theme="dark"] .text-converter-wrapper,
            [data-theme="dark"] .tool-container {
                background-color: #1a1a1a !important;
                color: #ffffff !important;
            }

            /* Input Fields - Dark with White Text */
            [data-theme="dark"] input,
            [data-theme="dark"] textarea,
            [data-theme="dark"] select {
                background-color: #2a2a2a !important;
                border: 1px solid #555555 !important;
                color: #ffffff !important;
            }

            [data-theme="dark"] input:focus,
            [data-theme="dark"] textarea:focus,
            [data-theme="dark"] select:focus {
                border-color: #66b3ff !important;
                box-shadow: 0 0 0 2px rgba(102, 179, 255, 0.2) !important;
            }

            [data-theme="dark"] input::placeholder,
            [data-theme="dark"] textarea::placeholder {
                color: #cccccc !important;
            }

            /* Buttons - High Contrast */
            [data-theme="dark"] button {
                background-color: #2a2a2a !important;
                color: #ffffff !important;
                border: 1px solid #555555 !important;
            }

            [data-theme="dark"] button:hover {
                background-color: #3a3a3a !important;
                border-color: #666666 !important;
            }

            /* Primary Buttons - Bright Blue */
            [data-theme="dark"] .bg-blue-600,
            [data-theme="dark"] .bg-blue-700 {
                background-color: #0066cc !important;
                color: #ffffff !important;
                border-color: #0066cc !important;
            }

            [data-theme="dark"] .bg-blue-600:hover,
            [data-theme="dark"] .bg-blue-700:hover {
                background-color: #0080ff !important;
                border-color: #0080ff !important;
            }

            /* Logo Fix - White Text on Dark Background */
            [data-theme="dark"] .logo,
            [data-theme="dark"] .logo *,
            [data-theme="dark"] nav .logo,
            [data-theme="dark"] nav .logo * {
                color: #ffffff !important;
                filter: invert(1) !important;
            }

            /* WordFix Logo Specific */
            [data-theme="dark"] nav a[href="/"] {
                color: #ffffff !important;
            }

            [data-theme="dark"] nav a[href="/"] img {
                filter: invert(1) brightness(2) !important;
            }

            /* Footer - Dark */
            [data-theme="dark"] footer,
            [data-theme="dark"] contentinfo {
                background-color: #1a1a1a !important;
                border-top: 1px solid #333333 !important;
                color: #ffffff !important;
            }

            /* Borders - Visible Gray */
            [data-theme="dark"] .border-gray-200,
            [data-theme="dark"] .border-gray-300,
            [data-theme="dark"] .border-t,
            [data-theme="dark"] .border-b {
                border-color: #555555 !important;
            }

            /* Stats Section */
            [data-theme="dark"] .bg-green-50 {
                background-color: #2a2a2a !important;
                border-color: #555555 !important;
                color: #ffffff !important;
            }

            /* Highlighted Text */
            [data-theme="dark"] mark {
                background-color: #ffff00 !important;
                color: #000000 !important;
            }

            /* Dark Mode Toggle Button */
            .theme-toggle {
                position: relative;
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 2.5rem;
                height: 2.5rem;
                border-radius: 0.375rem;
                border: 1px solid #d1d5db;
                background-color: white;
                color: #374151;
                cursor: pointer;
                transition: all 0.2s ease;
            }

            .theme-toggle:hover {
                background-color: #f3f4f6;
                border-color: #9ca3af;
            }

            [data-theme="dark"] .theme-toggle {
                background-color: #2a2a2a;
                border-color: #555555;
                color: #ffffff;
            }

            [data-theme="dark"] .theme-toggle:hover {
                background-color: #3a3a3a;
                color: #66b3ff;
            }

            .theme-toggle svg {
                width: 1.25rem;
                height: 1.25rem;
            }

            /* Hide/Show icons based on theme */
            [data-theme="light"] .theme-toggle .moon-icon {
                display: block;
            }

            [data-theme="light"] .theme-toggle .sun-icon {
                display: none;
            }

            [data-theme="dark"] .theme-toggle .moon-icon {
                display: none;
            }

            [data-theme="dark"] .theme-toggle .sun-icon {
                display: block;
            }

            /* Apply to All Layout Files (except admin) */
            [data-theme="dark"] .layout-main,
            [data-theme="dark"] .layout-tool,
            [data-theme="dark"] .layout-public {
                background-color: #000000 !important;
                color: #ffffff !important;
            }

            /* Force Override Any White Backgrounds */
            [data-theme="dark"] * {
                transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease !important;
            }

            [data-theme="dark"] *:not(.admin-layout):not(.admin-panel):not([class*="admin"]) {
                border-color: #555555 !important;
            }

            /* Specific White Background Overrides */
            [data-theme="dark"] .container,
            [data-theme="dark"] .wrapper,
            [data-theme="dark"] .panel,
            [data-theme="dark"] .card,
            [data-theme="dark"] .box {
                background-color: #1a1a1a !important;
                color: #ffffff !important;
            }

            /* Dropdown and Select Options */
            [data-theme="dark"] option,
            [data-theme="dark"] select option {
                background-color: #1a1a1a !important;
                color: #ffffff !important;
            }

            /* Specific Background Color Classes */
            [data-theme="dark"] .bg-indigo-50,
            [data-theme="dark"] .bg-blue-50,
            [data-theme="dark"] .bg-green-50,
            [data-theme="dark"] .bg-yellow-50,
            [data-theme="dark"] .bg-red-50,
            [data-theme="dark"] .bg-purple-50,
            [data-theme="dark"] .bg-pink-50,
            [data-theme="dark"] .bg-gray-25,
            [data-theme="dark"] .bg-gray-75 {
                background-color: #1a1a1a !important;
                color: #ffffff !important;
                border-color: #333333 !important;
            }

            /* Specific Border Color Classes */
            [data-theme="dark"] .border-indigo-200,
            [data-theme="dark"] .border-blue-200,
            [data-theme="dark"] .border-green-200,
            [data-theme="dark"] .border-yellow-200,
            [data-theme="dark"] .border-red-200,
            [data-theme="dark"] .border-purple-200,
            [data-theme="dark"] .border-pink-200,
            [data-theme="dark"] .border-indigo-300,
            [data-theme="dark"] .border-blue-600 {
                border-color: #444444 !important;
            }

            /* Text Color Classes */
            [data-theme="dark"] .text-indigo-600,
            [data-theme="dark"] .text-blue-600,
            [data-theme="dark"] .text-blue-900,
            [data-theme="dark"] .text-green-600,
            [data-theme="dark"] .text-yellow-600,
            [data-theme="dark"] .text-red-600,
            [data-theme="dark"] .text-purple-600,
            [data-theme="dark"] .text-pink-600,
            [data-theme="dark"] .text-gray-700 {
                color: #66b3ff !important;
            }

            /* Force All White Elements to Dark */
            [data-theme="dark"] *[class*="bg-white"],
            [data-theme="dark"] *[style*="background-color: white"],
            [data-theme="dark"] *[style*="background: white"],
            [data-theme="dark"] *[style*="background-color: #ffffff"],
            [data-theme="dark"] *[style*="background: #ffffff"],
            [data-theme="dark"] .bg-gray-25,
            [data-theme="dark"] .bg-gray-75 {
                background-color: #1a1a1a !important;
                color: #ffffff !important;
                border-color: #333333 !important;
            }

            /* Text Areas and Inputs */
            [data-theme="dark"] textarea,
            [data-theme="dark"] input[type="text"],
            [data-theme="dark"] input[type="email"],
            [data-theme="dark"] input[type="password"],
            [data-theme="dark"] select {
                background-color: #2a2a2a !important;
                color: #ffffff !important;
                border-color: #444444 !important;
            }

            [data-theme="dark"] textarea::placeholder,
            [data-theme="dark"] input::placeholder {
                color: #999999 !important;
            }

            /* Mobile Dropdown Menu Fix */
            [data-theme="dark"] .absolute.right-0.mt-2.w-48,
            [data-theme="dark"] .origin-top-right.rounded-md.shadow-lg {
                background-color: #1a1a1a !important;
                border: 1px solid #333333 !important;
            }

            [data-theme="dark"] .py-1.bg-white.rounded-md.shadow-xs {
                background-color: #1a1a1a !important;
            }

            /* Dropdown Menus */
            [data-theme="dark"] .dropdown-menu,
            [data-theme="dark"] [x-show] {
                background-color: #1a1a1a !important;
                border: 1px solid #555555 !important;
                color: #ffffff !important;
            }

            [data-theme="dark"] .dropdown-menu a:hover,
            [data-theme="dark"] [x-show] a:hover {
                background-color: #2a2a2a !important;
                color: #66b3ff !important;
            }

            /* Mobile Menu & Sidebar */
            [data-theme="dark"] .bg-white.rounded-xl,
            [data-theme="dark"] .bg-white.rounded-xl.border,
            [data-theme="dark"] .bg-white.rounded-xl.shadow-sm,
            [data-theme="dark"] .mobile-menu,
            [data-theme="dark"] .sidebar,
            [data-theme="dark"] nav > div:last-child,
            [data-theme="dark"] .sm\\:hidden > div,
            [data-theme="dark"] [x-show] {
                background-color: #1a1a1a !important;
                border-color: #555555 !important;
                color: #ffffff !important;
            }

            /* Mobile Navigation Overlay */
            [data-theme="dark"] .sm\\:hidden .pt-2.pb-3,
            [data-theme="dark"] .sm\\:hidden .pt-4.pb-3,
            [data-theme="dark"] .sm\\:hidden .space-y-1,
            [data-theme="dark"] .sm\\:hidden .border-t,
            [data-theme="dark"] .bg-gray-50,
            [data-theme="dark"] .bg-blue-50 {
                background-color: #1a1a1a !important;
                border-color: #333333 !important;
                color: #ffffff !important;
            }

            /* Mobile Menu Buttons */
            [data-theme="dark"] .theme-toggle-mobile,
            [data-theme="dark"] .bg-gray-50.rounded-lg,
            [data-theme="dark"] .bg-blue-50.rounded-lg {
                background-color: #2a2a2a !important;
                color: #ffffff !important;
                border-color: #444444 !important;
            }

            [data-theme="dark"] .theme-toggle-mobile:hover,
            [data-theme="dark"] .bg-gray-50.rounded-lg:hover,
            [data-theme="dark"] .bg-blue-50.rounded-lg:hover {
                background-color: #3a3a3a !important;
            }

            /* Mobile Sidebar Main Container */
            [data-theme="dark"] .px-3.pt-3.pb-4,
            [data-theme="dark"] .max-h-\\[calc\\(100vh-4rem\\)\\],
            [data-theme="dark"] .overflow-y-auto {
                background-color: #1a1a1a !important;
            }

            /* Mobile Sidebar Dropdown Items */
            [data-theme="dark"] .bg-white.rounded-xl.border.border-gray-100.shadow-sm,
            [data-theme="dark"] .bg-white.rounded-xl.border.border-gray-100.shadow-sm.overflow-hidden {
                background-color: #2a2a2a !important;
                border-color: #444444 !important;
                color: #ffffff !important;
            }

            /* Mobile Sidebar Dropdown Content */
            [data-theme="dark"] .border-t.border-gray-100.bg-gray-50 {
                background-color: #1a1a1a !important;
                border-color: #333333 !important;
            }

            /* Mobile Auth Section */
            [data-theme="dark"] .mt-4.pt-4.border-t.border-gray-200 {
                border-color: #333333 !important;
                background-color: #1a1a1a !important;
            }

            /* Mobile Sidebar Links */
            [data-theme="dark"] .block.px-4.py-2\\.5.text-sm.text-gray-600 {
                color: #ffffff !important;
                background-color: transparent !important;
            }

            [data-theme="dark"] .block.px-4.py-2\\.5.text-sm.text-gray-600:hover {
                background-color: #2a2a2a !important;
                color: #66b3ff !important;
            }

            /* Force All Mobile Sidebar Elements to Dark */
            [data-theme="dark"] .space-y-2 > div,
            [data-theme="dark"] .space-y-2 .bg-white,
            [data-theme="dark"] .px-3.pt-3.pb-4 .bg-white,
            [data-theme="dark"] .overflow-y-auto .bg-white {
                background-color: #2a2a2a !important;
                color: #ffffff !important;
                border-color: #444444 !important;
            }

            /* Mobile Sidebar Button States */
            [data-theme="dark"] .text-gray-700 {
                color: #ffffff !important;
            }

            [data-theme="dark"] .hover\\:bg-blue-50:hover {
                background-color: #2a2a2a !important;
            }

            [data-theme="dark"] .hover\\:text-blue-600:hover {
                color: #66b3ff !important;
            }

            /* Mobile Sidebar Specific Overrides */
            [data-theme="dark"] nav .bg-white,
            [data-theme="dark"] nav .bg-gray-50,
            [data-theme="dark"] nav .bg-blue-50 {
                background-color: #2a2a2a !important;
                color: #ffffff !important;
            }

            /* Alpine.js Mobile Menu */
            [data-theme="dark"] [x-show] .bg-white,
            [data-theme="dark"] [x-collapse] .bg-white,
            [data-theme="dark"] [x-data] .bg-white {
                background-color: #2a2a2a !important;
                color: #ffffff !important;
            }

            /* Enhanced Light Mode Contrast */
            [data-theme="light"] .bg-gray-50,
            body:not([data-theme="dark"]) .bg-gray-50 {
                background-color: #f8fafc !important; /* Slightly darker gray-50 */
            }

            [data-theme="light"] .bg-gray-100,
            body:not([data-theme="dark"]) .bg-gray-100 {
                background-color: #f1f5f9 !important; /* Enhanced gray-100 */
            }

            [data-theme="light"] .border-gray-200,
            body:not([data-theme="dark"]) .border-gray-200 {
                border-color: #d1d5db !important; /* More visible border */
            }

            [data-theme="light"] .border-gray-300,
            body:not([data-theme="dark"]) .border-gray-300 {
                border-color: #9ca3af !important; /* Stronger border */
            }

            [data-theme="light"] .shadow-md,
            body:not([data-theme="dark"]) .shadow-md {
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.15), 0 2px 4px -1px rgba(0, 0, 0, 0.1) !important;
            }

            [data-theme="light"] .shadow-lg,
            body:not([data-theme="dark"]) .shadow-lg {
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.15), 0 4px 6px -2px rgba(0, 0, 0, 0.1) !important;
            }

            /* Enhanced Text Contrast */
            [data-theme="light"] .text-gray-600,
            body:not([data-theme="dark"]) .text-gray-600 {
                color: #4b5563 !important; /* Darker gray for better readability */
            }

            [data-theme="light"] .text-gray-700,
            body:not([data-theme="dark"]) .text-gray-700 {
                color: #374151 !important; /* Enhanced text contrast */
            }

            /* Minimal Input Focus Styles */
            textarea:focus,
            input[type="text"]:focus,
            input[type="email"]:focus,
            input[type="password"]:focus,
            input[type="search"]:focus,
            select:focus {
                outline: none !important;
                border-color: #d1d5db !important; /* Subtle gray border */
                box-shadow: 0 0 0 1px rgba(156, 163, 175, 0.3) !important; /* Very subtle shadow */
                transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out !important;
            }

            /* Dark Mode Input Focus */
            [data-theme="dark"] textarea:focus,
            [data-theme="dark"] input[type="text"]:focus,
            [data-theme="dark"] input[type="email"]:focus,
            [data-theme="dark"] input[type="password"]:focus,
            [data-theme="dark"] input[type="search"]:focus,
            [data-theme="dark"] select:focus {
                border-color: #4b5563 !important; /* Subtle dark gray border */
                box-shadow: 0 0 0 1px rgba(75, 85, 99, 0.3) !important; /* Very subtle dark shadow */
            }

            /* Remove default focus rings */
            *:focus {
                outline: none !important;
            }

            /* Minimal button focus styles */
            button:focus {
                outline: none !important;
                box-shadow: 0 0 0 1px rgba(156, 163, 175, 0.2) !important;
            }

            [data-theme="dark"] button:focus {
                box-shadow: 0 0 0 1px rgba(75, 85, 99, 0.3) !important;
            }

            /* Override Tailwind focus styles */
            .focus\\:ring-2:focus,
            .focus\\:ring-blue-500:focus,
            .focus\\:ring-indigo-500:focus {
                --tw-ring-offset-shadow: none !important;
                --tw-ring-shadow: none !important;
                box-shadow: 0 0 0 1px rgba(156, 163, 175, 0.3) !important;
            }

            [data-theme="dark"] .focus\\:ring-2:focus,
            [data-theme="dark"] .focus\\:ring-blue-500:focus,
            [data-theme="dark"] .focus\\:ring-indigo-500:focus {
                box-shadow: 0 0 0 1px rgba(75, 85, 99, 0.3) !important;
            }

            /* Mobile Menu Items */
            [data-theme="dark"] .mobile-menu a,
            [data-theme="dark"] .mobile-menu button,
            [data-theme="dark"] .sidebar a,
            [data-theme="dark"] .sidebar button {
                color: #ffffff !important;
                background-color: transparent !important;
            }

            [data-theme="dark"] .mobile-menu a:hover,
            [data-theme="dark"] .mobile-menu button:hover,
            [data-theme="dark"] .sidebar a:hover,
            [data-theme="dark"] .sidebar button:hover {
                background-color: #2a2a2a !important;
                color: #66b3ff !important;
            }

            /* Fix All White Backgrounds */
            [data-theme="dark"] [class*="bg-white"],
            [data-theme="dark"] [style*="background-color: white"],
            [data-theme="dark"] [style*="background: white"] {
                background-color: #1a1a1a !important;
                color: #ffffff !important;
            }

            /* Social Share Buttons - Keep Original Colors but Darker */
            [data-theme="dark"] .bg-green-600 {
                background-color: #1a5d1a !important;
            }

            [data-theme="dark"] .bg-red-600 {
                background-color: #cc2828 !important;
            }

            [data-theme="dark"] .bg-black {
                background-color: #000000 !important;
            }
        </style>
        
        <!-- Enhanced Global Optimization Styles for All Devices -->
        <style>
            /* Desktop & Laptop Optimization (1024px and above) - COMPACT DESIGN */
            @media (min-width: 1024px) {
                /* Maximize container width but keep compact */
                .max-w-7xl {
                    max-width: 98% !important;
                    padding-left: 1rem !important;
                    padding-right: 1rem !important;
                }
                
                /* Tool containers - full width but compact */
                .bg-white.rounded-lg.shadow-md {
                    width: 100% !important;
                    max-width: none !important;
                }
                
                /* Input/Output areas - compact but usable */
                .text-converter-wrapper textarea,
                textarea {
                    height: 160px !important; /* Compact height */
                    font-size: 0.875rem !important; /* Smaller text */
                    padding: 0.75rem !important; /* Less padding */
                }
                
                /* Compact button spacing */
                .text-converter-wrapper .flex.gap-1\.5 {
                    gap: 0.375rem !important;
                }
                
                .text-converter-wrapper button {
                    width: 2rem !important;
                    height: 2rem !important;
                    padding: 0.25rem !important;
                }
                
                /* Compact stats text */
                .text-converter-wrapper .grid-cols-2 {
                    gap: 0.5rem !important;
                    font-size: 0.75rem !important;
                }
                
                /* Tool titles - compact */
                .tool-title, h1 {
                    font-size: 1.5rem !important; /* Smaller title */
                    line-height: 1.3 !important;
                    margin-bottom: 0.75rem !important;
                }
                
                /* Tool description - compact */
                .text-sm {
                    font-size: 0.75rem !important;
                }
                
                /* Share buttons - compact */
                .inline-flex.items-center.px-3.py-1\\.5 {
                    padding: 0.375rem 0.5rem !important;
                    font-size: 0.75rem !important;
                }
                
                /* Grid layouts - compact spacing */
                .grid.grid-cols-1.lg\\:grid-cols-2 {
                    gap: 0.75rem !important;
                }
                
                /* Tool header - compact padding */
                .bg-gray-50.px-6.py-4 {
                    padding: 1rem !important;
                }
                
                /* Content sections - compact margins */
                .mb-6 {
                    margin-bottom: 1rem !important;
                }
                
                .p-6 {
                    padding: 1rem !important;
                }
            }
            
            /* Tablet Optimization (768px to 1023px) - COMPACT DESIGN */
            @media (min-width: 768px) and (max-width: 1023px) {
                /* Container width for tablets - compact */
                .max-w-7xl {
                    max-width: 95% !important;
                    padding-left: 0.75rem !important;
                    padding-right: 0.75rem !important;
                }
                
                /* Tool containers - full width */
                .bg-white.rounded-lg.shadow-md {
                    width: 100% !important;
                }
                
                /* Input/Output areas - compact for tablets */
                .text-converter-wrapper textarea,
                textarea {
                    height: 150px !important; /* Compact height */
                    font-size: 0.875rem !important; /* Smaller text */
                    padding: 0.75rem !important; /* Less padding */
                }
                
                /* Button sizing for tablets - compact */
                .text-converter-wrapper button {
                    width: 1.875rem !important; /* 30px */
                    height: 1.875rem !important;
                    padding: 0.25rem !important;
                }
                
                /* Tool titles for tablets - compact */
                .tool-title, h1 {
                    font-size: 1.375rem !important; /* Smaller */
                    line-height: 1.3 !important;
                    margin-bottom: 0.5rem !important;
                }
                
                /* Stats section for tablets - compact */
                .text-converter-wrapper .grid-cols-2 {
                    gap: 0.5rem !important;
                    font-size: 0.75rem !important;
                }
                
                /* Share buttons for tablets - compact */
                .inline-flex.items-center.px-3.py-1\\.5 {
                    padding: 0.25rem 0.5rem !important;
                    font-size: 0.75rem !important;
                }
                
                /* Grid spacing for tablets - compact */
                .grid.grid-cols-1.lg\\:grid-cols-2 {
                    gap: 0.75rem !important;
                }
                
                .p-6 {
                    padding: 1rem !important;
                }
            }
            
            /* Global Mobile Optimization for All Tools */
            @media (max-width: 768px) {
                /* Make tool titles more compact */
                .tool-title, h1 {
                    font-size: 1.25rem !important; /* Smaller title */
                    line-height: 1.3 !important;
                    margin-bottom: 0.5rem !important;
                }
                
                /* Optimize tool container width - FULL WIDTH */
                .max-w-7xl {
                    max-width: 100% !important;
                    padding-left: 0.5rem !important;
                    padding-right: 0.5rem !important;
                }
                
                /* Tool main container - 100% width */
                .bg-white.rounded-lg.shadow-md {
                    width: 100% !important;
                    margin: 0 !important;
                    border-radius: 0.5rem !important;
                }
                
                /* Input/Output container - 100% width */
                .text-converter-wrapper,
                .grid.grid-cols-1.lg\\:grid-cols-2 {
                    width: 100% !important;
                    gap: 0.5rem !important;
                }
                
                /* Make input/output areas 100% width and compact */
                .text-converter-wrapper textarea,
                textarea {
                    width: 100% !important;
                    height: 140px !important; /* Smaller height */
                    font-size: 0.875rem !important; /* Smaller text */
                    padding: 0.75rem !important; /* Less padding */
                    margin: 0 !important;
                }
                
                /* Fix button wrapping - Case Sensitive/Insensitive */
                .flex.gap-2,
                .flex.space-x-2,
                .flex.items-center.gap-1,
                .flex.items-center.space-x-1 {
                    flex-wrap: nowrap !important;
                    gap: 0.25rem !important;
                    overflow-x: auto !important;
                }
                
                /* Compact all buttons */
                button {
                    padding: 0.375rem 0.5rem !important;
                    font-size: 0.75rem !important;
                    white-space: nowrap !important;
                    min-width: auto !important;
                }
                
                /* Extra compact for icon buttons */
                .text-converter-wrapper button,
                .w-8.h-8 {
                    width: 1.75rem !important;
                    height: 1.75rem !important;
                    padding: 0.25rem !important;
                }
                
                /* Case sensitive/insensitive buttons - prevent wrapping */
                .px-4.py-2,
                .bg-blue-600,
                .bg-gray-300 {
                    padding: 0.375rem 0.5rem !important;
                    font-size: 0.75rem !important;
                    min-width: auto !important;
                    flex-shrink: 0 !important;
                }
                
                /* Compact button spacing */
                .text-converter-wrapper .flex.gap-1\.5 {
                    gap: 0.25rem !important;
                    flex-wrap: nowrap !important;
                }
                
                /* Compact stats section */
                .text-converter-wrapper .grid-cols-2 {
                    gap: 0.375rem !important;
                    font-size: 0.75rem !important;
                }
                
                /* Tool description text */
                .text-sm {
                    font-size: 0.75rem !important;
                }
                
                /* Compact tool header */
                .bg-gray-50.px-6.py-4 {
                    padding: 0.75rem !important;
                }
                
                /* Make share buttons smaller and prevent wrapping */
                .inline-flex.items-center.px-3.py-1\\.5 {
                    padding: 0.25rem 0.375rem !important;
                    font-size: 0.7rem !important;
                    white-space: nowrap !important;
                }
                
                /* Share button container - allow horizontal scroll */
                .flex.flex-wrap.gap-2 {
                    flex-wrap: nowrap !important;
                    overflow-x: auto !important;
                    gap: 0.25rem !important;
                    padding-bottom: 0.5rem !important;
                }
                
                /* Compact example sections */
                .mb-6 {
                    margin-bottom: 1rem !important;
                }
                
                .mb-3 {
                    margin-bottom: 0.5rem !important;
                }
                
                /* Optimize prose content */
                .prose {
                    font-size: 0.875rem !important;
                }
                
                .prose h2 {
                    font-size: 1.125rem !important;
                    margin-top: 1rem !important;
                    margin-bottom: 0.5rem !important;
                }
                
                .prose h3 {
                    font-size: 1rem !important;
                    margin-top: 0.75rem !important;
                    margin-bottom: 0.375rem !important;
                }
                
                /* Compact list items */
                .prose ul, .prose ol {
                    margin-top: 0.5rem !important;
                    margin-bottom: 0.5rem !important;
                }
                
                .prose li {
                    margin-top: 0.25rem !important;
                    margin-bottom: 0.25rem !important;
                }
                
                /* Fix input field containers */
                .grid > div {
                    width: 100% !important;
                }
                
                /* Ensure full width for all tool containers */
                .p-6 {
                    padding: 0.75rem !important;
                    width: 100% !important;
                }
                
                /* Character/Word counter specific fixes */
                .grid.grid-cols-1.gap-4 {
                    gap: 0.5rem !important;
                    width: 100% !important;
                }
                
                /* Search mode buttons container */
                .flex.items-center.space-x-2 {
                    flex-wrap: nowrap !important;
                    gap: 0.25rem !important;
                    overflow-x: visible !important;
                }
            }
            
            /* Extra small screens optimization */
            @media (max-width: 480px) {
                .tool-title, h1 {
                    font-size: 1.125rem !important;
                }
                
                .text-converter-wrapper textarea,
                textarea {
                    height: 120px !important;
                    font-size: 0.8125rem !important;
                    padding: 0.5rem !important;
                }
                
                .max-w-7xl {
                    padding-left: 0.25rem !important;
                    padding-right: 0.25rem !important;
                }
                
                /* Even more compact buttons on very small screens */
                button {
                    padding: 0.25rem 0.375rem !important;
                    font-size: 0.7rem !important;
                }
                
                .text-converter-wrapper button,
                .w-8.h-8 {
                    width: 1.5rem !important;
                    height: 1.5rem !important;
                }
            }
            
            /* Modal Responsiveness Enhancements */
            @media (max-width: 640px) {
                /* Ensure modals work on very small screens */
                .modal-container {
                    padding: 0.5rem !important;
                    min-height: 100vh !important;
                }
                
                /* Modal content adjustments */
                .modal-content {
                    max-height: 95vh !important;
                    overflow-y: auto !important;
                    margin: 1rem 0 !important;
                }
                
                /* Sticky button container */
                .modal-buttons {
                    position: sticky !important;
                    bottom: 0 !important;
                    background: white !important;
                    padding-top: 1rem !important;
                    margin-top: 1rem !important;
                    border-top: 1px solid #e5e7eb !important;
                }
                
                /* Dark mode modal buttons */
                [data-theme="dark"] .modal-buttons {
                    background: #1a1a1a !important;
                    border-top-color: #333333 !important;
                }
                
                /* Form field adjustments for mobile */
                .modal-form input,
                .modal-form textarea,
                .modal-form select {
                    font-size: 16px !important; /* Prevents zoom on iOS */
                    padding: 0.75rem !important;
                }
                
                /* Modal header adjustments */
                .modal-header {
                    padding: 1rem !important;
                }
                
                .modal-header h3 {
                    font-size: 1.125rem !important;
                }
                
                .modal-header p {
                    font-size: 0.875rem !important;
                }
            }
            
            /* Tablet modal optimizations */
            @media (min-width: 641px) and (max-width: 1024px) {
                .modal-content {
                    max-height: 90vh !important;
                }
            }
            
            /* Prevent body scroll when modal is open */
            body.modal-open {
                overflow: hidden !important;
                position: fixed !important;
                width: 100% !important;
            }
        </style>
        
        
        <!-- Dark Mode Theme Initialization -->
        <script>
            // Initialize theme before page renders to prevent flash
            (function() {
                const savedTheme = localStorage.getItem('theme') || 'light';
                document.documentElement.setAttribute('data-theme', savedTheme);
            })();
        </script>
    </head>
    <body class="font-sans antialiased bg-gray-50" data-theme="light">
        <!-- Navigation -->
        @include('components.navbar')
        
        <!-- Page Content -->
        <main>
            @yield('content')
        </main>
        
        <!-- Footer -->
        @include('components.footer')
        
        <!-- Scripts Stack -->
        @stack('scripts')
        
        <!-- Dark Mode Toggle Functionality -->
        <script>
            // Dark Mode Toggle System
            function initTheme() {
                const savedTheme = localStorage.getItem('theme') || 'light';
                document.documentElement.setAttribute('data-theme', savedTheme);
                document.body.setAttribute('data-theme', savedTheme);
            }
            
            function toggleTheme() {
                const currentTheme = document.documentElement.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                document.documentElement.setAttribute('data-theme', newTheme);
                document.body.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                
                // Dispatch custom event for other components
                window.dispatchEvent(new CustomEvent('themeChanged', { detail: { theme: newTheme } }));
            }
            
            // Initialize theme on page load
            document.addEventListener('DOMContentLoaded', initTheme);
            
            // Re-initialize theme if it changes
            window.addEventListener('storage', function(e) {
                if (e.key === 'theme') {
                    initTheme();
                }
            });
        </script>
    </body>
</html>
