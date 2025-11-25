@extends('layouts.tool')

@section('title', 'Slashed Text Generator - WordFix')

@section('tool-title', 'Slashed Text Generator')

@section('tool-description', 'Add slashes through your text for strikethrough effect')

@section('tool-content')
<x-text-converter 
    toolId="slashedText"
    inputPlaceholder="Type your text here..."
    outputPlaceholder="Slashed text will appear here..."
    downloadFileName="slashed-text.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6 mt-4">
    Adds combining slashes through each character for a strikethrough effect.
</div>

<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Example</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before</p>
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm">Hello World</div>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-base">H̷e̷l̷l̷o̷ W̷o̷r̷l̷d̷</div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Slashed Text</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Adds Unicode combining short stroke overlay to create slashed text effect.</p>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function slashText(text) {
        if (!text) return '';
        const slash = '\u0337'; // Combining short stroke overlay
        return text.split('').map(char => char + slash).join('');
    }
    setSlashedTextConverter(slashText);
</script>
@endpush
