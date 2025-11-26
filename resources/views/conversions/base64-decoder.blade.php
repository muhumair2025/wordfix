@extends('layouts.tool')

@section('title', 'Base64 Decoder - WordFix')

@section('tool-title', 'Base64 Decoder')

@section('tool-description', 'Decode Base64 strings back to text')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-indigo-50 border border-indigo-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-2">
        <label class="flex items-center cursor-pointer bg-white border border-indigo-200 rounded px-3 py-1.5">
            <input type="checkbox" id="urlSafe" class="w-4 h-4 text-indigo-600 rounded" onchange="decodeBase64()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">URL Safe Decoding</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-indigo-200 rounded px-3 py-1.5">
            <input type="checkbox" id="autoFix" class="w-4 h-4 text-indigo-600 rounded" checked onchange="decodeBase64()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Auto-fix Padding</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-indigo-200 rounded px-3 py-1.5">
            <input type="checkbox" id="liveDecode" class="w-4 h-4 text-indigo-600 rounded" checked onchange="decodeBase64()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Live Decode</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="base64Decoder"
    inputPlaceholder="Paste your Base64 string here..."
    outputPlaceholder="Decoded text will appear here..."
    downloadFileName="decoded-text.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-indigo-600" id="inputSize">0</div>
        <div class="text-xs text-gray-600">Input Size (Bytes)</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="outputSize">0</div>
        <div class="text-xs text-gray-600">Output Size (Bytes)</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="compressionRatio">0%</div>
        <div class="text-xs text-gray-600">Size Reduction</div>
    </div>
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-purple-600" id="validBase64">Yes</div>
        <div class="text-xs text-gray-600">Valid Base64</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Base64 Decoder</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Decode Base64 encoded strings back to their original text format. Supports standard and URL-safe Base64 variants.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Instant decoding</li>
            <li>Support for URL-safe Base64 (replacing -_ with +/)</li>
            <li>Auto-fix missing padding (=)</li>
            <li>Validation status</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function decodeBase64() {
        const input = document.getElementById('base64Decoder-input');
        const output = document.getElementById('base64Decoder-output');
        if (!input || !output) return;
        
        let text = input.value.trim();
        const originalLength = text.length;
        
        if (!text) {
            output.value = '';
            document.getElementById('statsSection').classList.add('hidden');
            return;
        }

        const urlSafe = document.getElementById('urlSafe')?.checked || false;
        const autoFix = document.getElementById('autoFix')?.checked || false;
        
        // Helper function to decode a single string
        const decodeString = (str) => {
            try {
                let s = str.trim();
                if (!s) return '';
                
                if (urlSafe) {
                    s = s.replace(/-/g, '+').replace(/_/g, '/');
                }
                
                if (autoFix) {
                    while (s.length % 4) {
                        s += '=';
                    }
                }
                
                return decodeURIComponent(escape(window.atob(s)));
            } catch (e) {
                return '[Error: Invalid Base64]';
            }
        };

        try {
            let result = '';
            let validCount = 0;
            let totalCount = 0;
            
            // Check if multi-line
            if (text.includes('\n')) {
                const lines = text.split('\n');
                const decodedLines = lines.map(line => {
                    if (!line.trim()) return '';
                    totalCount++;
                    const decoded = decodeString(line);
                    if (decoded !== '[Error: Invalid Base64]') validCount++;
                    return decoded;
                });
                result = decodedLines.join('\n');
            } else {
                totalCount = 1;
                result = decodeString(text);
                if (result !== '[Error: Invalid Base64]') validCount++;
            }
            
            output.value = result;
            
            // Update stats
            const outputLen = new Blob([result]).size; 
            const inputLen = new Blob([input.value]).size;
            const reduction = inputLen > 0 ? (((inputLen - outputLen) / inputLen) * 100).toFixed(1) : 0;
            
            document.getElementById('inputSize').textContent = inputLen;
            document.getElementById('outputSize').textContent = outputLen;
            document.getElementById('compressionRatio').textContent = reduction + '%';
            
            const validLabel = document.getElementById('validBase64');
            if (validCount === totalCount && totalCount > 0) {
                validLabel.textContent = 'Yes';
                validLabel.className = 'text-xl font-bold text-green-600';
            } else if (validCount > 0) {
                validLabel.textContent = `Partial (${validCount}/${totalCount})`;
                validLabel.className = 'text-xl font-bold text-yellow-600';
            } else {
                validLabel.textContent = 'No';
                validLabel.className = 'text-xl font-bold text-red-600';
            }
            
            document.getElementById('statsSection').classList.remove('hidden');
            
        } catch (e) {
            output.value = "Error: Processing failed";
            document.getElementById('statsSection').classList.add('hidden');
        }
    }
    
    setBase64DecoderConverter(text => {
        decodeBase64();
        return document.getElementById('base64Decoder-output').value;
    });
</script>
@endpush
