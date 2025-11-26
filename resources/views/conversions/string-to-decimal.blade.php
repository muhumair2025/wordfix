@extends('layouts.tool')

@section('title', 'String to Decimal - WordFix')

@section('tool-title', 'String to Decimal')

@section('tool-description', 'Convert text to decimal (ASCII/Unicode) values')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-pink-50 border border-pink-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-3">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-xs font-medium text-gray-700 mb-1">Delimiter</label>
            <select id="delimiter" onchange="convertString()" class="w-full px-3 py-2 text-sm border border-pink-300 rounded focus:ring-2 focus:ring-pink-500">
                <option value=" ">Space</option>
                <option value=",">Comma (,)</option>
                <option value=", ">Comma + Space (, )</option>
                <option value=";">Semicolon (;)</option>
                <option value="">None</option>
            </select>
        </div>
        <div class="flex flex-wrap gap-2 mt-5">
            <label class="flex items-center cursor-pointer bg-white border border-pink-200 rounded px-3 py-1.5">
                <input type="checkbox" id="padding" class="w-4 h-4 text-pink-600 rounded" onchange="convertString()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Pad with Zeros (065)</span>
            </label>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="stringToDecimal"
    inputPlaceholder="Type your text here..."
    outputPlaceholder="Decimal values will appear here..."
    downloadFileName="decimal-values.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-pink-50 border border-pink-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-pink-600" id="originalChars">0</div>
        <div class="text-xs text-gray-600">Original Chars</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="valuesGenerated">0</div>
        <div class="text-xs text-gray-600">Values Generated</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About String to Decimal</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Convert text characters into their corresponding ASCII or Unicode decimal values.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Convert any character to decimal</li>
            <li>Custom delimiters (space, comma, etc.)</li>
            <li>Optional zero padding</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function convertString() {
        const input = document.getElementById('stringToDecimal-input');
        const output = document.getElementById('stringToDecimal-output');
        if (!input || !output) return;
        
        let text = input.value;
        const originalLength = text.length;
        
        if (!text) {
            output.value = '';
            document.getElementById('statsSection').classList.add('hidden');
            return;
        }

        const delimiter = document.getElementById('delimiter')?.value || ' ';
        const padding = document.getElementById('padding')?.checked || false;
        
        let result = [];
        
        for (let i = 0; i < text.length; i++) {
            let code = text.charCodeAt(i).toString();
            
            if (padding) {
                // Pad to 3 digits for standard ASCII, maybe more for unicode
                while (code.length < 3) code = '0' + code;
            }
            
            result.push(code);
        }
        
        output.value = result.join(delimiter);
        
        // Update stats
        document.getElementById('originalChars').textContent = originalLength;
        document.getElementById('valuesGenerated').textContent = result.length;
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setStringToDecimalConverter(text => {
        convertString();
        return document.getElementById('stringToDecimal-output').value;
    });
</script>
@endpush
