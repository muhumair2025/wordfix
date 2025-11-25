@extends('layouts.tool')

@section('title', 'Lower Case - WordFix')

@section('tool-title', 'Lower Case Text Tool')

@section('tool-description', '')

@section('tool-content')
<!-- Text Converter Component -->
<x-text-converter 
    toolId="lowerCase"
    inputPlaceholder="Type or paste your content here"
    outputPlaceholder="lowercase text will appear here"
    downloadFileName="lowercase-text.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    This lower casing tool converts texts to "lowercase" or all small letters.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">lowercase Text Example</h3>
    <div class="mb-3">
        <p class="text-sm font-medium text-gray-700 mb-2">Before</p>
        <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
            The Lower Case Text Tool Helps You Change Text To Lower Case Just Like This
        </div>
    </div>
    <div>
        <p class="text-sm font-medium text-gray-700 mb-2">After</p>
        <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
            the lower case text tool helps you change text to lower case just like this
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Lower Case Converter Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>lower case converter</strong> is a simple text transformation tool that converts any text into lowercase letters instantly. This tool is perfect for standardizing text, fixing formatting issues, or preparing content for case-sensitive systems.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use the Lower Case Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Type or paste your text into the input box</li>
            <li>The tool automatically converts your text to lowercase in real-time</li>
            <li>Copy the converted text or download it as a file</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Email addresses and usernames</li>
            <li>URLs and file names</li>
            <li>Programming variables and functions</li>
            <li>Database entries and search queries</li>
            <li>Social media handles</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    setLowerCaseConverter(function(text) {
        return text.toLowerCase();
    });
</script>
@endpush

