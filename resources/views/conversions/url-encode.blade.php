@extends('layouts.tool')

@section('title', 'URL Encode - WordFix')

@section('tool-title', 'URL Encode')

@section('tool-description', 'Encode text for use in URLs')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-teal-50 border border-teal-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-2">
        <label class="flex items-center cursor-pointer bg-white border border-teal-200 rounded px-3 py-1.5">
            <input type="checkbox" id="encodeAll" class="w-4 h-4 text-teal-600 rounded" onchange="encodeUrl()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Encode All Special Chars</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-teal-200 rounded px-3 py-1.5">
            <input type="checkbox" id="rfc3986" class="w-4 h-4 text-teal-600 rounded" checked onchange="encodeUrl()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">RFC 3986 Compliance</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="urlEncode"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="URL encoded text will appear here..."
    downloadFileName="encoded-url.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-teal-50 border border-teal-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-teal-600" id="originalChars">0</div>
        <div class="text-xs text-gray-600">Original Chars</div>
    </div>
    <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-indigo-600" id="finalChars">0</div>
        <div class="text-xs text-gray-600">Final Chars</div>
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
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About URL Encode</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Encode text for safe use in URLs (percent-encoding). Converts special characters to their %XX representation.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Standard URL encoding</li>
            <li>RFC 3986 compliance (encoding ! * ' ( ) etc.)</li>
            <li>Option to aggressively encode all non-alphanumeric characters</li>
            <li>UTF-8 support</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function encodeUrl() {
        const input = document.getElementById('urlEncode-input');
        const output = document.getElementById('urlEncode-output');
        if (!input || !output) return;
        
        let text = input.value;
        const originalLength = text.length;
        
        if (!text) {
            output.value = '';
            document.getElementById('statsSection').classList.add('hidden');
            return;
        }

        const encodeAll = document.getElementById('encodeAll')?.checked || false;
        const rfc3986 = document.getElementById('rfc3986')?.checked || false;
        
        try {
            let result = encodeURIComponent(text);
            
            if (rfc3986) {
                // RFC 3986 reserves ! ' ( ) *
                result = result.replace(/[!'()*]/g, function(c) {
                    return '%' + c.charCodeAt(0).toString(16).toUpperCase();
                });
            }
            
            if (encodeAll) {
                // Also encode ~ - . _ which are normally unreserved
                result = result.replace(/[~_.-]/g, function(c) {
                    return '%' + c.charCodeAt(0).toString(16).toUpperCase();
                });
            }
            
            output.value = result;
            
            // Update stats
            const expansion = originalLength > 0 ? (((result.length - originalLength) / originalLength) * 100).toFixed(1) : 0;
            
            document.getElementById('originalChars').textContent = originalLength;
            document.getElementById('finalChars').textContent = result.length;
            document.getElementById('expansionRatio').textContent = '+' + expansion + '%';
            document.getElementById('statsSection').classList.remove('hidden');
            
        } catch (e) {
            output.value = "Error: Encoding failed";
        }
    }
    
    setUrlEncodeConverter(text => {
        encodeUrl();
        return document.getElementById('urlEncode-output').value;
    });
</script>
@endpush
