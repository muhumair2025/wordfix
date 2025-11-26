@extends('layouts.tool')

@section('title', 'Remove Consonants - WordFix')

@section('tool-title', 'Remove Consonants')

@section('tool-description', 'Remove consonant letters while keeping vowels, numbers, and symbols')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-emerald-50 border border-emerald-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-2">
        <label class="flex items-center cursor-pointer bg-white border border-emerald-200 rounded px-3 py-1.5">
            <input type="checkbox" id="lowercase" class="w-4 h-4 text-emerald-600 rounded" checked onchange="removeConsonants()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Lowercase (bcdfg...)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-emerald-200 rounded px-3 py-1.5">
            <input type="checkbox" id="uppercase" class="w-4 h-4 text-emerald-600 rounded" checked onchange="removeConsonants()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Uppercase (BCDFG...)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-emerald-200 rounded px-3 py-1.5">
            <input type="checkbox" id="keepVowels" class="w-4 h-4 text-emerald-600 rounded" checked onchange="removeConsonants()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Keep Vowels (aeiou)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-emerald-200 rounded px-3 py-1.5">
            <input type="checkbox" id="keepSpaces" class="w-4 h-4 text-emerald-600 rounded" checked onchange="removeConsonants()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Keep Spaces</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-emerald-200 rounded px-3 py-1.5">
            <input type="checkbox" id="keepNumbers" class="w-4 h-4 text-emerald-600 rounded" checked onchange="removeConsonants()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Keep Numbers</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-emerald-200 rounded px-3 py-1.5">
            <input type="checkbox" id="cleanSpaces" class="w-4 h-4 text-emerald-600 rounded" onchange="removeConsonants()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Clean Extra Spaces</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="removeConsonants"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Text with consonants removed will appear here..."
    downloadFileName="no-consonants.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-emerald-50 border border-emerald-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-emerald-600" id="originalChars">0</div>
        <div class="text-xs text-gray-600">Original Chars</div>
    </div>
    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-red-600" id="consonantsRemoved">0</div>
        <div class="text-xs text-gray-600">Consonants Removed</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="vowelsKept">0</div>
        <div class="text-xs text-gray-600">Vowels Kept</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="finalChars">0</div>
        <div class="text-xs text-gray-600">Final Chars</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Remove Consonants</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Remove consonant letters from text while keeping vowels, numbers, and symbols. Perfect for linguistic analysis or text transformation.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Remove lowercase consonants (b, c, d, f, g...)</li>
            <li>Remove uppercase consonants (B, C, D, F, G...)</li>
            <li>Keep vowels (a, e, i, o, u)</li>
            <li>Keep spaces, numbers, and punctuation</li>
            <li>Clean up extra spaces</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function removeConsonants() {
        const input = document.getElementById('removeConsonants-input');
        const output = document.getElementById('removeConsonants-output');
        if (!input || !output) return;
        
        const text = input.value;
        const originalLength = text.length;
        
        const removeLowercase = document.getElementById('lowercase')?.checked || false;
        const removeUppercase = document.getElementById('uppercase')?.checked || false;
        const keepVowels = document.getElementById('keepVowels')?.checked || false;
        const keepSpaces = document.getElementById('keepSpaces')?.checked || false;
        const keepNumbers = document.getElementById('keepNumbers')?.checked || false;
        const cleanSpaces = document.getElementById('cleanSpaces')?.checked || false;
        
        const vowels = 'aeiouAEIOU';
        const lowercaseConsonants = 'bcdfghjklmnpqrstvwxyz';
        const uppercaseConsonants = 'BCDFGHJKLMNPQRSTVWXYZ';
        
        let result = '';
        let consonantsRemoved = 0;
        let vowelsKept = 0;
        
        for (let char of text) {
            let keep = true;
            
            // Check if lowercase consonant
            if (removeLowercase && lowercaseConsonants.includes(char)) {
                keep = false;
                consonantsRemoved++;
            }
            
            // Check if uppercase consonant
            if (removeUppercase && uppercaseConsonants.includes(char)) {
                keep = false;
                consonantsRemoved++;
            }
            
            // Count vowels
            if (vowels.includes(char)) {
                vowelsKept++;
            }
            
            // Keep spaces
            if (!keepSpaces && char === ' ') {
                keep = false;
            }
            
            // Keep numbers
            if (!keepNumbers && /\d/.test(char)) {
                keep = false;
            }
            
            if (keep) {
                result += char;
            }
        }
        
        // Clean up extra spaces
        if (cleanSpaces) {
            result = result.replace(/  +/g, ' ').trim();
        }
        
        output.value = result;
        
        // Update stats
        document.getElementById('originalChars').textContent = originalLength;
        document.getElementById('consonantsRemoved').textContent = consonantsRemoved;
        document.getElementById('vowelsKept').textContent = vowelsKept;
        document.getElementById('finalChars').textContent = result.length;
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setRemoveConsonantsConverter(text => {
        removeConsonants();
        return document.getElementById('removeConsonants-output').value;
    });
</script>
@endpush
