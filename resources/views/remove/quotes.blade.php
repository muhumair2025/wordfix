@extends('layouts.tool')

@section('title', 'Remove Quotes - WordFix')

@section('tool-title', 'Remove Quotes')

@section('tool-description', 'Remove single, double, and smart quotes from text')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-gray-50 border border-gray-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-2">
        <label class="flex items-center cursor-pointer bg-white border border-gray-200 rounded px-3 py-1.5">
            <input type="checkbox" id="doubleQuotes" class="w-4 h-4 text-gray-600 rounded" checked onchange="removeQuotes()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Double Quotes (")</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-gray-200 rounded px-3 py-1.5">
            <input type="checkbox" id="singleQuotes" class="w-4 h-4 text-gray-600 rounded" checked onchange="removeQuotes()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Single Quotes (')</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-gray-200 rounded px-3 py-1.5">
            <input type="checkbox" id="smartQuotes" class="w-4 h-4 text-gray-600 rounded" checked onchange="removeQuotes()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Smart Quotes (“”‘’)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-gray-200 rounded px-3 py-1.5">
            <input type="checkbox" id="backticks" class="w-4 h-4 text-gray-600 rounded" onchange="removeQuotes()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Backticks (`)</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="removeQuotes"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Text without quotes will appear here..."
    downloadFileName="no-quotes.txt"
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
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Remove Quotes</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Remove various types of quotation marks from text, including standard quotes and smart (curly) quotes.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Remove standard double quotes (")</li>
            <li>Remove standard single quotes (')</li>
            <li>Remove smart/curly double quotes (“”)</li>
            <li>Remove smart/curly single quotes (‘’)</li>
            <li>Remove backticks (`)</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function removeQuotes() {
        const input = document.getElementById('removeQuotes-input');
        const output = document.getElementById('removeQuotes-output');
        if (!input || !output) return;
        
        let text = input.value;
        const originalLength = text.length;
        
        const removeDouble = document.getElementById('doubleQuotes')?.checked || false;
        const removeSingle = document.getElementById('singleQuotes')?.checked || false;
        const removeSmart = document.getElementById('smartQuotes')?.checked || false;
        const removeBackticks = document.getElementById('backticks')?.checked || false;
        
        let quotesRemoved = 0;
        
        // Remove double quotes
        if (removeDouble) {
            const matches = text.match(/"/g);
            quotesRemoved += matches ? matches.length : 0;
            text = text.replace(/"/g, '');
        }
        
        // Remove single quotes
        if (removeSingle) {
            const matches = text.match(/'/g);
            quotesRemoved += matches ? matches.length : 0;
            text = text.replace(/'/g, '');
        }
        
        // Remove smart quotes
        if (removeSmart) {
            const matches = text.match(/[“”‘’]/g);
            quotesRemoved += matches ? matches.length : 0;
            text = text.replace(/[“”‘’]/g, '');
        }
        
        // Remove backticks
        if (removeBackticks) {
            const matches = text.match(/`/g);
            quotesRemoved += matches ? matches.length : 0;
            text = text.replace(/`/g, '');
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
    
    setRemoveQuotesConverter(text => {
        removeQuotes();
        return document.getElementById('removeQuotes-output').value;
    });
</script>
@endpush
