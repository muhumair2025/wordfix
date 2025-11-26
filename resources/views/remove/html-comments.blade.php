@extends('layouts.tool')

@section('title', 'Remove HTML Comments - WordFix')

@section('tool-title', 'Remove HTML Comments')

@section('tool-description', 'Remove HTML comments while keeping the rest of the code intact')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-violet-50 border border-violet-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-2">
        <label class="flex items-center cursor-pointer bg-white border border-violet-200 rounded px-3 py-1.5">
            <input type="checkbox" id="singleLine" class="w-4 h-4 text-violet-600 rounded" checked onchange="removeComments()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Single Line (&lt;!-- --&gt;)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-violet-200 rounded px-3 py-1.5">
            <input type="checkbox" id="multiLine" class="w-4 h-4 text-violet-600 rounded" checked onchange="removeComments()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Multi-line Comments</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-violet-200 rounded px-3 py-1.5">
            <input type="checkbox" id="conditional" class="w-4 h-4 text-violet-600 rounded" onchange="removeComments()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Conditional (&lt;!--[if IE]&gt;)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-violet-200 rounded px-3 py-1.5">
            <input type="checkbox" id="removeEmptyLines" class="w-4 h-4 text-violet-600 rounded" onchange="removeComments()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Remove Empty Lines</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-violet-200 rounded px-3 py-1.5">
            <input type="checkbox" id="trimLines" class="w-4 h-4 text-violet-600 rounded" onchange="removeComments()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Trim Lines</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="removeHtmlComments"
    inputPlaceholder="Paste your HTML code here..."
    outputPlaceholder="HTML without comments will appear here..."
    downloadFileName="no-comments.html"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-violet-50 border border-violet-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-violet-600" id="commentsRemoved">0</div>
        <div class="text-xs text-gray-600">Comments Removed</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="originalChars">0</div>
        <div class="text-xs text-gray-600">Original Chars</div>
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
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Remove HTML Comments</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Remove HTML comments from code while preserving the rest of your markup. Perfect for cleaning production code, reducing file size, or removing developer notes.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Remove single-line HTML comments</li>
            <li>Remove multi-line comments</li>
            <li>Remove conditional comments (IE-specific)</li>
            <li>Option to remove resulting empty lines</li>
            <li>Trim whitespace from lines</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Comment Types</h3>
        <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm space-y-1">
            <div><strong>Standard:</strong> &lt;!-- comment --&gt;</div>
            <div><strong>Multi-line:</strong> &lt;!-- line 1<br>&nbsp;&nbsp;&nbsp;&nbsp;line 2 --&gt;</div>
            <div><strong>Conditional:</strong> &lt;!--[if IE]&gt; ... &lt;![endif]--&gt;</div>
        </div>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function removeComments() {
        const input = document.getElementById('removeHtmlComments-input');
        const output = document.getElementById('removeHtmlComments-output');
        if (!input || !output) return;
        
        let text = input.value;
        const originalLength = text.length;
        
        const removeSingleLine = document.getElementById('singleLine')?.checked || false;
        const removeMultiLine = document.getElementById('multiLine')?.checked || false;
        const removeConditional = document.getElementById('conditional')?.checked || false;
        const removeEmptyLines = document.getElementById('removeEmptyLines')?.checked || false;
        const trimLines = document.getElementById('trimLines')?.checked || false;
        
        let commentsRemoved = 0;
        
        // Remove conditional comments (IE-specific)
        if (removeConditional) {
            const conditionalMatches = text.match(/<!--\[if[\s\S]*?<!\[endif\]-->/gi);
            commentsRemoved += conditionalMatches ? conditionalMatches.length : 0;
            text = text.replace(/<!--\[if[\s\S]*?<!\[endif\]-->/gi, '');
        }
        
        // Remove multi-line and single-line comments
        if (removeSingleLine || removeMultiLine) {
            const commentMatches = text.match(/<!--[\s\S]*?-->/g);
            commentsRemoved += commentMatches ? commentMatches.length : 0;
            text = text.replace(/<!--[\s\S]*?-->/g, '');
        }
        
        // Trim lines
        if (trimLines) {
            text = text.split('\n').map(line => line.trim()).join('\n');
        }
        
        // Remove empty lines
        if (removeEmptyLines) {
            text = text.split('\n').filter(line => line.trim().length > 0).join('\n');
        }
        
        output.value = text;
        
        // Update stats
        const reduction = originalLength > 0 ? (((originalLength - text.length) / originalLength) * 100).toFixed(1) : 0;
        
        document.getElementById('commentsRemoved').textContent = commentsRemoved;
        document.getElementById('originalChars').textContent = originalLength;
        document.getElementById('finalChars').textContent = text.length;
        document.getElementById('reductionPercent').textContent = reduction + '%';
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setRemoveHtmlCommentsConverter(text => {
        removeComments();
        return document.getElementById('removeHtmlComments-output').value;
    });
</script>
@endpush
