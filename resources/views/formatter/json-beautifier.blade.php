@extends('layouts.tool')

@section('title', 'Online JSON Beautifier Tool - WordFix')

@section('tool-title', 'Online JSON Beautifier Tool')

@section('tool-description', 'Format and beautify your JSON data with proper indentation and validation')

@section('tool-content')
<!-- Text Converter Component -->
<x-text-converter 
    toolId="jsonBeautifier"
    inputPlaceholder="Paste your minified or unformatted JSON here"
    outputPlaceholder="Beautified JSON will appear here"
    downloadFileName="beautified.json"
    :showStats="true"
/>

<!-- Formatting Options -->
<div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h3 class="text-sm font-semibold text-gray-900 mb-3">Formatting Options</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <label for="indentSize" class="block text-xs font-medium text-gray-700 mb-1">Indent Size:</label>
            <select id="indentSize" onchange="updateFormatting()" class="w-full px-3 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="2">2 spaces</option>
                <option value="4" selected>4 spaces</option>
                <option value="tab">1 tab</option>
            </select>
        </div>
        <div class="flex items-end">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="sortKeys" onchange="updateFormatting()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Sort keys alphabetically</span>
            </label>
        </div>
        <div class="flex items-end">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="compactArrays" onchange="updateFormatting()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Compact small arrays</span>
            </label>
        </div>
    </div>
</div>

<!-- Validation Status -->
<div id="validationStatus" class="mb-6"></div>

