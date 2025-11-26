@extends('layouts.tool')

@section('title', 'Remove HTML Tags - WordFix')

@section('tool-title', 'Remove HTML Tags')

@section('tool-description', 'Remove HTML tags and extract clean text from markup')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-pink-50 border border-pink-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-2">
        <label class="flex items-center cursor-pointer bg-white border border-pink-200 rounded px-3 py-1.5">
            <input type="checkbox" id="allTags" class="w-4 h-4 text-pink-600 rounded" checked onchange="removeHtmlTags()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">All HTML Tags</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-pink-200 rounded px-3 py-1.5">
            <input type="checkbox" id="attributes" class="w-4 h-4 text-pink-600 rounded" checked onchange="removeHtmlTags()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Attributes</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-pink-200 rounded px-3 py-1.5">
            <input type="checkbox" id="comments" class="w-4 h-4 text-pink-600 rounded" checked onchange="removeHtmlTags()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Comments</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-pink-200 rounded px-3 py-1.5">
            <input type="checkbox" id="scripts" class="w-4 h-4 text-pink-600 rounded" checked onchange="removeHtmlTags()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Scripts/Styles</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-pink-200 rounded px-3 py-1.5">
            <input type="checkbox" id="entities" class="w-4 h-4 text-pink-600 rounded" onchange="removeHtmlTags()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Decode Entities</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-pink-200 rounded px-3 py-1.5">
            <input type="checkbox" id="preserveLineBreaks" class="w-4 h-4 text-pink-600 rounded" onchange="removeHtmlTags()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Preserve Line Breaks</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="removeHtmlTags"
    inputPlaceholder="Paste your HTML here..."
    outputPlaceholder="Clean text will appear here..."
    downloadFileName="clean-text.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-pink-50 border border-pink-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-pink-600" id="tagsRemoved">0</div>
        <div class="text-xs text-gray-600">Tags Removed</div>
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
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Remove HTML Tags</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Remove HTML tags and extract clean text from web pages, emails, or any HTML content. Perfect for content extraction and text cleaning.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Remove all HTML tags</li>
            <li>Remove tag attributes</li>
            <li>Remove HTML comments</li>
            <li>Remove script and style blocks</li>
            <li>Decode HTML entities (&amp;nbsp; → space)</li>
            <li>Preserve paragraph breaks</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function removeHtmlTags() {
        const input = document.getElementById('removeHtmlTags-input');
        const output = document.getElementById('removeHtmlTags-output');
        if (!input || !output) return;
        
        let text = input.value;
        const originalLength = text.length;
        let tagsRemoved = 0;
        
        const removeAll = document.getElementById('allTags')?.checked || false;
        const removeAttributes = document.getElementById('attributes')?.checked || false;
        const removeComments = document.getElementById('comments')?.checked || false;
        const removeScripts = document.getElementById('scripts')?.checked || false;
        const decodeEntities = document.getElementById('entities')?.checked || false;
        const preserveLineBreaks = document.getElementById('preserveLineBreaks')?.checked || false;
        
        // Preserve line breaks by converting <br> and block elements to newlines
        if (preserveLineBreaks) {
            text = text.replace(/<br\s*\/?>/gi, '\n');
            text = text.replace(/<\/(p|div|h[1-6]|li|tr)>/gi, '\n');
        }
        
        // Remove script and style content
        if (removeScripts) {
            text = text.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, '');
            text = text.replace(/<style\b[^<]*(?:(?!<\/style>)<[^<]*)*<\/style>/gi, '');
        }
        
        // Remove HTML comments
        if (removeComments) {
            const commentMatches = text.match(/<!--[\s\S]*?-->/g);
            tagsRemoved += commentMatches ? commentMatches.length : 0;
            text = text.replace(/<!--[\s\S]*?-->/g, '');
        }
        
        // Count tags
        const tagMatches = text.match(/<[^>]+>/g);
        tagsRemoved += tagMatches ? tagMatches.length : 0;
        
        // Remove all HTML tags
        if (removeAll) {
            text = text.replace(/<[^>]+>/g, '');
        } else if (removeAttributes) {
            // Just remove attributes, keep tags
            text = text.replace(/<(\w+)[^>]*>/g, '<$1>');
        }
        
        // Decode HTML entities
        if (decodeEntities) {
            const entities = {
                '&nbsp;': ' ',
                '&amp;': '&',
                '&lt;': '<',
                '&gt;': '>',
                '&quot;': '"',
                '&#39;': "'",
                '&apos;': "'",
                '&cent;': '¢',
                '&pound;': '£',
                '&yen;': '¥',
                '&euro;': '€',
                '&copy;': '©',
                '&reg;': '®'
            };
            
            for (const [entity, char] of Object.entries(entities)) {
                text = text.replace(new RegExp(entity, 'g'), char);
            }
            
            // Decode numeric entities
            text = text.replace(/&#(\d+);/g, (match, dec) => String.fromCharCode(dec));
            text = text.replace(/&#x([0-9a-f]+);/gi, (match, hex) => String.fromCharCode(parseInt(hex, 16)));
        }
        
        // Clean up multiple line breaks
        if (preserveLineBreaks) {
            text = text.replace(/\n{3,}/g, '\n\n');
        }
        
        // Clean up extra spaces
        text = text.replace(/  +/g, ' ');
        text = text.trim();
        
        output.value = text;
        
        // Update stats
        const reduction = originalLength > 0 ? (((originalLength - text.length) / originalLength) * 100).toFixed(1) : 0;
        
        document.getElementById('tagsRemoved').textContent = tagsRemoved;
        document.getElementById('originalChars').textContent = originalLength;
        document.getElementById('finalChars').textContent = text.length;
        document.getElementById('reductionPercent').textContent = reduction + '%';
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setRemoveHtmlTagsConverter(text => {
        removeHtmlTags();
        return document.getElementById('removeHtmlTags-output').value;
    });
</script>
@endpush
