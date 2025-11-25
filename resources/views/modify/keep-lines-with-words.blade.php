@extends('layouts.tool')

@section('title', 'Keep Lines that Contain Certain Words Tool - WordFix')

@section('tool-title', 'Keep Lines that Contain Certain Words Tool')

@section('tool-description', 'Filter and keep only lines that contain any of multiple specified words')

@section('tool-content')
<!-- Search Options Panel -->
<div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h3 class="text-sm font-semibold text-gray-900 mb-4">Keep lines that contain the following words:</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3" id="wordInputsGrid">
        <input type="text" id="word1" placeholder="Word_1" oninput="updateConversion()" class="px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        <input type="text" id="word2" placeholder="Word_2" oninput="updateConversion()" class="px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        <input type="text" id="word3" placeholder="Word_3" oninput="updateConversion()" class="px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        <input type="text" id="word4" placeholder="Word_4" oninput="updateConversion()" class="px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        <input type="text" id="word5" placeholder="Word_5" oninput="updateConversion()" class="px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        <input type="text" id="word6" placeholder="Word_6" oninput="updateConversion()" class="px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        <input type="text" id="word7" placeholder="Word_7" oninput="updateConversion()" class="px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        <input type="text" id="word8" placeholder="Word_8" oninput="updateConversion()" class="px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        <input type="text" id="word9" placeholder="Word_9" oninput="updateConversion()" class="px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
        <input type="text" id="word10" placeholder="Word_10" oninput="updateConversion()" class="px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
    </div>
    
    <p class="text-xs text-gray-500 mt-3">Please note: only use words and numbers. Lines matching ANY of these words will be kept.</p>
    
    <div class="flex flex-wrap gap-4 mt-4">
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="caseSensitive" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Case sensitive search</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="wholeWord" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Match whole words only</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="matchAll" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Match ALL words (AND logic instead of OR)</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="showLineNumbers" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Show original line numbers</span>
        </label>
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="keepLinesWords"
    inputPlaceholder="Type or paste your content here"
    outputPlaceholder="Filtered lines will appear here"
    downloadFileName="filtered-lines.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    Use this tool to keep lines that contain certain words. Enter multiple search terms (up to 10 words) and lines matching ANY of these words will be kept. You can also use AND logic to keep only lines that contain ALL words.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Keep Lines with Multiple Words Example</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before (Original Text)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
                Michael ran slow.<br>
                We ate pizza.<br>
                The cat jumped high.<br>
                She drinks coffee every morning.
            </div>
            <p class="text-xs text-gray-500 mt-2">
                Search for: "pizza" OR "coffee"
            </p>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After (Filtered - OR Logic)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
                We ate pizza.<br>
                She drinks coffee every morning.
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Keep Lines Containing Certain Words Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Keep Lines Containing Certain Words</strong> tool filters your text to keep only lines that contain one or more of your specified words. You can enter up to 10 different search terms and choose between OR logic (match any word) or AND logic (match all words).
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use This Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Enter your search words in the input fields (up to 10 words)</li>
            <li>Choose your matching logic:
                <ul class="list-disc list-inside ml-6 mt-2">
                    <li><strong>OR Logic (default):</strong> Keep lines containing ANY of the words</li>
                    <li><strong>AND Logic:</strong> Keep only lines containing ALL of the words</li>
                </ul>
            </li>
            <li>Configure search options (case sensitivity, whole words, etc.)</li>
            <li>Paste your text into the input box</li>
            <li>Only matching lines appear in the output</li>
            <li>Copy or download the filtered results</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Multiple Word Search</strong> - Search for up to 10 different words simultaneously</li>
            <li><strong>OR/AND Logic</strong> - Match any word (OR) or all words (AND)</li>
            <li><strong>Case Sensitive Option</strong> - Match exact case or ignore case differences</li>
            <li><strong>Whole Word Matching</strong> - Match complete words only</li>
            <li><strong>Line Numbers</strong> - Show original line numbers in output</li>
            <li><strong>Real-time Filtering</strong> - See results as you type</li>
            <li>Handles special characters and punctuation</li>
            <li>Empty word fields are automatically ignored</li>
            <li>Import/export functionality</li>
            <li>Mobile responsive grid layout</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Multi-Keyword Log Filtering</strong> - Extract lines with ERROR, WARNING, or CRITICAL</li>
            <li><strong>Content Filtering</strong> - Find lines mentioning multiple topics</li>
            <li><strong>Email Filtering</strong> - Find messages from multiple senders</li>
            <li><strong>Code Review</strong> - Find lines with specific function or variable names</li>
            <li><strong>Data Analysis</strong> - Filter CSV/TSV rows by multiple criteria</li>
            <li><strong>Document Search</strong> - Find paragraphs mentioning any of several keywords</li>
            <li><strong>List Filtering</strong> - Filter lists by multiple categories</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">OR vs AND Logic</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">OR Logic (Default)</h4>
        <p>Keeps lines that contain <strong>at least one</strong> of your search words.</p>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Words:</strong> cat, dog</li>
            <li><strong>Keeps:</strong> "I have a cat" ✓, "She has a dog" ✓, "He likes cats and dogs" ✓</li>
            <li><strong>Removes:</strong> "The bird is singing" ✗</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">AND Logic</h4>
        <p>Keeps lines that contain <strong>all</strong> of your search words.</p>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Words:</strong> cat, dog</li>
            <li><strong>Keeps:</strong> "He likes cats and dogs" ✓</li>
            <li><strong>Removes:</strong> "I have a cat" ✗, "She has a dog" ✗</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Use OR logic to find lines with any matching keyword (broader search)</li>
            <li>Use AND logic to find lines containing all keywords (narrower search)</li>
            <li>Leave unused word fields empty - they'll be automatically ignored</li>
            <li>Case-insensitive search is more flexible for general filtering</li>
            <li>Whole word matching prevents false matches (e.g., "cat" won't match "category")</li>
            <li>Combine with line numbers to easily reference original text locations</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let filterOptions = {
        words: [],
        caseSensitive: false,
        wholeWord: false,
        matchAll: false,
        showLineNumbers: false
    };
    
    // Update conversion options
    window.updateConversion = function() {
        // Collect all non-empty words
        filterOptions.words = [];
        for (let i = 1; i <= 10; i++) {
            const wordInput = document.getElementById('word' + i);
            if (wordInput && wordInput.value.trim()) {
                filterOptions.words.push(wordInput.value.trim());
            }
        }
        
        filterOptions.caseSensitive = document.getElementById('caseSensitive').checked;
        filterOptions.wholeWord = document.getElementById('wholeWord').checked;
        filterOptions.matchAll = document.getElementById('matchAll').checked;
        filterOptions.showLineNumbers = document.getElementById('showLineNumbers').checked;
        
        // Trigger re-conversion
        const inputElement = document.getElementById('keepLinesWords-input');
        if (inputElement) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Set the conversion function
    setKeepLinesWordsConverter(function(text) {
        if (!text) return '';
        if (filterOptions.words.length === 0) return text; // If no search words, return all
        
        const lines = text.split('\n');
        const filteredLines = [];
        
        lines.forEach((line, index) => {
            let matches = false;
            
            if (filterOptions.matchAll) {
                // AND logic - line must contain ALL words
                matches = filterOptions.words.every(word => {
                    return lineContainsWord(line, word);
                });
            } else {
                // OR logic - line must contain AT LEAST ONE word
                matches = filterOptions.words.some(word => {
                    return lineContainsWord(line, word);
                });
            }
            
            if (matches) {
                let resultLine = line.trim();
                
                if (filterOptions.showLineNumbers) {
                    resultLine = `Line ${index + 1}: ${resultLine}`;
                }
                
                filteredLines.push(resultLine);
            }
        });
        
        return filteredLines.join('\n');
    });
    
    function lineContainsWord(line, word) {
        let searchLine = line;
        let searchWord = word;
        
        // Apply case sensitivity
        if (!filterOptions.caseSensitive) {
            searchLine = searchLine.toLowerCase();
            searchWord = searchWord.toLowerCase();
        }
        
        if (filterOptions.wholeWord) {
            // Match whole words only
            const regex = new RegExp(`\\b${escapeRegex(searchWord)}\\b`, filterOptions.caseSensitive ? '' : 'i');
            return regex.test(line);
        } else {
            // Simple contains check
            return searchLine.includes(searchWord);
        }
    }
    
    function escapeRegex(str) {
        return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }
    
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateConversion();
    });
</script>
@endpush

