@extends('layouts.tool')

@section('title', 'URL Extractor - WordFix')

@section('tool-title', 'URL Extractor')

@section('tool-description', 'Extract all URLs from text - HTTP, HTTPS, FTP, and more')

@section('tool-content')
<!-- Options -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">URL Types</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
        <label class="flex items-center cursor-pointer bg-blue-50 border border-blue-200 rounded-lg p-3">
            <input type="checkbox" id="extractHTTP" class="w-4 h-4 text-blue-600 rounded" checked onchange="extractURLs()">
            <span class="ml-2 text-sm font-medium">HTTP/HTTPS</span>
        </label>
        <label class="flex items-center cursor-pointer bg-green-50 border border-green-200 rounded-lg p-3">
            <input type="checkbox" id="extractFTP" class="w-4 h-4 text-green-600 rounded" onchange="extractURLs()">
            <span class="ml-2 text-sm font-medium">FTP</span>
        </label>
        <label class="flex items-center cursor-pointer bg-purple-50 border border-purple-200 rounded-lg p-3">
            <input type="checkbox" id="extractWWW" class="w-4 h-4 text-purple-600 rounded" checked onchange="extractURLs()">
            <span class="ml-2 text-sm font-medium">www.</span>
        </label>
        <label class="flex items-center cursor-pointer bg-yellow-50 border border-yellow-200 rounded-lg p-3">
            <input type="checkbox" id="removeDuplicates" class="w-4 h-4 text-yellow-600 rounded" checked onchange="extractURLs()">
            <span class="ml-2 text-sm font-medium">Remove Duplicates</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="urlExtractor"
    inputPlaceholder="Paste text containing URLs... Visit https://example.com or www.test.org"
    outputPlaceholder="Extracted URLs will appear here..."
    downloadFileName="extracted-urls.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-blue-600" id="totalCount">0</div>
        <div class="text-xs text-gray-600">Total URLs</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-green-600" id="uniqueCount">0</div>
        <div class="text-xs text-gray-600">Unique</div>
    </div>
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-purple-600" id="domainCount">0</div>
        <div class="text-xs text-gray-600">Domains</div>
    </div>
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-yellow-600" id="secureCount">0</div>
        <div class="text-xs text-gray-600">HTTPS</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About URL Extractor</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Extract all URLs from text including HTTP, HTTPS, FTP, and www addresses. Perfect for link analysis, web scraping preparation, and content auditing.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Extracts HTTP, HTTPS, FTP, and www URLs</li>
            <li>Automatic duplicate removal option</li>
            <li>Domain and security statistics</li>
            <li>One URL per line format</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Uses</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>SEO:</strong> Extract links from web pages</li>
            <li><strong>Research:</strong> Collect references from documents</li>
            <li><strong>Security:</strong> Audit external links</li>
            <li><strong>Development:</strong> Parse URLs from logs</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function extractURLs() {
        const input = document.getElementById('urlExtractor-input');
        const output = document.getElementById('urlExtractor-output');
        if (!input || !output) return;
        
        const text = input.value;
        const extractHTTP = document.getElementById('extractHTTP')?.checked ?? true;
        const extractFTP = document.getElementById('extractFTP')?.checked ?? false;
        const extractWWW = document.getElementById('extractWWW')?.checked ?? true;
        const removeDuplicates = document.getElementById('removeDuplicates')?.checked ?? true;
        
        let urls = [];
        
        if (extractHTTP) {
            const httpUrls = text.match(/https?:\/\/[^\s<>"']+/gi) || [];
            urls.push(...httpUrls);
        }
        
        if (extractFTP) {
            const ftpUrls = text.match(/ftp:\/\/[^\s<>"']+/gi) || [];
            urls.push(...ftpUrls);
        }
        
        if (extractWWW) {
            const wwwUrls = text.match(/www\.[^\s<>"']+/gi) || [];
            urls.push(...wwwUrls);
        }
        
        if (removeDuplicates) {
            urls = [...new Set(urls)];
        }
        
        output.value = urls.join('\n');
        
        // Calculate stats
        const unique = [...new Set(urls)];
        const domains = new Set(urls.map(url => {
            try {
                const urlObj = new URL(url.startsWith('http') ? url : 'http://' + url);
                return urlObj.hostname;
            } catch {
                return url.split('/')[0];
            }
        }));
        const secureCount = urls.filter(url => url.startsWith('https://')).length;
        
        document.getElementById('totalCount').textContent = urls.length;
        document.getElementById('uniqueCount').textContent = unique.length;
        document.getElementById('domainCount').textContent = domains.size;
        document.getElementById('secureCount').textContent = secureCount;
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setUrlExtractorConverter(text => {
        extractURLs();
        return document.getElementById('urlExtractor-output').value;
    });
</script>
@endpush
