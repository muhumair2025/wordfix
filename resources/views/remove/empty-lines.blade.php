@extends('layouts.tool')

@section('title', 'Remove Empty Lines - WordFix')

@section('tool-title', 'Remove Empty Lines')

@section('tool-description', 'Remove empty, blank, and whitespace-only lines from text')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-green-50 border border-green-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-3">
        <div class="text-sm font-medium text-gray-700 flex items-center gap-2">
            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
            </svg>
            <span class="hidden sm:inline">Remove Mode</span>
        </div>
        
        <div class="flex flex-wrap gap-2">
            <label class="flex items-center cursor-pointer bg-white border border-green-200 rounded px-3 py-1.5">
                <input type="checkbox" id="removeEmpty" class="w-4 h-4 text-green-600 rounded" checked onchange="removeLines()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Empty Lines</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-green-200 rounded px-3 py-1.5">
                <input type="checkbox" id="removeWhitespace" class="w-4 h-4 text-green-600 rounded" checked onchange="removeLines()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Whitespace Only</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-green-200 rounded px-3 py-1.5">
                <input type="checkbox" id="trimLines" class="w-4 h-4 text-green-600 rounded" onchange="removeLines()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Trim Lines</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-green-200 rounded px-3 py-1.5">
                <input type="checkbox" id="collapseMultiple" class="w-4 h-4 text-green-600 rounded" onchange="removeLines()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Collapse Multiple</span>
            </label>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="removeEmptyLines"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Text with empty lines removed will appear here..."
    downloadFileName="no-empty-lines.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="originalLines">0</div>
        <div class="text-xs text-gray-600">Original Lines</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="remainingLines">0</div>
        <div class="text-xs text-gray-600">Remaining</div>
    </div>
    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-red-600" id="removedLines">0</div>
        <div class="text-xs text-gray-600">Removed</div>
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
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Remove Empty Lines</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Remove empty lines, whitespace-only lines, and collapse multiple blank lines into one. Perfect for cleaning code, text documents, and data files.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Remove completely empty lines</li>
            <li>Remove lines with only spaces/tabs</li>
            <li>Trim leading/trailing whitespace from lines</li>
            <li>Collapse multiple empty lines into one</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function removeLines() {
        const input = document.getElementById('removeEmptyLines-input');
        const output = document.getElementById('removeEmptyLines-output');
        if (!input || !output) return;
        
        const text = input.value;
        const removeEmpty = document.getElementById('removeEmpty')?.checked || false;
        const removeWhitespace = document.getElementById('removeWhitespace')?.checked || false;
        const trimLines = document.getElementById('trimLines')?.checked || false;
        const collapseMultiple = document.getElementById('collapseMultiple')?.checked || false;
        
        let lines = text.split('\n');
        const originalCount = lines.length;
        
        // Trim lines first if requested
        if (trimLines) {
            lines = lines.map(line => line.trim());
        }
        
        // Remove empty lines
        if (removeEmpty) {
            lines = lines.filter(line => line.length > 0);
        }
        
        // Remove whitespace-only lines
        if (removeWhitespace) {
            lines = lines.filter(line => line.trim().length > 0);
        }
        
        // Collapse multiple empty lines
        if (collapseMultiple && !removeEmpty) {
            const collapsed = [];
            let previousEmpty = false;
            
            lines.forEach(line => {
                const isEmpty = line.trim().length === 0;
                if (!isEmpty || !previousEmpty) {
                    collapsed.push(line);
                }
                previousEmpty = isEmpty;
            });
            
            lines = collapsed;
        }
        
        output.value = lines.join('\n');
        
        // Update stats
        const removed = originalCount - lines.length;
        const reduction = originalCount > 0 ? ((removed / originalCount) * 100).toFixed(1) : 0;
        
        document.getElementById('originalLines').textContent = originalCount;
        document.getElementById('remainingLines').textContent = lines.length;
        document.getElementById('removedLines').textContent = removed;
        document.getElementById('reductionPercent').textContent = reduction + '%';
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setRemoveEmptyLinesConverter(text => {
        removeLines();
        return document.getElementById('removeEmptyLines-output').value;
    });
</script>
@endpush
