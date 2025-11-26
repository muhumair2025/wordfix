@extends('layouts.tool')

@section('title', 'Remove Single Quotes - WordFix')

@section('tool-title', 'Remove Single Quotes')

@section('tool-description', 'Remove single quotes and apostrophes from text')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-gray-50 border border-gray-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-2">
        <label class="flex items-center cursor-pointer bg-white border border-gray-200 rounded px-3 py-1.5">
            <input type="checkbox" id="standardQuotes" class="w-4 h-4 text-gray-600 rounded" checked onchange="removeSingleQuotes()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Standard Single Quotes (')</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-gray-200 rounded px-3 py-1.5">
            <input type="checkbox" id="smartQuotes" class="w-4 h-4 text-gray-600 rounded" checked onchange="removeSingleQuotes()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Smart Single Quotes (‘’)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-gray-200 rounded px-3 py-1.5">
            <input type="checkbox" id="replaceWithSpace" class="w-4 h-4 text-gray-600 rounded" onchange="removeSingleQuotes()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Replace with Space</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="removeSingleQuotes"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Text without single quotes will appear here..."
    downloadFileName="no-single-quotes.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-gray-600" id="originalChars">0</div>
        <div class="text-xs text-gray-600">Original Chars</div>
    </div>
    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-red-600" id="quotesRemoved">0</div>
        <div class="text-xs text-gray-600">Quotes Removed</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="finalChars">0</div>
        <div class="text-xs text-gray-600">Final Chars</div>
    </div>
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-purple-600" id="reductionPercent">0%</div>
        <div class="text-xs text-gray-600">Reduction</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Remove Single Quotes</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Specialized tool to remove single quotes and apostrophes from text, including both standard and smart (curly) variations.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Remove standard single quotes/apostrophes (')</li>
            <li>Remove smart single quotes (‘ and ’)</li>
            <li>Option to replace with space instead of removing</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function removeSingleQuotes() {
        const input = document.getElementById('removeSingleQuotes-input');
        const output = document.getElementById('removeSingleQuotes-output');
        if (!input || !output) return;
        
        let text = input.value;
        const originalLength = text.length;
        
        const removeStandard = document.getElementById('standardQuotes')?.checked || false;
        const removeSmart = document.getElementById('smartQuotes')?.checked || false;
        const replaceWithSpace = document.getElementById('replaceWithSpace')?.checked || false;
        
        const replacement = replaceWithSpace ? ' ' : '';
        let quotesRemoved = 0;
        
        // Remove standard single quotes
        if (removeStandard) {
            const matches = text.match(/'/g);
            quotesRemoved += matches ? matches.length : 0;
            text = text.replace(/'/g, replacement);
        }
        
        // Remove smart single quotes
        if (removeSmart) {
            const matches = text.match(/[‘’]/g);
            quotesRemoved += matches ? matches.length : 0;
            text = text.replace(/[‘’]/g, replacement);
        }
        
        output.value = text;
        
        // Update stats
        const reduction = originalLength > 0 ? (((originalLength - text.length) / originalLength) * 100).toFixed(1) : 0;
        
        document.getElementById('originalChars').textContent = originalLength;
        document.getElementById('quotesRemoved').textContent = quotesRemoved;
        document.getElementById('finalChars').textContent = text.length;
        document.getElementById('reductionPercent').textContent = reduction + '%';
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setRemoveSingleQuotesConverter(text => {
        removeSingleQuotes();
        return document.getElementById('removeSingleQuotes-output').value;
    });
</script>
@endpush
