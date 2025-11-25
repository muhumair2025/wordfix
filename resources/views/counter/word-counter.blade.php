@extends('layouts.tool')

@section('title', 'Specific Character and Word Counter - WordFix')

@section('tool-title', 'Specific Character and Word Counter')

@section('tool-description', 'Count specific words or characters in your text with highlighted results')

@section('tool-content')
<!-- Word Counter Tool -->
<div class="word-counter-wrapper">
    <!-- Main Content Area -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Left Side - Input Area -->
        <div>
            <textarea 
                id="wordCounter-input"
                class="w-full h-80 p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none text-sm"
                placeholder="Type or paste your content here"
            ></textarea>
            <!-- Input Buttons -->
            <div class="flex flex-wrap gap-2 mt-3">
                <button 
                    onclick="wordCounterImportFile()" 
                    class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors"
                >
                    Import From File
                </button>
                <button 
                    onclick="wordCounterClear()" 
                    class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors"
                >
                    Clear
                </button>
            </div>

            <!-- Search Input -->
            <div class="mt-6">
                <label for="wordCounter-search" class="block text-sm font-medium text-gray-700 mb-2">
                    Character/Word to Count:
                </label>
                <input 
                    type="text" 
                    id="wordCounter-search"
                    class="w-full p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                    placeholder="Enter word or character to count (e.g., 'wo')"
                />
                
                <!-- Case Sensitivity Toggle -->
                <div class="mt-3 flex items-center gap-3">
                    <span class="text-sm font-medium text-gray-700">Search Mode:</span>
                    <button 
                        id="btnCaseSensitive"
                        onclick="setCaseSensitivity(true)" 
                        class="px-4 py-2 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors"
                    >
                        Case Sensitive
                    </button>
                    <button 
                        id="btnCaseInsensitive"
                        onclick="setCaseSensitivity(false)" 
                        class="px-4 py-2 bg-gray-300 text-gray-700 text-xs font-medium rounded hover:bg-gray-400 transition-colors"
                    >
                        Case Insensitive
                    </button>
                </div>
            </div>

            <!-- Stats Section -->
            <div class="mt-6 border-t border-gray-200 pt-4">
                <div class="flex flex-wrap gap-4 text-xs text-gray-600">
                    <div><span class="font-medium">Stats:</span></div>
                    <div>
                        <span class="font-medium">Character Count:</span>
                        <span id="charCount">0</span>
                    </div>
                    <div>
                        <span class="font-medium">Character Count (without spaces):</span>
                        <span id="charCountNoSpace">0</span>
                    </div>
                    <div>
                        <span class="font-medium">Word Count:</span>
                        <span id="wordCount">0</span>
                    </div>
                    <div>
                        <span class="font-medium">Sentence Count:</span>
                        <span id="sentenceCount">0</span>
                    </div>
                    <div>
                        <span class="font-medium">Paragraph Count:</span>
                        <span id="paragraphCount">0</span>
                    </div>
                    <div>
                        <span class="font-medium">Line Count:</span>
                        <span id="lineCount">0</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side - Results Area -->
        <div>
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-4">
                <h3 class="text-xl font-bold text-blue-900 mb-2">Results</h3>
                <div class="text-3xl font-bold text-blue-900">
                    <span id="matchCount">0</span> <span class="text-lg">matches found.</span>
                </div>
            </div>

            <!-- Highlighted Output -->
            <div 
                id="wordCounter-output"
                class="w-full min-h-80 p-4 border border-gray-300 rounded-md bg-gray-50 text-sm overflow-auto"
                style="white-space: pre-wrap; word-wrap: break-word; max-height: 500px;"
            >
                <span class="text-gray-400">Highlighted results will appear here</span>
            </div>
        </div>
    </div>
</div>

