@extends('layouts.tool')

@section('title', 'Remove Extra Spaces - WordFix')

@section('tool-title', 'Remove Extra Spaces')

@section('tool-description', 'Remove extra spaces, tabs, and normalize whitespace in text')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-purple-50 border border-purple-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-2">
        <label class="flex items-center cursor-pointer bg-white border border-purple-200 rounded px-3 py-1.5">
            <input type="checkbox" id="multipleSpaces" class="w-4 h-4 text-purple-600 rounded" checked onchange="removeSpaces()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Multiple Spaces → 1</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-purple-200 rounded px-3 py-1.5">
            <input type="checkbox" id="leadingSpaces" class="w-4 h-4 text-purple-600 rounded" onchange="removeSpaces()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Leading Spaces</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-purple-200 rounded px-3 py-1.5">
            <input type="checkbox" id="trailingSpaces" class="w-4 h-4 text-purple-600 rounded" onchange="removeSpaces()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Trailing Spaces</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-purple-200 rounded px-3 py-1.5">
            <input type="checkbox" id="tabs" class="w-4 h-4 text-purple-600 rounded" onchange="removeSpaces()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Tabs → Spaces</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-purple-200 rounded px-3 py-1.5">
            <input type="checkbox" id="allSpaces" class="w-4 h-4 text-purple-600 rounded" onchange="removeSpaces()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Remove All Spaces</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="removeExtraSpaces"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Text with extra spaces removed will appear here..."
    downloadFileName="no-extra-spaces.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-purple-600" id="originalChars">0</div>
        <div class="text-xs text-gray-600">Original Chars</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="finalChars">0</div>
        <div class="text-xs text-gray-600">Final Chars</div>
    </div>
    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-red-600" id="removedChars">0</div>
        <div class="text-xs text-gray-600">Removed</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="spacePercent">0%</div>
        <div class="text-xs text-gray-600">Reduction</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Remove Extra Spaces</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Remove extra spaces, normalize whitespace, and clean up text formatting. Perfect for cleaning copy-pasted content and normalizing data.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Collapse multiple spaces into one</li>
            <li>Remove leading/trailing spaces per line</li>
            <li>Convert tabs to spaces</li>
            <li>Remove all spaces completely</li>
            <li>Shows character reduction statistics</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function removeSpaces() {
        const input = document.getElementById('removeExtraSpaces-input');
        const output = document.getElementById('removeExtraSpaces-output');
        if (!input || !output) return;
        
        let text = input.value;
        const originalLength = text.length;
        
        const multipleSpaces = document.getElementById('multipleSpaces')?.checked || false;
        const leadingSpaces = document.getElementById('leadingSpaces')?.checked || false;
        const trailingSpaces = document.getElementById('trailingSpaces')?.checked || false;
        const tabs = document.getElementById('tabs')?.checked || false;
        const allSpaces = document.getElementById('allSpaces')?.checked || false;
        
        // Remove all spaces (overrides other options)
        if (allSpaces) {
            text = text.replace(/\s+/g, '');
        } else {
            // Convert tabs to spaces
            if (tabs) {
                text = text.replace(/\t/g, ' ');
            }
            
            // Replace multiple spaces with one
            if (multipleSpaces) {
                text = text.replace(/ {2,}/g, ' ');
            }
            
            // Remove leading/trailing spaces per line
            if (leadingSpaces || trailingSpaces) {
                const lines = text.split('\n');
                text = lines.map(line => {
                    if (leadingSpaces && trailingSpaces) {
                        return line.trim();
                    } else if (leadingSpaces) {
                        return line.replace(/^\s+/, '');
                    } else if (trailingSpaces) {
                        return line.replace(/\s+$/, '');
                    }
                    return line;
                }).join('\n');
            }
        }
        
        output.value = text;
        
        // Update stats
        const removed = originalLength - text.length;
        const reduction = originalLength > 0 ? ((removed / originalLength) * 100).toFixed(1) : 0;
        
        document.getElementById('originalChars').textContent = originalLength;
        document.getElementById('finalChars').textContent = text.length;
        document.getElementById('removedChars').textContent = removed;
        document.getElementById('spacePercent').textContent = reduction + '%';
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setRemoveExtraSpacesConverter(text => {
        removeSpaces();
        return document.getElementById('removeExtraSpaces-output').value;
    });
</script>
@endpush
