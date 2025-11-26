@extends('layouts.tool')

@section('title', 'Random Number Generator - WordFix')

@section('tool-title', 'Random Number Generator')

@section('tool-description', 'Generate random numbers within a range')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-orange-50 border border-orange-200 rounded-lg p-3">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Min Value</label>
            <input type="number" id="min" value="1" class="w-full px-3 py-2 text-sm border border-orange-300 rounded focus:ring-2 focus:ring-orange-500" onchange="generateNumbers()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Max Value</label>
            <input type="number" id="max" value="100" class="w-full px-3 py-2 text-sm border border-orange-300 rounded focus:ring-2 focus:ring-orange-500" onchange="generateNumbers()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Count</label>
            <input type="number" id="count" value="10" min="1" max="1000" class="w-full px-3 py-2 text-sm border border-orange-300 rounded focus:ring-2 focus:ring-orange-500" onchange="generateNumbers()">
        </div>
    </div>
    <div class="mt-3 flex gap-4">
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="allowDuplicates" class="w-4 h-4 text-orange-600 rounded" checked onchange="generateNumbers()">
            <span class="ml-2 text-xs font-medium text-gray-700">Allow Duplicates</span>
        </label>
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="sortNumbers" class="w-4 h-4 text-orange-600 rounded" onchange="generateNumbers()">
            <span class="ml-2 text-xs font-medium text-gray-700">Sort Ascending</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="numberGenerator"
    inputPlaceholder=""
    outputPlaceholder="Generated numbers will appear here..."
    downloadFileName="random-numbers.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-orange-50 border border-orange-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-orange-600" id="generatedCount">0</div>
        <div class="text-xs text-gray-600">Numbers Generated</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="sum">0</div>
        <div class="text-xs text-gray-600">Sum</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="average">0</div>
        <div class="text-xs text-gray-600">Average</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Random Number Generator</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Generate a list of random numbers within a specified range. Useful for sampling, lotteries, or statistical simulations.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Custom Min/Max range</li>
            <li>Option to allow or prevent duplicates</li>
            <li>Sort results automatically</li>
            <li>Calculate Sum and Average of generated numbers</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function generateNumbers() {
        const output = document.getElementById('numberGenerator-output');
        if (!output) return;

        const min = parseInt(document.getElementById('min').value) || 1;
        const max = parseInt(document.getElementById('max').value) || 100;
        let count = parseInt(document.getElementById('count').value) || 10;
        const allowDuplicates = document.getElementById('allowDuplicates').checked;
        const sortNumbers = document.getElementById('sortNumbers').checked;

        if (min > max) {
            output.value = "Error: Min value cannot be greater than Max value.";
            return;
        }

        // If no duplicates allowed, max count is range size
        if (!allowDuplicates) {
            const rangeSize = max - min + 1;
            if (count > rangeSize) {
                count = rangeSize;
                document.getElementById('count').value = count;
            }
        }

        let numbers = [];
        
        if (allowDuplicates) {
            for (let i = 0; i < count; i++) {
                numbers.push(Math.floor(Math.random() * (max - min + 1)) + min);
            }
        } else {
            // Unique numbers
            // If range is small, generate all and shuffle
            const rangeSize = max - min + 1;
            if (rangeSize < count * 3) { // Heuristic: if range is small relative to count
                let pool = [];
                for (let i = min; i <= max; i++) pool.push(i);
                
                // Fisher-Yates shuffle
                for (let i = pool.length - 1; i > 0; i--) {
                    const j = Math.floor(Math.random() * (i + 1));
                    [pool[i], pool[j]] = [pool[j], pool[i]];
                }
                numbers = pool.slice(0, count);
            } else {
                // If range is large, use Set to track uniqueness
                let set = new Set();
                while (set.size < count) {
                    set.add(Math.floor(Math.random() * (max - min + 1)) + min);
                }
                numbers = Array.from(set);
            }
        }

        if (sortNumbers) {
            numbers.sort((a, b) => a - b);
        }

        output.value = numbers.join('\n');
        
        // Update stats
        const sum = numbers.reduce((a, b) => a + b, 0);
        const avg = numbers.length > 0 ? (sum / numbers.length).toFixed(2) : 0;
        
        document.getElementById('generatedCount').textContent = numbers.length;
        document.getElementById('sum').textContent = sum;
        document.getElementById('average').textContent = avg;
        document.getElementById('statsSection').classList.remove('hidden');
        
        // Trigger input update for stats
        const input = document.getElementById('numberGenerator-input');
        if (input) {
            input.value = output.value;
            input.dispatchEvent(new Event('input'));
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', generateNumbers);
    
    // Override converter
    setNumberGeneratorConverter(text => text);
</script>

<style>
    /* Hide input area for generator */
    #numberGenerator-input {
        display: none;
    }
    /* Make output full width */
    .text-converter-wrapper .grid {
        display: block;
    }
    .text-converter-wrapper .grid > div:first-child {
        display: none;
    }
</style>
@endpush
