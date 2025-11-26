@extends('layouts.tool')

@section('title', 'HTML Entities Converter - WordFix')

@section('tool-title', 'HTML Entities Converter')

@section('tool-description', 'Encode or decode HTML entities')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-orange-50 border border-orange-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-3">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-xs font-medium text-gray-700 mb-1">Action</label>
            <select id="action" onchange="convertEntities()" class="w-full px-3 py-2 text-sm border border-orange-300 rounded focus:ring-2 focus:ring-orange-500">
                <option value="encode">Encode (Special Chars)</option>
                <option value="encodeAll">Encode All Characters</option>
                <option value="decode">Decode</option>
            </select>
        </div>
        
        <div class="flex flex-wrap gap-2 mt-5">
            <label class="flex items-center cursor-pointer bg-white border border-orange-200 rounded px-3 py-1.5">
                <input type="checkbox" id="useHex" class="w-4 h-4 text-orange-600 rounded" onchange="convertEntities()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Use Hex (&#x...)</span>
            </label>
            <label class="flex items-center cursor-pointer bg-white border border-orange-200 rounded px-3 py-1.5">
                <input type="checkbox" id="useNamed" class="w-4 h-4 text-orange-600 rounded" checked onchange="convertEntities()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Use Named (&copy;)</span>
            </label>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="htmlEntities"
    inputPlaceholder="Paste your text or HTML here..."
    outputPlaceholder="Converted text will appear here..."
    downloadFileName="converted.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-orange-50 border border-orange-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-orange-600" id="originalChars">0</div>
        <div class="text-xs text-gray-600">Original Chars</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="finalChars">0</div>
        <div class="text-xs text-gray-600">Final Chars</div>
    </div>
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-purple-600" id="changePercent">0%</div>
        <div class="text-xs text-gray-600">Size Change</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About HTML Entities Converter</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Convert characters to their HTML entity equivalents and vice versa. Essential for displaying special characters in HTML safely.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Encode special characters (e.g., < to &lt;)</li>
            <li>Encode all characters (obfuscation)</li>
            <li>Decode entities back to text</li>
            <li>Support for Named, Decimal, and Hex entities</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function convertEntities() {
        const input = document.getElementById('htmlEntities-input');
        const output = document.getElementById('htmlEntities-output');
        if (!input || !output) return;
        
        let text = input.value;
        const originalLength = text.length;
        
        if (!text) {
            output.value = '';
            document.getElementById('statsSection').classList.add('hidden');
            return;
        }

        const action = document.getElementById('action')?.value || 'encode';
        const useHex = document.getElementById('useHex')?.checked || false;
        const useNamed = document.getElementById('useNamed')?.checked || false;
        
        let result = '';
        
        if (action === 'decode') {
            const textarea = document.createElement('textarea');
            textarea.innerHTML = text;
            result = textarea.value;
        } else {
            // Encode
            for (let i = 0; i < text.length; i++) {
                const char = text[i];
                const code = char.charCodeAt(0);
                
                // Check if needs encoding
                let needsEncoding = false;
                if (action === 'encodeAll') {
                    needsEncoding = true;
                } else {
                    // Special chars only: < > & " ' and non-ascii
                    needsEncoding = (code > 127 || char === '<' || char === '>' || char === '&' || char === '"' || char === "'");
                }
                
                if (needsEncoding) {
                    if (useNamed) {
                        // Basic named entities
                        const named = {
                            '<': '&lt;', '>': '&gt;', '&': '&amp;', '"': '&quot;', "'": '&apos;',
                            '©': '&copy;', '®': '&reg;', '€': '&euro;', '£': '&pound;', '¥': '&yen;'
                        };
                        if (named[char]) {
                            result += named[char];
                            continue;
                        }
                    }
                    
                    if (useHex) {
                        result += '&#x' + code.toString(16) + ';';
                    } else {
                        result += '&#' + code + ';';
                    }
                } else {
                    result += char;
                }
            }
        }
        
        output.value = result;
        
        // Update stats
        const change = originalLength > 0 ? (((result.length - originalLength) / originalLength) * 100).toFixed(1) : 0;
        const changeText = change > 0 ? `+${change}%` : `${change}%`;
        
        document.getElementById('originalChars').textContent = originalLength;
        document.getElementById('finalChars').textContent = result.length;
        document.getElementById('changePercent').textContent = changeText;
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setHtmlEntitiesConverter(text => {
        convertEntities();
        return document.getElementById('htmlEntities-output').value;
    });
</script>
@endpush
