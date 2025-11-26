@extends('layouts.app')

@section('content')
<div class="py-4 h-[calc(100vh-64px)] flex flex-col">
    <div class="w-full px-4 sm:px-6 lg:px-8 flex-1 flex flex-col">
        <!-- Tool Content -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden flex-1 flex flex-col">
            <!-- Tool Header -->
            <div class="border-b border-gray-200 bg-gray-50 px-6 py-4 flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">@yield('tool-title')</h1>
                    <p class="text-sm text-gray-600 mt-1">@yield('tool-description')</p>
                </div>
                <!-- Optional Header Actions -->
                @yield('header-actions')
            </div>
            
            <!-- Tool Body -->
            <div class="p-0 flex-1 flex flex-col overflow-hidden">
                @yield('tool-content')
            </div>
        </div>
    </div>
</div>
@endsection
