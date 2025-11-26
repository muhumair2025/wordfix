@extends('layouts.tool')

@section('title', 'Random Sort - WordFix')

@section('tool-title', 'Random Sort')

@section('tool-description', 'Shuffle and randomize line order - perfect for randomization tasks')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-purple-50 border border-purple-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-3">
        <button onclick="shuffleLines()" class="px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded hover:bg-purple-700 transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            Shuffle Lines
        </button>
        
        <div class="flex flex-wrap gap-2">
            <label class="flex items-center cursor-pointer bg-white border border-purple-200 rounded px-3 py-1.5">
                <input type="checkbox" id="removeDuplicates" class="w-4 h-4 text-purple-600 rounded" onchange="shuffleLines()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Remove Duplicates</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-purple-200 rounded px-3 py-1.5">
                <input type="checkbox" id="removeEmpty" class="w-4 h-4 text-purple-600 rounded" checked onchange="shuffleLines()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Skip Empty Lines</span>
            </label>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="randomSort"
    inputPlaceholder="Paste your lines here (one per line)..."
    outputPlaceholder="Shuffled lines will appear here..."
    downloadFileName="shuffled-lines.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-3 gap-3">
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-purple-600" id="totalLines">0</div>
        <div class="text-xs text-gray-600">Shuffled Lines</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="uniqueLines">0</div>
        <div class="text-xs text-gray-600">Unique</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="shuffleCount">0</div>
        <div class="text-xs text-gray-600">Times Shuffled</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Random Sort</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Randomly shuffle lines using cryptographically secure randomization. Perfect for randomizing lists, creating random samples, or mixing content.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>True random shuffle using Fisher-Yates algorithm</li>
            <li>Click to shuffle multiple times</li>
            <li>Remove duplicates before shuffling</li>
            <li>Skip empty lines automatically</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Use Cases</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Randomize quiz questions</li>
            <li>Shuffle playlist items</li>
            <li>Create random samples</li>
            <li>Mix content order</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let shuffleCounter = 0;
    
    function shuffleLines() {
        const input = document.getElementById('randomSort-input');
        const output = document.getElementById('randomSort-output');
        if (!input || !output) return;
        
        const text = input.value;
        const removeDuplicates = document.getElementById('removeDuplicates')?.checked || false;
        const removeEmpty = document.getElementById('removeEmpty')?.checked || false;
        
        let lines = text.split('\n');
        
        if (removeEmpty) {
            lines = lines.filter(line => line.trim().length > 0);
        }
        
        if (removeDuplicates) {
            lines = [...new Set(lines)];
        }
        
        // Fisher-Yates shuffle algorithm
        for (let i = lines.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [lines[i], lines[j]] = [lines[j], lines[i]];
        }
        
        output.value = lines.join('\n');
        shuffleCounter++;
        
        // Update stats
        const unique = [...new Set(lines)];
        document.getElementById('totalLines').textContent = lines.length;
        document.getElementById('uniqueLines').textContent = unique.length;
        document.getElementById('shuffleCount').textContent = shuffleCounter;
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setRandomSortConverter(text => {
        // Don't auto-shuffle on input, only on button click
        return document.getElementById('randomSort-output').value;
    });
</script>
@endpush
