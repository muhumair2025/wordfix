@extends('layouts.tool')

@section('title', 'Replace Text Between - WordFix')

@section('tool-title', 'Replace Text Between')

@section('tool-description', 'Replace text found between two specific delimiters')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-teal-50 border border-teal-200 rounded-lg p-3">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3 mb-3">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Start Delimiter</label>
            <input type="text" id="startStr" placeholder="e.g., (" 
                class="w-full px-3 py-2 text-sm border border-teal-300 rounded focus:ring-2 focus:ring-teal-500"
                oninput="replaceTextBetween()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">End Delimiter</label>
            <input type="text" id="endStr" placeholder="e.g., )" 
                class="w-full px-3 py-2 text-sm border border-teal-300 rounded focus:ring-2 focus:ring-teal-500"
                oninput="replaceTextBetween()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Replace With</label>
            <input type="text" id="replaceStr" placeholder="Replacement text" 
                class="w-full px-3 py-2 text-sm border border-teal-300 rounded focus:ring-2 focus:ring-teal-500"
                oninput="replaceTextBetween()">
        </div>
    </div>
    
    <div class="flex flex-wrap items-center gap-2">
        <label class="flex items-center cursor-pointer bg-white border border-teal-200 rounded px-3 py-1.5">
            <input type="checkbox" id="replaceDelimiters" class="w-4 h-4 text-teal-600 rounded" checked onchange="replaceTextBetween()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Replace Delimiters Also</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-teal-200 rounded px-3 py-1.5">
            <input type="checkbox" id="caseSensitive" class="w-4 h-4 text-teal-600 rounded" onchange="replaceTextBetween()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Case Sensitive</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-teal-200 rounded px-3 py-1.5">
            <input type="checkbox" id="greedy" class="w-4 h-4 text-teal-600 rounded" onchange="replaceTextBetween()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Greedy Match</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="replaceTextBetween"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Text with replacements will appear here..."
    downloadFileName="replaced-text.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-teal-50 border border-teal-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-teal-600" id="originalChars">0</div>
        <div class="text-xs text-gray-600">Original Chars</div>
    </div>
    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-red-600" id="matchesReplaced">0</div>
        <div class="text-xs text-gray-600">Matches Replaced</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="finalChars">0</div>
        <div class="text-xs text-gray-600">Final Chars</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="changePercent">0%</div>
        <div class="text-xs text-gray-600">Change</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Replace Text Between</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Replace content found between two specific delimiters with new text. Useful for updating tags, modifying structured data, or bulk editing.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Specify start and end delimiters</li>
            <li>Custom replacement text</li>
            <li>Option to replace delimiters themselves or just the content inside</li>
            <li>Greedy vs Lazy matching</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Examples</h3>
        <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm space-y-1">
            <div><strong>Input:</strong> "Hello [name]!"</div>
            <div><strong>Start:</strong> "[" <strong>End:</strong> "]" <strong>Replace:</strong> "World"</div>
            <div><strong>Output:</strong> "Hello World!" (with delimiters replaced)</div>
        </div>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function escapeRegExp(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    function replaceTextBetween() {
        const input = document.getElementById('replaceTextBetween-input');
        const output = document.getElementById('replaceTextBetween-output');
        if (!input || !output) return;
        
        let text = input.value;
        const originalLength = text.length;
        
        const startStr = document.getElementById('startStr')?.value || '';
        const endStr = document.getElementById('endStr')?.value || '';
        const replaceStr = document.getElementById('replaceStr')?.value || '';
        const replaceDelimiters = document.getElementById('replaceDelimiters')?.checked || false;
        const caseSensitive = document.getElementById('caseSensitive')?.checked || false;
        const greedy = document.getElementById('greedy')?.checked || false;
        
        if (!startStr || !endStr) {
            output.value = text;
            document.getElementById('statsSection').classList.add('hidden');
            return;
        }
        
        const flags = caseSensitive ? 'g' : 'gi';
        const startEscaped = escapeRegExp(startStr);
        const endEscaped = escapeRegExp(endStr);
        
        // Construct regex
        const patternStr = greedy 
            ? `${startEscaped}[\\s\\S]*${endEscaped}`
            : `${startEscaped}[\\s\\S]*?${endEscaped}`;
            
        const regex = new RegExp(patternStr, flags);
        
        // Count matches
        const matches = text.match(regex);
        const matchesReplaced = matches ? matches.length : 0;
        
        if (replaceDelimiters) {
            // Replace everything including delimiters
            text = text.replace(regex, replaceStr);
        } else {
            // Keep delimiters, replace content inside
            // We need to use a callback to preserve the exact delimiters found
            text = text.replace(regex, (match) => {
                // We know match starts with startStr (ignoring case) and ends with endStr
                // But we need to be careful with lengths if case insensitive
                const startLen = startStr.length;
                const endLen = endStr.length;
                const actualStart = match.substring(0, startLen);
                const actualEnd = match.substring(match.length - endLen);
                return actualStart + replaceStr + actualEnd;
            });
        }
        
        output.value = text;
        
        // Update stats
        const change = originalLength > 0 ? (((text.length - originalLength) / originalLength) * 100).toFixed(1) : 0;
        const changeText = change > 0 ? `+${change}%` : `${change}%`;
        
        document.getElementById('originalChars').textContent = originalLength;
        document.getElementById('matchesReplaced').textContent = matchesReplaced;
        document.getElementById('finalChars').textContent = text.length;
        document.getElementById('changePercent').textContent = changeText;
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setReplaceTextBetweenConverter(text => {
        replaceTextBetween();
        return document.getElementById('replaceTextBetween-output').value;
    });
</script>
@endpush
