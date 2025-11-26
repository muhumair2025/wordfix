@extends('layouts.tool')

@section('title', 'Remove Spaces - WordFix')

@section('tool-title', 'Remove Spaces')

@section('tool-description', 'Remove all spaces or specific types of spacing from text')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-purple-50 border border-purple-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-2">
        <label class="flex items-center cursor-pointer bg-white border border-purple-200 rounded px-3 py-1.5">
            <input type="checkbox" id="allSpaces" class="w-4 h-4 text-purple-600 rounded" checked onchange="removeSpaces()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">All Spaces</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-purple-200 rounded px-3 py-1.5">
            <input type="checkbox" id="tabs" class="w-4 h-4 text-purple-600 rounded" checked onchange="removeSpaces()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Tabs</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-purple-200 rounded px-3 py-1.5">
            <input type="checkbox" id="lineBreaks" class="w-4 h-4 text-purple-600 rounded" onchange="removeSpaces()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Line Breaks</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-purple-200 rounded px-3 py-1.5">
            <input type="checkbox" id="nonBreaking" class="w-4 h-4 text-purple-600 rounded" checked onchange="removeSpaces()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Non-breaking Spaces</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="removeSpaces"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Text without spaces will appear here..."
    downloadFileName="no-spaces.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-purple-600" id="originalChars">0</div>
        <div class="text-xs text-gray-600">Original Chars</div>
    </div>
    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-red-600" id="spacesRemoved">0</div>
        <div class="text-xs text-gray-600">Spaces Removed</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="finalChars">0</div>
        <div class="text-xs text-gray-600">Final Chars</div>
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
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Remove Spaces</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Remove all spaces, tabs, and whitespace from text. Useful for minifying code, cleaning data, or preparing text for specific formats.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Remove standard spaces</li>
            <li>Remove tabs</li>
            <li>Remove line breaks (newlines)</li>
            <li>Remove non-breaking spaces (&nbsp;)</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function removeSpaces() {
        const input = document.getElementById('removeSpaces-input');
        const output = document.getElementById('removeSpaces-output');
        if (!input || !output) return;
        
        let text = input.value;
        const originalLength = text.length;
        
        const removeAll = document.getElementById('allSpaces')?.checked || false;
        const removeTabs = document.getElementById('tabs')?.checked || false;
        const removeLineBreaks = document.getElementById('lineBreaks')?.checked || false;
        const removeNonBreaking = document.getElementById('nonBreaking')?.checked || false;
        
        let spacesRemoved = 0;
        
        // Remove standard spaces
        if (removeAll) {
            const matches = text.match(/ /g);
            spacesRemoved += matches ? matches.length : 0;
            text = text.replace(/ /g, '');
        }
        
        // Remove tabs
        if (removeTabs) {
            const matches = text.match(/\t/g);
            spacesRemoved += matches ? matches.length : 0;
            text = text.replace(/\t/g, '');
        }
        
        // Remove line breaks
        if (removeLineBreaks) {
            const matches = text.match(/[\r\n]/g);
            spacesRemoved += matches ? matches.length : 0;
            text = text.replace(/[\r\n]/g, '');
        }
        
        // Remove non-breaking spaces
        if (removeNonBreaking) {
            // Matches \u00A0 (NBSP)
            const matches = text.match(/\u00A0/g);
            spacesRemoved += matches ? matches.length : 0;
            text = text.replace(/\u00A0/g, '');
        }
        
        output.value = text;
        
        // Update stats
        const reduction = originalLength > 0 ? (((originalLength - text.length) / originalLength) * 100).toFixed(1) : 0;
        
        document.getElementById('originalChars').textContent = originalLength;
        document.getElementById('spacesRemoved').textContent = spacesRemoved;
        document.getElementById('finalChars').textContent = text.length;
        document.getElementById('reductionPercent').textContent = reduction + '%';
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setRemoveSpacesConverter(text => {
        removeSpaces();
        return document.getElementById('removeSpaces-output').value;
    });
</script>
@endpush
