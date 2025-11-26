@extends('layouts.tool')

@section('title', 'Number Sort - WordFix')

@section('tool-title', 'Number Sort')

@section('tool-description', 'Sort numbers numerically - ascending or descending with natural sort')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-yellow-50 border border-yellow-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-3">
        <div class="flex items-center gap-2">
            <button onclick="setSortOrder('asc')" id="btn-asc" class="px-3 py-2 bg-yellow-600 text-white text-xs font-medium rounded hover:bg-yellow-700 transition-colors flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"></path>
                </svg>
                <span class="hidden sm:inline">1 → 9</span>
            </button>
            <button onclick="setSortOrder('desc')" id="btn-desc" class="px-3 py-2 bg-gray-200 text-gray-700 text-xs font-medium rounded hover:bg-gray-300 transition-colors flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"></path>
                </svg>
                <span class="hidden sm:inline">9 → 1</span>
            </button>
        </div>
        
        <div class="flex flex-wrap gap-2">
            <label class="flex items-center cursor-pointer bg-white border border-yellow-200 rounded px-3 py-1.5">
                <input type="checkbox" id="removeDuplicates" class="w-4 h-4 text-yellow-600 rounded" onchange="sortNumbers()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Remove Duplicates</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-yellow-200 rounded px-3 py-1.5">
                <input type="checkbox" id="naturalSort" class="w-4 h-4 text-yellow-600 rounded" checked onchange="sortNumbers()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Natural Sort</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-yellow-200 rounded px-3 py-1.5">
                <input type="checkbox" id="ignoreText" class="w-4 h-4 text-yellow-600 rounded" onchange="sortNumbers()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Ignore Non-Numbers</span>
            </label>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="numberSort"
    inputPlaceholder="Paste your numbers here (one per line)... e.g., 100, 20, 3"
    outputPlaceholder="Sorted numbers will appear here..."
    downloadFileName="sorted-numbers.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-yellow-600" id="totalNumbers">0</div>
        <div class="text-xs text-gray-600">Total Numbers</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="minNumber">0</div>
        <div class="text-xs text-gray-600">Minimum</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="maxNumber">0</div>
        <div class="text-xs text-gray-600">Maximum</div>
    </div>
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-purple-600" id="sumNumber">0</div>
        <div class="text-xs text-gray-600">Sum</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Number Sort</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Sort numbers numerically (not alphabetically) with support for natural sorting, decimals, and negative numbers.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>True numerical sort (100 comes after 20, not before)</li>
            <li>Natural sort handles text+numbers (file1, file10, file2)</li>
            <li>Support for decimals and negative numbers</li>
            <li>Calculate min, max, and sum</li>
            <li>Option to ignore non-numeric lines</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Examples</h3>
        <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm space-y-1">
            <div><strong>Input:</strong> 100, 20, 3</div>
            <div><strong>Alphabetical (wrong):</strong> 100, 20, 3</div>
            <div><strong>Numerical (correct):</strong> 3, 20, 100</div>
        </div>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let sortOrder = 'asc';
    
    function setSortOrder(order) {
        sortOrder = order;
        document.getElementById('btn-asc').className = order === 'asc'
            ? 'px-3 py-2 bg-yellow-600 text-white text-xs font-medium rounded hover:bg-yellow-700 transition-colors flex items-center gap-1.5'
            : 'px-3 py-2 bg-gray-200 text-gray-700 text-xs font-medium rounded hover:bg-gray-300 transition-colors flex items-center gap-1.5';
        document.getElementById('btn-desc').className = order === 'desc'
            ? 'px-3 py-2 bg-yellow-600 text-white text-xs font-medium rounded hover:bg-yellow-700 transition-colors flex items-center gap-1.5'
            : 'px-3 py-2 bg-gray-200 text-gray-700 text-xs font-medium rounded hover:bg-gray-300 transition-colors flex items-center gap-1.5';
        sortNumbers();
    }
    
    function sortNumbers() {
        const input = document.getElementById('numberSort-input');
        const output = document.getElementById('numberSort-output');
        if (!input || !output) return;
        
        const text = input.value;
        const removeDuplicates = document.getElementById('removeDuplicates')?.checked || false;
        const naturalSort = document.getElementById('naturalSort')?.checked || false;
        const ignoreText = document.getElementById('ignoreText')?.checked || false;
        
        let lines = text.split('\n').filter(line => line.trim().length > 0);
        
        // Filter only lines with numbers if ignoreText is enabled
        if (ignoreText) {
            lines = lines.filter(line => /\d/.test(line));
        }
        
        // Sort
        if (naturalSort) {
            // Natural sort - handles mixed text and numbers like "file1", "file10", "file2"
            lines.sort((a, b) => {
                return sortOrder === 'asc' 
                    ? a.localeCompare(b, undefined, { numeric: true, sensitivity: 'base' })
                    : b.localeCompare(a, undefined, { numeric: true, sensitivity: 'base' });
            });
        } else {
            // Pure number sort
            lines.sort((a, b) => {
                const numA = parseFloat(a);
                const numB = parseFloat(b);
                return sortOrder === 'asc' ? numA - numB : numB - numA;
            });
        }
        
        // Remove duplicates
        if (removeDuplicates) {
            lines = [...new Set(lines)];
        }
        
        output.value = lines.join('\n');
        
        // Calculate stats
        const numbers = lines.map(line => parseFloat(line)).filter(n => !isNaN(n));
        const min = numbers.length > 0 ? Math.min(...numbers) : 0;
        const max = numbers.length > 0 ? Math.max(...numbers) : 0;
        const sum = numbers.reduce((total, num) => total + num, 0);
        
        document.getElementById('totalNumbers').textContent = lines.length;
        document.getElementById('minNumber').textContent = min;
        document.getElementById('maxNumber').textContent = max;
        document.getElementById('sumNumber').textContent = sum.toFixed(2);
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setNumberSortConverter(text => {
        sortNumbers();
        return document.getElementById('numberSort-output').value;
    });
</script>
@endpush
