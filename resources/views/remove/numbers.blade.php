@extends('layouts.tool')

@section('title', 'Remove Numbers - WordFix')

@section('tool-title', 'Remove Numbers')

@section('tool-description', 'Remove numbers, decimals, and numeric characters from text')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-orange-50 border border-orange-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-2">
        <label class="flex items-center cursor-pointer bg-white border border-orange-200 rounded px-3 py-1.5">
            <input type="checkbox" id="integers" class="w-4 h-4 text-orange-600 rounded" checked onchange="removeNumbers()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Integers (123)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-orange-200 rounded px-3 py-1.5">
            <input type="checkbox" id="decimals" class="w-4 h-4 text-orange-600 rounded" checked onchange="removeNumbers()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Decimals (12.5)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-orange-200 rounded px-3 py-1.5">
            <input type="checkbox" id="negatives" class="w-4 h-4 text-orange-600 rounded" checked onchange="removeNumbers()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Negatives (-10)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-orange-200 rounded px-3 py-1.5">
            <input type="checkbox" id="percentages" class="w-4 h-4 text-orange-600 rounded" onchange="removeNumbers()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Percentages (50%)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-orange-200 rounded px-3 py-1.5">
            <input type="checkbox" id="currency" class="w-4 h-4 text-orange-600 rounded" onchange="removeNumbers()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Currency ($100)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-orange-200 rounded px-3 py-1.5">
            <input type="checkbox" id="keepSpaces" class="w-4 h-4 text-orange-600 rounded" checked onchange="removeNumbers()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Keep Spaces</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="removeNumbers"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Text with numbers removed will appear here..."
    downloadFileName="no-numbers.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-orange-50 border border-orange-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-orange-600" id="originalChars">0</div>
        <div class="text-xs text-gray-600">Original Chars</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="numbersFound">0</div>
        <div class="text-xs text-gray-600">Numbers Found</div>
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
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Remove Numbers</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Remove numeric characters from text with control over integers, decimals, negatives, percentages, and currency values.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Remove integers (whole numbers)</li>
            <li>Remove decimal numbers</li>
            <li>Remove negative numbers</li>
            <li>Remove percentages with % symbol</li>
            <li>Remove currency values ($, €, £)</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function removeNumbers() {
        const input = document.getElementById('removeNumbers-input');
        const output = document.getElementById('removeNumbers-output');
        if (!input || !output) return;
        
        let text = input.value;
        const originalLength = text.length;
        let numbersFound = 0;
        
        const removeIntegers = document.getElementById('integers')?.checked || false;
        const removeDecimals = document.getElementById('decimals')?.checked || false;
        const removeNegatives = document.getElementById('negatives')?.checked || false;
        const removePercentages = document.getElementById('percentages')?.checked || false;
        const removeCurrency = document.getElementById('currency')?.checked || false;
        const keepSpaces = document.getElementById('keepSpaces')?.checked || false;
        
        // Remove currency
        if (removeCurrency) {
            const currencyMatches = text.match(/[$€£¥]\s?[\d,]+\.?\d*/g);
            numbersFound += currencyMatches ? currencyMatches.length : 0;
            text = text.replace(/[$€£¥]\s?[\d,]+\.?\d*/g, keepSpaces ? ' ' : '');
        }
        
        // Remove percentages
        if (removePercentages) {
            const percentMatches = text.match(/\d+\.?\d*%/g);
            numbersFound += percentMatches ? percentMatches.length : 0;
            text = text.replace(/\d+\.?\d*%/g, keepSpaces ? ' ' : '');
        }
        
        // Remove decimals
        if (removeDecimals) {
            const decimalMatches = text.match(/-?\d+\.\d+/g);
            numbersFound += decimalMatches ? decimalMatches.length : 0;
            text = text.replace(/-?\d+\.\d+/g, keepSpaces ? ' ' : '');
        }
        
        // Remove negatives
        if (removeNegatives && !removeDecimals) {
            const negativeMatches = text.match(/-\d+/g);
            numbersFound += negativeMatches ? negativeMatches.length : 0;
            text = text.replace(/-\d+/g, keepSpaces ? ' ' : '');
        }
        
        // Remove integers
        if (removeIntegers) {
            const integerMatches = text.match(/\d+/g);
            numbersFound += integerMatches ? integerMatches.length : 0;
            text = text.replace(/\d+/g, keepSpaces ? ' ' : '');
        }
        
        // Clean up multiple spaces
        if (keepSpaces) {
            text = text.replace(/  +/g, ' ');
        }
        
        output.value = text;
        
        // Update stats
        const reduction = originalLength > 0 ? (((originalLength - text.length) / originalLength) * 100).toFixed(1) : 0;
        
        document.getElementById('originalChars').textContent = originalLength;
        document.getElementById('numbersFound').textContent = numbersFound;
        document.getElementById('finalChars').textContent = text.length;
        document.getElementById('reductionPercent').textContent = reduction + '%';
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setRemoveNumbersConverter(text => {
        removeNumbers();
        return document.getElementById('removeNumbers-output').value;
    });
</script>
@endpush
