@extends('layouts.tool')

@section('title', 'Remove Letters - WordFix')

@section('tool-title', 'Remove Letters')

@section('tool-description', 'Remove alphabetic characters, keeping only numbers and symbols')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-teal-50 border border-teal-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-2">
        <label class="flex items-center cursor-pointer bg-white border border-teal-200 rounded px-3 py-1.5">
            <input type="checkbox" id="lowercase" class="w-4 h-4 text-teal-600 rounded" checked onchange="removeLetters()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Lowercase (a-z)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-teal-200 rounded px-3 py-1.5">
            <input type="checkbox" id="uppercase" class="w-4 h-4 text-teal-600 rounded" checked onchange="removeLetters()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Uppercase (A-Z)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-teal-200 rounded px-3 py-1.5">
            <input type="checkbox" id="accented" class="w-4 h-4 text-teal-600 rounded" onchange="removeLetters()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Accented (é, ñ)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-teal-200 rounded px-3 py-1.5">
            <input type="checkbox" id="keepSpaces" class="w-4 h-4 text-teal-600 rounded" checked onchange="removeLetters()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Keep Spaces</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-teal-200 rounded px-3 py-1.5">
            <input type="checkbox" id="keepNumbers" class="w-4 h-4 text-teal-600 rounded" checked onchange="removeLetters()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Keep Numbers</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-teal-200 rounded px-3 py-1.5">
            <input type="checkbox" id="keepPunctuation" class="w-4 h-4 text-teal-600 rounded" onchange="removeLetters()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Keep Punctuation</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="removeLetters"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Text with letters removed will appear here..."
    downloadFileName="no-letters.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-teal-50 border border-teal-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-teal-600" id="originalChars">0</div>
        <div class="text-xs text-gray-600">Original Chars</div>
    </div>
    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-red-600" id="lettersRemoved">0</div>
        <div class="text-xs text-gray-600">Letters Removed</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="finalChars">0</div>
        <div class="text-xs text-gray-600">Final Chars</div>
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
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Remove Letters</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Remove alphabetic characters from text while keeping numbers, spaces, and punctuation. Perfect for extracting numeric data or cleaning text.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Remove lowercase letters</li>
            <li>Remove uppercase letters</li>
            <li>Remove accented letters</li>
            <li>Keep or remove spaces</li>
            <li>Keep or remove numbers</li>
            <li>Keep or remove punctuation</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function removeLetters() {
        const input = document.getElementById('removeLetters-input');
        const output = document.getElementById('removeLetters-output');
        if (!input || !output) return;
        
        let text = input.value;
        const originalLength = text.length;
        
        const removeLowercase = document.getElementById('lowercase')?.checked || false;
        const removeUppercase = document.getElementById('uppercase')?.checked || false;
        const removeAccented = document.getElementById('accented')?.checked || false;
        const keepSpaces = document.getElementById('keepSpaces')?.checked || false;
        const keepNumbers = document.getElementById('keepNumbers')?.checked || false;
        const keepPunctuation = document.getElementById('keepPunctuation')?.checked || false;
        
        let result = '';
        let lettersRemoved = 0;
        
        for (let char of text) {
            let keep = true;
            
            // Check if lowercase letter
            if (removeLowercase && /[a-z]/.test(char)) {
                keep = false;
                lettersRemoved++;
            }
            
            // Check if uppercase letter
            if (removeUppercase && /[A-Z]/.test(char)) {
                keep = false;
                lettersRemoved++;
            }
            
            // Check if accented letter
            if (removeAccented && /[À-ÿ]/.test(char)) {
                keep = false;
                lettersRemoved++;
            }
            
            // Keep spaces if requested
            if (!keepSpaces && char === ' ') {
                keep = false;
            }
            
            // Keep numbers if requested
            if (!keepNumbers && /\d/.test(char)) {
                keep = false;
            }
            
            // Keep punctuation if requested
            if (!keepPunctuation && /[.,\/#!?$%\^&\*;:{}=\-_`~()]/.test(char)) {
                keep = false;
            }
            
            if (keep) {
                result += char;
            }
        }
        
        // Clean up multiple spaces
        if (keepSpaces) {
            result = result.replace(/  +/g, ' ');
        }
        
        output.value = result;
        
        // Update stats
        const reduction = originalLength > 0 ? (((originalLength - result.length) / originalLength) * 100).toFixed(1) : 0;
        
        document.getElementById('originalChars').textContent = originalLength;
        document.getElementById('lettersRemoved').textContent = lettersRemoved;
        document.getElementById('finalChars').textContent = result.length;
        document.getElementById('reductionPercent').textContent = reduction + '%';
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setRemoveLettersConverter(text => {
        removeLetters();
        return document.getElementById('removeLetters-output').value;
    });
</script>
@endpush
