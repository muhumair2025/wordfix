@extends('layouts.tool')

@section('title', 'Trim Spaces - WordFix')

@section('tool-title', 'Trim Spaces')

@section('tool-description', 'Remove leading and trailing spaces from each line')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-cyan-50 border border-cyan-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-2">
        <label class="flex items-center cursor-pointer bg-white border border-cyan-200 rounded px-3 py-1.5">
            <input type="checkbox" id="trimLeading" class="w-4 h-4 text-cyan-600 rounded" checked onchange="trimSpaces()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Trim Leading Spaces (Start)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-cyan-200 rounded px-3 py-1.5">
            <input type="checkbox" id="trimTrailing" class="w-4 h-4 text-cyan-600 rounded" checked onchange="trimSpaces()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Trim Trailing Spaces (End)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-cyan-200 rounded px-3 py-1.5">
            <input type="checkbox" id="removeEmpty" class="w-4 h-4 text-cyan-600 rounded" onchange="trimSpaces()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Remove Empty Lines</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-cyan-200 rounded px-3 py-1.5">
            <input type="checkbox" id="cleanInner" class="w-4 h-4 text-cyan-600 rounded" onchange="trimSpaces()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Clean Inner Spaces (Multiple → 1)</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="trimSpaces"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Trimmed text will appear here..."
    downloadFileName="trimmed-text.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-cyan-50 border border-cyan-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-cyan-600" id="originalChars">0</div>
        <div class="text-xs text-gray-600">Original Chars</div>
    </div>
    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-red-600" id="spacesRemoved">0</div>
        <div class="text-xs text-gray-600">Spaces Removed</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="finalChars">0</div>
        <div class="text-xs text-gray-600">Final Chars</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="linesProcessed">0</div>
        <div class="text-xs text-gray-600">Lines Processed</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Trim Spaces</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Clean up your text by removing unnecessary whitespace from the beginning and end of each line.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Trim leading spaces (indentation)</li>
            <li>Trim trailing spaces</li>
            <li>Clean multiple spaces within text</li>
            <li>Remove empty lines</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function trimSpaces() {
        const input = document.getElementById('trimSpaces-input');
        const output = document.getElementById('trimSpaces-output');
        if (!input || !output) return;
        
        let text = input.value;
        const originalLength = text.length;
        
        const trimLeading = document.getElementById('trimLeading')?.checked || false;
        const trimTrailing = document.getElementById('trimTrailing')?.checked || false;
        const removeEmpty = document.getElementById('removeEmpty')?.checked || false;
        const cleanInner = document.getElementById('cleanInner')?.checked || false;
        
        let lines = text.split('\n');
        const linesProcessed = lines.length;
        
        lines = lines.map(line => {
            let processed = line;
            if (trimLeading && trimTrailing) {
                processed = processed.trim();
            } else if (trimLeading) {
                processed = processed.trimStart();
            } else if (trimTrailing) {
                processed = processed.trimEnd();
            }
            
            if (cleanInner) {
                processed = processed.replace(/  +/g, ' ');
            }
            
            return processed;
        });
        
        if (removeEmpty) {
            lines = lines.filter(line => line.length > 0);
        }
        
        text = lines.join('\n');
        
        output.value = text;
        
        // Update stats
        const spacesRemoved = originalLength - text.length;
        
        document.getElementById('originalChars').textContent = originalLength;
        document.getElementById('spacesRemoved').textContent = spacesRemoved;
        document.getElementById('finalChars').textContent = text.length;
        document.getElementById('linesProcessed').textContent = linesProcessed;
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setTrimSpacesConverter(text => {
        trimSpaces();
        return document.getElementById('trimSpaces-output').value;
    });
</script>
@endpush
