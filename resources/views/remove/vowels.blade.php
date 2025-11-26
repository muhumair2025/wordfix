@extends('layouts.tool')

@section('title', 'Remove Vowels - WordFix')

@section('tool-title', 'Remove Vowels')

@section('tool-description', 'Remove vowel letters from text')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-yellow-50 border border-yellow-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-2">
        <label class="flex items-center cursor-pointer bg-white border border-yellow-200 rounded px-3 py-1.5">
            <input type="checkbox" id="lowercase" class="w-4 h-4 text-yellow-600 rounded" checked onchange="removeVowels()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Lowercase (aeiou)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-yellow-200 rounded px-3 py-1.5">
            <input type="checkbox" id="uppercase" class="w-4 h-4 text-yellow-600 rounded" checked onchange="removeVowels()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Uppercase (AEIOU)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-yellow-200 rounded px-3 py-1.5">
            <input type="checkbox" id="yAsVowel" class="w-4 h-4 text-yellow-600 rounded" onchange="removeVowels()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Treat 'Y' as Vowel</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-yellow-200 rounded px-3 py-1.5">
            <input type="checkbox" id="accented" class="w-4 h-4 text-yellow-600 rounded" checked onchange="removeVowels()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Accented (áéíóú)</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="removeVowels"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Text without vowels will appear here..."
    downloadFileName="no-vowels.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-yellow-600" id="originalChars">0</div>
        <div class="text-xs text-gray-600">Original Chars</div>
    </div>
    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-red-600" id="vowelsRemoved">0</div>
        <div class="text-xs text-gray-600">Vowels Removed</div>
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
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Remove Vowels</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Remove vowels from text, creating a "disemvoweled" version. Fun for puzzles or text compression experiments.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Remove lowercase vowels</li>
            <li>Remove uppercase vowels</li>
            <li>Option to treat 'Y' as a vowel</li>
            <li>Remove accented vowels</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function removeVowels() {
        const input = document.getElementById('removeVowels-input');
        const output = document.getElementById('removeVowels-output');
        if (!input || !output) return;
        
        let text = input.value;
        const originalLength = text.length;
        
        const removeLowercase = document.getElementById('lowercase')?.checked || false;
        const removeUppercase = document.getElementById('uppercase')?.checked || false;
        const yAsVowel = document.getElementById('yAsVowel')?.checked || false;
        const removeAccented = document.getElementById('accented')?.checked || false;
        
        let vowelsRemoved = 0;
        let pattern = '';
        
        if (removeLowercase) pattern += 'aeiou';
        if (removeUppercase) pattern += 'AEIOU';
        if (yAsVowel) pattern += 'yY';
        if (removeAccented) pattern += 'áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙäëïöüÄËÏÖÜâêîôûÂÊÎÔÛ';
        
        if (pattern) {
            const regex = new RegExp(`[${pattern}]`, 'g');
            const matches = text.match(regex);
            vowelsRemoved = matches ? matches.length : 0;
            text = text.replace(regex, '');
        }
        
        output.value = text;
        
        // Update stats
        const reduction = originalLength > 0 ? (((originalLength - text.length) / originalLength) * 100).toFixed(1) : 0;
        
        document.getElementById('originalChars').textContent = originalLength;
        document.getElementById('vowelsRemoved').textContent = vowelsRemoved;
        document.getElementById('finalChars').textContent = text.length;
        document.getElementById('reductionPercent').textContent = reduction + '%';
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setRemoveVowelsConverter(text => {
        removeVowels();
        return document.getElementById('removeVowels-output').value;
    });
</script>
@endpush
