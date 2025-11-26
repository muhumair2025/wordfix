@extends('layouts.tool')

@section('title', 'Email Extractor - WordFix')

@section('tool-title', 'Email Extractor')

@section('tool-description', 'Extract all email addresses from any text - fast, accurate, and free')

@section('tool-content')
<!-- Text Input -->
<div class="mb-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">Paste Your Text</label>
    <textarea 
        id="emailInput" 
        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
        rows="8"
        placeholder="Paste text containing emails here... Contact us at support@example.com or sales@company.org"
        oninput="extractEmails()"
    ></textarea>
</div>

<!-- Results Section -->mn njkkjjlkn gap-3">
        <h3 class="text-lg font-semibold text-gray-900">
            Found <span id="emailCount" class="text-blue-600">0</span> Email(s)
        </h3>
        <div class="flex flex-wrap gap-2">
            <button onclick="copyEmails()" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                Copy All
            </button>
            <button onclick="downloadEmails()" class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                Download
            </button>
            <button onclick="clearAll()" class="px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
                Clear
            </button>
        </div>
    </div>
    
    <!-- Email List -->
    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 max-h-96 overflow-y-auto">
        <ul id="emailList" class="space-y-2"></ul>
    </div>
</div>

<!-- Stats -->
<div id="statsSection" class="hidden mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-blue-600" id="uniqueCount">0</div>
        <div class="text-xs text-gray-600">Unique</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-green-600" id="gmailCount">0</div>
        <div class="text-xs text-gray-600">Gmail</div>
    </div>
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-purple-600" id="domainCount">0</div>
        <div class="text-xs text-gray-600">Domains</div>
    </div>
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-yellow-600" id="duplicateCount">0</div>
        <div class="text-xs text-gray-600">Duplicates</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Email Extractor</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Email Extractor</strong> automatically finds and extracts all email addresses from any text. Perfect for data processing, lead generation, and contact list management.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Extracts all valid email addresses automatically</li>
            <li>Shows unique count and duplicate detection</li>
            <li>Domain statistics (Gmail, Yahoo, etc.)</li>
            <li>Copy all or download as text file</li>
            <li>Works with large text blocks</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Uses</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Lead Generation:</strong> Extract contacts from web pages</li>
            <li><strong>Data Processing:</strong> Clean and organize email lists</li>
            <li><strong>Research:</strong> Gather contacts from documents</li>
            <li><strong>Marketing:</strong> Build email campaigns</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How It Works</h3>
        <ol class="list-decimal list-inside space-y-1 ml-4">
            <li>Paste your text containing emails</li>
            <li>Emails are automatically detected using regex</li>
            <li>View statistics and analysis</li>
            <li>Copy or download the results</li>
        </ol>
        
        <div class="bg-blue-50 border-l-4 border-blue-600 p-4 mt-6">
            <p class="text-blue-900 text-sm">
                <strong>Privacy:</strong> All extraction happens in your browser. No data is sent to any server.
            </p>
        </div>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let extractedEmails = [];
    
    function extractEmails() {
        const text = document.getElementById('emailInput').value;
        const emailRegex = /[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,}/g;
        extractedEmails = text.match(emailRegex) || [];
        
        if (extractedEmails.length > 0) {
            displayResults();
        } else {
            document.getElementById('resultsSection').classList.add('hidden');
            document.getElementById('statsSection').classList.add('hidden');
        }
    }
    
    function displayResults() {
        const unique = [...new Set(extractedEmails)];
        const domains = {};
        let gmailCount = 0;
        
        unique.forEach(email => {
            const domain = email.split('@')[1];
            domains[domain] = (domains[domain] || 0) + 1;
            if (domain.includes('gmail')) gmailCount++;
        });
        
        // Update counts
        document.getElementById('emailCount').textContent = extractedEmails.length;
        document.getElementById('uniqueCount').textContent = unique.length;
        document.getElementById('gmailCount').textContent = gmailCount;
        document.getElementById('domainCount').textContent = Object.keys(domains).length;
        document.getElementById('duplicateCount').textContent = extractedEmails.length - unique.length;
        
        // Display email list
        const listHTML = unique.map(email => 
            `<li class="flex items-center justify-between bg-white p-3 rounded border border-gray-200">
                <span class="text-sm font-mono text-gray-900">${email}</span>
                <button onclick="copyEmail('${email}')" class="text-blue-600 hover:text-blue-700 text-xs">Copy</button>
            </li>`
        ).join('');
        
        document.getElementById('emailList').innerHTML = listHTML;
        document.getElementById('resultsSection').classList.remove('hidden');
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    function copyEmail(email) {
        navigator.clipboard.writeText(email);
    }
    
    function copyEmails() {
        const unique = [...new Set(extractedEmails)];
        navigator.clipboard.writeText(unique.join('\n'));
        alert('Emails copied to clipboard!');
    }
    
    function downloadEmails() {
        const unique = [...new Set(extractedEmails)];
        const blob = new Blob([unique.join('\n')], { type: 'text/plain' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'extracted-emails.txt';
        a.click();
    }
    
    function clearAll() {
        document.getElementById('emailInput').value = '';
        extractedEmails = [];
        document.getElementById('resultsSection').classList.add('hidden');
        document.getElementById('statsSection').classList.add('hidden');
    }
</script>
@endpush
