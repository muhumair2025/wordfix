@extends('layouts.tool')

@section('title', 'Decimal to String - WordFix')

@section('tool-title', 'Decimal to String')

@section('tool-description', 'Convert decimal (ASCII/Unicode) values to text')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-yellow-50 border border-yellow-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-3">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-xs font-medium text-gray-700 mb-1">Delimiter</label>
            <select id="delimiter" onchange="convertDecimal()" class="w-full px-3 py-2 text-sm border border-yellow-300 rounded focus:ring-2 focus:ring-yellow-500">
                <option value=" ">Space</option>
                <option value=",">Comma (,)</option>
                <option value=";">Semicolon (;)</option>
                <option value="">None</option>
            </select>
        </div>
        <div class="flex-1 min-w-[200px]">
            <label class="block text-xs font-medium text-gray-700 mb-1">Input Base</label>
            <select id="base" onchange="convertDecimal()" class="w-full px-3 py-2 text-sm border border-yellow-300 rounded focus:ring-2 focus:ring-yellow-500">
                <option value="10">Decimal (10)</option>
                <option value="16">Hexadecimal (16)</option>
                <option value="8">Octal (8)</option>
            </select>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="decimalToString"
    inputPlaceholder="Enter decimal values (e.g., 72 101 108 108 111)..."
    outputPlaceholder="Converted text will appear here..."
    downloadFileName="converted-text.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-yellow-600" id="valuesCount">0</div>
        <div class="text-xs text-gray-600">Values Parsed</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="charsGenerated">0</div>
        <div class="text-xs text-gray-600">Chars Generated</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Decimal to String</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Convert ASCII or Unicode decimal values back into readable text. Also supports Hexadecimal and Octal inputs.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Convert Decimal to Text (e.g., 65 -> A)</li>
            <li>Convert Hex to Text (e.g., 41 -> A)</li>
            <li>Convert Octal to Text (e.g., 101 -> A)</li>
            <li>Custom delimiters</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function convertDecimal() {
        const input = document.getElementById('decimalToString-input');
        const output = document.getElementById('decimalToString-output');
        if (!input || !output) return;
        
        let text = input.value.trim();
        
        if (!text) {
            output.value = '';
            document.getElementById('statsSection').classList.add('hidden');
            return;
        }

        const delimiter = document.getElementById('delimiter')?.value || ' ';
        const base = parseInt(document.getElementById('base')?.value || '10');
        
        try {
            // Split input based on delimiter or whitespace if delimiter is space/empty
            let values = [];
            if (delimiter === '') {
                // If no delimiter, try to guess or assume fixed width? 
                // Actually, without delimiter it's hard to parse variable length numbers.
                // We'll assume space separation as fallback or regex match numbers
                values = text.match(/[0-9a-fA-F]+/g) || [];
            } else {
                // Split by specified delimiter, handling potential extra whitespace
                values = text.split(delimiter).map(v => v.trim()).filter(v => v.length > 0);
            }
            
            let result = '';
            let validCount = 0;
            
            for (let val of values) {
                const num = parseInt(val, base);
                if (!isNaN(num)) {
                    result += String.fromCharCode(num);
                    validCount++;
                }
            }
            
            output.value = result;
            
            // Update stats
            document.getElementById('valuesCount').textContent = validCount;
            document.getElementById('charsGenerated').textContent = result.length;
            document.getElementById('statsSection').classList.remove('hidden');
            
        } catch (e) {
            output.value = "Error: Conversion failed";
        }
    }
    
    setDecimalToStringConverter(text => {
        convertDecimal();
        return document.getElementById('decimalToString-output').value;
    });
</script>
@endpush
