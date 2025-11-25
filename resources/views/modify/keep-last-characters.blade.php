@extends('layouts.tool')

@section('title', 'Keep Last Characters Of Each Line - WordFix')

@section('tool-title', 'Keep Last Characters Of Each Line')

@section('tool-description', 'Extract and keep only the last N characters from each line of your text')

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
            <span class="ml-2 text-sm text-gray-700">Add "..." before if text was truncated</span>
        </label>
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="keepLastChars"
    inputPlaceholder="Type or paste your text here (one item per line)"
    outputPlaceholder="Last characters of each line will appear here"
    downloadFileName="last-characters.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    This tool extracts and keeps only the last N characters from each line of your text. Perfect for extracting suffixes, file extensions, ending patterns, or processing structured data.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Keep Last Characters Example</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before (Original Text)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
                document.pdf<br>
                image.jpg<br>
                script.js<br>
                style.css
            </div>
            <p class="text-xs text-gray-500 mt-2">
                Settings: Keep last 4 characters
            </p>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After (Last 4 Characters)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
                .pdf<br>
                .jpg<br>
                t.js<br>
                .css
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Keep Last Characters Of Each Line Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Keep Last Characters Of Each Line</strong> tool extracts and keeps only the last N characters from each line in your text. Perfect for extracting file extensions, suffixes, ending codes, or processing structured data from the end.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use This Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Set the number of characters to keep from the end of each line</li>
            <li>Choose what to do with lines shorter than the specified length</li>
            <li>Configure additional options (skip empty lines, trim, add ellipsis)</li>
            <li>Type or paste your text into the input box</li>
            <li>The extracted last characters appear in the output</li>
            <li>Copy or download the results</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Flexible Character Count</strong> - Extract any number of characters from the end</li>
            <li><strong>Short Line Handling</strong> - Multiple options for lines shorter than the target length</li>
            <li><strong>Padding Options</strong> - Pad with spaces, dashes, dots, or custom characters</li>
            <li><strong>Ellipsis Support</strong> - Add "..." at the beginning to show text was truncated</li>
            <li><strong>Empty Line Control</strong> - Skip or process blank lines</li>
            <li><strong>Trim Option</strong> - Remove trailing whitespace before processing</li>
            <li>Real-time extraction as you type</li>
            <li>Import/export functionality</li>
            <li>Mobile responsive design</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Extract File Extensions</strong> - Get file types from filenames (.pdf, .jpg, .txt)</li>
            <li><strong>Extract Suffixes</strong> - Get ending codes, IDs, or patterns</li>
            <li><strong>Process Timestamps</strong> - Extract time portions from datetime strings</li>
            <li><strong>Extract Domain Extensions</strong> - Get TLDs from URLs (.com, .org, .net)</li>
            <li><strong>Data Processing</strong> - Extract fixed-width fields from the end of lines</li>
            <li><strong>Version Numbers</strong> - Extract version info from filenames</li>
            <li><strong>Extract Endings</strong> - Get last words, digits, or patterns</li>
            <li><strong>CSV/Data Extraction</strong> - Extract trailing columns from structured data</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Examples</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Extract File Extensions</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> document.pdf, image.jpg, script.js</li>
            <li><strong>Settings:</strong> Keep last 4 characters</li>
            <li><strong>Output:</strong> .pdf, .jpg, t.js</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Extract ID Suffixes</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> USER-12345, PROD-67890, ORDER-11111</li>
            <li><strong>Settings:</strong> Keep last 5 characters</li>
            <li><strong>Output:</strong> 12345, 67890, 11111</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Use for extracting file extensions - keep last 4 or 5 characters</li>
            <li>Great for getting suffixes from product codes or IDs</li>
            <li>Padding helps create uniform-length results</li>
            <li>Use "Add ellipsis" when showing truncated previews from the end</li>
            <li>Works great with structured data files and logs</li>
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
        const inputElement = document.getElementById('keepLastChars-input');
        if (inputElement) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Set the conversion function
    setKeepLastCharsConverter(function(text) {
        if (!text) return '';
        
        const lines = text.split('\n');
        
        const processedLines = lines.map(line => {
            // Skip empty lines if option enabled
            if (!line.trim() && extractOptions.skipEmptyLines) {
                return '';
            }
            
            // Trim if option enabled
            let processedLine = extractOptions.trimLines ? line.trim() : line;
            
            // Extract last N characters
            const startPos = Math.max(0, processedLine.length - extractOptions.charCount);
            let result = processedLine.substring(startPos);
            
            // Handle short lines
            if (processedLine.length < extractOptions.charCount) {
                if (extractOptions.fillMode === 'skip') {
                    return null; // Will be filtered out
                } else if (extractOptions.fillMode === 'keep') {
                    // Keep as is
                } else if (extractOptions.fillMode.startsWith('pad-') || extractOptions.fillMode === 'pad-custom') {
                    // Pad to target length (at the beginning for last chars)
                    const paddingNeeded = extractOptions.charCount - result.length;
                    result = extractOptions.paddingChar.repeat(paddingNeeded) + result;
                }
            } else if (processedLine.length > extractOptions.charCount && extractOptions.addEllipsis) {
                // Add ellipsis for truncated text (at the beginning for last chars)
                result = '...' + result;
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

