@extends('layouts.tool')

@section('title', 'Phone Number Extractor - WordFix')

@section('tool-title', 'Phone Number Extractor')

@section('tool-description', 'Extract phone numbers from text in various international formats')

@section('tool-content')
<!-- Text Input -->
<div class="mb-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">Paste Your Text</label>
    <textarea 
        id="phoneInput" 
        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none"
        rows="8"
        placeholder="Paste text containing phone numbers like (555) 123-4567, +1-555-123-4567, or 555.123.4567"
        oninput="extractPhones()"
    ></textarea>
</div>

<!-- Results Section -->
<div id="resultsSection" class="hidden">
    <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <h3 class="text-lg font-semibold text-gray-900">
            Found <span id="phoneCount" class="text-blue-600">0</span> Phone Number(s)
        </h3>
        <div class="flex flex-wrap gap-2">
            <button onclick="copyPhones()" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                Copy All
            </button>
            <button onclick="downloadPhones()" class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                Download
            </button>
            <button onclick="clearAll()" class="px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
                Clear
            </button>
        </div>
    </div>
    
    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-blue-600" id="uniqueCount">0</div>
            <div class="text-xs text-gray-600">Unique</div>
        </div>
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-green-600" id="intlCount">0</div>
            <div class="text-xs text-gray-600">International</div>
        </div>
        <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-purple-600" id="duplicateCount">0</div>
            <div class="text-xs text-gray-600">Duplicates</div>
        </div>
    </div>
    
    <!-- Phone List -->
    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 max-h-96 overflow-y-auto">
        <ul id="phoneList" class="space-y-2"></ul>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Phone Number Extractor</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Phone Number Extractor</strong> automatically finds and extracts phone numbers from text in various formats including US, international, and formatted numbers.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Supports multiple phone number formats</li>
            <li>Detects international numbers (+1, +44, etc.)</li>
            <li>Handles various separators (-, ., spaces)</li>
            <li>Identifies parentheses format (555) 123-4567</li>
            <li>Duplicate detection and statistics</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Uses</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Marketing:</strong> Extract contacts from documents</li>
            <li><strong>Sales:</strong> Build phone lists from leads</li>
            <li><strong>Data Entry:</strong> Clean and organize phone numbers</li>
            <li><strong>Research:</strong> Gather contact information</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Supported Formats</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>(555) 123-4567</li>
            <li>555-123-4567</li>
            <li>555.123.4567</li>
            <li>+1 555 123 4567</li>
            <li>+44 20 1234 5678</li>
            <li>5551234567</li>
        </ul>
        
        <div class="bg-blue-50 border-l-4 border-blue-600 p-4 mt-6">
            <p class="text-blue-900 text-sm">
                <strong>Privacy:</strong> All processing happens locally in your browser. No phone numbers are stored or transmitted.
            </p>
        </div>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let extractedPhones = [];
    
    function extractPhones() {
        const text = document.getElementById('phoneInput').value;
        
        // Multiple phone regex patterns
        const patterns = [
            /\+?\d{1,4}?[-.\s]?\(?\d{1,3}?\)?[-.\s]?\d{1,4}[-.\s]?\d{1,4}[-.\s]?\d{1,9}/g,
            /\(\d{3}\)\s*\d{3}[-.\s]?\d{4}/g,
            /\d{3}[-.\s]\d{3}[-.\s]\d{4}/g
        ];
        
        extractedPhones = [];
        patterns.forEach(pattern => {
            const matches = text.match(pattern) || [];
            extractedPhones.push(...matches);
        });
        
        // Filter valid-looking phone numbers (7-15 digits)
        extractedPhones = extractedPhones.filter(phone => {
            const digits = phone.replace(/\D/g, '');
            return digits.length >= 7 && digits.length <= 15;
        });
        
        if (extractedPhones.length > 0) {
            displayResults();
        } else {
            document.getElementById('resultsSection').classList.add('hidden');
        }
    }
    
    function displayResults() {
        const unique = [...new Set(extractedPhones)];
        const intlCount = unique.filter(phone => phone.startsWith('+')).length;
        
        document.getElementById('phoneCount').textContent = extractedPhones.length;
        document.getElementById('uniqueCount').textContent = unique.length;
        document.getElementById('intlCount').textContent = intlCount;
        document.getElementById('duplicateCount').textContent = extractedPhones.length - unique.length;
        
        const listHTML = unique.map(phone => {
            const isIntl = phone.startsWith('+');
            const badge = isIntl ? '<span class="ml-2 px-2 py-0.5 bg-green-100 text-green-700 text-xs rounded">International</span>' : '';
            
            return `<li class="flex items-center justify-between bg-white p-3 rounded border border-gray-200">
                <div class="flex items-center gap-2">
                    <span class="text-sm font-mono text-gray-900">${phone}</span>
                    ${badge}
                </div>
                <div class="flex gap-2">
                    <button onclick="copyPhone('${phone}')" class="text-blue-600 hover:text-blue-700 text-xs">Copy</button>
                    <a href="tel:${phone}" class="text-green-600 hover:text-green-700 text-xs">Call</a>
                </div>
            </li>`;
        }).join('');
        
        document.getElementById('phoneList').innerHTML = listHTML;
        document.getElementById('resultsSection').classList.remove('hidden');
    }
    
    function copyPhone(phone) {
        navigator.clipboard.writeText(phone);
    }
    
    function copyPhones() {
        const unique = [...new Set(extractedPhones)];
        navigator.clipboard.writeText(unique.join('\n'));
        alert('Phone numbers copied to clipboard!');
    }
    
    function downloadPhones() {
        const unique = [...new Set(extractedPhones)];
        const blob = new Blob([unique.join('\n')], { type: 'text/plain' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'phone-numbers.txt';
        a.click();
    }
    
    function clearAll() {
        document.getElementById('phoneInput').value = '';
        extractedPhones = [];
        document.getElementById('resultsSection').classList.add('hidden');
    }
</script>
@endpush
