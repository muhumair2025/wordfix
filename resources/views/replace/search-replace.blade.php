@extends('layouts.tool')

@section('title', 'Search and Replace - WordFix')

@section('tool-title', 'Search and Replace')

@section('tool-description', 'Find and replace text with advanced options')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-blue-50 border border-blue-200 rounded-lg p-3">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Find</label>
            <input type="text" id="findStr" placeholder="Text to find..." 
                class="w-full px-3 py-2 text-sm border border-blue-300 rounded focus:ring-2 focus:ring-blue-500"
                oninput="searchReplace()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Replace With</label>
            <input type="text" id="replaceStr" placeholder="Replacement text..." 
                class="w-full px-3 py-2 text-sm border border-blue-300 rounded focus:ring-2 focus:ring-blue-500"
                oninput="searchReplace()">
        </div>
    </div>
    
    <div class="flex flex-wrap items-center gap-2">
        <label class="flex items-center cursor-pointer bg-white border border-blue-200 rounded px-3 py-1.5">
            <input type="checkbox" id="caseSensitive" class="w-4 h-4 text-blue-600 rounded" onchange="searchReplace()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Case Sensitive</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-blue-200 rounded px-3 py-1.5">
            <input type="checkbox" id="wholeWord" class="w-4 h-4 text-blue-600 rounded" onchange="searchReplace()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Whole Words Only</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-blue-200 rounded px-3 py-1.5">
            <input type="checkbox" id="useRegex" class="w-4 h-4 text-blue-600 rounded" onchange="searchReplace()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Use Regex</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-blue-200 rounded px-3 py-1.5">
            <input type="checkbox" id="replaceAll" class="w-4 h-4 text-blue-600 rounded" checked onchange="searchReplace()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Replace All Occurrences</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="searchReplace"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Text with replacements will appear here..."
    downloadFileName="replaced-text.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="originalChars">0</div>
        <div class="text-xs text-gray-600">Original Chars</div>
    </div>
    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-red-600" id="matchesFound">0</div>
        <div class="text-xs text-gray-600">Matches Found</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="finalChars">0</div>
        <div class="text-xs text-gray-600">Final Chars</div>
    </div>
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-purple-600" id="changePercent">0%</div>
        <div class="text-xs text-gray-600">Change</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Search and Replace</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>A powerful find and replace tool with support for regular expressions, case sensitivity, and whole word matching.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Find and replace text instantly</li>
            <li>Regular Expression (Regex) support</li>
            <li>Case sensitive or insensitive matching</li>
            <li>Whole word matching option</li>
            <li>Replace all or single occurrence</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function escapeRegExp(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    function searchReplace() {
        const input = document.getElementById('searchReplace-input');
        const output = document.getElementById('searchReplace-output');
        if (!input || !output) return;
        
        let text = input.value;
        const originalLength = text.length;
        
        const findStr = document.getElementById('findStr')?.value || '';
        const replaceStr = document.getElementById('replaceStr')?.value || '';
        const caseSensitive = document.getElementById('caseSensitive')?.checked || false;
        const wholeWord = document.getElementById('wholeWord')?.checked || false;
        const useRegex = document.getElementById('useRegex')?.checked || false;
        const replaceAll = document.getElementById('replaceAll')?.checked || false;
        
        if (!findStr) {
            output.value = text;
            document.getElementById('statsSection').classList.add('hidden');
            return;
        }
        
        let flags = caseSensitive ? '' : 'i';
        if (replaceAll) flags += 'g';
        
        let regex;
        try {
            if (useRegex) {
                regex = new RegExp(findStr, flags);
            } else {
                let pattern = escapeRegExp(findStr);
                if (wholeWord) {
                    pattern = `\\b${pattern}\\b`;
                }
                regex = new RegExp(pattern, flags);
            }
            
            // Count matches
            // Note: if global flag not set, match() returns array with index/input
            // if global flag set, match() returns array of strings
            const matches = text.match(regex);
            let matchesFound = 0;
            if (matches) {
                matchesFound = replaceAll ? matches.length : 1;
            }
            
            // Replace
            text = text.replace(regex, replaceStr);
            
            output.value = text;
            
            // Update stats
            const change = originalLength > 0 ? (((text.length - originalLength) / originalLength) * 100).toFixed(1) : 0;
            const changeText = change > 0 ? `+${change}%` : `${change}%`;
            
            document.getElementById('originalChars').textContent = originalLength;
            document.getElementById('matchesFound').textContent = matchesFound;
            document.getElementById('finalChars').textContent = text.length;
            document.getElementById('changePercent').textContent = changeText;
            document.getElementById('statsSection').classList.remove('hidden');
            
        } catch (e) {
            // Invalid regex
            console.error(e);
            output.value = "Error: Invalid Regular Expression";
        }
    }
    
    setSearchReplaceConverter(text => {
        searchReplace();
        return document.getElementById('searchReplace-output').value;
    });
</script>
@endpush
