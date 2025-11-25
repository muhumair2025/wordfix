@extends('layouts.tool')

@section('title', 'Keep First Characters Of Each Line - WordFix')

@section('tool-title', 'Keep First Characters Of Each Line')

@section('tool-description', 'Extract and keep only the first N characters from each line of your text')

@section('tool-content')
<!-- Options Panel -->
<div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h3 class="text-sm font-semibold text-gray-900 mb-4">Extraction Options</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div>
            <label for="charCount" class="block text-sm font-medium text-gray-700 mb-2">
                Number of characters to keep:
            </label>
            <input 
                type="number" 
                id="charCount"
                value="5"
                min="1"
                oninput="updateConversion()"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
        </div>
        
        <div>
            <label for="fillMode" class="block text-sm font-medium text-gray-700 mb-2">
                If line is shorter:
            </label>
            <select id="fillMode" onchange="updateConversion()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="keep">Keep as is</option>
                <option value="pad-space">Pad with spaces</option>
                <option value="pad-dash">Pad with dashes (-)</option>
                <option value="pad-dot">Pad with dots (.)</option>
                <option value="skip">Skip line</option>
            </select>
        </div>
        
        <div>
            <label for="paddingChar" class="block text-sm font-medium text-gray-700 mb-2">
                Custom padding character:
            </label>
            <input 
                type="text" 
                id="paddingChar"
                maxlength="1"
                placeholder="_"
                oninput="updateConversion()"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
        </div>
    </div>
    
    <div class="flex flex-wrap gap-4">
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="skipEmptyLines" checked onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Skip empty lines</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="trimLines" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Trim whitespace before processing</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="addEllipsis" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Add "..." if text was truncated</span>
        </label>
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="keepFirstChars"
    inputPlaceholder="Type or paste your text here (one item per line)"
    outputPlaceholder="First characters of each line will appear here"
    downloadFileName="first-characters.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    This tool extracts and keeps only the first N characters from each line of your text. Perfect for creating abbreviations, extracting prefixes, truncating text, or processing structured data.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Keep First Characters Example</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before (Original Text)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
                Lorem Ipsum is simply dummy<br>
                The quick brown fox jumps<br>
                Hello World<br>
                Programming
            </div>
            <p class="text-xs text-gray-500 mt-2">
                Settings: Keep first 5 characters
            </p>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After (First 5 Characters)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
                Lorem<br>
                The q<br>
                Hello<br>
                Progr
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Keep First Characters Of Each Line Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Keep First Characters Of Each Line</strong> tool extracts and keeps only the first N characters from each line in your text. Perfect for creating abbreviations, extracting prefixes, truncating long text, or processing structured data files.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use This Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Set the number of characters to keep from the beginning of each line</li>
            <li>Choose what to do with lines shorter than the specified length</li>
            <li>Configure additional options (skip empty lines, trim, add ellipsis)</li>
            <li>Type or paste your text into the input box</li>
            <li>The extracted first characters appear in the output</li>
            <li>Copy or download the results</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Flexible Character Count</strong> - Extract any number of characters (1-1000+)</li>
            <li><strong>Short Line Handling</strong> - Multiple options for lines shorter than the target length</li>
            <li><strong>Padding Options</strong> - Pad with spaces, dashes, dots, or custom characters</li>
            <li><strong>Ellipsis Support</strong> - Automatically add "..." to show text was truncated</li>
            <li><strong>Empty Line Control</strong> - Skip or process blank lines</li>
            <li><strong>Trim Option</strong> - Remove leading whitespace before processing</li>
            <li>Real-time extraction as you type</li>
            <li>Import/export functionality</li>
            <li>Mobile responsive design</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Create Abbreviations</strong> - Extract first letters to create acronyms</li>
            <li><strong>Truncate Long Text</strong> - Shorten lines to a specific length</li>
            <li><strong>Extract Prefixes</strong> - Get ID prefixes, codes, or categories from data</li>
            <li><strong>Preview Text</strong> - Create text previews with character limits</li>
            <li><strong>Data Processing</strong> - Extract fixed-width fields from text files</li>
            <li><strong>Create Initials</strong> - Get first characters for name initials</li>
            <li><strong>Format Lists</strong> - Standardize list item lengths</li>
            <li><strong>CSV/Data Extraction</strong> - Extract specific columns from structured data</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Padding Options Explained</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Keep as is</h4>
        <p>Short lines remain unchanged. Example: "Hi" stays "Hi" even if you're keeping 5 characters.</p>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Pad with spaces/dashes/dots</h4>
        <p>Short lines are padded to reach the target length. Example: "Hi" becomes "Hi   " (5 chars with spaces).</p>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Skip line</h4>
        <p>Lines shorter than the target length are omitted from results.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Examples</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Create Acronyms</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> Hypertext Markup Language</li>
            <li><strong>Settings:</strong> Keep first 1 character</li>
            <li><strong>Output:</strong> H, M, L</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Truncate for Preview</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> This is a very long sentence that needs to be truncated</li>
            <li><strong>Settings:</strong> Keep first 20 characters, add "..."</li>
            <li><strong>Output:</strong> This is a very long...</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Use "Add ellipsis" when truncating text for previews or summaries</li>
            <li>Padding is useful when creating fixed-width text columns</li>
            <li>Use "Trim whitespace" to ignore leading spaces in original text</li>
            <li>Keep 1 character to extract first letters/initials</li>
            <li>Combine with other tools for advanced text processing workflows</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let extractOptions = {
        charCount: 5,
        fillMode: 'keep',
        paddingChar: ' ',
        skipEmptyLines: true,
        trimLines: false,
        addEllipsis: false
    };
    
    // Update conversion options
    window.updateConversion = function() {
        extractOptions.charCount = parseInt(document.getElementById('charCount').value) || 5;
        extractOptions.fillMode = document.getElementById('fillMode').value;
        extractOptions.skipEmptyLines = document.getElementById('skipEmptyLines').checked;
        extractOptions.trimLines = document.getElementById('trimLines').checked;
        extractOptions.addEllipsis = document.getElementById('addEllipsis').checked;
        
        const customChar = document.getElementById('paddingChar').value;
        if (customChar) {
            extractOptions.paddingChar = customChar.charAt(0);
            extractOptions.fillMode = 'pad-custom';
        } else {
            // Set padding char based on fillMode
            switch (extractOptions.fillMode) {
                case 'pad-space':
                    extractOptions.paddingChar = ' ';
                    break;
                case 'pad-dash':
                    extractOptions.paddingChar = '-';
                    break;
                case 'pad-dot':
                    extractOptions.paddingChar = '.';
                    break;
            }
        }
        
        // Trigger re-conversion
        const inputElement = document.getElementById('keepFirstChars-input');
        if (inputElement) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Set the conversion function
    setKeepFirstCharsConverter(function(text) {
        if (!text) return '';
        
        const lines = text.split('\n');
        
        const processedLines = lines.map(line => {
            // Skip empty lines if option enabled
            if (!line.trim() && extractOptions.skipEmptyLines) {
                return '';
            }
            
            // Trim if option enabled
            let processedLine = extractOptions.trimLines ? line.trim() : line;
            
            // Extract first N characters
            let result = processedLine.substring(0, extractOptions.charCount);
            
            // Handle short lines
            if (processedLine.length < extractOptions.charCount) {
                if (extractOptions.fillMode === 'skip') {
                    return null; // Will be filtered out
                } else if (extractOptions.fillMode === 'keep') {
                    // Keep as is
                } else if (extractOptions.fillMode.startsWith('pad-') || extractOptions.fillMode === 'pad-custom') {
                    // Pad to target length
                    const paddingNeeded = extractOptions.charCount - result.length;
                    result += extractOptions.paddingChar.repeat(paddingNeeded);
                }
            } else if (processedLine.length > extractOptions.charCount && extractOptions.addEllipsis) {
                // Add ellipsis for truncated text
                result += '...';
            }
            
            return result;
        }).filter(line => line !== null);
        
        return processedLines.join('\n');
    });
    
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateConversion();
    });
</script>
@endpush

