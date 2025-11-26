@extends('layouts.tool')

@section('title', 'Base64 Encoder - WordFix')

@section('tool-title', 'Base64 Encoder')

@section('tool-description', 'Encode text to Base64 format')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-blue-50 border border-blue-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-2">
        <label class="flex items-center cursor-pointer bg-white border border-blue-200 rounded px-3 py-1.5">
            <input type="checkbox" id="urlSafe" class="w-4 h-4 text-blue-600 rounded" onchange="encodeBase64()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">URL Safe Encoding</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-blue-200 rounded px-3 py-1.5">
            <input type="checkbox" id="splitLines" class="w-4 h-4 text-blue-600 rounded" onchange="encodeBase64()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Split Lines (76 chars)</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="base64Encoder"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Base64 encoded string will appear here..."
    downloadFileName="encoded-base64.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="inputSize">0</div>
        <div class="text-xs text-gray-600">Input Size (Bytes)</div>
    </div>
    <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-indigo-600" id="outputSize">0</div>
        <div class="text-xs text-gray-600">Output Size (Bytes)</div>
    </div>
    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-red-600" id="expansionRatio">0%</div>
        <div class="text-xs text-gray-600">Size Increase</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Base64 Encoder</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Encode text into Base64 format. Useful for data transmission, embedding images, or basic obfuscation.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Standard Base64 encoding</li>
            <li>URL-safe encoding (using -_ instead of +/)</li>
            <li>Option to split output into 76-character lines (MIME standard)</li>
            <li>UTF-8 character support</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function encodeBase64() {
        const input = document.getElementById('base64Encoder-input');
        const output = document.getElementById('base64Encoder-output');
        if (!input || !output) return;
        
        let text = input.value;
        
        if (!text) {
            output.value = '';
            document.getElementById('statsSection').classList.add('hidden');
            return;
        }

        const urlSafe = document.getElementById('urlSafe')?.checked || false;
        const splitLines = document.getElementById('splitLines')?.checked || false;
        
        try {
            // Encode
            // Using btoa(unescape(encodeURIComponent(str))) to handle UTF-8 correctly
            let encoded = window.btoa(unescape(encodeURIComponent(text)));
            
            if (urlSafe) {
                encoded = encoded.replace(/\+/g, '-').replace(/\//g, '_').replace(/=+$/, '');
            }
            
            if (splitLines) {
                encoded = encoded.match(/.{1,76}/g).join('\n');
            }
            
            output.value = encoded;
            
            // Update stats
            const inputLen = new Blob([text]).size;
            const outputLen = new Blob([encoded]).size;
            const expansion = inputLen > 0 ? (((outputLen - inputLen) / inputLen) * 100).toFixed(1) : 0;
            
            document.getElementById('inputSize').textContent = inputLen;
            document.getElementById('outputSize').textContent = outputLen;
            document.getElementById('expansionRatio').textContent = '+' + expansion + '%';
            document.getElementById('statsSection').classList.remove('hidden');
            
        } catch (e) {
            output.value = "Error: Encoding failed";
        }
    }
    
    setBase64EncoderConverter(text => {
        encodeBase64();
        return document.getElementById('base64Encoder-output').value;
    });
</script>
@endpush
