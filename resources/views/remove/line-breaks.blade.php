@extends('layouts.tool')

@section('title', 'Remove Line Breaks - WordFix')

@section('tool-title', 'Remove Line Breaks')

@section('tool-description', 'Remove line breaks and join lines with custom separator')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-indigo-50 border border-indigo-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-3">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-xs font-medium text-gray-700 mb-1">Join With</label>
            <select id="separator" onchange="removeLineBreaks()" class="w-full px-3 py-2 text-sm border border-indigo-300 rounded focus:ring-2 focus:ring-indigo-500">
                <option value=" ">Space</option>
                <option value="">Nothing</option>
                <option value=", ">Comma + Space</option>
                <option value="; ">Semicolon + Space</option>
                <option value=" | ">Pipe + Spaces</option>
                <option value="custom">Custom...</option>
            </select>
        </div>
        
        <div class="flex-1 min-w-[200px] hidden" id="customSeparatorDiv">
            <label class="block text-xs font-medium text-gray-700 mb-1">Custom Separator</label>
            <input type="text" id="customSeparator" placeholder="Enter custom separator" 
                class="w-full px-3 py-2 text-sm border border-indigo-300 rounded focus:ring-2 focus:ring-indigo-500"
                oninput="removeLineBreaks()">
        </div>
        
        <div class="flex flex-wrap gap-2">
            <label class="flex items-center cursor-pointer bg-white border border-indigo-200 rounded px-3 py-1.5">
                <input type="checkbox" id="preserveParagraphs" class="w-4 h-4 text-indigo-600 rounded" onchange="removeLineBreaks()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Preserve Paragraphs</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-indigo-200 rounded px-3 py-1.5">
                <input type="checkbox" id="trimLines" class="w-4 h-4 text-indigo-600 rounded" checked onchange="removeLineBreaks()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Trim Lines</span>
            </label>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="removeLineBreaks"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Text with line breaks removed will appear here..."
    downloadFileName="no-line-breaks.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-3 gap-3">
    <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-indigo-600" id="originalLines">0</div>
        <div class="text-xs text-gray-600">Original Lines</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="finalLines">0</div>
        <div class="text-xs text-gray-600">Final Lines</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="removedBreaks">0</div>
        <div class="text-xs text-gray-600">Breaks Removed</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Remove Line Breaks</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Remove line breaks and join lines with custom separators. Perfect for converting multi-line text to single line, creating CSV data, or reformatting content.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Join lines with space, comma, or custom separator</li>
            <li>Preserve paragraph breaks (double line breaks)</li>
            <li>Automatic line trimming</li>
            <li>Multiple preset separators</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    // Show/hide custom separator input
    document.getElementById('separator').addEventListener('change', function() {
        const customDiv = document.getElementById('customSeparatorDiv');
        customDiv.classList.toggle('hidden', this.value !== 'custom');
        removeLineBreaks();
    });
    
    function removeLineBreaks() {
        const input = document.getElementById('removeLineBreaks-input');
        const output = document.getElementById('removeLineBreaks-output');
        if (!input || !output) return;
        
        let text = input.value;
        const separatorSelect = document.getElementById('separator').value;
        const customSeparator = document.getElementById('customSeparator')?.value || ' ';
        const preserveParagraphs = document.getElementById('preserveParagraphs')?.checked || false;
        const trimLines = document.getElementById('trimLines')?.checked || false;
        
        const separator = separatorSelect === 'custom' ? customSeparator : separatorSelect;
        
        let lines = text.split('\n');
        const originalLineCount = lines.length;
        
        if (trimLines) {
            lines = lines.map(line => line.trim());
        }
        
        if (preserveParagraphs) {
            // Join lines but preserve double line breaks (paragraphs)
            const paragraphs = text.split(/\n\n+/);
            const result = paragraphs.map(para => {
                const paraLines = para.split('\n').map(line => trimLines ? line.trim() : line);
                return paraLines.join(separator);
            }).join('\n\n');
            output.value = result;
        } else {
            // Join all lines
            output.value = lines.join(separator);
        }
        
        const finalLineCount = output.value.split('\n').length;
        const removed = originalLineCount - finalLineCount;
        
        document.getElementById('originalLines').textContent = originalLineCount;
        document.getElementById('finalLines').textContent = finalLineCount;
        document.getElementById('removedBreaks').textContent = removed;
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setRemoveLineBreaksConverter(text => {
        removeLineBreaks();
        return document.getElementById('removeLineBreaks-output').value;
    });
</script>
@endpush
