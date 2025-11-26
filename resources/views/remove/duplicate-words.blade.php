@extends('layouts.tool')

@section('title', 'Remove Duplicate Words - WordFix')

@section('tool-title', 'Remove Duplicate Words')

@section('tool-description', 'Remove duplicate words from text while keeping unique words')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-amber-50 border border-amber-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-3">
        <div class="flex items-center gap-2">
            <button onclick="setKeepMode('first')" id="btn-first" class="px-3 py-2 bg-amber-600 text-white text-xs font-medium rounded hover:bg-amber-700 transition-colors flex items-center gap-1.5">
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
            <label class="flex items-center cursor-pointer bg-white border border-amber-200 rounded px-3 py-1.5">
                <input type="checkbox" id="caseSensitive" class="w-4 h-4 text-amber-600 rounded" onchange="removeDuplicateWords()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Case Sensitive</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-amber-200 rounded px-3 py-1.5">
                <input type="checkbox" id="preserveOrder" class="w-4 h-4 text-amber-600 rounded" checked onchange="removeDuplicateWords()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Preserve Word Order</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-amber-200 rounded px-3 py-1.5">
                <input type="checkbox" id="sortAlpha" class="w-4 h-4 text-amber-600 rounded" onchange="removeDuplicateWords()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Sort Alphabetically</span>
            </label>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="removeDuplicateWords"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Text with duplicate words removed will appear here..."
    downloadFileName="unique-words.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-amber-50 border border-amber-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-amber-600" id="originalWords">0</div>
        <div class="text-xs text-gray-600">Original Words</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="uniqueWords">0</div>
        <div class="text-xs text-gray-600">Unique Words</div>
    </div>
    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-red-600" id="duplicatesRemoved">0</div>
        <div class="text-xs text-gray-600">Duplicates Removed</div>
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
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Remove Duplicate Words</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Remove duplicate words from text while keeping only unique words. Perfect for cleaning word lists, removing redundancy, or text analysis.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Keep first or last occurrence of duplicate words</li>
            <li>Case-sensitive or insensitive matching</li>
            <li>Preserve original word order</li>
            <li>Optional alphabetical sorting</li>
            <li>Shows duplicate count and reduction stats</li>
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
            ? 'px-3 py-2 bg-amber-600 text-white text-xs font-medium rounded hover:bg-amber-700 transition-colors flex items-center gap-1.5'
            : 'px-3 py-2 bg-gray-200 text-gray-700 text-xs font-medium rounded hover:bg-gray-300 transition-colors flex items-center gap-1.5';
        document.getElementById('btn-last').className = mode === 'last'
            ? 'px-3 py-2 bg-amber-600 text-white text-xs font-medium rounded hover:bg-amber-700 transition-colors flex items-center gap-1.5'
            : 'px-3 py-2 bg-gray-200 text-gray-700 text-xs font-medium rounded hover:bg-gray-300 transition-colors flex items-center gap-1.5';
        removeDuplicateWords();
    }
    
    function removeDuplicateWords() {
        const input = document.getElementById('removeDuplicateWords-input');
        const output = document.getElementById('removeDuplicateWords-output');
        if (!input || !output) return;
        
        const text = input.value;
        const caseSensitive = document.getElementById('caseSensitive')?.checked || false;
        const preserveOrder = document.getElementById('preserveOrder')?.checked || false;
        const sortAlpha = document.getElementById('sortAlpha')?.checked || false;
        
        // Extract words
        const words = text.match(/\S+/g) || [];
        const originalCount = words.length;
        
        // Remove duplicates
        const seen = new Map();
        const result = [];
        
        words.forEach((word, index) => {
            const key = caseSensitive ? word : word.toLowerCase();
            
            if (keepMode === 'first') {
                if (!seen.has(key)) {
                    seen.set(key, true);
                    result.push(word);
                }
            } else {
                seen.set(key, { word, index });
            }
        });
        
        let finalResult;
        if (keepMode === 'last') {
            finalResult = Array.from(seen.values());
            if (preserveOrder) {
                finalResult.sort((a, b) => a.index - b.index);
            }
            finalResult = finalResult.map(item => item.word);
        } else {
            finalResult = result;
        }
        
        // Sort alphabetically if requested
        if (sortAlpha) {
            finalResult.sort((a, b) => {
                const strA = caseSensitive ? a : a.toLowerCase();
                const strB = caseSensitive ? b : b.toLowerCase();
                return strA.localeCompare(strB);
            });
        }
        
        output.value = finalResult.join(' ');
        
        // Update stats
        const removed = originalCount - finalResult.length;
        const reduction = originalCount > 0 ? ((removed / originalCount) * 100).toFixed(1) : 0;
        
        document.getElementById('originalWords').textContent = originalCount;
        document.getElementById('uniqueWords').textContent = finalResult.length;
        document.getElementById('duplicatesRemoved').textContent = removed;
        document.getElementById('reductionPercent').textContent = reduction + '%';
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setRemoveDuplicateWordsConverter(text => {
        removeDuplicateWords();
        return document.getElementById('removeDuplicateWords-output').value;
    });
</script>
@endpush
