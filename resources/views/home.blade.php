@extends('layouts.app')

@section('title', 'WordFix - Free Online Text Tools')

@section('content')
<div class="py-6 md:py-8 pb-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search Tools Component -->
        @include('components.search-tools')
        
        <!-- Hero Section - Minimal -->
        <div class="text-center mb-6">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                Text Case Converter
            </h1>
            <p class="text-sm text-gray-600 max-w-2xl mx-auto">
                Convert text instantly with multiple case options
            </p>
        </div>
        
        <!-- Main Converter Card -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden mb-6">
            <!-- Side-by-Side Textareas -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 p-4 md:p-6">
                <!-- Input Section -->
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-2">Input Text</label>
                    <textarea 
                        id="inputText"
                        class="w-full h-64 p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none text-sm"
                        placeholder="Type or paste your text here..."
                    ></textarea>
                </div>
                
                <!-- Output Section -->
                <div>
                    <label class="block text-xs font-medium text-gray-700 mb-2">Converted Text</label>
                    <textarea 
                        id="outputText"
                        class="w-full h-64 p-3 border border-gray-300 rounded-md bg-gray-50 resize-none text-sm"
                        placeholder="Converted text will appear here..."
                        readonly
                    ></textarea>
                </div>
            </div>
            
            <!-- Tool Buttons - Compact -->
            <div class="border-t border-gray-200 px-4 md:px-6 py-3 bg-gray-50">
                <div class="flex flex-wrap gap-2">
                    <button 
                        onclick="convertText('sentence')" 
                        class="px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors"
                        title="Capitalize first letter of each sentence"
                    >
                        Sentence case
                    </button>
                    <button 
                        onclick="convertText('lower')" 
                        class="px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors"
                        title="Convert all letters to lowercase"
                    >
                        lower case
                    </button>
                    <button 
                        onclick="convertText('upper')" 
                        class="px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors"
                        title="Convert all letters to UPPERCASE"
                    >
                        UPPER CASE
                    </button>
                    <button 
                        onclick="convertText('capitalize')" 
                        class="px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors"
                        title="Capitalize first letter of each word"
                    >
                        Capitalized Case
                    </button>
                    <button 
                        onclick="convertText('alternate')" 
                        class="px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors"
                        title="Alternate between upper and lowercase"
                    >
                        aLtErNaTiNg cAsE
                    </button>
                    <button 
                        onclick="convertText('title')" 
                        class="px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors"
                        title="Capitalize first letter of each word"
                    >
                        Title Case
                    </button>
                    <button 
                        onclick="convertText('invert')" 
                        class="px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors"
                        title="Swap uppercase to lowercase and vice versa"
                    >
                        InVeRsE Case
                    </button>
                </div>
            </div>
            
            <!-- Utility Buttons with Icons -->
            <div class="border-t border-gray-200 px-4 md:px-6 py-3 bg-white">
                <div class="flex flex-wrap gap-2">
                    <button 
                        onclick="copyText()" 
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors"
                        title="Copy converted text"
                    >
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                        </svg>
                        Copy Results
                    </button>
                    <button 
                        onclick="downloadText()" 
                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors"
                        title="Download as text file"
                    >
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                        </svg>
                        Download
                    </button>
                    <button 
                        onclick="clearText()" 
                        class="inline-flex items-center px-4 py-2 bg-red-600 text-white text-sm font-medium rounded hover:bg-red-700 transition-colors"
                        title="Clear all text"
                    >
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                        </svg>
                        Clear
                    </button>
                </div>
            </div>
            
            <!-- Stats Section -->
            <div class="border-t border-gray-200 px-4 md:px-6 py-3 bg-gray-50">
                <div class="flex flex-wrap gap-4 text-xs text-gray-600">
                    <div><span class="font-medium">Stats:</span></div>
                    <div>
                        <span class="font-medium">Character Count:</span> <span id="charCount">0</span>
                    </div>
                    <div>
                        <span class="font-medium">Character Count (without spaces):</span> <span id="charCountNoSpace">0</span>
                    </div>
                    <div>
                        <span class="font-medium">Word Count:</span> <span id="wordCount">0</span>
                    </div>
                    <div>
                        <span class="font-medium">Sentence Count:</span> <span id="sentenceCount">0</span>
                    </div>
                    <div>
                        <span class="font-medium">Line Count:</span> <span id="lineCount">0</span>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

