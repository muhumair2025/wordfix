@extends('layouts.tool')

@section('title', 'Snake Case Converter - WordFix')

@section('tool-title', 'Snake Case Converter')

@section('tool-description', 'Convert text to snake_case format - perfect for programming variables')

@section('tool-content')
<x-text-converter 
    toolId="snakeCase"
    inputPlaceholder="Type your text here... e.g., Hello World"
    outputPlaceholder="snake_case text will appear here..."
    downloadFileName="snake-case.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6 mt-4">
    Converts text to snake_case: lowercase with underscores between words.
</div>

<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Examples</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before</p>
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm space-y-1">
                <div>Hello World</div>
                <div>UserName</div>
                <div>API Response</div>
            </div>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After (snake_case)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm space-y-1">
                <div>hello_world</div>
                <div>user_name</div>
                <div>api_response</div>
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Snake Case</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>snake_case is a naming convention where words are lowercase and separated by underscores. Commonly used in Python, Ruby, and database naming.</p>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function convertToSnakeCase(text) {
        if (!text) return '';
        return text
            .replace(/([a-z])([A-Z])/g, '$1_$2') // Split camelCase
            .replace(/[\s-]+/g, '_') // Replace spaces and hyphens with underscores
            .replace(/[^a-zA-Z0-9_]/g, '') // Remove special chars
            .toLowerCase();
    }
    setSnakeCaseConverter(convertToSnakeCase);
</script>
@endpush
