@extends('layouts.tool')

@section('title', 'Title Case - WordFix')

@section('tool-title', 'Title Case Text Tool')

@section('tool-description', '')

@section('tool-content')
<!-- Text Converter Component -->
<x-text-converter 
    toolId="titleCase"
    inputPlaceholder="Type or paste your content here"
    outputPlaceholder="Title Case text will appear here"
    downloadFileName="title-case-text.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    This tool converts texts to "Title Case" capitalizing the first letter of each word.
</div>

<!-- Example -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Title Case Text Example</h3>
    <div class="mb-3">
        <p class="text-sm font-medium text-gray-700 mb-2">Before</p>
        <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">the title case text tool helps you change text to title case</div>
    </div>
    <div>
        <p class="text-sm font-medium text-gray-700 mb-2">After</p>
        <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">The Title Case Text Tool Helps You Change Text To Title Case</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Title Case Converter Tool</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>The <strong>title case converter</strong> capitalizes the first letter of each word while keeping the rest lowercase. Perfect for headings, titles, and proper formatting.</p>
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Uses</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Book titles and article headlines</li>
            <li>Document headers and section titles</li>
            <li>Blog post titles and meta descriptions</li>
            <li>Email subject lines</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    setTitleCaseConverter(function(text) {
        return text.toLowerCase().split(' ').map(word => {
            return word.charAt(0).toUpperCase() + word.slice(1);
        }).join(' ');
    });
</script>
@endpush