@push('scripts')
<script>
    const inputText = document.getElementById('inputText');
    const outputText = document.getElementById('outputText');
    
    // Conversion Functions
    function convertText(type) {
        const text = inputText.value;
        if (!text) {
            showToast('Please enter some text first!', 'error');
            return;
        }
        
        let result = '';
        
        switch(type) {
            case 'sentence':
                // Sentence case: lowercase all, then capitalize first letter after periods
                result = text.toLowerCase().replace(/(^\w|\.\s+\w)/gm, function(txt) {
                    return txt.toUpperCase();
                });
                break;
                
            case 'lower':
                // Lowercase: convert all to lowercase
                result = text.toLowerCase();
                break;
                
            case 'upper':
                // Uppercase: convert all to uppercase
                result = text.toUpperCase();
                break;
                
            case 'capitalize':
                // Capitalized Case: capitalize first letter of each word
                result = text.replace(/\b\w/g, char => char.toUpperCase());
                break;
                
            case 'alternate':
                // Alternating case: alternate between upper and lowercase
                let isUpper = false;
                result = '';
                for (let char of text) {
                    if (char.match(/[a-zA-Z]/)) {
                        result += isUpper ? char.toUpperCase() : char.toLowerCase();
                        isUpper = !isUpper;
                    } else {
                        result += char;
                    }
                }
                break;
                
            case 'title':
                // Title Case: capitalize first letter of each word
                result = text.toLowerCase().split(' ').map(word => {
                    return word.charAt(0).toUpperCase() + word.slice(1);
                }).join(' ');
                break;
                
            case 'invert':
                // Invert Case: swap uppercase to lowercase and vice versa
                result = text.split('').map(c =>
                    c >= 'A' && c <= 'Z' ? c.toLowerCase() :
                    c >= 'a' && c <= 'z' ? c.toUpperCase() :
                    c
                ).join('');
                break;
        }
        
        outputText.value = result;
        showToast('Text converted successfully!', 'success');
    }
    
    // Copy to clipboard
    function copyText() {
        if (!outputText.value) {
            showToast('No text to copy!', 'error');
            return;
        }
        
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(outputText.value).then(() => {
                showToast('Text copied to clipboard!', 'success');
            }).catch(() => {
                // Fallback
                outputText.select();
                document.execCommand('copy');
                showToast('Text copied to clipboard!', 'success');
            });
        } else {
            outputText.select();
            document.execCommand('copy');
            showToast('Text copied to clipboard!', 'success');
        }
    }
    
    // Download as text file
    function downloadText() {
        const text = outputText.value;
        if (!text) {
            showToast('No text to download!', 'error');
            return;
        }
        const blob = new Blob([text], { type: 'text/plain' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'converted-text.txt';
        a.click();
        URL.revokeObjectURL(url);
        showToast('File downloaded successfully!', 'success');
    }
    
    // Clear all text
    function clearText() {
        inputText.value = '';
        outputText.value = '';
        updateStats();
        showToast('Text cleared!', 'success');
    }
    
    // Update statistics
    function updateStats() {
        const text = inputText.value;
        
        // Character count
        document.getElementById('charCount').textContent = text.length;
        
        // Character count without spaces
        document.getElementById('charCountNoSpace').textContent = text.replace(/\s/g, '').length;
        
        // Word count
        const words = text.trim().split(/\s+/).filter(word => word.length > 0);
        document.getElementById('wordCount').textContent = text.trim().length === 0 ? 0 : words.length;
        
        // Sentence count
        const sentences = text.split(/[.!?]+/).filter(s => s.trim().length > 0);
        document.getElementById('sentenceCount').textContent = sentences.length;
        
        // Line count
        document.getElementById('lineCount').textContent = text.split('\n').length;
    }
    
    // Toast notification
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
        toast.className = `fixed bottom-6 left-1/2 transform -translate-x-1/2 ${bgColor} text-white px-6 py-3 rounded-lg shadow-lg text-sm z-50 animate-fade-in`;
        toast.style.minWidth = '250px';
        toast.style.textAlign = 'center';
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.classList.remove('animate-fade-in');
            toast.classList.add('animate-fade-out');
            setTimeout(() => toast.remove(), 300);
        }, 2500);
    }
    
    // Event listeners
    inputText.addEventListener('input', updateStats);
    
    // Initialize stats
    updateStats();
</script>

<style>
@keyframes fade-in {
    from { 
        opacity: 0; 
        transform: translate(-50%, 10px);
    }
    to { 
        opacity: 1; 
        transform: translate(-50%, 0);
    }
}
@keyframes fade-out {
    from { 
        opacity: 1; 
        transform: translate(-50%, 0);
    }
    to { 
        opacity: 0; 
        transform: translate(-50%, 10px);
    }
}
.animate-fade-in { 
    animation: fade-in 0.3s ease-out forwards;
}
.animate-fade-out { 
    animation: fade-out 0.3s ease-out forwards;
}
</style>
@endpush
@endsection
