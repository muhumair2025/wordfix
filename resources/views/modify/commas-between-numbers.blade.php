@extends('layouts.tool')

@section('title', 'Commas Between Numbers Tool - WordFix')

@section('tool-title', 'Commas Between Numbers Tool')

@section('tool-description', 'Add commas between each number or digit in your text')

@section('tool-content')
<!-- Conversion Options -->
<div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h3 class="text-sm font-semibold text-gray-900 mb-4">Comma Insertion Options</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div>
            <label for="separatorType" class="block text-sm font-medium text-gray-700 mb-2">Separator Type:</label>
            <select id="separatorType" onchange="updateConversion()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value=", ">Comma with space (, )</option>
                <option value=",">Comma (,)</option>
                <option value="; ">Semicolon with space (; )</option>
                <option value=";">Semicolon (;)</option>
                <option value=" | ">Pipe with spaces ( | )</option>
                <option value="|">Pipe (|)</option>
                <option value=" - ">Dash with spaces ( - )</option>
                <option value="-">Dash (-)</option>
                <option value=" ">Space only</option>
                <option value="custom">Custom...</option>
            </select>
        </div>
        
        <div id="customSeparatorDiv" style="display: none;">
            <label for="customSeparator" class="block text-sm font-medium text-gray-700 mb-2">Custom Separator:</label>
            <input 
                type="text" 
                id="customSeparator"
                placeholder="Enter custom separator"
                oninput="updateConversion()"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
        </div>
        
        <div>
            <label for="groupingSize" class="block text-sm font-medium text-gray-700 mb-2">Group Numbers Every:</label>
            <select id="groupingSize" onchange="updateConversion()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="1">1 digit (1,2,3,4)</option>
                <option value="2">2 digits (12,34,56)</option>
                <option value="3">3 digits (123,456,789)</option>
                <option value="4">4 digits (1234,5678)</option>
            </select>
        </div>
    </div>
    
    <div class="flex flex-wrap gap-4">
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="onlyNumbers" checked onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Process numbers only (ignore text)</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="preserveSpaces" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Preserve existing spaces</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="processDecimals" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Keep decimals together</span>
        </label>
    </div>
</div>

