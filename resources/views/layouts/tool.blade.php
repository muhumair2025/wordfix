@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search Tools Component -->
        @include('components.search-tools')
        
        <!-- Tool Content -->
        <div class="bg-white rounded-lg shadow-lg border border-gray-300 overflow-hidden"
             :class="{'bg-gray-800 border-gray-600': document.body.getAttribute('data-theme') === 'dark'}">
            <!-- Tool Header -->
            <div class="border-b border-gray-300 bg-gray-100 px-6 py-4"
                 :class="{'border-gray-600 bg-gray-700': document.body.getAttribute('data-theme') === 'dark'}">
                <h1 class="text-2xl font-bold text-gray-900"
                    :class="{'text-white': document.body.getAttribute('data-theme') === 'dark'}">@yield('tool-title')</h1>
                <p class="text-sm text-gray-600 mt-1"
                   :class="{'text-gray-300': document.body.getAttribute('data-theme') === 'dark'}">@yield('tool-description')</p>
            </div>
            
            <!-- Tool Body -->
            <div class="p-6">
                @yield('tool-content')
            </div>
        </div>
        
        <!-- Tool Information (Optional) -->
        @hasSection('tool-info')
        <div class="mt-6 bg-white rounded-lg shadow-lg border border-gray-300 overflow-hidden" 
             x-data="{ isOpen: false }"
             :class="{'bg-gray-800 border-gray-600': document.body.getAttribute('data-theme') === 'dark'}">
            <!-- Accordion Header -->
            <button @click="isOpen = !isOpen" 
                    class="w-full px-6 py-4 text-left bg-gray-100 border-b border-gray-300 hover:bg-gray-200 transition-colors duration-200 flex items-center justify-between shadow-sm"
                    :class="{'bg-gray-700 border-gray-600 hover:bg-gray-600 text-white': document.body.getAttribute('data-theme') === 'dark'}">
                <h3 class="text-lg font-semibold text-gray-900"
                    :class="{'text-white': document.body.getAttribute('data-theme') === 'dark'}">
                    About This Tool
                </h3>
                <svg class="w-5 h-5 transform transition-transform duration-200" 
                     :class="isOpen ? 'rotate-180' : 'rotate-0'"
                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
            
            <!-- Accordion Content -->
            <div x-show="isOpen" 
                 x-cloak
                 x-collapse
                 class="p-6">
                @yield('tool-info')
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