<div class="text-sm text-blue-600 mb-6">
    This tool counts specific characters or words in your text and highlights all matches. You can choose between case-sensitive or case-insensitive search.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Example</h3>
    <div class="mb-3">
        <p class="text-sm font-medium text-gray-700 mb-2">Sample Text</p>
        <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
            What is lorem ipsum, and when did publishers begin using it?<br>
            The standard lorem ipsum passage has been a printer's friend for centuries.
        </div>
    </div>
    <div class="mb-3">
        <p class="text-sm font-medium text-gray-700 mb-2">Search for: "wo" (Case Sensitive)</p>
        <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
            <span class="font-semibold text-blue-900">4 matches found.</span><br>
            Finds: "<mark style="background-color: yellow;">wo</mark>rkers", "<mark style="background-color: yellow;">wo</mark>rk", etc.
        </div>
    </div>
    <div>
        <p class="text-sm font-medium text-gray-700 mb-2">Search for: "lorem" (Case Insensitive)</p>
        <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
            <span class="font-semibold text-blue-900">Matches both "lorem" and "Lorem"</span><br>
            Case insensitive mode finds all variations regardless of capitalization.
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Specific Character and Word Counter Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Specific Character and Word Counter</strong> is a powerful tool that helps you find and count specific words, phrases, or characters in your text. It provides an instant count and highlights all matches in your content for easy visualization.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use the Word Counter Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Type or paste your text into the input box</li>
            <li>Enter the word, phrase, or character you want to count in the search field</li>
            <li>Choose between "Case Sensitive" or "Case Insensitive" search mode</li>
            <li>The tool will automatically count and highlight all matches in real-time</li>
            <li>View the total count in the Results section and see highlighted matches on the right</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Toggle between case-sensitive and case-insensitive search</li>
            <li>Real-time counting as you type</li>
            <li>Visual highlighting of all matches with yellow background</li>
            <li>Comprehensive text statistics (character count, word count, etc.)</li>
            <li>Import text from files</li>
            <li>Works with single characters, words, or phrases</li>
            <li>Handles special characters and regex patterns safely</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Counting keyword occurrences in content</li>
            <li>Analyzing word frequency in documents</li>
            <li>Finding repeated phrases or terms</li>
            <li>SEO content analysis</li>
            <li>Academic writing and research</li>
            <li>Proofreading and editing</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
