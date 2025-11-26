@extends('layouts.tool')

@section('title', 'Remove URLs - WordFix')

@section('tool-title', 'Remove URLs')

@section('tool-description', 'Remove URLs, links, and web addresses from text')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-cyan-50 border border-cyan-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-2">
        <label class="flex items-center cursor-pointer bg-white border border-cyan-200 rounded px-3 py-1.5">
            <input type="checkbox" id="httpUrls" class="w-4 h-4 text-cyan-600 rounded" checked onchange="removeUrls()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">HTTP/HTTPS</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-cyan-200 rounded px-3 py-1.5">
            <input type="checkbox" id="wwwUrls" class="w-4 h-4 text-cyan-600 rounded" checked onchange="removeUrls()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">www. URLs</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-cyan-200 rounded px-3 py-1.5">
            <input type="checkbox" id="domainOnly" class="w-4 h-4 text-cyan-600 rounded" onchange="removeUrls()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Domain Only</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-cyan-200 rounded px-3 py-1.5">
            <input type="checkbox" id="emails" class="w-4 h-4 text-cyan-600 rounded" onchange="removeUrls()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Email Addresses</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-cyan-200 rounded px-3 py-1.5">
            <input type="checkbox" id="ftpUrls" class="w-4 h-4 text-cyan-600 rounded" onchange="removeUrls()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">FTP URLs</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-cyan-200 rounded px-3 py-1.5">
            <input type="checkbox" id="keepSpaces" class="w-4 h-4 text-cyan-600 rounded" checked onchange="removeUrls()">
            <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Replace with Space</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="removeUrls"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Text with URLs removed will appear here..."
    downloadFileName="no-urls.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-cyan-50 border border-cyan-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-cyan-600" id="urlsFound">0</div>
        <div class="text-xs text-gray-600">URLs Found</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="httpCount">0</div>
        <div class="text-xs text-gray-600">HTTP/S</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="wwwCount">0</div>
        <div class="text-xs text-gray-600">WWW</div>
    </div>
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-purple-600" id="emailCount">0</div>
        <div class="text-xs text-gray-600">Emails</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Remove URLs</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Remove URLs, links, and email addresses from text. Perfect for cleaning social media content, removing spam links, or extracting text without web addresses.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Remove HTTP/HTTPS URLs</li>
            <li>Remove www. URLs</li>
            <li>Remove domain-only URLs (example.com)</li>
            <li>Remove email addresses</li>
            <li>Remove FTP URLs</li>
            <li>Replace with space or nothing</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function removeUrls() {
        const input = document.getElementById('removeUrls-input');
        const output = document.getElementById('removeUrls-output');
        if (!input || !output) return;
        
        let text = input.value;
        
        const removeHttp = document.getElementById('httpUrls')?.checked || false;
        const removeWww = document.getElementById('wwwUrls')?.checked || false;
        const removeDomain = document.getElementById('domainOnly')?.checked || false;
        const removeEmails = document.getElementById('emails')?.checked || false;
        const removeFtp = document.getElementById('ftpUrls')?.checked || false;
        const keepSpaces = document.getElementById('keepSpaces')?.checked || false;
        
        const replacement = keepSpaces ? ' ' : '';
        let urlsFound = 0;
        let httpCount = 0;
        let wwwCount = 0;
        let emailCount = 0;
        
        // Remove HTTP/HTTPS URLs
        if (removeHttp) {
            const matches = text.match(/https?:\/\/[^\s]+/g);
            httpCount = matches ? matches.length : 0;
            urlsFound += httpCount;
            text = text.replace(/https?:\/\/[^\s]+/g, replacement);
        }
        
        // Remove FTP URLs
        if (removeFtp) {
            const matches = text.match(/ftp:\/\/[^\s]+/g);
            urlsFound += matches ? matches.length : 0;
            text = text.replace(/ftp:\/\/[^\s]+/g, replacement);
        }
        
        // Remove www. URLs
        if (removeWww) {
            const matches = text.match(/www\.[^\s]+/g);
            wwwCount = matches ? matches.length : 0;
            urlsFound += wwwCount;
            text = text.replace(/www\.[^\s]+/g, replacement);
        }
        
        // Remove domain-only URLs
        if (removeDomain) {
            const matches = text.match(/\b[a-z0-9-]+\.(com|net|org|edu|gov|io|co|uk|de|fr|jp|cn)\b/gi);
            urlsFound += matches ? matches.length : 0;
            text = text.replace(/\b[a-z0-9-]+\.(com|net|org|edu|gov|io|co|uk|de|fr|jp|cn)\b/gi, replacement);
        }
        
        // Remove emails
        if (removeEmails) {
            const matches = text.match(/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/g);
            emailCount = matches ? matches.length : 0;
            urlsFound += emailCount;
            text = text.replace(/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}/g, replacement);
        }
        
        // Clean up multiple spaces
        if (keepSpaces) {
            text = text.replace(/  +/g, ' ');
        }
        
        output.value = text;
        
        // Update stats
        document.getElementById('urlsFound').textContent = urlsFound;
        document.getElementById('httpCount').textContent = httpCount;
        document.getElementById('wwwCount').textContent = wwwCount;
        document.getElementById('emailCount').textContent = emailCount;
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setRemoveUrlsConverter(text => {
        removeUrls();
        return document.getElementById('removeUrls-output').value;
    });
</script>
@endpush
