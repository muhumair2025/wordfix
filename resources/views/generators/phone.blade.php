@extends('layouts.tool')

@section('title', 'Random Phone Number Generator - WordFix')

@section('tool-title', 'Random Phone Number Generator')

@section('tool-description', 'Generate valid-looking random phone numbers for testing and development')

@section('tool-content')
<!-- Compact Configuration Bar (Matches Newline with Commas style) -->
<div class="mb-4 bg-indigo-50 border border-indigo-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-3">
        <!-- Country/Preset -->
        <div class="flex-1 min-w-[150px]">
            <label class="block text-xs font-medium text-gray-700 mb-1">Country / Preset</label>
            <select id="country" class="w-full px-3 py-2 text-sm border border-indigo-300 rounded focus:ring-2 focus:ring-indigo-500" onchange="updateFormatFromCountry()">
                <option value="US">United States (US)</option>
                <option value="UK">United Kingdom (UK)</option>
                <option value="CA">Canada (CA)</option>
                <option value="AU">Australia (AU)</option>
                <option value="DE">Germany (DE)</option>
                <option value="FR">France (FR)</option>
                <option value="IN">India (IN)</option>
                <option value="JP">Japan (JP)</option>
                <option value="CN">China (CN)</option>
                <option value="BR">Brazil (BR)</option>
                <option value="custom">Custom Format</option>
            </select>
        </div>

        <!-- Quantity -->
        <div class="flex-1 min-w-[100px] max-w-[150px]">
            <label class="block text-xs font-medium text-gray-700 mb-1">Quantity: <span id="quantityDisplay" class="font-bold text-indigo-600">10</span></label>
            <input type="range" id="quantityRange" min="1" max="50" value="10" class="w-full h-2 bg-indigo-200 rounded-lg appearance-none cursor-pointer accent-indigo-600" oninput="syncQuantity(this.value); generateNumbers()">
            <input type="hidden" id="quantity" value="10">
        </div>

        <!-- Separator -->
        <div class="flex-1 min-w-[120px]">
            <label class="block text-xs font-medium text-gray-700 mb-1">Separator</label>
            <select id="separator" class="w-full px-3 py-2 text-sm border border-indigo-300 rounded focus:ring-2 focus:ring-indigo-500" onchange="generateNumbers()">
                <option value="default">Default</option>
                <option value="-">Dash (-)</option>
                <option value=".">Dot (.)</option>
                <option value=" ">Space ( )</option>
                <option value="">None</option>
            </select>
        </div>

        <!-- Options -->
        <div class="flex flex-wrap gap-2 mt-5">
            <label class="flex items-center cursor-pointer bg-white border border-indigo-200 rounded px-3 py-1.5">
                <input type="checkbox" id="includeCountryCode" class="w-4 h-4 text-indigo-600 rounded" onchange="generateNumbers()">
                <span class="ml-1.5 text-xs font-medium whitespace-nowrap">Country Code</span>
            </label>
        </div>
    </div>

    <!-- Custom Format Input (Hidden by default) -->
    <div id="customFormatContainer" class="mt-3 hidden">
        <label class="block text-xs font-medium text-gray-700 mb-1">Custom Format (X = Digit)</label>
        <input type="text" id="format" class="w-full px-3 py-2 text-sm border border-indigo-300 rounded focus:ring-2 focus:ring-indigo-500 font-mono" placeholder="(XXX) XXX-XXXX" oninput="generateNumbers()">
    </div>
</div>

