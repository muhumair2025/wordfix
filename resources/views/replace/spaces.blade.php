@extends('layouts.tool')

@section('title', 'Replace Spaces - WordFix')

@section('tool-title', 'Replace Spaces')

@section('tool-description', 'Replace spaces with other characters or strings')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-purple-50 border border-purple-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-3">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-xs font-medium text-gray-700 mb-1">Replace With</label>
            <div class="flex gap-2">
                <select id="replaceType" onchange="toggleCustomReplace()" class="w-full px-3 py-2 text-sm border border-purple-300 rounded focus:ring-2 focus:ring-purple-500">
                    <option value="-">Hyphen (-)</option>
                    <option value="_">Underscore (_)</option>
                    <option value=",">Comma (,)</option>
                    <option value=".">Dot (.)</option>
                    <option value="%20">URL Encoded (%20)</option>
                    <option value="+">Plus (+)</option>
                    <option value="">Nothing (Remove)</option>
                    <option value="custom">Custom...</option>
                </select>
                <input type="text" id="customReplace" placeholder="Custom" class="hidden w-24 px-3 py-2 text-sm border border-purple-300 rounded focus:ring-2 focus:ring-purple-500" oninput="replaceSpaces()">
            </div>
        </div>
        
        <div class="flex flex-wrap gap-2 mt-5">
            <label class="flex items-center cursor-pointer bg-white border border-purple-200 rounded px-3 py-1.5">
                <input type="checkbox" id="cleanMultiple" class="w-4 h-4 text-purple-600 rounded" checked onchange="replaceSpaces()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Clean Multiple Spaces First</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-purple-200 rounded px-3 py-1.5">
                <input type="checkbox" id="includeTabs" class="w-4 h-4 text-purple-600 rounded" checked onchange="replaceSpaces()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Include Tabs</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-purple-200 rounded px-3 py-1.5">
                <input type="checkbox" id="includeLineBreaks" class="w-4 h-4 text-purple-600 rounded" onchange="replaceSpaces()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Include Line Breaks</span>
            </label>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="replaceSpaces"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Text with spaces replaced will appear here..."
    downloadFileName="replaced-spaces.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-purple-600" id="originalChars">0</div>
        <div class="text-xs text-gray-600">Original Chars</div>
    </div>
    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-red-600" id="spacesReplaced">0</div>
        <div class="text-xs text-gray-600">Spaces Replaced</div>
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
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Replace Spaces</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Replace spaces in your text with any other character or string. Useful for creating URL slugs, variable names, or formatting data.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Replace spaces with hyphens, underscores, commas, etc.</li>
            <li>Custom replacement string support</li>
            <li>Option to clean multiple spaces first (avoid double replacements)</li>
            <li>Include tabs and line breaks in replacement</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function toggleCustomReplace() {
        const type = document.getElementById('replaceType').value;
        const customInput = document.getElementById('customReplace');
        if (type === 'custom') {
            customInput.classList.remove('hidden');
            customInput.focus();
        } else {
            customInput.classList.add('hidden');
        }
        replaceSpaces();
    }

    function replaceSpaces() {
        const input = document.getElementById('replaceSpaces-input');
        const output = document.getElementById('replaceSpaces-output');
        if (!input || !output) return;
        
        let text = input.value;
        const originalLength = text.length;
        
        const replaceType = document.getElementById('replaceType')?.value;
        const customReplace = document.getElementById('customReplace')?.value;
        const cleanMultiple = document.getElementById('cleanMultiple')?.checked || false;
        const includeTabs = document.getElementById('includeTabs')?.checked || false;
        const includeLineBreaks = document.getElementById('includeLineBreaks')?.checked || false;
        
        let replacement = replaceType === 'custom' ? customReplace : replaceType;
        
        // Clean multiple spaces first if requested
        if (cleanMultiple) {
            text = text.replace(/  +/g, ' ');
        }
        
        // Build regex for what to replace
        let pattern = ' ';
        if (includeTabs) pattern += '\\t';
        if (includeLineBreaks) pattern += '\\r\\n';
        
        const regex = new RegExp(`[${pattern}]`, 'g');
        
        // Count matches
        const matches = text.match(regex);
        const spacesReplaced = matches ? matches.length : 0;
        
        // Replace
        text = text.replace(regex, replacement);
        
        output.value = text;
        
        // Update stats
        const change = originalLength > 0 ? (((text.length - originalLength) / originalLength) * 100).toFixed(1) : 0;
        const changeText = change > 0 ? `+${change}%` : `${change}%`;
        
        document.getElementById('originalChars').textContent = originalLength;
        document.getElementById('spacesReplaced').textContent = spacesReplaced;
        document.getElementById('finalChars').textContent = text.length;
        document.getElementById('changePercent').textContent = changeText;
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setReplaceSpacesConverter(text => {
        replaceSpaces();
        return document.getElementById('replaceSpaces-output').value;
    });
</script>
@endpush
