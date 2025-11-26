@extends('layouts.app')

@section('title', $page->title . ' - WordFix')

@push('styles')
<style>
.page-content {
    line-height: 1.7;
    color: #374151;
}

.page-content h1 {
    font-size: 2.25rem;
    font-weight: 700;
    color: #111827;
    margin-top: 2rem;
    margin-bottom: 1.5rem;
    line-height: 1.2;
}

.page-content h2 {
    font-size: 1.875rem;
    font-weight: 600;
    color: #1f2937;
    margin-top: 2.5rem;
    margin-bottom: 1.25rem;
    line-height: 1.3;
    border-bottom: 2px solid #e5e7eb;
    padding-bottom: 0.5rem;
}

.page-content h3 {
    font-size: 1.5rem;
    font-weight: 600;
    color: #374151;
    margin-top: 2rem;
    margin-bottom: 1rem;
    line-height: 1.4;
}

.page-content h4 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #4b5563;
    margin-top: 1.5rem;
    margin-bottom: 0.75rem;
}

.page-content p {
    margin-bottom: 1.25rem;
    font-size: 1rem;
    line-height: 1.7;
}

.page-content ul, .page-content ol {
    margin-bottom: 1.5rem;
    padding-left: 1.5rem;
}

.page-content li {
    margin-bottom: 0.5rem;
    line-height: 1.6;
}

.page-content ul li {
    list-style-type: disc;
}

.page-content ol li {
    list-style-type: decimal;
}

.page-content strong {
    font-weight: 600;
    color: #111827;
}

.page-content em {
    font-style: italic;
}

.page-content a {
    color: #2563eb;
    text-decoration: underline;
}

.page-content a:hover {
    color: #1d4ed8;
}

.page-content code {
    background-color: #f3f4f6;
    padding: 0.125rem 0.25rem;
    border-radius: 0.25rem;
    font-family: 'Courier New', monospace;
    font-size: 0.875rem;
}

.page-content blockquote {
    border-left: 4px solid #e5e7eb;
    padding-left: 1rem;
    margin: 1.5rem 0;
    font-style: italic;
    color: #6b7280;
}

.page-content hr {
    border: none;
    border-top: 1px solid #e5e7eb;
    margin: 2rem 0;
}

.page-content table {
    width: 100%;
    border-collapse: collapse;
    margin: 1.5rem 0;
}

.page-content th, .page-content td {
    border: 1px solid #e5e7eb;
    padding: 0.75rem;
    text-align: left;
}

.page-content th {
    background-color: #f9fafb;
    font-weight: 600;
}

/* First element margin reset */
.page-content > *:first-child {
    margin-top: 0;
}

/* Last element margin reset */
.page-content > *:last-child {
    margin-bottom: 0;
}
</style>
@endpush

@if($page->meta_description)
    @section('meta_description', $page->meta_description)
@endif

@if($page->meta_keywords)
    @section('meta_keywords', $page->meta_keywords)
@endif

@section('content')
<div class="min-h-screen bg-gray-50">
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="flex mb-8" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="{{ url('/') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $page->title }}</span>
                        </div>
                    </li>
                </ol>
            </nav>

            <!-- Page Content -->
            <article class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <div class="px-6 py-8 sm:px-8 lg:px-12">
                    <header class="mb-8">
                        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">{{ $page->title }}</h1>
                        <div class="flex items-center text-sm text-gray-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Last updated: {{ $page->updated_at->format('F j, Y') }}
                        </div>
                    </header>

                    <div class="page-content">
                        {!! $page->content !!}
                    </div>
                </div>
            </article>

            <!-- Back to Home -->
            <div class="mt-8 text-center">
                <a href="{{ url('/') }}" 
                   class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Back to Tools
                </a>
            </div>
        </div>
    </main>
</div>
@endsection
