@extends('layouts.tool')

@section('title', 'Remove Text Between - WordFix')

@section('tool-title', 'Remove Text Between')

@section('tool-description', 'Remove text between two specified delimiters')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-teal-50 border border-teal-200 rounded-lg p-3">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-3">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Start Delimiter</label>
            <input type="text" id="startStr" placeholder="e.g., (" 
                class="w-full px-3 py-2 text-sm border border-teal-300 rounded focus:ring-2 focus:ring-teal-500"
                oninput="removeTextBetween()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">End Delimiter</label>
            <input type="text" id="endStr" placeholder="e.g., )" 
                class="w-full px-3 py-2 text-sm border border-teal-300 rounded focus:ring-2 focus:ring-teal-500"
                oninput="removeTextBetween()">
        </div>
    </div>
    
    <div class="flex flex-wrap items-center gap-2">
        <label class="flex items-center cursor-pointer bg-white border border-teal-200 rounded px-3 py-1.5">
            <input type="checkbox" id="removeDelimiters" class="w-4 h-4 text-teal-600 rounded" checked onchange="removeTextBetween()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Remove Delimiters Also</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-teal-200 rounded px-3 py-1.5">
            <input type="checkbox" id="caseSensitive" class="w-4 h-4 text-teal-600 rounded" onchange="removeTextBetween()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Case Sensitive</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-teal-200 rounded px-3 py-1.5">
            <input type="checkbox" id="greedy" class="w-4 h-4 text-teal-600 rounded" onchange="removeTextBetween()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Greedy Match</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-teal-200 rounded px-3 py-1.5">
            <input type="checkbox" id="cleanSpaces" class="w-4 h-4 text-teal-600 rounded" checked onchange="removeTextBetween()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Clean Extra Spaces</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="removeTextBetween"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Text with content removed will appear here..."
    downloadFileName="cleaned-text.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-teal-50 border border-teal-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-teal-600" id="originalChars">0</div>
        <div class="text-xs text-gray-600">Original Chars</div>
    </div>
    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-red-600" id="matchesRemoved">0</div>
        <div class="text-xs text-gray-600">Matches Removed</div>
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
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Remove Text Between</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Remove all text found between two specific strings or characters. Useful for removing tags, comments, or parenthetical content.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Specify start and end delimiters</li>
            <li>Option to remove delimiters themselves</li>
            <li>Greedy vs Lazy matching</li>
            <li>Case sensitive matching</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Examples</h3>
        <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm space-y-1">
            <div><strong>Input:</strong> "Hello (world) there"</div>
            <div><strong>Start:</strong> "(" <strong>End:</strong> ")"</div>
            <div><strong>Output:</strong> "Hello  there" (with delimiters removed)</div>
        </div>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function escapeRegExp(string) {
        return string.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }

    function removeTextBetween() {
        const input = document.getElementById('removeTextBetween-input');
        const output = document.getElementById('removeTextBetween-output');
        if (!input || !output) return;
        
        let text = input.value;
        const originalLength = text.length;
        
        const startStr = document.getElementById('startStr')?.value || '';
        const endStr = document.getElementById('endStr')?.value || '';
        const removeDelimiters = document.getElementById('removeDelimiters')?.checked || false;
        const caseSensitive = document.getElementById('caseSensitive')?.checked || false;
        const greedy = document.getElementById('greedy')?.checked || false;
        const cleanSpaces = document.getElementById('cleanSpaces')?.checked || false;
        
        if (!startStr || !endStr) {
            output.value = text;
            document.getElementById('statsSection').classList.add('hidden');
            return;
        }
        
        const flags = caseSensitive ? 'g' : 'gi';
        const startEscaped = escapeRegExp(startStr);
        const endEscaped = escapeRegExp(endStr);
        
        // Construct regex
        // Lazy: start.*?end
        // Greedy: start.*end
        const patternStr = greedy 
            ? `${startEscaped}[\\s\\S]*${endEscaped}`
            : `${startEscaped}[\\s\\S]*?${endEscaped}`;
            
        const regex = new RegExp(patternStr, flags);
        
        // Count matches
        const matches = text.match(regex);
        const matchesRemoved = matches ? matches.length : 0;
        
        if (removeDelimiters) {
            // Remove everything including delimiters
            text = text.replace(regex, '');
        } else {
            // Keep delimiters, remove content inside
            // This is tricky with regex replace, we need to capture delimiters if we want to keep them
            // But regex matches the whole thing.
            // We can replace with startStr + endStr
            // But we need to respect case if case insensitive match found different case
            // For simplicity, we'll replace with the literal start/end strings provided by user
            text = text.replace(regex, startStr + endStr);
        }
        
        // Clean extra spaces
        if (cleanSpaces) {
            text = text.replace(/  +/g, ' ');
        }
        
        output.value = text;
        
        // Update stats
        const reduction = originalLength > 0 ? (((originalLength - text.length) / originalLength) * 100).toFixed(1) : 0;
        
        document.getElementById('originalChars').textContent = originalLength;
        document.getElementById('matchesRemoved').textContent = matchesRemoved;
        document.getElementById('finalChars').textContent = text.length;
        document.getElementById('reductionPercent').textContent = reduction + '%';
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setRemoveTextBetweenConverter(text => {
        removeTextBetween();
        return document.getElementById('removeTextBetween-output').value;
    });
</script>
@endpush
