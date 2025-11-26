@extends('layouts.tool')

@section('title', 'Alphabetical Sort - WordFix')

@section('tool-title', 'Alphabetical Sort')

@section('tool-description', 'Sort lines alphabetically with advanced options - A-Z or Z-A')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-blue-50 border border-blue-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-3">
        <div class="flex items-center gap-2">
            <button onclick="setSortOrder('asc')" id="btn-asc" class="px-3 py-2 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"></path>
                </svg>
                <span class="hidden sm:inline">A → Z</span>
            </button>
            <button onclick="setSortOrder('desc')" id="btn-desc" class="px-3 py-2 bg-gray-200 text-gray-700 text-xs font-medium rounded hover:bg-gray-300 transition-colors flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h9m5-4v12m0 0l-4-4m4 4l4-4"></path>
                </svg>
                <span class="hidden sm:inline">Z → A</span>
            </button>
        </div>
        
        <div class="flex flex-wrap gap-2">
            <label class="flex items-center cursor-pointer bg-white border border-blue-200 rounded px-3 py-1.5">
                <input type="checkbox" id="caseSensitive" class="w-4 h-4 text-blue-600 rounded" onchange="sortLines()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Case Sensitive</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-blue-200 rounded px-3 py-1.5">
                <input type="checkbox" id="removeDuplicates" class="w-4 h-4 text-blue-600 rounded" onchange="sortLines()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Remove Duplicates</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-blue-200 rounded px-3 py-1.5">
                <input type="checkbox" id="trimLines" class="w-4 h-4 text-blue-600 rounded" checked onchange="sortLines()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Trim Whitespace</span>
            </label>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="alphabeticalSort"
    inputPlaceholder="Paste your lines here (one per line)..."
    outputPlaceholder="Sorted lines will appear here..."
    downloadFileName="sorted-alphabetically.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-3 gap-3">
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="totalLines">0</div>
        <div class="text-xs text-gray-600">Total Lines</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="uniqueLines">0</div>
        <div class="text-xs text-gray-600">Unique</div>
    </div>
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-purple-600" id="removedDuplicates">0</div>
        <div class="text-xs text-gray-600">Duplicates Removed</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Alphabetical Sort</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Sort lines alphabetically with advanced options for case sensitivity, duplicate removal, and whitespace handling.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Sort A-Z (ascending) or Z-A (descending)</li>
            <li>Case sensitive or insensitive sorting</li>
            <li>Remove duplicate lines automatically</li>
            <li>Trim whitespace from lines</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let sortOrder = 'asc';
    
    function setSortOrder(order) {
        sortOrder = order;
        document.getElementById('btn-asc').className = order === 'asc'
            ? 'px-3 py-2 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors flex items-center gap-1.5'
            : 'px-3 py-2 bg-gray-200 text-gray-700 text-xs font-medium rounded hover:bg-gray-300 transition-colors flex items-center gap-1.5';
        document.getElementById('btn-desc').className = order === 'desc'
            ? 'px-3 py-2 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors flex items-center gap-1.5'
            : 'px-3 py-2 bg-gray-200 text-gray-700 text-xs font-medium rounded hover:bg-gray-300 transition-colors flex items-center gap-1.5';
        sortLines();
    }
    
    function sortLines() {
        const input = document.getElementById('alphabeticalSort-input');
        const output = document.getElementById('alphabeticalSort-output');
        if (!input || !output) return;
        
        const text = input.value;
        const caseSensitive = document.getElementById('caseSensitive')?.checked || false;
        const removeDuplicates = document.getElementById('removeDuplicates')?.checked || false;
        const trimLines = document.getElementById('trimLines')?.checked || false;
        
        let lines = text.split('\n').filter(line => line.trim().length > 0);
        const originalCount = lines.length;
        
        if (trimLines) {
            lines = lines.map(line => line.trim());
        }
        
        // Sort
        lines.sort((a, b) => {
            const strA = caseSensitive ? a : a.toLowerCase();
            const strB = caseSensitive ? b : b.toLowerCase();
            return sortOrder === 'asc' ? strA.localeCompare(strB) : strB.localeCompare(strA);
        });
        
        // Remove duplicates
        if (removeDuplicates) {
            lines = [...new Set(lines)];
        }
        
        output.value = lines.join('\n');
        
        // Update stats
        document.getElementById('totalLines').textContent = originalCount;
        document.getElementById('uniqueLines').textContent = lines.length;
        document.getElementById('removedDuplicates').textContent = originalCount - lines.length;
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setAlphabeticalSortConverter(text => {
        sortLines();
        return document.getElementById('alphabeticalSort-output').value;
    });
</script>
@endpush