<!-- Output Area (Mimics x-text-converter output style) -->
<div class="text-converter-wrapper">
    <div class="mb-4">
        <textarea 
            id="resultDisplay"
            class="w-full h-64 p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none text-sm bg-gray-50 font-mono"
            placeholder="Generated numbers will appear here..."
            readonly
        ></textarea>
        
        <!-- Action Buttons -->
        <div class="flex flex-wrap gap-1.5 mt-2">
            <button 
                onclick="copyResults()" 
                title="Copy Results"
                class="w-8 h-8 flex items-center justify-center bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
            </button>
            <button 
                onclick="downloadResults()" 
                title="Download"
                class="w-8 h-8 flex items-center justify-center bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                </svg>
            </button>
            <button 
                onclick="generateNumbers()" 
                title="Regenerate"
                class="w-8 h-8 flex items-center justify-center bg-indigo-600 text-white rounded hover:bg-indigo-700 transition-colors"
            >
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Stats Section -->
    <div class="border-t border-gray-200 pt-3 mb-4">
        <div class="flex flex-wrap gap-3 text-xs text-gray-600">
            <div><span class="font-medium text-gray-700">Generated:</span> <span id="generatedCount">0</span></div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none mt-8">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Random Phone Number Generator</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            Generate valid-looking random phone numbers for various countries. Ideal for testing databases, validating input forms, or populating mock data for applications.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>International Support:</strong> Presets for US, UK, Canada, Australia, Germany, France, and more.</li>
            <li><strong>Custom Formats:</strong> Define your own pattern using 'X' for digits.</li>
            <li><strong>Bulk Generation:</strong> Generate up to 50 numbers at once.</li>
            <li><strong>Advanced Options:</strong> Toggle country codes and customize separators.</li>
            <li><strong>Export:</strong> Copy to clipboard or download as a text file.</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    const PRESETS = {
        'US': { format: '(XXX) XXX-XXXX', code: '+1' },
        'UK': { format: '07XXX XXXXXX', code: '+44' },
        'CA': { format: '(XXX) XXX-XXXX', code: '+1' },
        'AU': { format: '04XX XXX XXX', code: '+61' },
        'DE': { format: '01XX XXXXXXX', code: '+49' },
        'FR': { format: '06 XX XX XX XX', code: '+33' },
        'IN': { format: '9XXXX XXXXX', code: '+91' },
        'JP': { format: '090-XXXX-XXXX', code: '+81' },
        'CN': { format: '1XX XXXX XXXX', code: '+86' },
        'BR': { format: '(XX) 9XXXX-XXXX', code: '+55' }
    };

    function syncQuantity(val) {
        document.getElementById('quantity').value = val;
        document.getElementById('quantityDisplay').textContent = val;
    }

    function updateFormatFromCountry() {
        const country = document.getElementById('country').value;
        const formatInput = document.getElementById('format');
        const customContainer = document.getElementById('customFormatContainer');
        
        if (country === 'custom') {
            customContainer.classList.remove('hidden');
            formatInput.focus();
        } else {
            customContainer.classList.add('hidden');
            formatInput.value = PRESETS[country].format;
        }
        generateNumbers();
    }

    function generateNumbers() {
        const country = document.getElementById('country').value;
        const quantity = parseInt(document.getElementById('quantity').value) || 10;
        const includeCode = document.getElementById('includeCountryCode').checked;
        const separator = document.getElementById('separator').value;
        
        let format = document.getElementById('format').value;
        
        // If empty format and custom, default to US
        if (!format && country === 'custom') {
            format = '(XXX) XXX-XXXX';
        }

        const results = [];
        
        for (let i = 0; i < quantity; i++) {
            let number = generateSingle(format);
            
            // Apply separator override
            if (separator !== 'default') {
                number = number.replace(/[\.\-\s]/g, separator);
                if (separator === '') {
                    number = number.replace(/\D/g, '');
                }
            }

            // Prepend country code
            if (includeCode && country !== 'custom') {
                number = PRESETS[country].code + ' ' + number;
            }

            results.push(number);
        }

        document.getElementById('resultDisplay').value = results.join('\n');
        document.getElementById('generatedCount').textContent = results.length;
    }

    function generateSingle(pattern) {
        return pattern.replace(/X/g, () => Math.floor(Math.random() * 10));
    }

    function copyResults() {
        const text = document.getElementById('resultDisplay').value;
        if (!text) return;

        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(text).then(showToast('Copied to clipboard!')).catch(fallbackCopy);
        } else {
            fallbackCopy();
        }
    }

    function fallbackCopy() {
        const textArea = document.getElementById('resultDisplay');
        textArea.select();
        try {
            document.execCommand('copy');
            showToast('Copied to clipboard!');
        } catch (err) {
            console.error('Fallback copy failed', err);
        }
    }

    function downloadResults() {
        const text = document.getElementById('resultDisplay').value;
        if (!text) return;
        
        const blob = new Blob([text], { type: 'text/plain' });
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'random-phone-numbers.txt';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        window.URL.revokeObjectURL(url);
        showToast('File downloaded!');
    }

    function showToast(message) {
        // Simple toast implementation if not available globally
        const toast = document.createElement('div');
        toast.className = 'fixed bottom-6 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-4 py-2 rounded shadow-lg text-sm z-50';
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.remove();
        }, 2000);
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
        updateFormatFromCountry();
    });
</script>
@endpush
