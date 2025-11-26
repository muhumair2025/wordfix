@extends('layouts.tool')

@section('title', 'Replace New Line with Commas - WordFix')

@section('tool-title', 'Replace New Line with Commas')

@section('tool-description', 'Convert line breaks to commas or other custom separators')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-indigo-50 border border-indigo-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-3">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-xs font-medium text-gray-700 mb-1">Separator</label>
            <div class="flex gap-2">
                <select id="separatorType" onchange="toggleCustomSeparator()" class="w-full px-3 py-2 text-sm border border-indigo-300 rounded focus:ring-2 focus:ring-indigo-500">
                    <option value=", ">Comma + Space (, )</option>
                    <option value=",">Comma (,)</option>
                    <option value=";">Semicolon (;)</option>
                    <option value="; ">Semicolon + Space (; )</option>
                    <option value="|">Pipe (|)</option>
                    <option value=" ">Space ( )</option>
                    <option value="">None (Join Lines)</option>
                    <option value="custom">Custom...</option>
                </select>
                <input type="text" id="customSeparator" placeholder="Custom" class="hidden w-24 px-3 py-2 text-sm border border-indigo-300 rounded focus:ring-2 focus:ring-indigo-500" oninput="replaceNewLines()">
            </div>
        </div>
        
        <div class="flex flex-wrap gap-2 mt-5">
            <label class="flex items-center cursor-pointer bg-white border border-indigo-200 rounded px-3 py-1.5">
                <input type="checkbox" id="ignoreEmpty" class="w-4 h-4 text-indigo-600 rounded" checked onchange="replaceNewLines()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Ignore Empty Lines</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-indigo-200 rounded px-3 py-1.5">
                <input type="checkbox" id="trimLines" class="w-4 h-4 text-indigo-600 rounded" checked onchange="replaceNewLines()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Trim Lines First</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-indigo-200 rounded px-3 py-1.5">
                <input type="checkbox" id="quoteItems" class="w-4 h-4 text-indigo-600 rounded" onchange="replaceNewLines()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Quote Items ("item")</span>
            </label>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="replaceNewLines"
    inputPlaceholder="Paste your list here (one item per line)..."
    outputPlaceholder="Comma separated text will appear here..."
    downloadFileName="comma-separated.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-indigo-600" id="originalLines">0</div>
        <div class="text-xs text-gray-600">Original Lines</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="itemsJoined">0</div>
        <div class="text-xs text-gray-600">Items Joined</div>
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
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Replace New Line with Commas</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Convert vertical lists into comma-separated strings or other formats. Perfect for SQL queries, array generation, or data formatting.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Convert newlines to commas, semicolons, pipes, or spaces</li>
            <li>Custom separator support</li>
            <li>Option to quote each item (e.g., "item1", "item2")</li>
            <li>Ignore empty lines</li>
            <li>Trim whitespace from each line</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function toggleCustomSeparator() {
        const type = document.getElementById('separatorType').value;
        const customInput = document.getElementById('customSeparator');
        if (type === 'custom') {
            customInput.classList.remove('hidden');
            customInput.focus();
        } else {
            customInput.classList.add('hidden');
        }
        replaceNewLines();
    }

    function replaceNewLines() {
        const input = document.getElementById('replaceNewLines-input');
        const output = document.getElementById('replaceNewLines-output');
        if (!input || !output) return;
        
        const text = input.value;
        const originalLength = text.length;
        
        const separatorType = document.getElementById('separatorType')?.value;
        const customSeparator = document.getElementById('customSeparator')?.value;
        const ignoreEmpty = document.getElementById('ignoreEmpty')?.checked || false;
        const trimLines = document.getElementById('trimLines')?.checked || false;
        const quoteItems = document.getElementById('quoteItems')?.checked || false;
        
        let separator = separatorType === 'custom' ? customSeparator : separatorType;
        
        let lines = text.split('\n');
        const originalLines = lines.length;
        
        if (trimLines) {
            lines = lines.map(line => line.trim());
        }
        
        if (ignoreEmpty) {
            lines = lines.filter(line => line.length > 0);
        }
        
        if (quoteItems) {
            lines = lines.map(line => `"${line}"`);
        }
        
        const result = lines.join(separator);
        output.value = result;
        
        // Update stats
        const reduction = originalLength > 0 ? (((originalLength - result.length) / originalLength) * 100).toFixed(1) : 0;
        
        document.getElementById('originalLines').textContent = originalLines;
        document.getElementById('itemsJoined').textContent = lines.length;
        document.getElementById('finalChars').textContent = result.length;
        document.getElementById('reductionPercent').textContent = reduction + '%';
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setReplaceNewLinesConverter(text => {
        replaceNewLines();
        return document.getElementById('replaceNewLines-output').value;
    });
</script>
@endpush
