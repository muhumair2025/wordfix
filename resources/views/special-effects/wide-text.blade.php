@extends('layouts.tool')

@section('title', 'Wide Text Generator - WordFix')

@section('tool-title', 'Wide Text Generator')

@section('tool-description', 'Convert text to fullwidth characters for aesthetic vaporwave style')

@section('tool-content')
<x-text-converter 
    toolId="wideText"
    inputPlaceholder="Type your text here..."
    outputPlaceholder="Wide text will appear here..."
    downloadFileName="wide-text.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6 mt-4">
    Converts text to fullwidth Unicode characters - popular in vaporwave aesthetics.
</div>

<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Example</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before</p>
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm">Hello World</div>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After (Wide)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-base">Ｈｅｌｌｏ　Ｗｏｒｌｄ</div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Wide Text</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Fullwidth text uses Unicode fullwidth characters, popular in Japanese text and vaporwave aesthetics. Creates wider, spaced-out text.</p>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function convertToWideText(text) {
        if (!text) return '';
        
        let result = '';
        for (let i = 0; i < text.length; i++) {
            const code = text.charCodeAt(i);
            
            // Convert ASCII to fullwidth
            if (code === 32) {
                // Space character
                result += String.fromCharCode(0x3000); // Fullwidth space
            } else if (code >= 33 && code <= 126) {
                // Printable ASCII characters
                result += String.fromCharCode(code + 0xFEE0);
            } else {
                result += text[i];
            }
        }
        
        return result;
    }
    setWideTextConverter(convertToWideText);
</script>
@endpush
