@extends('layouts.app')

@section('title', $categoryData['title'] . ' - WordFix')

@section('content')
<div class="py-6 md:py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search Tools Component -->
        @include('components.search-tools')
        
        <!-- Category Header -->
        <div class="text-center mb-8">
            <div class="flex items-center justify-center mb-4">
                <div class="bg-{{ $categoryData['color'] }}-100 rounded-full p-3 mr-4">
                    {!! $categoryData['icon'] !!}
                </div>
                <div class="text-left">
                    <h1 class="text-3xl md:text-4xl font-bold text-gray-900">
                        {{ $categoryData['title'] }}
                    </h1>
                    <p class="text-lg text-gray-600 mt-1">
                        {{ count($categoryData['tools']) }} tools available
                    </p>
                </div>
            </div>
            <p class="text-gray-600 max-w-3xl mx-auto leading-relaxed">
                {{ $categoryData['description'] }}
            </p>
        </div>
        
        <!-- Category Stats -->
        <div class="text-center mb-8">
            <div class="inline-flex bg-white rounded-lg border border-gray-200 p-4">
                <div class="text-2xl font-bold text-{{ $categoryData['color'] }}-600 mr-2">{{ count($categoryData['tools']) }}</div>
                <div class="text-sm text-gray-600 self-center">tools available</div>
            </div>
        </div>
        
        <!-- Tools Grid -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mb-8">
            @foreach($categoryData['tools'] as $tool)
            <a href="{{ $tool['url'] }}" class="bg-white rounded-lg border border-gray-200 hover:border-{{ $categoryData['color'] }}-300 hover:shadow-md transition-all duration-200 p-4 group">
                <div class="flex items-center mb-3">
                    <div class="bg-{{ $categoryData['color'] }}-100 rounded-lg p-2 mr-3">
                        {!! $tool['icon'] !!}
                    </div>
                    <h3 class="font-medium text-gray-900 text-sm group-hover:text-{{ $categoryData['color'] }}-600 transition-colors">
                        {{ $tool['name'] }}
                    </h3>
                </div>
                <p class="text-gray-600 text-xs leading-relaxed">
                    {{ $tool['description'] }}
                </p>
            </a>
            @endforeach
        </div>
        
        <!-- Related Categories -->
        <div class="bg-white rounded-lg border border-gray-200 p-6">
            <h3 class="font-medium text-gray-900 mb-4">Other Categories</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3">
                @foreach($relatedCategories as $category)
                <a href="/{{ $category['slug'] }}" class="flex items-center p-3 rounded-lg border border-gray-200 hover:border-{{ $category['color'] }}-300 transition-all duration-200 group">
                    <div class="bg-{{ $category['color'] }}-100 rounded-lg p-1.5 mr-2">
                        {!! $category['icon'] !!}
                    </div>
                    <div>
                        <div class="font-medium text-gray-900 text-sm">{{ $category['name'] }}</div>
                        <div class="text-xs text-gray-500">{{ $category['count'] }} tools</div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
