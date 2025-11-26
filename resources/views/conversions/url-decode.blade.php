@extends('layouts.tool')

@section('title', 'URL Decode - WordFix')

@section('tool-title', 'URL Decode')

@section('tool-description', 'Decode URL-encoded strings')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-cyan-50 border border-cyan-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-2">
        <label class="flex items-center cursor-pointer bg-white border border-cyan-200 rounded px-3 py-1.5">
            <input type="checkbox" id="decodePlus" class="w-4 h-4 text-cyan-600 rounded" checked onchange="decodeUrl()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Decode Plus (+) as Space</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-cyan-200 rounded px-3 py-1.5">
            <input type="checkbox" id="recursive" class="w-4 h-4 text-cyan-600 rounded" onchange="decodeUrl()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Recursive Decoding (Multiple Passes)</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="urlDecode"
    inputPlaceholder="Paste your URL encoded string here..."
    outputPlaceholder="Decoded text will appear here..."
    downloadFileName="decoded-url.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-cyan-50 border border-cyan-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-cyan-600" id="originalChars">0</div>
        <div class="text-xs text-gray-600">Original Chars</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="finalChars">0</div>
        <div class="text-xs text-gray-600">Final Chars</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="passes">1</div>
        <div class="text-xs text-gray-600">Decoding Passes</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About URL Decode</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Decode URL-encoded strings back to normal text. Handles standard percent-encoding and plus signs.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Decode standard URL encoding (%20, %3A, etc.)</li>
            <li>Option to decode plus signs (+) as spaces</li>
            <li>Recursive decoding for double-encoded strings</li>
            <li>UTF-8 support</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function decodeUrl() {
        const input = document.getElementById('urlDecode-input');
        const output = document.getElementById('urlDecode-output');
        if (!input || !output) return;
        
        let text = input.value;
        const originalLength = text.length;
        
        if (!text) {
            output.value = '';
            document.getElementById('statsSection').classList.add('hidden');
            return;
        }

        const decodePlus = document.getElementById('decodePlus')?.checked || false;
        const recursive = document.getElementById('recursive')?.checked || false;
        
        let result = text;
        let passes = 0;
        const maxPasses = 5; // Prevent infinite loops
        
        try {
            do {
                let prevResult = result;
                
                if (decodePlus) {
                    result = result.replace(/\+/g, ' ');
                }
                
                result = decodeURIComponent(result);
                passes++;
                
                if (!recursive || result === prevResult || passes >= maxPasses) break;
                
            } while (true);
            
            output.value = result;
            
            // Update stats
            document.getElementById('originalChars').textContent = originalLength;
            document.getElementById('finalChars').textContent = result.length;
            document.getElementById('passes').textContent = passes;
            document.getElementById('statsSection').classList.remove('hidden');
            
        } catch (e) {
            output.value = "Error: Invalid URL encoding";
        }
    }
    
    setUrlDecodeConverter(text => {
        decodeUrl();
        return document.getElementById('urlDecode-output').value;
    });
</script>
@endpush
