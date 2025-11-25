@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search Tools Component -->
        @include('components.search-tools')
        
        <!-- Tool Content -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
            <!-- Tool Header -->
            <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                <h1 class="text-2xl font-bold text-gray-900">@yield('tool-title')</h1>
                <p class="text-sm text-gray-600 mt-1">@yield('tool-description')</p>
            </div>
            
            <!-- Tool Body -->
            <div class="p-6">
                @yield('tool-content')
            </div>
        </div>
        
        <!-- Tool Information (Optional) -->
        @hasSection('tool-info')
        <div class="mt-6 bg-white rounded-lg shadow-md border border-gray-200 p-6">
            @yield('tool-info')
        </div>
        @endif
    </div>
</div>
@endsection

