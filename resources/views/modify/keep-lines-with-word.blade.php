@extends('layouts.tool')

@section('title', 'Keep Lines Containing a Certain String/Word - WordFix')

@section('tool-title', 'Keep Lines Containing a Certain String/Word')

@section('tool-description', 'Filter and keep only lines that contain a specific word or string')

@section('tool-content')
<!-- Search Options Panel -->
<div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h3 class="text-sm font-semibold text-gray-900 mb-4">Filter Options</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div class="md:col-span-2">
            <label for="searchWord" class="block text-sm font-medium text-gray-700 mb-2">
                Keep lines that contain:
            </label>
            <input 
                type="text" 
                id="searchWord"
                placeholder="Enter word or string to search for"
                oninput="updateConversion()"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent text-base"
            />
            <p class="text-xs text-gray-500 mt-1">Enter a single word or phrase</p>
        </div>
    </div>
    
    <div class="flex flex-wrap gap-4">
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="caseSensitive" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Case sensitive search</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="wholeWord" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Match whole words only</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="trimResults" checked onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Trim whitespace from results</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="showLineNumbers" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Show original line numbers</span>
        </label>
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="keepLinesWord"
    inputPlaceholder="Type or paste your content here"
    outputPlaceholder="Filtered lines will appear here"
    downloadFileName="filtered-lines.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    Use this tool to keep lines that contain a certain string or text. Enter your search term and only lines containing that word or phrase will be kept in the output.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Keep Lines Example</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before (Original Text)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
                He ate his first marshmallow.<br>
                The sun was very bright.<br>
                He ran very quickly to the store.<br>
                She loves chocolate cake.
            </div>
            <p class="text-xs text-gray-500 mt-2">
                Search for: "sun"
            </p>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After (Filtered)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
                The sun was very bright.
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Keep Lines Containing a Certain Word Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Keep Lines Containing a Certain Word</strong> tool filters your text to keep only lines that contain a specific word or string. All other lines are removed. Perfect for extracting relevant information, filtering log files, or finding specific content in large texts.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use This Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Enter the word or string you want to search for in the "Keep lines that contain" field</li>
            <li>Choose your search options (case sensitive, whole words, etc.)</li>
            <li>Paste your text into the input box</li>
            <li>Only lines containing your search term will appear in the output</li>
            <li>Copy or download the filtered results</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Case Sensitive Option</strong> - Match exact case or ignore case differences</li>
            <li><strong>Whole Word Matching</strong> - Match complete words only, not partial matches</li>
            <li><strong>Trim Results</strong> - Clean up whitespace from filtered lines</li>
            <li><strong>Line Numbers</strong> - Show original line numbers in output</li>
            <li><strong>Real-time Filtering</strong> - See results as you type</li>
            <li>Works with single words or phrases</li>
            <li>Handles special characters and punctuation</li>
            <li>Import/export functionality</li>
            <li>Mobile responsive</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Log File Filtering</strong> - Extract error lines or specific events</li>
            <li><strong>Data Extraction</strong> - Find lines with specific keywords</li>
            <li><strong>Email Filtering</strong> - Find messages from specific senders</li>
            <li><strong>Code Search</strong> - Find lines with specific function names</li>
            <li><strong>Content Analysis</strong> - Extract paragraphs mentioning topics</li>
            <li><strong>CSV/TSV Filtering</strong> - Keep rows with specific values</li>
            <li><strong>List Filtering</strong> - Filter lists by criteria</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Examples</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Filter Log Errors</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Search:</strong> "ERROR"</li>
            <li><strong>Result:</strong> Only lines containing "ERROR" are kept</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Find Email Domain</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Search:</strong> "@gmail.com"</li>
            <li><strong>Result:</strong> Only Gmail addresses are kept</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Use case-insensitive search to find all variations (Error, ERROR, error)</li>
            <li>Enable "Whole word only" to avoid partial matches (searching "sun" won't match "sunny")</li>
            <li>Show line numbers to track where matches came from in original text</li>
            <li>Works great with large files and extensive data</li>
            <li>Combine with other tools for advanced text processing workflows</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let filterOptions = {
        searchWord: '',
        caseSensitive: false,
        wholeWord: false,
        trimResults: true,
        showLineNumbers: false
    };
    
    // Update conversion options
    window.updateConversion = function() {
        filterOptions.searchWord = document.getElementById('searchWord').value;
        filterOptions.caseSensitive = document.getElementById('caseSensitive').checked;
        filterOptions.wholeWord = document.getElementById('wholeWord').checked;
        filterOptions.trimResults = document.getElementById('trimResults').checked;
        filterOptions.showLineNumbers = document.getElementById('showLineNumbers').checked;
        
        // Trigger re-conversion
        const inputElement = document.getElementById('keepLinesWord-input');
        if (inputElement) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Set the conversion function
    setKeepLinesWordConverter(function(text) {
        if (!text) return '';
        if (!filterOptions.searchWord) return text; // If no search term, return all
        
        const lines = text.split('\n');
        const filteredLines = [];
        
        lines.forEach((line, index) => {
            let searchLine = line;
            let searchTerm = filterOptions.searchWord;
            
            // Apply case sensitivity
            if (!filterOptions.caseSensitive) {
                searchLine = searchLine.toLowerCase();
                searchTerm = searchTerm.toLowerCase();
            }
            
            // Check if line contains the search term
            let matches = false;
            
            if (filterOptions.wholeWord) {
                // Match whole words only
                const regex = new RegExp(`\\b${escapeRegex(searchTerm)}\\b`, filterOptions.caseSensitive ? '' : 'i');
                matches = regex.test(line);
            } else {
                // Simple contains check
                matches = searchLine.includes(searchTerm);
            }
            
            if (matches) {
                let resultLine = filterOptions.trimResults ? line.trim() : line;
                
                if (filterOptions.showLineNumbers) {
                    resultLine = `Line ${index + 1}: ${resultLine}`;
                }
                
                filteredLines.push(resultLine);
            }
        });
        
        return filteredLines.join('\n');
    });
    
    function escapeRegex(str) {
        return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }
    
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateConversion();
    });
</script>
@endpush