<!-- Quick Examples -->
<div class="mb-6">
    <h3 class="text-sm font-semibold text-gray-900 mb-3">Quick Examples:</h3>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
        <button onclick="loadExample('phone')" class="px-3 py-2 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Phone Number
        </button>
        <button onclick="loadExample('credit-card')" class="px-3 py-2 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Credit Card
        </button>
        <button onclick="loadExample('large-number')" class="px-3 py-2 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Large Number (1,000,000)
        </button>
        <button onclick="loadExample('list')" class="px-3 py-2 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Number List
        </button>
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="commaNumbers"
    inputPlaceholder="Enter numbers or text with numbers"
    outputPlaceholder="Result with commas will appear here"
    downloadFileName="numbers-with-commas.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    Free online tool that adds commas between numbers. Simply enter the list of numbers and the online tool will add commas between each number. You can group numbers and choose different separators for various formatting needs.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Commas Between Numbers Examples</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 1: Format Large Number</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> <code>1000000</code></div>
                <div><strong>Output:</strong> <code>1,000,000</code></div>
                <div class="text-xs text-gray-500 mt-1">Settings: Group every 3 digits, comma separator</div>
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 2: Format Credit Card</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> <code>1234567890123456</code></div>
                <div><strong>Output:</strong> <code>1234-5678-9012-3456</code></div>
                <div class="text-xs text-gray-500 mt-1">Settings: Group every 4 digits, dash separator</div>
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 3: Format Phone Number</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> <code>1234567890</code></div>
                <div><strong>Output:</strong> <code>123-456-7890</code></div>
                <div class="text-xs text-gray-500 mt-1">Settings: Group by 3,3,4 pattern with dash</div>
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 4: Number List</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> <code>123456</code></div>
                <div><strong>Output:</strong> <code>1, 2, 3, 4, 5, 6</code></div>
                <div class="text-xs text-gray-500 mt-1">Settings: Group every 1 digit, comma with space</div>
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Commas Between Numbers Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Commas Between Numbers Tool</strong> automatically adds commas or other separators between numbers in your text. Perfect for formatting large numbers, credit card numbers, phone numbers, or creating number sequences with custom separators.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use This Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Choose your separator type (comma, dash, pipe, space, or custom)</li>
            <li>Select grouping size (1, 2, 3, or 4 digits per group)</li>
            <li>Configure your options:
                <ul class="list-disc list-inside ml-6 mt-2">
                    <li><strong>Process numbers only</strong> - Only add commas to numbers, leave text unchanged</li>
                    <li><strong>Preserve existing spaces</strong> - Keep spaces in the original text</li>
                    <li><strong>Keep decimals together</strong> - Don't split decimal numbers</li>
                </ul>
            </li>
            <li>Or click a quick example to see common use cases</li>
            <li>Paste your numbers or text into the input box</li>
            <li>Get formatted results instantly</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Multiple Separator Options</strong> - Comma, semicolon, pipe, dash, space, or custom</li>
            <li><strong>Flexible Grouping</strong> - Group by 1, 2, 3, or 4 digits</li>
            <li><strong>Smart Number Detection</strong> - Process only numbers, ignore text</li>
            <li><strong>Decimal Handling</strong> - Option to keep decimal numbers intact</li>
            <li><strong>Space Preservation</strong> - Maintain original spacing if needed</li>
            <li><strong>Quick Examples</strong> - Pre-loaded examples for common formats</li>
            <li><strong>Custom Separators</strong> - Use any character or string as separator</li>
            <li>Real-time formatting as you type</li>
            <li>Works with very large numbers</li>
            <li>Import/export functionality</li>
            <li>Mobile responsive</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Large Number Formatting</strong> - Format 1000000 as 1,000,000 for readability</li>
            <li><strong>Credit Card Numbers</strong> - Format as 1234-5678-9012-3456</li>
            <li><strong>Phone Numbers</strong> - Format as 123-456-7890 or (123) 456-7890</li>
            <li><strong>Bank Account Numbers</strong> - Add separators for easier reading</li>
            <li><strong>Serial Numbers</strong> - Format product codes or IDs</li>
            <li><strong>Number Sequences</strong> - Create comma-separated digit lists</li>
            <li><strong>Financial Data</strong> - Format currency amounts with thousand separators</li>
            <li><strong>ID Formatting</strong> - Make long IDs more readable</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Grouping Options Explained</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">1 Digit Groups</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> 123456</li>
            <li><strong>Output:</strong> 1, 2, 3, 4, 5, 6</li>
            <li><strong>Use case:</strong> Individual digit separation</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">2 Digit Groups</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> 12345678</li>
            <li><strong>Output:</strong> 12, 34, 56, 78</li>
            <li><strong>Use case:</strong> Paired digit formatting</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">3 Digit Groups (Standard)</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> 1234567890</li>
            <li><strong>Output:</strong> 1,234,567,890</li>
            <li><strong>Use case:</strong> Standard thousand separators</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">4 Digit Groups</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> 1234567890123456</li>
            <li><strong>Output:</strong> 1234-5678-9012-3456</li>
            <li><strong>Use case:</strong> Credit card formatting</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Advanced Examples</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Format Mixed Text and Numbers</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> Order ID: 1234567890</li>
            <li><strong>Settings:</strong> Process numbers only, 3-digit groups, comma separator</li>
            <li><strong>Output:</strong> Order ID: 1,234,567,890</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Format Serial Code</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> PROD123456789ABC</li>
            <li><strong>Settings:</strong> Numbers only, 3-digit groups, dash separator</li>
            <li><strong>Output:</strong> PROD123-456-789ABC</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Use 3-digit grouping for standard thousand separators (1,000,000)</li>
            <li>Use 4-digit grouping with dash separator for credit card formatting</li>
            <li>Enable "Process numbers only" to format numbers within text without affecting words</li>
            <li>Use "Keep decimals together" when working with financial data (123.45 won't become 123,.,45)</li>
            <li>Quick examples load pre-configured settings you can modify</li>
            <li>Custom separators allow for any creative formatting pattern</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let conversionOptions = {
        separator: ', ',
        groupingSize: 1,
        onlyNumbers: true,
        preserveSpaces: false,
        processDecimals: false,
        customSeparator: ''
    };
    
    // Quick example presets
    const examples = {
        'phone': {
            text: '1234567890',
            separator: '-',
            groupingSize: 3,
            description: 'Phone number format'
        },
        'credit-card': {
            text: '1234567890123456',
            separator: '-',
            groupingSize: 4,
            description: 'Credit card format'
        },
        'large-number': {
            text: '1000000',
            separator: ', ',
            groupingSize: 3,
            description: 'Standard thousand separators'
        },
        'list': {
            text: '123456789',
            separator: ', ',
            groupingSize: 1,
            description: 'Individual digits separated'
        }
    };
    
    // Load example
    window.loadExample = function(exampleName) {
        const example = examples[exampleName];
        if (!example) return;
        
        // Set the input
        const inputElement = document.getElementById('commaNumbers-input');
        if (inputElement) {
            inputElement.value = example.text;
        }
        
        // Set options
        document.getElementById('separatorType').value = example.separator;
        document.getElementById('groupingSize').value = example.groupingSize;
        
        updateConversion();
    };
    
    // Update conversion options
    window.updateConversion = function() {
        const separatorSelect = document.getElementById('separatorType');
        
        if (separatorSelect.value === 'custom') {
            conversionOptions.separator = document.getElementById('customSeparator').value;
            document.getElementById('customSeparatorDiv').style.display = 'block';
        } else {
            conversionOptions.separator = separatorSelect.value;
            document.getElementById('customSeparatorDiv').style.display = 'none';
        }
        
        conversionOptions.groupingSize = parseInt(document.getElementById('groupingSize').value) || 1;
        conversionOptions.onlyNumbers = document.getElementById('onlyNumbers').checked;
        conversionOptions.preserveSpaces = document.getElementById('preserveSpaces').checked;
        conversionOptions.processDecimals = document.getElementById('processDecimals').checked;
        
        // Trigger re-conversion
        const inputElement = document.getElementById('commaNumbers-input');
        if (inputElement) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Set the conversion function
    setCommaNumbersConverter(function(text) {
        if (!text || !text.trim()) return '';
        
        if (conversionOptions.onlyNumbers) {
            // Process only numbers in text, leave rest unchanged
            return text.replace(/\d+(\.\d+)?/g, (match) => {
                // If it's a decimal and we should keep decimals together
                if (match.includes('.') && conversionOptions.processDecimals) {
                    return match; // Don't modify decimals
                }
                
                return addCommasToNumber(match);
            });
        } else {
            // Process entire text as numbers
            return addCommasToNumber(text);
        }
    });
    
    function addCommasToNumber(numStr) {
        // Remove existing commas/separators if any
        numStr = numStr.replace(/[,\s-]/g, '');
        
        // Handle decimal numbers
        if (numStr.includes('.') && conversionOptions.processDecimals) {
            const parts = numStr.split('.');
            const integerPart = addCommasToInteger(parts[0]);
            return integerPart + '.' + parts[1];
        }
        
        return addCommasToInteger(numStr);
    }
    
    function addCommasToInteger(numStr) {
        const groupSize = conversionOptions.groupingSize;
        const separator = conversionOptions.separator;
        
        // Split into groups from right to left
        const groups = [];
        let remaining = numStr;
        
        while (remaining.length > 0) {
            const endPos = remaining.length;
            const startPos = Math.max(0, endPos - groupSize);
            const group = remaining.substring(startPos, endPos);
            
            groups.unshift(group);
            remaining = remaining.substring(0, startPos);
        }
        
        return groups.join(separator);
    }
    
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateConversion();
    });
</script>
@endpush