(function() {
    const inputText = document.getElementById('wordCounter-input');
    const outputDiv = document.getElementById('wordCounter-output');
    const searchInput = document.getElementById('wordCounter-search');
    const matchCountSpan = document.getElementById('matchCount');
    let isCaseSensitive = true; // Default to case sensitive
    
    // Set case sensitivity
    window.setCaseSensitivity = function(sensitive) {
        isCaseSensitive = sensitive;
        
        // Update button styles
        const btnCaseSensitive = document.getElementById('btnCaseSensitive');
        const btnCaseInsensitive = document.getElementById('btnCaseInsensitive');
        
        if (sensitive) {
            btnCaseSensitive.className = 'px-4 py-2 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors';
            btnCaseInsensitive.className = 'px-4 py-2 bg-gray-300 text-gray-700 text-xs font-medium rounded hover:bg-gray-400 transition-colors';
        } else {
            btnCaseSensitive.className = 'px-4 py-2 bg-gray-300 text-gray-700 text-xs font-medium rounded hover:bg-gray-400 transition-colors';
            btnCaseInsensitive.className = 'px-4 py-2 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors';
        }
        
        // Trigger re-search
        searchAndHighlight();
    };
    
    // Main search and highlight function
    function searchAndHighlight() {
        const text = inputText.value;
        const searchTerm = searchInput.value;
        
        updateStats();
        
        if (!searchTerm || !text) {
            outputDiv.innerHTML = '<span class="text-gray-400">Highlighted results will appear here</span>';
            matchCountSpan.textContent = '0';
            return;
        }
        
        // Escape special regex characters in search term
        const escapedTerm = searchTerm.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
        
        // Create regex with case sensitivity option
        const flags = isCaseSensitive ? 'g' : 'gi';
        const regex = new RegExp(escapedTerm, flags);
        
        // Count matches
        const matches = text.match(regex);
        const matchCount = matches ? matches.length : 0;
        matchCountSpan.textContent = matchCount;
        
        if (matchCount === 0) {
            outputDiv.innerHTML = escapeHtml(text);
            return;
        }
        
        // Highlight matches
        const highlightedText = text.replace(regex, match => {
            return `<mark style="background-color: yellow; font-weight: bold;">${escapeHtml(match)}</mark>`;
        });
        
        outputDiv.innerHTML = highlightedText;
    }
    
    // Escape HTML to prevent XSS
    function escapeHtml(text) {
        const div = document.createElement('div');
        div.textContent = text;
        return div.innerHTML;
    }
    
    // Update statistics
    function updateStats() {
        const text = inputText.value;
        
        // Calculate all stats
        const charCountValue = text.length;
        const charCountNoSpaceValue = text.replace(/\s/g, '').length;
        const words = text.trim().split(/\s+/).filter(word => word.length > 0);
        const wordCountValue = text.trim().length === 0 ? 0 : words.length;
        const sentences = text.split(/[.!?]+/).filter(s => s.trim().length > 0);
        const sentenceCountValue = sentences.length;
        const paragraphs = text.split(/\n\n+/).filter(p => p.trim().length > 0);
        const paragraphCountValue = text.trim().length === 0 ? 0 : Math.max(paragraphs.length, 1);
        const lineCountValue = text.split('\n').length;
        
        // Update stats display
        document.getElementById('charCount').textContent = charCountValue;
        document.getElementById('charCountNoSpace').textContent = charCountNoSpaceValue;
        document.getElementById('wordCount').textContent = wordCountValue;
        document.getElementById('sentenceCount').textContent = sentenceCountValue;
        document.getElementById('paragraphCount').textContent = paragraphCountValue;
        document.getElementById('lineCount').textContent = lineCountValue;
    }
    
    // Event listeners
    inputText.addEventListener('input', searchAndHighlight);
    searchInput.addEventListener('input', searchAndHighlight);
    
    // Import file function
    window.wordCounterImportFile = function() {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = '.txt';
        input.onchange = function(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(event) {
                inputText.value = event.target.result;
                searchAndHighlight();
                showToast('File imported successfully!', 'success');
            };
            reader.onerror = function() {
                showToast('Error reading file!', 'error');
            };
            reader.readAsText(file);
        };
        input.click();
    };
    
    // Clear input function
    window.wordCounterClear = function() {
        inputText.value = '';
        searchInput.value = '';
        outputDiv.innerHTML = '<span class="text-gray-400">Highlighted results will appear here</span>';
        matchCountSpan.textContent = '0';
        updateStats();
    };
    
    // Toast notification function
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
        toast.className = `fixed bottom-6 left-1/2 transform -translate-x-1/2 ${bgColor} text-white px-6 py-3 rounded shadow-lg text-sm z-50 animate-fade-in`;
        toast.style.minWidth = '250px';
        toast.style.textAlign = 'center';
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.classList.remove('animate-fade-in');
            toast.classList.add('animate-fade-out');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
    
    // Initialize
    updateStats();
    
    // Load example text on page load
    const exampleText = `What is lorem ipsum, and when did publishers begin using it?
The standard lorem ipsum passage has been a printer's friend for centuries. Like stock photos today, it served as a placeholder for actual content. The original text comes from Cicero's philosophical work "De Finibus Bonorum et Malorum," written in 45 BC.

The use of the lorem ipsum passage dates back to the 1500s. When printing presses required painstaking hand-setting of type, workers needed something to show clients how their pages would look. To save time, they turned to Cicero's words, creating sample books filled with preset paragraphs.`;
    
    inputText.value = exampleText;
    searchInput.value = 'wo';
    searchAndHighlight();
})();
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
