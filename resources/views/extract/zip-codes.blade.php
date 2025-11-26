@extends('layouts.tool')

@section('title', 'Zip Code Extractor - WordFix')

@section('tool-title', 'Zip Code Extractor')

@section('tool-description', 'Extract zip codes and postal codes from text - US, Canada, UK formats')

@section('tool-content')
<!-- Format Options -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Postal Code Formats</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        <label class="flex items-center cursor-pointer bg-blue-50 border border-blue-200 rounded-lg p-3">
            <input type="checkbox" id="extractUS" class="w-4 h-4 text-blue-600 rounded" checked onchange="extractZipCodes()">
            <span class="ml-2 text-sm font-medium">US (12345)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-green-50 border border-green-200 rounded-lg p-3">
            <input type="checkbox" id="extractUSExtended" class="w-4 h-4 text-green-600 rounded" checked onchange="extractZipCodes()">
            <span class="ml-2 text-sm font-medium">US+ (12345-6789)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-purple-50 border border-purple-200 rounded-lg p-3">
            <input type="checkbox" id="extractCA" class="w-4 h-4 text-purple-600 rounded" checked onchange="extractZipCodes()">
            <span class="ml-2 text-sm font-medium">Canada (A1A 1A1)</span>
        </label>
        <label class="flex items-center cursor-pointer bg-yellow-50 border border-yellow-200 rounded-lg p-3">
            <input type="checkbox" id="extractUK" class="w-4 h-4 text-yellow-600 rounded" checked onchange="extractZipCodes()">
            <span class="ml-2 text-sm font-medium">UK (SW1A 1AA)</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="zipCodes"
    inputPlaceholder="Paste text containing postal codes... e.g., Address: 123 Main St, New York, NY 10001"
    outputPlaceholder="Extracted zip codes will appear here..."
    downloadFileName="zip-codes.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-blue-600" id="totalCount">0</div>
        <div class="text-xs text-gray-600">Total Codes</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-green-600" id="uniqueCount">0</div>
        <div class="text-xs text-gray-600">Unique</div>
    </div>
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-purple-600" id="usCount">0</div>
        <div class="text-xs text-gray-600">US Format</div>
    </div>
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-yellow-600" id="intlCount">0</div>
        <div class="text-xs text-gray-600">International</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Zip Code Extractor</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Extract postal codes from text in multiple formats including US ZIP codes, Canadian postal codes, and UK postcodes.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Supported Formats</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>US ZIP:</strong> 12345 (5-digit)</li>
            <li><strong>US ZIP+4:</strong> 12345-6789 (extended)</li>
            <li><strong>Canada:</strong> A1A 1A1 (alphanumeric)</li>
            <li><strong>UK:</strong> SW1A 1AA (postcode)</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Multi-format detection</li>
            <li>Automatic format classification</li>
            <li>Duplicate detection</li>
            <li>Statistics by format type</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Uses</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Logistics:</strong> Extract shipping zip codes</li>
            <li><strong>Marketing:</strong> Analyze customer locations</li>
            <li><strong>Data Entry:</strong> Parse address lists</li>
            <li><strong>Analytics:</strong> Geographic data analysis</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function extractZipCodes() {
        const input = document.getElementById('zipCodes-input');
        const output = document.getElementById('zipCodes-output');
        if (!input || !output) return;
        
        const text = input.value;
        const extractUS = document.getElementById('extractUS')?.checked ?? true;
        const extractUSExtended = document.getElementById('extractUSExtended')?.checked ?? true;
        const extractCA = document.getElementById('extractCA')?.checked ?? true;
        const extractUK = document.getElementById('extractUK')?.checked ?? true;
        
        let zipCodes = [];
        let usCount = 0;
        let intlCount = 0;
        
        if (extractUS) {
            const usZips = text.match(/\b\d{5}\b/g) || [];
            zipCodes.push(...usZips);
            usCount += usZips.length;
        }
        
        if (extractUSExtended) {
            const usExtZips = text.match(/\b\d{5}-\d{4}\b/g) || [];
            zipCodes.push(...usExtZips);
            usCount += usExtZips.length;
        }
        
        if (extractCA) {
            const caZips = text.match(/\b[A-Z]\d[A-Z]\s?\d[A-Z]\d\b/gi) || [];
            zipCodes.push(...caZips);
            intlCount += caZips.length;
        }
        
        if (extractUK) {
            const ukZips = text.match(/\b[A-Z]{1,2}\d{1,2}[A-Z]?\s?\d[A-Z]{2}\b/gi) || [];
            zipCodes.push(...ukZips);
            intlCount += ukZips.length;
        }
        
        const unique = [...new Set(zipCodes)];
        output.value = unique.join('\n');
        
        // Update stats
        document.getElementById('totalCount').textContent = zipCodes.length;
        document.getElementById('uniqueCount').textContent = unique.length;
        document.getElementById('usCount').textContent = usCount;
        document.getElementById('intlCount').textContent = intlCount;
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setZipCodesConverter(text => {
        extractZipCodes();
        return document.getElementById('zipCodes-output').value;
    });
</script>
@endpush
