@extends('layouts.tool')

@section('title', 'Remove Special Characters - WordFix')

@section('tool-title', 'Remove Special Characters')

@section('tool-description', 'Remove special characters, punctuation, symbols, and non-alphanumeric text')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-red-50 border border-red-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-2">
        <label class="flex items-center cursor-pointer bg-white border border-red-200 rounded px-3 py-1.5">
            <input type="checkbox" id="punctuation" class="w-4 h-4 text-red-600 rounded" checked onchange="removeCharacters()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Punctuation</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-red-200 rounded px-3 py-1.5">
            <input type="checkbox" id="symbols" class="w-4 h-4 text-red-600 rounded" onchange="removeCharacters()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Symbols (!@#$%)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-red-200 rounded px-3 py-1.5">
            <input type="checkbox" id="numbers" class="w-4 h-4 text-red-600 rounded" onchange="removeCharacters()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Numbers</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-red-200 rounded px-3 py-1.5">
            <input type="checkbox" id="whitespace" class="w-4 h-4 text-red-600 rounded" onchange="removeCharacters()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Extra Spaces</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-red-200 rounded px-3 py-1.5">
            <input type="checkbox" id="accents" class="w-4 h-4 text-red-600 rounded" onchange="removeCharacters()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Accents (é→e)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-red-200 rounded px-3 py-1.5">
            <input type="checkbox" id="unicode" class="w-4 h-4 text-red-600 rounded" onchange="removeCharacters()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Unicode/Emoji</span>
        </label>
    </div>
    
    <div class="mt-3 flex flex-wrap items-center gap-3">
        <div class="flex-1 min-w-[250px]">
            <label class="block text-xs font-medium text-gray-700 mb-1">Custom Chars to Remove</label>
            <input type="text" id="customChars" placeholder="e.g., _-~"
                class="w-full px-3 py-2 text-sm border border-red-300 rounded focus:ring-2 focus:ring-red-500"
                oninput="removeCharacters()">
        </div>
        <label class="flex items-center cursor-pointer bg-white border border-red-200 rounded px-3 py-1.5">
            <input type="checkbox" id="preserveSpaces" class="w-4 h-4 text-red-600 rounded" checked onchange="removeCharacters()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Keep Spaces</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="removeSpecialChars"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Text with special characters removed will appear here..."
    downloadFileName="no-special-chars.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-red-600" id="originalChars">0</div>
        <div class="text-xs text-gray-600">Original Chars</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="finalChars">0</div>
        <div class="text-xs text-gray-600">Final Chars</div>
    </div>
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-purple-600" id="removedChars">0</div>
        <div class="text-xs text-gray-600">Removed</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="reductionPercent">0%</div>
        <div class="text-xs text-gray-600">Reduction</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Remove Special Characters</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Remove special characters, punctuation, symbols, and non-alphanumeric text with granular control over what to keep or remove.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Remove punctuation (. , ! ? ; :)</li>
            <li>Remove symbols (!@#$%^&*)</li>
            <li>Remove or keep numbers</li>
            <li>Remove accented characters (é → e)</li>
            <li>Remove Unicode and emoji</li>
            <li>Custom character removal</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function removeAccents(str) {
        return str.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
    }
    
    function removeCharacters() {
        const input = document.getElementById('removeSpecialChars-input');
        const output = document.getElementById('removeSpecialChars-output');
        if (!input || !output) return;
        
        let text = input.value;
        const originalLength = text.length;
        
        const removePunctuation = document.getElementById('punctuation')?.checked || false;
        const removeSymbols = document.getElementById('symbols')?.checked || false;
        const removeNumbers = document.getElementById('numbers')?.checked || false;
        const removeWhitespace = document.getElementById('whitespace')?.checked || false;
        const removeAccentsEnabled = document.getElementById('accents')?.checked || false;
        const removeUnicode = document.getElementById('unicode')?.checked || false;
        const customChars = document.getElementById('customChars')?.value || '';
        const preserveSpaces = document.getElementById('preserveSpaces')?.checked || false;
        
        // Remove accents
        if (removeAccentsEnabled) {
            text = removeAccents(text);
        }
        
        // Remove punctuation
        if (removePunctuation) {
            text = text.replace(/[.,\/#!?$%\^&\*;:{}=\-_`~()]/g, '');
        }
        
        // Remove symbols
        if (removeSymbols) {
            text = text.replace(/[@#$%^&*<>{}[\]\\|]/g, '');
        }
        
        // Remove numbers
        if (removeNumbers) {
            text = text.replace(/\d/g, '');
        }
        
        // Remove Unicode/Emoji (anything outside basic ASCII)
        if (removeUnicode) {
            text = text.replace(/[^\x00-\x7F]/g, '');
        }
        
        // Remove custom characters
        if (customChars) {
            const regex = new RegExp('[' + customChars.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, '\\$&') + ']', 'g');
            text = text.replace(regex, '');
        }
        
        // Clean up extra whitespace
        if (removeWhitespace) {
            text = text.replace(/  +/g, ' ');
        }
        
        // Remove all spaces if not preserving
        if (!preserveSpaces) {
            text = text.replace(/ /g, '');
        }
        
        output.value = text;
        
        // Update stats
        const removed = originalLength - text.length;
        const reduction = originalLength > 0 ? ((removed / originalLength) * 100).toFixed(1) : 0;
        
        document.getElementById('originalChars').textContent = originalLength;
        document.getElementById('finalChars').textContent = text.length;
        document.getElementById('removedChars').textContent = removed;
        document.getElementById('reductionPercent').textContent = reduction + '%';
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setRemoveSpecialCharsConverter(text => {
        removeCharacters();
        return document.getElementById('removeSpecialChars-output').value;
    });
</script>
@endpush
