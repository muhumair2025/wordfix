@extends('layouts.tool')

@section('title', 'Number Extractor - WordFix')

@section('tool-title', 'Number Extractor')

@section('tool-description', 'Extract all numbers from text - integers, decimals, percentages, and more')

@section('tool-content')
<!-- Configuration Options -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Extraction Options</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        <label class="flex items-center cursor-pointer bg-blue-50 border border-blue-200 rounded-lg p-3">
            <input type="checkbox" id="extractIntegers" class="w-4 h-4 text-blue-600 rounded" checked onchange="extractNumbers()">
            <span class="ml-2 text-sm font-medium">Integers</span>
        </label>
        <label class="flex items-center cursor-pointer bg-green-50 border border-green-200 rounded-lg p-3">
            <input type="checkbox" id="extractDecimals" class="w-4 h-4 text-green-600 rounded" checked onchange="extractNumbers()">
            <span class="ml-2 text-sm font-medium">Decimals</span>
        </label>
        <label class="flex items-center cursor-pointer bg-purple-50 border border-purple-200 rounded-lg p-3">
            <input type="checkbox" id="extractNegatives" class="w-4 h-4 text-purple-600 rounded" checked onchange="extractNumbers()">
            <span class="ml-2 text-sm font-medium">Negatives</span>
        </label>
        <label class="flex items-center cursor-pointer bg-yellow-50 border border-yellow-200 rounded-lg p-3">
            <input type="checkbox" id="extractPercentages" class="w-4 h-4 text-yellow-600 rounded" checked onchange="extractNumbers()">
            <span class="ml-2 text-sm font-medium">Percentages</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="numberExtractor"
    inputPlaceholder="Paste text containing numbers... e.g., The price is $123.45 with 15% discount"
    outputPlaceholder="Extracted numbers will appear here..."
    downloadFileName="extracted-numbers.txt"
    :showStats="true"
/>

<!-- Stats Section -->
<div id="statsSection" class="hidden mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-blue-600" id="totalCount">0</div>
        <div class="text-xs text-gray-600">Total Numbers</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-green-600" id="uniqueCount">0</div>
        <div class="text-xs text-gray-600">Unique</div>
    </div>
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-purple-600" id="avgValue">0</div>
        <div class="text-xs text-gray-600">Average</div>
    </div>
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-yellow-600" id="sumValue">0</div>
        <div class="text-xs text-gray-600">Sum</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Number Extractor</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Extract all numbers from text including integers, decimals, negatives, and percentages. Perfect for data analysis and processing.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Extract integers, decimals, and negative numbers</li>
            <li>Detect percentages automatically</li>
            <li>Calculate sum and average</li>
            <li>Show unique count and statistics</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Uses</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Data Analysis:</strong> Extract numbers from reports</li>
            <li><strong>Finance:</strong> Parse invoices and receipts</li>
            <li><strong>Research:</strong> Gather statistics from documents</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function extractNumbers() {
        const input = document.getElementById('numberExtractor-input');
        const output = document.getElementById('numberExtractor-output');
        if (!input || !output) return;
        
        const text = input.value;
        const extractIntegers = document.getElementById('extractIntegers')?.checked ?? true;
        const extractDecimals = document.getElementById('extractDecimals')?.checked ?? true;
        const extractNegatives = document.getElementById('extractNegatives')?.checked ?? true;
        const extractPercentages = document.getElementById('extractPercentages')?.checked ?? true;
        
        let numbers = [];
        
        if (extractPercentages) {
            const percentages = text.match(/-?\d+\.?\d*%/g) || [];
            numbers.push(...percentages);
        }
        
        if (extractDecimals) {
            const decimals = text.match(/-?\d+\.\d+/g) || [];
            numbers.push(...decimals.filter(n => !n.includes('%')));
        }
        
        if (extractIntegers) {
            const integers = text.match(/\b\d+\b/g) || [];
            numbers.push(...integers);
        }
        
        if (extractNegatives) {
            const negatives = text.match(/-\d+/g) || [];
            numbers.push(...negatives);
        }
        
        // Remove duplicates and display
        const unique = [...new Set(numbers)];
        output.value = unique.join('\n');
        
        // Calculate statistics
        const numericValues = unique.map(n => parseFloat(n.replace('%', ''))).filter(n => !isNaN(n));
        const sum = numericValues.reduce((a, b) => a + b, 0);
        const avg = numericValues.length > 0 ? sum / numericValues.length : 0;
        
        document.getElementById('totalCount').textContent = numbers.length;
        document.getElementById('uniqueCount').textContent = unique.length;
        document.getElementById('avgValue').textContent = avg.toFixed(2);
        document.getElementById('sumValue').textContent = sum.toFixed(2);
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setNumberExtractorConverter(text => {
        extractNumbers();
        return document.getElementById('numberExtractor-output').value;
    });
</script>
@endpush
