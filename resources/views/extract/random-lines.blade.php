@extends('layouts.tool')

@section('title', 'Random Line Selector - WordFix')

@section('tool-title', 'Random Line Selector')

@section('tool-description', 'Extract random lines from text - perfect for sampling, testing, or randomization')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4">
    <div class="flex flex-wrap items-end gap-3">
        <div class="flex-1 min-w-[150px]">
            <label class="block text-xs font-medium text-gray-700 mb-1">Number of Lines</label>
            <input type="number" id="lineCount" value="5" min="1" max="1000"
                class="w-full px-3 py-2 text-sm border border-blue-300 rounded focus:ring-2 focus:ring-blue-500">
        </div>
        
        <label class="flex items-center cursor-pointer bg-white border border-blue-200 rounded px-3 py-2">
            <input type="checkbox" id="allowDuplicates" class="w-4 h-4 text-blue-600 rounded">
            <span class="ml-2 text-sm font-medium whitespace-nowrap">Allow Duplicates</span>
        </label>
        
        <button onclick="extractRandomLines()" 
            class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
            </svg>
            Generate Random
        </button>
    </div>
</div>

<x-text-converter 
    toolId="randomLines"
    inputPlaceholder="Paste your text here (one item per line)..."
    outputPlaceholder="Random lines will appear here..."
    downloadFileName="random-lines.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-6 grid grid-cols-3 gap-4">
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-blue-600" id="totalInput">0</div>
        <div class="text-xs text-gray-600">Input Lines</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-green-600" id="selectedCount">0</div>
        <div class="text-xs text-gray-600">Selected</div>
    </div>
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-purple-600" id="percentSelected">0</div>
        <div class="text-xs text-gray-600">Percentage</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Random Line Selector</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Randomly select lines from your text. Perfect for sampling data, creating test sets, or random selection tasks.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Select any number of random lines</li>
            <li>Option to allow or prevent duplicates</li>
            <li>Preserves original line content</li>
            <li>Shows selection statistics</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Uses</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Testing:</strong> Create random test data sets</li>
            <li><strong>Sampling:</strong> Select random survey responses</li>
            <li><strong>Contests:</strong> Pick random winners</li>
            <li><strong>QA:</strong> Random quality checks</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function extractRandomLines() {
        const input = document.getElementById('randomLines-input');
        const output = document.getElementById('randomLines-output');
        if (!input || !output) return;
        
        const text = input.value;
        const lines = text.split('\n').filter(line => line.trim().length > 0);
        const count = parseInt(document.getElementById('lineCount')?.value || 5);
        const allowDuplicates = document.getElementById('allowDuplicates')?.checked ?? false;
        
        if (lines.length === 0) {
            output.value = '';
            document.getElementById('statsSection').classList.add('hidden');
            return;
        }
        
        let selected = [];
        if (allowDuplicates) {
            // With duplicates: just pick random lines
            for (let i = 0; i < count; i++) {
                const randomIndex = Math.floor(Math.random() * lines.length);
                selected.push(lines[randomIndex]);
            }
        } else {
            // Without duplicates: shuffle and take first N
            const shuffled = [...lines].sort(() => 0.5 - Math.random());
            selected = shuffled.slice(0, Math.min(count, lines.length));
        }
        
        output.value = selected.join('\n');
        
        // Update stats
        const percent = lines.length > 0 ? (selected.length / lines.length * 100).toFixed(1) : 0;
        document.getElementById('totalInput').textContent = lines.length;
        document.getElementById('selectedCount').textContent = selected.length;
        document.getElementById('percentSelected').textContent = percent + '%';
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    // Set converter to trigger on input change as well
    setRandomLinesConverter(text => {
        // Don't auto-generate on every input change, just update input stats
        const lines = text.split('\n').filter(line => line.trim().length > 0);
        if (lines.length > 0) {
            document.getElementById('totalInput').textContent = lines.length;
        }
        return document.getElementById('randomLines-output').value;
    });
</script>
@endpush
