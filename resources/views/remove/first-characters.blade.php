@extends('layouts.tool')

@section('title', 'Remove First Characters - WordFix')

@section('tool-title', 'Remove First Characters')

@section('tool-description', 'Remove first N characters from each line or entire text')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-sky-50 border border-sky-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-3">
        <div class="flex-1 min-w-[150px]">
            <label class="block text-xs font-medium text-gray-700 mb-1">Characters to Remove</label>
            <input type="number" id="charCount" value="1" min="0" max="1000"
                class="w-full px-3 py-2 text-sm border border-sky-300 rounded focus:ring-2 focus:ring-sky-500"
                oninput="removeFirstChars()">
        </div>
        
        <div class="flex flex-wrap gap-2">
            <label class="flex items-center cursor-pointer bg-white border border-sky-200 rounded px-3 py-1.5">
                <input type="checkbox" id="perLine" class="w-4 h-4 text-sky-600 rounded" checked onchange="removeFirstChars()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Per Line</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-sky-200 rounded px-3 py-1.5">
                <input type="checkbox" id="skipEmpty" class="w-4 h-4 text-sky-600 rounded" onchange="removeFirstChars()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Skip Empty Lines</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-sky-200 rounded px-3 py-1.5">
                <input type="checkbox" id="trimAfter" class="w-4 h-4 text-sky-600 rounded" onchange="removeFirstChars()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Trim After</span>
            </label>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="removeFirstChars"
    inputPlaceholder="Paste your text here (one line per entry)..."
    outputPlaceholder="Text with first characters removed will appear here..."
    downloadFileName="trimmed-text.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-sky-50 border border-sky-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-sky-600" id="originalChars">0</div>
        <div class="text-xs text-gray-600">Original Chars</div>
    </div>
    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-red-600" id="charsRemoved">0</div>
        <div class="text-xs text-gray-600">Chars Removed</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="finalChars">0</div>
        <div class="text-xs text-gray-600">Final Chars</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="linesProcessed">0</div>
        <div class="text-xs text-gray-600">Lines Processed</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Remove First Characters</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Remove a specified number of characters from the beginning of each line or the entire text. Perfect for cleaning data, removing prefixes, or text formatting.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Specify number of characters to remove</li>
            <li>Apply per line or to entire text</li>
            <li>Skip empty lines option</li>
            <li>Trim whitespace after removal</li>
            <li>Shows removal statistics</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function removeFirstChars() {
        const input = document.getElementById('removeFirstChars-input');
        const output = document.getElementById('removeFirstChars-output');
        if (!input || !output) return;
        
        const text = input.value;
        const charCount = parseInt(document.getElementById('charCount')?.value || 0);
        const perLine = document.getElementById('perLine')?.checked || false;
        const skipEmpty = document.getElementById('skipEmpty')?.checked || false;
        const trimAfter = document.getElementById('trimAfter')?.checked || false;
        
        let result;
        let charsRemoved = 0;
        let linesProcessed = 0;
        
        if (perLine) {
            const lines = text.split('\n');
            result = lines.map(line => {
                if (skipEmpty && line.trim().length === 0) {
                    return line;
                }
                
                linesProcessed++;
                const removed = line.substring(0, charCount);
                charsRemoved += removed.length;
                let processed = line.substring(charCount);
                
                if (trimAfter) {
                    processed = processed.trim();
                }
                
                return processed;
            }).join('\n');
        } else {
            charsRemoved = Math.min(charCount, text.length);
            result = text.substring(charCount);
            
            if (trimAfter) {
                result = result.trim();
            }
            
            linesProcessed = 1;
        }
        
        output.value = result;
        
        // Update stats
        document.getElementById('originalChars').textContent = text.length;
        document.getElementById('charsRemoved').textContent = charsRemoved;
        document.getElementById('finalChars').textContent = result.length;
        document.getElementById('linesProcessed').textContent = linesProcessed;
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setRemoveFirstCharsConverter(text => {
        removeFirstChars();
        return document.getElementById('removeFirstChars-output').value;
    });
</script>
@endpush
