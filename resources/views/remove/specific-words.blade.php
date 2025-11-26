@extends('layouts.tool')

@section('title', 'Remove Specific Words - WordFix')

@section('tool-title', 'Remove Specific Words')

@section('tool-description', 'Remove specific words or phrases from text with advanced filtering')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-slate-50 border border-slate-200 rounded-lg p-3">
    <div class="space-y-3">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Words to Remove (comma-separated)</label>
            <input type="text" id="wordsToRemove" 
                placeholder="e.g., spam, unwanted, delete, test"
                class="w-full px-3 py-2 text-sm border border-slate-300 rounded focus:ring-2 focus:ring-slate-500"
                oninput="removeWords()">
        </div>
        
        <div class="flex flex-wrap items-center gap-2">
            <label class="flex items-center cursor-pointer bg-white border border-slate-200 rounded px-3 py-1.5">
                <input type="checkbox" id="caseSensitive" class="w-4 h-4 text-slate-600 rounded" onchange="removeWords()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Case Sensitive</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-slate-200 rounded px-3 py-1.5">
                <input type="checkbox" id="wholeWord" class="w-4 h-4 text-slate-600 rounded" checked onchange="removeWords()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Whole Words Only</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-slate-200 rounded px-3 py-1.5">
                <input type="checkbox" id="removeEmpty" class="w-4 h-4 text-slate-600 rounded" onchange="removeWords()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Remove Empty Lines</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-slate-200 rounded px-3 py-1.5">
                <input type="checkbox" id="trimSpaces" class="w-4 h-4 text-slate-600 rounded" checked onchange="removeWords()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Clean Spaces</span>
            </label>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="removeSpecificWords"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Text with specified words removed will appear here..."
    downloadFileName="filtered-text.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-slate-50 border border-slate-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-slate-600" id="wordsSearched">0</div>
        <div class="text-xs text-gray-600">Words Searched</div>
    </div>
    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-red-600" id="occurrencesRemoved">0</div>
        <div class="text-xs text-gray-600">Occurrences Removed</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="originalWords">0</div>
        <div class="text-xs text-gray-600">Original Words</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="finalWords">0</div>
        <div class="text-xs text-gray-600">Final Words</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Remove Specific Words</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Remove specific words or phrases from text with advanced filtering options. Perfect for censoring, filtering spam, or cleaning content.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Remove multiple words at once (comma-separated)</li>
            <li>Case-sensitive or insensitive matching</li>
            <li>Whole word matching or partial</li>
            <li>Automatic space cleanup</li>
            <li>Remove resulting empty lines</li>
            <li>Shows removal statistics</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Examples</h3>
        <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm space-y-1">
            <div><strong>Input:</strong> "This is spam test content"</div>
            <div><strong>Remove:</strong> "spam, test"</div>
            <div><strong>Output:</strong> "This is content"</div>
        </div>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function removeWords() {
        const input = document.getElementById('removeSpecificWords-input');
        const output = document.getElementById('removeSpecificWords-output');
        if (!input || !output) return;
        
        let text = input.value;
        const wordsInput = document.getElementById('wordsToRemove')?.value || '';
        const caseSensitive = document.getElementById('caseSensitive')?.checked || false;
        const wholeWord = document.getElementById('wholeWord')?.checked || false;
        const removeEmpty = document.getElementById('removeEmpty')?.checked || false;
        const trimSpaces = document.getElementById('trimSpaces')?.checked || false;
        
        if (!wordsInput.trim()) {
            output.value = text;
            document.getElementById('statsSection').classList.add('hidden');
            return;
        }
        
        // Parse words to remove
        const wordsToRemove = wordsInput.split(',').map(word => word.trim()).filter(word => word.length > 0);
        let occurrencesRemoved = 0;
        const originalWordCount = text.split(/\s+/).filter(w => w.length > 0).length;
        
        // Remove each word
        wordsToRemove.forEach(word => {
            const flags = caseSensitive ? 'g' : 'gi';
            const pattern = wholeWord 
                ? new RegExp('\\b' + word.replace(/[.*+?^${}()|[\]\\]/g, '\\$&') + '\\b', flags)
                : new RegExp(word.replace(/[.*+?^${}()|[\]\\]/g, '\\$&'), flags);
            
            const matches = text.match(pattern);
            occurrencesRemoved += matches ? matches.length : 0;
            text = text.replace(pattern, '');
        });
        
        // Clean up spaces
        if (trimSpaces) {
            text = text.replace(/\s{2,}/g, ' ');
            text = text.replace(/^\s+|\s+$/gm, '');
        }
        
        // Remove empty lines
        if (removeEmpty) {
            text = text.split('\n').filter(line => line.trim().length > 0).join('\n');
        }
        
        output.value = text;
        
        // Update stats
        const finalWordCount = text.split(/\s+/).filter(w => w.length > 0).length;
        
        document.getElementById('wordsSearched').textContent = wordsToRemove.length;
        document.getElementById('occurrencesRemoved').textContent = occurrencesRemoved;
        document.getElementById('originalWords').textContent = originalWordCount;
        document.getElementById('finalWords').textContent = finalWordCount;
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setRemoveSpecificWordsConverter(text => {
        removeWords();
        return document.getElementById('removeSpecificWords-output').value;
    });
</script>
@endpush
