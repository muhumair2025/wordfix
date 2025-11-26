@extends('layouts.tool')

@section('title', 'Remove Duplicate Lines - WordFix')

@section('tool-title', 'Remove Duplicate Lines')

@section('tool-description', 'Remove duplicate lines with advanced options - keep first or last occurrence')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-blue-50 border border-blue-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-3">
        <div class="flex items-center gap-2">
            <button onclick="setKeepMode('first')" id="btn-first" class="px-3 py-2 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                </svg>
                <span class="hidden sm:inline">Keep First</span>
            </button>
            <button onclick="setKeepMode('last')" id="btn-last" class="px-3 py-2 bg-gray-200 text-gray-700 text-xs font-medium rounded hover:bg-gray-300 transition-colors flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 10H11a8 8 0 00-8 8v2m18-10l-6 6m6-6l-6-6"></path>
                </svg>
                <span class="hidden sm:inline">Keep Last</span>
            </button>
        </div>
        
        <div class="flex flex-wrap gap-2">
            <label class="flex items-center cursor-pointer bg-white border border-blue-200 rounded px-3 py-1.5">
                <input type="checkbox" id="caseSensitive" class="w-4 h-4 text-blue-600 rounded" onchange="removeDuplicates()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Case Sensitive</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-blue-200 rounded px-3 py-1.5">
                <input type="checkbox" id="trimLines" class="w-4 h-4 text-blue-600 rounded" checked onchange="removeDuplicates()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Trim Whitespace</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-blue-200 rounded px-3 py-1.5">
                <input type="checkbox" id="ignoreEmpty" class="w-4 h-4 text-blue-600 rounded" checked onchange="removeDuplicates()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Ignore Empty</span>
            </label>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="removeDuplicateLines"
    inputPlaceholder="Paste your text here (one line per entry)..."
    outputPlaceholder="Lines with duplicates removed will appear here..."
    downloadFileName="no-duplicates.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="originalCount">0</div>
        <div class="text-xs text-gray-600">Original Lines</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="uniqueCount">0</div>
        <div class="text-xs text-gray-600">Unique Lines</div>
    </div>
    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-red-600" id="removedCount">0</div>
        <div class="text-xs text-gray-600">Removed</div>
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
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Remove Duplicate Lines</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Remove duplicate lines while keeping either the first or last occurrence. Perfect for cleaning lists, deduplicating data, and text processing.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Keep first or last occurrence of duplicates</li>
            <li>Case-sensitive or insensitive comparison</li>
            <li>Automatic whitespace trimming</li>
            <li>Option to ignore empty lines</li>
            <li>Shows reduction statistics</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let keepMode = 'first';
    
    function setKeepMode(mode) {
        keepMode = mode;
        document.getElementById('btn-first').className = mode === 'first'
            ? 'px-3 py-2 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors flex items-center gap-1.5'
            : 'px-3 py-2 bg-gray-200 text-gray-700 text-xs font-medium rounded hover:bg-gray-300 transition-colors flex items-center gap-1.5';
        document.getElementById('btn-last').className = mode === 'last'
            ? 'px-3 py-2 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors flex items-center gap-1.5'
            : 'px-3 py-2 bg-gray-200 text-gray-700 text-xs font-medium rounded hover:bg-gray-300 transition-colors flex items-center gap-1.5';
        removeDuplicates();
    }
    
    function removeDuplicates() {
        const input = document.getElementById('removeDuplicateLines-input');
        const output = document.getElementById('removeDuplicateLines-output');
        if (!input || !output) return;
        
        const text = input.value;
        const caseSensitive = document.getElementById('caseSensitive')?.checked || false;
        const trimLines = document.getElementById('trimLines')?.checked || false;
        const ignoreEmpty = document.getElementById('ignoreEmpty')?.checked || false;
        
        let lines = text.split('\n');
        const originalCount = lines.length;
        
        if (trimLines) {
            lines = lines.map(line => line.trim());
        }
        
        if (ignoreEmpty) {
            lines = lines.filter(line => line.length > 0);
        }
        
        // Remove duplicates keeping first or last
        const seen = new Map();
        const result = [];
        
        lines.forEach((line, index) => {
            const key = caseSensitive ? line : line.toLowerCase();
            
            if (keepMode === 'first') {
                if (!seen.has(key)) {
                    seen.set(key, true);
                    result.push(line);
                }
            } else {
                seen.set(key, { line, index });
            }
        });
        
        let finalResult;
        if (keepMode === 'last') {
            finalResult = Array.from(seen.values())
                .sort((a, b) => a.index - b.index)
                .map(item => item.line);
        } else {
            finalResult = result;
        }
        
        output.value = finalResult.join('\n');
        
        // Update stats
        const removed = originalCount - finalResult.length;
        const reduction = originalCount > 0 ? ((removed / originalCount) * 100).toFixed(1) : 0;
        
        document.getElementById('originalCount').textContent = originalCount;
        document.getElementById('uniqueCount').textContent = finalResult.length;
        document.getElementById('removedCount').textContent = removed;
        document.getElementById('reductionPercent').textContent = reduction + '%';
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setRemoveDuplicateLinesConverter(text => {
        removeDuplicates();
        return document.getElementById('removeDuplicateLines-output').value;
    });
</script>
@endpush
