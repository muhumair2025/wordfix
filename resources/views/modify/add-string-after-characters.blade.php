@extends('layouts.tool')

@section('title', 'Add String After Number of Characters - WordFix')

@section('tool-title', 'Add String After Number of Characters')

@section('tool-description', 'Insert custom text after a specific number of characters')

@section('tool-content')
<!-- Custom Options -->
<div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h3 class="text-sm font-semibold text-gray-900 mb-4">String Insertion Options</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="customText" class="block text-sm font-medium text-gray-700 mb-2">Custom Appended Text:</label>
            <input 
                type="text" 
                id="customText"
                placeholder="Enter text to append (e.g., ... or | or linebreak)"
                oninput="updateConversion()"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
            <p class="text-xs text-gray-500 mt-1">Tip: Use <code class="bg-gray-200 px-1 rounded">\n</code> for line break</p>
        </div>
        
        <div>
            <label for="afterChars" class="block text-sm font-medium text-gray-700 mb-2">Append after this many characters:</label>
            <input 
                type="number" 
                id="afterChars"
                value="50"
                min="1"
                oninput="updateConversion()"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
        </div>
    </div>
    
    <div class="mt-4 flex flex-wrap gap-4">
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="resetOnLineBreak" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Reset counter on line break</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="skipSpaces" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Don't count spaces</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="appendAtEnd" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Also append at end if incomplete</span>
        </label>
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="addStringAfter"
    inputPlaceholder="Type or paste your content here"
    outputPlaceholder="Text with inserted strings will appear here"
    downloadFileName="modified-text.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    Free online tool that adds text after a certain number of characters. You can insert a character after every 2,3,4,5 or more characters. Perfect for formatting text, adding separators, or breaking long strings.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Add String After Characters Example</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before (Original Text)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
            </div>
            <p class="text-xs text-gray-500 mt-2">
                Settings: Insert " | " after every 30 characters
            </p>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After (Modified Text)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
                Lorem Ipsum is simply dummy | text of the printing and typ | esetting industry. Lorem Ips | um has been the industry's st | andard dummy text ever since  | the 1500s.
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Add String After Number of Characters Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Add String After Number of Characters</strong> tool allows you to insert custom text or characters at regular intervals throughout your content. This is useful for formatting, adding separators, breaking long strings, or creating structured text patterns.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use This Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Enter the text or character you want to insert in the "Custom Appended Text" field</li>
            <li>Set the number of characters after which to insert your text</li>
            <li>Choose your options:
                <ul class="list-disc list-inside ml-6 mt-2">
                    <li><strong>Reset counter on line break</strong> - Start counting from 0 on each new line</li>
                    <li><strong>Don't count spaces</strong> - Exclude spaces from the character count</li>
                    <li><strong>Also append at end</strong> - Add the string at the end even if the final segment is shorter</li>
                </ul>
            </li>
            <li>Type or paste your text into the input box</li>
            <li>The modified text appears automatically in the output</li>
            <li>Copy or download the result</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Custom Text Insertion</strong> - Insert any text, character, or symbol</li>
            <li><strong>Flexible Character Count</strong> - Set any number from 1 to thousands</li>
            <li><strong>Line Break Support</strong> - Use <code>\n</code> to insert actual line breaks</li>
            <li><strong>Reset on New Lines</strong> - Option to restart counting on each line</li>
            <li><strong>Skip Spaces</strong> - Count only non-space characters</li>
            <li><strong>End Handling</strong> - Choose whether to append at incomplete segments</li>
            <li>Real-time conversion as you type</li>
            <li>Import text from files</li>
            <li>Download modified text</li>
            <li>Comprehensive text statistics</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Formatting Long Strings</strong> - Break credit card numbers, serial codes, or IDs (e.g., 1234-5678-9012-3456)</li>
            <li><strong>Adding Separators</strong> - Insert pipes, dashes, or other separators at intervals</li>
            <li><strong>Creating Patterns</strong> - Generate patterned text for design or testing</li>
            <li><strong>Line Breaking</strong> - Automatically break long lines at specific character counts</li>
            <li><strong>Text Formatting</strong> - Add ellipsis (...) or other markers at regular intervals</li>
            <li><strong>Code Formatting</strong> - Insert line breaks or comments at specific positions</li>
            <li><strong>SMS/Tweet Splitting</strong> - Break messages at character limits</li>
            <li><strong>Data Formatting</strong> - Format strings for database or API requirements</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Example Use Cases</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">1. Format Credit Card Number</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> 1234567890123456</li>
            <li><strong>Settings:</strong> Insert " " after every 4 characters</li>
            <li><strong>Output:</strong> 1234 5678 9012 3456</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">2. Break Long URLs</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> https://example.com/very-long-url-path</li>
            <li><strong>Settings:</strong> Insert "\n" after every 20 characters</li>
            <li><strong>Output:</strong> Multi-line broken URL</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">3. Add Ellipsis for Preview</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> Long paragraph of text</li>
            <li><strong>Settings:</strong> Insert "..." after every 100 characters</li>
            <li><strong>Output:</strong> Text with reading breaks</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Special Characters</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>\n</strong> - Line break (new line)</li>
            <li><strong>\t</strong> - Tab character</li>
            <li><strong>|</strong> - Pipe separator</li>
            <li><strong>-</strong> - Dash separator</li>
            <li><strong>...</strong> - Ellipsis</li>
            <li><strong>&lt;br&gt;</strong> - HTML line break</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Use "Reset counter on line break" when formatting multi-line content independently</li>
            <li>Enable "Don't count spaces" when formatting codes or IDs without spaces</li>
            <li>Use <code>\n</code> in the custom text field to insert actual line breaks</li>
            <li>Common intervals: 4 for credit cards, 3 for phone numbers, 50-80 for line wrapping</li>
            <li>Test with small intervals first to see the pattern before processing large texts</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let conversionOptions = {
        customText: '',
        afterChars: 50,
        resetOnLineBreak: false,
        skipSpaces: false,
        appendAtEnd: false
    };
    
    // Update conversion options
    window.updateConversion = function() {
        conversionOptions.customText = document.getElementById('customText').value;
        conversionOptions.afterChars = parseInt(document.getElementById('afterChars').value) || 50;
        conversionOptions.resetOnLineBreak = document.getElementById('resetOnLineBreak').checked;
        conversionOptions.skipSpaces = document.getElementById('skipSpaces').checked;
        conversionOptions.appendAtEnd = document.getElementById('appendAtEnd').checked;
        
        // Trigger re-conversion
        const inputElement = document.getElementById('addStringAfter-input');
        if (inputElement) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Set the conversion function for the component
    setAddStringAfterConverter(function(text) {
        if (!text || !text.trim()) return '';
        if (!conversionOptions.customText) return text;
        if (conversionOptions.afterChars < 1) return text;
        
        // Replace escape sequences in custom text
        let insertText = conversionOptions.customText
            .replace(/\\n/g, '\n')
            .replace(/\\t/g, '\t')
            .replace(/\\r/g, '\r');
        
        if (conversionOptions.resetOnLineBreak) {
            // Process line by line
            const lines = text.split('\n');
            const processedLines = lines.map(line => processLine(line, insertText));
            return processedLines.join('\n');
        } else {
            // Process entire text
            return processLine(text, insertText);
        }
    });
    
    function processLine(text, insertText) {
        if (!text) return text;
        
        let result = '';
        let charCount = 0;
        
        for (let i = 0; i < text.length; i++) {
            const char = text[i];
            
            // Add the character
            result += char;
            
            // Count the character (skip spaces if option is enabled)
            if (!conversionOptions.skipSpaces || char !== ' ') {
                charCount++;
            }
            
            // Check if we should insert the custom text
            if (charCount === conversionOptions.afterChars && i < text.length - 1) {
                result += insertText;
                charCount = 0; // Reset counter
            }
        }
        
        // Optionally append at the end if we have incomplete segment
        if (conversionOptions.appendAtEnd && charCount > 0 && charCount < conversionOptions.afterChars) {
            result += insertText;
        }
        
        return result;
    }
    
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateConversion();
    });
</script>
@endpush

