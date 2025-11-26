@extends('layouts.tool')

@section('title', 'Remove Tabs - WordFix')

@section('tool-title', 'Remove Tabs')

@section('tool-description', 'Remove tab characters or convert them to spaces')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-indigo-50 border border-indigo-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-3">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-xs font-medium text-gray-700 mb-1">Action</label>
            <select id="action" onchange="removeTabs()" class="w-full px-3 py-2 text-sm border border-indigo-300 rounded focus:ring-2 focus:ring-indigo-500">
                <option value="remove">Remove Completely</option>
                <option value="space">Replace with 1 Space</option>
                <option value="2spaces">Replace with 2 Spaces</option>
                <option value="4spaces">Replace with 4 Spaces</option>
            </select>
        </div>
        
        <div class="flex flex-wrap gap-2">
            <label class="flex items-center cursor-pointer bg-white border border-indigo-200 rounded px-3 py-1.5">
                <input type="checkbox" id="cleanSpaces" class="w-4 h-4 text-indigo-600 rounded" checked onchange="removeTabs()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Clean Extra Spaces</span>
            </label>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="removeTabs"
    inputPlaceholder="Paste your text with tabs here..."
    outputPlaceholder="Text with tabs removed/converted will appear here..."
    downloadFileName="no-tabs.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-indigo-600" id="originalChars">0</div>
        <div class="text-xs text-gray-600">Original Chars</div>
    </div>
    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-red-600" id="tabsFound">0</div>
        <div class="text-xs text-gray-600">Tabs Found</div>
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
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Remove Tabs</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Remove tab characters from text or convert them to spaces. Essential for fixing indentation issues or cleaning up code snippets.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Remove tabs completely</li>
            <li>Convert tabs to single space</li>
            <li>Convert tabs to 2 spaces (code style)</li>
            <li>Convert tabs to 4 spaces (code style)</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function removeTabs() {
        const input = document.getElementById('removeTabs-input');
        const output = document.getElementById('removeTabs-output');
        if (!input || !output) return;
        
        let text = input.value;
        const originalLength = text.length;
        
        const action = document.getElementById('action')?.value || 'remove';
        const cleanSpaces = document.getElementById('cleanSpaces')?.checked || false;
        
        // Count tabs
        const matches = text.match(/\t/g);
        const tabsFound = matches ? matches.length : 0;
        
        // Perform action
        if (action === 'remove') {
            text = text.replace(/\t/g, '');
        } else if (action === 'space') {
            text = text.replace(/\t/g, ' ');
        } else if (action === '2spaces') {
            text = text.replace(/\t/g, '  ');
        } else if (action === '4spaces') {
            text = text.replace(/\t/g, '    ');
        }
        
        // Clean extra spaces
        if (cleanSpaces) {
            text = text.replace(/  +/g, ' ');
        }
        
        output.value = text;
        
        // Update stats
        const reduction = originalLength > 0 ? (((originalLength - text.length) / originalLength) * 100).toFixed(1) : 0;
        
        document.getElementById('originalChars').textContent = originalLength;
        document.getElementById('tabsFound').textContent = tabsFound;
        document.getElementById('finalChars').textContent = text.length;
        document.getElementById('reductionPercent').textContent = reduction + '%';
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setRemoveTabsConverter(text => {
        removeTabs();
        return document.getElementById('removeTabs-output').value;
    });
</script>
@endpush
