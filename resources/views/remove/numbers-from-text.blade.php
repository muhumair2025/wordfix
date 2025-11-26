@extends('layouts.tool')

@section('title', 'Remove Numbers From Text - WordFix')

@section('tool-title', 'Remove Numbers From Text')

@section('tool-description', 'Remove all numeric digits from text')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-orange-50 border border-orange-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-2">
        <label class="flex items-center cursor-pointer bg-white border border-orange-200 rounded px-3 py-1.5">
            <input type="checkbox" id="digits" class="w-4 h-4 text-orange-600 rounded" checked onchange="removeNumbersFromText()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Digits (0-9)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-orange-200 rounded px-3 py-1.5">
            <input type="checkbox" id="replaceWithSpace" class="w-4 h-4 text-orange-600 rounded" onchange="removeNumbersFromText()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Replace with Space</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-orange-200 rounded px-3 py-1.5">
            <input type="checkbox" id="cleanSpaces" class="w-4 h-4 text-orange-600 rounded" checked onchange="removeNumbersFromText()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Clean Extra Spaces</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="removeNumbersFromText"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Text without numbers will appear here..."
    downloadFileName="no-digits.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-orange-50 border border-orange-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-orange-600" id="originalChars">0</div>
        <div class="text-xs text-gray-600">Original Chars</div>
    </div>
    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-red-600" id="digitsRemoved">0</div>
        <div class="text-xs text-gray-600">Digits Removed</div>
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
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Remove Numbers From Text</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>A simple and efficient tool to strip all numeric digits (0-9) from your text.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Remove all digits 0-9</li>
            <li>Option to replace numbers with spaces</li>
            <li>Automatic extra space cleanup</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function removeNumbersFromText() {
        const input = document.getElementById('removeNumbersFromText-input');
        const output = document.getElementById('removeNumbersFromText-output');
        if (!input || !output) return;
        
        let text = input.value;
        const originalLength = text.length;
        
        const replaceWithSpace = document.getElementById('replaceWithSpace')?.checked || false;
        const cleanSpaces = document.getElementById('cleanSpaces')?.checked || false;
        
        const replacement = replaceWithSpace ? ' ' : '';
        
        // Count digits
        const digitMatches = text.match(/\d/g);
        const digitsRemoved = digitMatches ? digitMatches.length : 0;
        
        // Remove digits
        text = text.replace(/\d/g, replacement);
        
        // Clean up spaces
        if (cleanSpaces) {
            text = text.replace(/  +/g, ' ');
        }
        
        output.value = text;
        
        // Update stats
        const reduction = originalLength > 0 ? (((originalLength - text.length) / originalLength) * 100).toFixed(1) : 0;
        
        document.getElementById('originalChars').textContent = originalLength;
        document.getElementById('digitsRemoved').textContent = digitsRemoved;
        document.getElementById('finalChars').textContent = text.length;
        document.getElementById('reductionPercent').textContent = reduction + '%';
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setRemoveNumbersFromTextConverter(text => {
        removeNumbersFromText();
        return document.getElementById('removeNumbersFromText-output').value;
    });
</script>
@endpush
