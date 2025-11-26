@extends('layouts.tool')

@section('title', 'Sort by Length - WordFix')

@section('tool-title', 'Sort by Length')

@section('tool-description', 'Sort lines by their character length - shortest to longest or vice versa')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-green-50 border border-green-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-3">
        <div class="flex items-center gap-2">
            <button onclick="setSortOrder('shortest')" id="btn-shortest" class="px-3 py-2 bg-green-600 text-white text-xs font-medium rounded hover:bg-green-700 transition-colors flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h12M4 18h8"></path>
                </svg>
                <span class="hidden sm:inline">Shortest First</span>
            </button>
            <button onclick="setSortOrder('longest')" id="btn-longest" class="px-3 py-2 bg-gray-200 text-gray-700 text-xs font-medium rounded hover:bg-gray-300 transition-colors flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <span class="hidden sm:inline">Longest First</span>
            </button>
        </div>
        
        <div class="flex flex-wrap gap-2">
            <label class="flex items-center cursor-pointer bg-white border border-green-200 rounded px-3 py-1.5">
                <input type="checkbox" id="removeDuplicates" class="w-4 h-4 text-green-600 rounded" onchange="sortByLength()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Remove Duplicates</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-green-200 rounded px-3 py-1.5">
                <input type="checkbox" id="countSpaces" class="w-4 h-4 text-green-600 rounded" checked onchange="sortByLength()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Count Spaces</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-green-200 rounded px-3 py-1.5">
                <input type="checkbox" id="trimLines" class="w-4 h-4 text-green-600 rounded" checked onchange="sortByLength()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Trim Lines</span>
            </label>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="lengthSort"
    inputPlaceholder="Paste your lines here (one per line)..."
    outputPlaceholder="Sorted lines will appear here..."
    downloadFileName="sorted-by-length.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="totalLines">0</div>
        <div class="text-xs text-gray-600">Total Lines</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="shortestLength">0</div>
        <div class="text-xs text-gray-600">Shortest</div>
    </div>
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-purple-600" id="longestLength">0</div>
        <div class="text-xs text-gray-600">Longest</div>
    </div>
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-yellow-600" id="avgLength">0</div>
        <div class="text-xs text-gray-600">Average</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Sort by Length</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Sort lines by their character length with options for handling spaces, duplicates, and whitespace.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Sort shortest to longest or longest to shortest</li>
            <li>Include or exclude spaces in length calculation</li>
            <li>Remove duplicate lines</li>
            <li>View length statistics</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let sortOrder = 'shortest';
    
    function setSortOrder(order) {
        sortOrder = order;
        document.getElementById('btn-shortest').className = order === 'shortest'
            ? 'px-3 py-2 bg-green-600 text-white text-xs font-medium rounded hover:bg-green-700 transition-colors flex items-center gap-1.5'
            : 'px-3 py-2 bg-gray-200 text-gray-700 text-xs font-medium rounded hover:bg-gray-300 transition-colors flex items-center gap-1.5';
        document.getElementById('btn-longest').className = order === 'longest'
            ? 'px-3 py-2 bg-green-600 text-white text-xs font-medium rounded hover:bg-green-700 transition-colors flex items-center gap-1.5'
            : 'px-3 py-2 bg-gray-200 text-gray-700 text-xs font-medium rounded hover:bg-gray-300 transition-colors flex items-center gap-1.5';
        sortByLength();
    }
    
    function sortByLength() {
        const input = document.getElementById('lengthSort-input');
        const output = document.getElementById('lengthSort-output');
        if (!input || !output) return;
        
        const text = input.value;
        const removeDuplicates = document.getElementById('removeDuplicates')?.checked || false;
        const countSpaces = document.getElementById('countSpaces')?.checked || false;
        const trimLines = document.getElementById('trimLines')?.checked || false;
        
        let lines = text.split('\n').filter(line => line.trim().length > 0);
        
        if (trimLines) {
            lines = lines.map(line => line.trim());
        }
        
        if (removeDuplicates) {
            lines = [...new Set(lines)];
        }
        
        // Sort by length
        lines.sort((a, b) => {
            const lenA = countSpaces ? a.length : a.replace(/\s/g, '').length;
            const lenB = countSpaces ? b.length : b.replace(/\s/g, '').length;
            return sortOrder === 'shortest' ? lenA - lenB : lenB - lenA;
        });
        
        output.value = lines.join('\n');
        
        // Calculate stats
        const lengths = lines.map(line => countSpaces ? line.length : line.replace(/\s/g, '').length);
        const shortest = lengths.length > 0 ? Math.min(...lengths) : 0;
        const longest = lengths.length > 0 ? Math.max(...lengths) : 0;
        const avg = lengths.length > 0 ? (lengths.reduce((sum, len) => sum + len, 0) / lengths.length).toFixed(1) : 0;
        
        document.getElementById('totalLines').textContent = lines.length;
        document.getElementById('shortestLength').textContent = shortest;
        document.getElementById('longestLength').textContent = longest;
        document.getElementById('avgLength').textContent = avg;
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setLengthSortConverter(text => {
        sortByLength();
        return document.getElementById('lengthSort-output').value;
    });
</script>
@endpush
