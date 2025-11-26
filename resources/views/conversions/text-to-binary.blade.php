@extends('layouts.tool')

@section('title', 'Text to Binary Code - WordFix')

@section('tool-title', 'Text to Binary Code')

@section('tool-description', 'Convert text to binary (010101) and vice versa')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-gray-50 border border-gray-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-3">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-xs font-medium text-gray-700 mb-1">Action</label>
            <select id="action" onchange="convertBinary()" class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-gray-500">
                <option value="toBinary">Text to Binary</option>
                <option value="toText">Binary to Text</option>
            </select>
        </div>
        
        <div class="flex flex-wrap gap-2 mt-5">
            <label class="flex items-center cursor-pointer bg-white border border-gray-200 rounded px-3 py-1.5">
                <input type="checkbox" id="separator" class="w-4 h-4 text-gray-600 rounded" checked onchange="convertBinary()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Space Separator</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-gray-200 rounded px-3 py-1.5">
                <input type="checkbox" id="padding" class="w-4 h-4 text-gray-600 rounded" checked onchange="convertBinary()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">8-bit Padding</span>
            </label>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="textToBinary"
    inputPlaceholder="Type your text or binary code here..."
    outputPlaceholder="Converted result will appear here..."
    downloadFileName="binary-code.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-gray-600" id="inputLen">0</div>
        <div class="text-xs text-gray-600">Input Length</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="outputLen">0</div>
        <div class="text-xs text-gray-600">Output Length</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="byteCount">0</div>
        <div class="text-xs text-gray-600">Byte Count</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Text to Binary Code</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Convert text into binary code (0s and 1s) representing ASCII/Unicode values, or decode binary back to text.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Convert Text to Binary</li>
            <li>Convert Binary to Text</li>
            <li>8-bit padding option (ensure 8 digits per byte)</li>
            <li>Space separator option</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function convertBinary() {
        const input = document.getElementById('textToBinary-input');
        const output = document.getElementById('textToBinary-output');
        if (!input || !output) return;
        
        let text = input.value;
        
        if (!text) {
            output.value = '';
            document.getElementById('statsSection').classList.add('hidden');
            return;
        }

        const action = document.getElementById('action')?.value || 'toBinary';
        const separator = document.getElementById('separator')?.checked || false;
        const padding = document.getElementById('padding')?.checked || false;
        
        let result = '';
        let byteCount = 0;
        
        if (action === 'toBinary') {
            let binaries = [];
            for (let i = 0; i < text.length; i++) {
                let bin = text.charCodeAt(i).toString(2);
                if (padding) {
                    while (bin.length < 8) bin = '0' + bin;
                }
                binaries.push(bin);
            }
            result = binaries.join(separator ? ' ' : '');
            byteCount = binaries.length;
        } else {
            // Binary to Text
            // Clean input
            const cleanBin = text.replace(/[^01]/g, '');
            // Split into 8-bit chunks if possible, or try to guess
            // If space separated, use that
            let binaries = [];
            if (text.includes(' ')) {
                binaries = text.trim().split(/\s+/);
            } else {
                // Assume 8-bit chunks
                binaries = cleanBin.match(/.{1,8}/g) || [];
            }
            
            for (let bin of binaries) {
                // Remove non-binary chars just in case
                bin = bin.replace(/[^01]/g, '');
                if (bin) {
                    result += String.fromCharCode(parseInt(bin, 2));
                    byteCount++;
                }
            }
        }
        
        output.value = result;
        
        // Update stats
        document.getElementById('inputLen').textContent = text.length;
        document.getElementById('outputLen').textContent = result.length;
        document.getElementById('byteCount').textContent = byteCount;
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setTextToBinaryConverter(text => {
        convertBinary();
        return document.getElementById('textToBinary-output').value;
    });
</script>
@endpush
