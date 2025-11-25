@extends('layouts.tool')

@section('title', 'Sentence Case - WordFix')

@section('tool-title', 'Sentence Case Text Tool')

@section('tool-description', '')

@section('tool-content')
<!-- Text Converter Component -->
<x-text-converter 
    toolId="sentenceCase"
    inputPlaceholder="Type or paste your content here"
    outputPlaceholder="Sentence case text will appear here"
    downloadFileName="sentence-case-text.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    This tool converts text to sentence case - capitalizing the first letter of each sentence.
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Sentence Case Converter</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>The <strong>sentence case converter</strong> capitalizes the first letter of each sentence while keeping the rest lowercase, following standard grammar rules.</p>
    </div>
</article>
@endsection

@push('scripts')
<script>
    setSentenceCaseConverter(function(text) {
        return text.toLowerCase().replace(/(^\w|\.\s+\w)/gm, function(txt) {
            return txt.toUpperCase();
        });
    });
</script>
@endpush

