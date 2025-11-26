@extends('layouts.tool')

@section('title', 'Remove Lines With Word - WordFix')

@section('tool-title', 'Remove Lines With Word')

@section('tool-description', 'Remove lines containing specific words or phrases')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-red-50 border border-red-200 rounded-lg p-3">
    <div class="space-y-3">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Word or Phrase to Remove Lines Containing</label>
            <input type="text" id="searchWord" placeholder="e.g., error, delete me" 
                class="w-full px-3 py-2 text-sm border border-red-300 rounded focus:ring-2 focus:ring-red-500"
                oninput="removeLinesWithWord()">
        </div>
        
        <div class="flex flex-wrap items-center gap-2">
            <label class="flex items-center cursor-pointer bg-white border border-red-200 rounded px-3 py-1.5">
                <input type="checkbox" id="caseSensitive" class="w-4 h-4 text-red-600 rounded" onchange="removeLinesWithWord()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Case Sensitive</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-red-200 rounded px-3 py-1.5">
                <input type="checkbox" id="exactMatch" class="w-4 h-4 text-red-600 rounded" onchange="removeLinesWithWord()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Exact Match Only</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-red-200 rounded px-3 py-1.5">
                <input type="checkbox" id="invert" class="w-4 h-4 text-red-600 rounded" onchange="removeLinesWithWord()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Invert (Keep Lines)</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-red-200 rounded px-3 py-1.5">
                <input type="checkbox" id="trimLines" class="w-4 h-4 text-red-600 rounded" checked onchange="removeLinesWithWord()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Trim Lines</span>
            </label>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="removeLinesWithWord"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Filtered text will appear here..."
    downloadFileName="filtered-lines.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-red-600" id="originalLines">0</div>
        <div class="text-xs text-gray-600">Original Lines</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="remainingLines">0</div>
        <div class="text-xs text-gray-600">Remaining Lines</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="removedLines">0</div>
        <div class="text-xs text-gray-600">Removed Lines</div>
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
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Remove Lines With Word</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Filter your text by removing entire lines that contain specific words or phrases. Useful for log analysis, data cleaning, and list filtering.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Remove lines containing a specific string</li>
            <li>Case-sensitive or insensitive search</li>
            <li>Exact match mode (whole line must match)</li>
            <li>Invert mode (Keep only lines containing the word)</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function removeLinesWithWord() {
        const input = document.getElementById('removeLinesWithWord-input');
        const output = document.getElementById('removeLinesWithWord-output');
        if (!input || !output) return;
        
        const text = input.value;
        const searchWord = document.getElementById('searchWord')?.value || '';
        const caseSensitive = document.getElementById('caseSensitive')?.checked || false;
        const exactMatch = document.getElementById('exactMatch')?.checked || false;
        const invert = document.getElementById('invert')?.checked || false;
        const trimLines = document.getElementById('trimLines')?.checked || false;
        
        let lines = text.split('\n');
        const originalCount = lines.length;
        
        if (trimLines) {
            lines = lines.map(line => line.trim());
        }
        
        if (searchWord) {
            lines = lines.filter(line => {
                let lineText = line;
                let searchText = searchWord;
                
                if (!caseSensitive) {
                    lineText = lineText.toLowerCase();
                    searchText = searchText.toLowerCase();
                }
                
                let match = false;
                if (exactMatch) {
                    match = lineText === searchText;
                } else {
                    match = lineText.includes(searchText);
                }
                
                // If invert is true, we keep matches (so filter returns true for match)
                // If invert is false, we remove matches (so filter returns false for match)
                return invert ? match : !match;
            });
        } else if (invert) {
            // If invert is on but no search word, result depends on logic. 
            // Usually "keep lines with nothing" means keep nothing or keep all?
            // Let's assume if no search word, we return everything unless user wants to filter.
            // But "Keep lines containing ''" matches everything.
            // So we do nothing if search word is empty.
        }
        
        output.value = lines.join('\n');
        
        // Update stats
        const removed = originalCount - lines.length;
        const reduction = originalCount > 0 ? ((removed / originalCount) * 100).toFixed(1) : 0;
        
        document.getElementById('originalLines').textContent = originalCount;
        document.getElementById('remainingLines').textContent = lines.length;
        document.getElementById('removedLines').textContent = removed;
        document.getElementById('reductionPercent').textContent = reduction + '%';
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setRemoveLinesWithWordConverter(text => {
        removeLinesWithWord();
        return document.getElementById('removeLinesWithWord-output').value;
    });
</script>
@endpush