<div class="text-sm text-blue-600 mb-6">
    This JSON beautifier formats your minified or messy JSON data into a clean, readable format with proper indentation. It also validates your JSON and reports any syntax errors.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">JSON Beautifier Example</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before (Minified JSON)</p>
            <div class="bg-red-50 border border-red-200 rounded p-3 text-xs text-gray-700 font-mono overflow-x-auto">
                {"name":"John Doe","age":30,"city":"New York","hobbies":["reading","coding","gaming"],"contact":{"email":"john@example.com","phone":"555-0123"}}
            </div>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After (Beautified JSON)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-xs text-gray-700 font-mono overflow-y-auto" style="max-height: 300px;">
                {<br>
                &nbsp;&nbsp;&nbsp;&nbsp;"name": "John Doe",<br>
                &nbsp;&nbsp;&nbsp;&nbsp;"age": 30,<br>
                &nbsp;&nbsp;&nbsp;&nbsp;"city": "New York",<br>
                &nbsp;&nbsp;&nbsp;&nbsp;"hobbies": [<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"reading",<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"coding",<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"gaming"<br>
                &nbsp;&nbsp;&nbsp;&nbsp;],<br>
                &nbsp;&nbsp;&nbsp;&nbsp;"contact": {<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"email": "john@example.com",<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"phone": "555-0123"<br>
                &nbsp;&nbsp;&nbsp;&nbsp;}<br>
                }
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About JSON Beautifier Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>JSON Beautifier</strong> is a powerful formatting and validation tool that transforms minified, compressed, or messy JSON data into a clean, readable, and properly indented format. It also validates your JSON syntax and reports errors.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use the JSON Beautifier</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Paste your minified or unformatted JSON into the input box</li>
            <li>Choose your preferred formatting options (indent size, key sorting)</li>
            <li>The tool automatically beautifies and validates your JSON in real-time</li>
            <li>Check the validation status for any syntax errors</li>
            <li>Copy the formatted JSON or download it as a .json file</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>JSON Validation</strong> - Automatically detects and reports syntax errors</li>
            <li><strong>Sort Keys</strong> - Alphabetically sort object keys for consistency</li>
            <li><strong>Compact Arrays</strong> - Keep small arrays on a single line for better readability</li>
            <li>Automatic indentation with customizable indent size (2 or 4 spaces, or tabs)</li>
            <li>Proper formatting of nested objects and arrays</li>
            <li>Handles large JSON files efficiently</li>
            <li>Preserves data types (strings, numbers, booleans, null)</li>
            <li>Supports Unicode characters and escaped sequences</li>
            <li>Real-time formatting as you type</li>
            <li>Import JSON from files</li>
            <li>Download beautified JSON</li>
            <li>Color-coded validation feedback</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">JSON Validation</h3>
        <p>
            The tool automatically validates your JSON and provides detailed error messages if there are issues:
        </p>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Syntax Errors:</strong> Missing commas, brackets, or quotes</li>
            <li><strong>Invalid Values:</strong> Unquoted strings or invalid data types</li>
            <li><strong>Structure Issues:</strong> Unclosed objects or arrays</li>
            <li><strong>Success Indicator:</strong> Green checkmark when JSON is valid</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Formatting API responses for debugging</li>
            <li>Cleaning up configuration files</li>
            <li>Validating JSON before sending to APIs</li>
            <li>Making minified JSON data readable</li>
            <li>Organizing package.json and other config files</li>
            <li>Debugging JSON parsing errors</li>
            <li>Learning JSON structure and syntax</li>
            <li>Preparing JSON for documentation</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Use "Sort keys alphabetically" to maintain consistent key ordering</li>
            <li>Enable "Compact small arrays" for more readable output with simple arrays</li>
            <li>The tool handles very large JSON files (up to several MB)</li>
            <li>Validation errors show the approximate location of the problem</li>
            <li>Works great with API responses, config files, and database exports</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let formatOptions = {
        indentSize: 4,
        indentChar: ' ',
        sortKeys: false,
        compactArrays: false
    };
    
    // Update formatting options
    window.updateFormatting = function() {
        const indentSize = document.getElementById('indentSize').value;
        if (indentSize === 'tab') {
            formatOptions.indentSize = 1;
            formatOptions.indentChar = '\t';
        } else {
            formatOptions.indentSize = parseInt(indentSize);
            formatOptions.indentChar = ' ';
        }
        
        formatOptions.sortKeys = document.getElementById('sortKeys').checked;
        formatOptions.compactArrays = document.getElementById('compactArrays').checked;
        
        // Trigger re-conversion
        const inputElement = document.getElementById('jsonBeautifier-input');
        if (inputElement) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Set the conversion function for the component
    setJsonBeautifierConverter(function(json) {
        if (!json || !json.trim()) {
            updateValidationStatus(null);
            return '';
        }
        return beautifyJSON(json, formatOptions);
    });
    
    function beautifyJSON(json, options) {
        try {
            // Parse JSON
            const parsed = JSON.parse(json);
            
            // Sort keys if option is enabled
            const processed = options.sortKeys ? sortObjectKeys(parsed) : parsed;
            
            // Beautify with custom formatting
            const beautified = customJSONStringify(processed, options);
            
            // Update validation status
            updateValidationStatus(true);
            
            return beautified;
        } catch (error) {
            // Update validation status with error
            updateValidationStatus(false, error.message);
            
            // Return original or error message
            return `/* JSON Syntax Error: ${error.message} */\n\n${json}`;
        }
    }
    
    function sortObjectKeys(obj) {
        if (Array.isArray(obj)) {
            return obj.map(item => sortObjectKeys(item));
        } else if (obj !== null && typeof obj === 'object') {
            const sorted = {};
            Object.keys(obj).sort().forEach(key => {
                sorted[key] = sortObjectKeys(obj[key]);
            });
            return sorted;
        }
        return obj;
    }
    
    function customJSONStringify(obj, options, currentIndent = 0) {
        const indent = options.indentChar.repeat(options.indentSize);
        const currentIndentStr = options.indentChar.repeat(options.indentSize * currentIndent);
        const nextIndentStr = options.indentChar.repeat(options.indentSize * (currentIndent + 1));
        
        if (obj === null) return 'null';
        if (typeof obj === 'boolean') return obj.toString();
        if (typeof obj === 'number') return obj.toString();
        if (typeof obj === 'string') return JSON.stringify(obj);
        
        if (Array.isArray(obj)) {
            if (obj.length === 0) return '[]';
            
            // Check if array should be compact
            const isCompact = options.compactArrays && obj.length <= 3 && 
                              obj.every(item => typeof item !== 'object' || item === null);
            
            if (isCompact) {
                const items = obj.map(item => customJSONStringify(item, options, currentIndent + 1));
                return '[' + items.join(', ') + ']';
            }
            
            let result = '[\n';
            obj.forEach((item, index) => {
                result += nextIndentStr + customJSONStringify(item, options, currentIndent + 1);
                if (index < obj.length - 1) result += ',';
                result += '\n';
            });
            result += currentIndentStr + ']';
            return result;
        }
        
        if (typeof obj === 'object') {
            const keys = Object.keys(obj);
            if (keys.length === 0) return '{}';
            
            let result = '{\n';
            keys.forEach((key, index) => {
                result += nextIndentStr + JSON.stringify(key) + ': ';
                result += customJSONStringify(obj[key], options, currentIndent + 1);
                if (index < keys.length - 1) result += ',';
                result += '\n';
            });
            result += currentIndentStr + '}';
            return result;
        }
        
        return JSON.stringify(obj);
    }
    
    function updateValidationStatus(isValid, errorMessage = '') {
        const statusDiv = document.getElementById('validationStatus');
        
        if (isValid === null) {
            statusDiv.innerHTML = '';
            return;
        }
        
        if (isValid) {
            statusDiv.innerHTML = `
                <div class="flex items-center gap-2 p-4 bg-green-50 border border-green-200 rounded-lg">
                    <svg class="w-5 h-5 text-green-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-green-700">Valid JSON</p>
                        <p class="text-xs text-green-600">Your JSON syntax is correct and properly formatted.</p>
                    </div>
                </div>
            `;
        } else {
            statusDiv.innerHTML = `
                <div class="flex items-start gap-2 p-4 bg-red-50 border border-red-200 rounded-lg">
                    <svg class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-red-700">Invalid JSON</p>
                        <p class="text-xs text-red-600 mt-1">${errorMessage}</p>
                    </div>
                </div>
            `;
        }
    }
</script>
@endpush

