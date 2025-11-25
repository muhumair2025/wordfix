@extends('layouts.tool')

@section('title', 'Column to Comma Converter - WordFix')

@section('tool-title', 'Column to Comma / Comma to Column Converter')

@section('tool-description', 'Convert between columns (lines) and comma-separated values - bidirectional converter')

@section('tool-content')
<!-- Conversion Mode Toggle -->
<div class="mb-6 flex justify-center">
    <div class="inline-flex rounded-md shadow-sm" role="group">
        <button 
            type="button" 
            id="btnColumnToComma"
            onclick="setConversionMode('column-to-comma')"
            class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-l-lg hover:bg-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-500"
        >
            Column to Comma
        </button>
        <button 
            type="button" 
            id="btnCommaToColumn"
            onclick="setConversionMode('comma-to-column')"
            class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500"
        >
            Comma to Column
        </button>
    </div>
</div>

<!-- Custom Options -->
<div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h3 class="text-sm font-semibold text-gray-900 mb-4">Conversion Options</h3>
    
    <!-- Column to Comma Options -->
    <div id="columnToCommaOptions">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="separator" class="block text-sm font-medium text-gray-700 mb-2">Separator:</label>
                <select id="separator" onchange="updateConversion()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value=",">Comma (,)</option>
                    <option value=", ">Comma with space (, )</option>
                    <option value=";">Semicolon (;)</option>
                    <option value="; ">Semicolon with space (; )</option>
                    <option value="|">Pipe (|)</option>
                    <option value=" | ">Pipe with spaces ( | )</option>
                    <option value="\t">Tab</option>
                    <option value=" ">Space</option>
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
        </div>
        
        <div class="flex flex-wrap gap-4">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="addQuotes" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Add quotes around items</span>
            </label>
            
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="skipEmptyLines" checked onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Skip empty lines</span>
            </label>
            
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="trimItems" checked onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Trim whitespace</span>
            </label>
            
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="addFinalComma" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Add trailing separator</span>
            </label>
        </div>
    </div>
    
    <!-- Comma to Column Options -->
    <div id="commaToColumnOptions" style="display: none;">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
            <div>
                <label for="splitBy" class="block text-sm font-medium text-gray-700 mb-2">Split by:</label>
                <select id="splitBy" onchange="updateConversion()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <option value=",">Comma (,)</option>
                    <option value=";">Semicolon (;)</option>
                    <option value="|">Pipe (|)</option>
                    <option value="\t">Tab</option>
                    <option value=" ">Space</option>
                    <option value="custom">Custom...</option>
                </select>
            </div>
            
            <div id="customSplitDiv" style="display: none;">
                <label for="customSplit" class="block text-sm font-medium text-gray-700 mb-2">Custom Delimiter:</label>
                <input 
                    type="text" 
                    id="customSplit"
                    placeholder="Enter custom delimiter"
                    oninput="updateConversion()"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                />
            </div>
        </div>
        
        <div class="flex flex-wrap gap-4">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="removeQuotes" checked onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Remove quotes</span>
            </label>
            
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="trimItems2" checked onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Trim whitespace</span>
            </label>
            
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="skipEmptyItems" checked onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Skip empty items</span>
            </label>
        </div>
    </div>
</div>

<!-- Quick Presets -->
<div class="mb-6">
    <h3 class="text-sm font-semibold text-gray-900 mb-3">Quick Presets (Column to Comma):</h3>
    <div class="flex flex-wrap gap-2">
        <button onclick="applyPreset('csv')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            CSV Format
        </button>
        <button onclick="applyPreset('array')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Array Items
        </button>
        <button onclick="applyPreset('sql')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            SQL IN Clause
        </button>
        <button onclick="applyPreset('json')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            JSON Array
        </button>
        <button onclick="applyPreset('pipe')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Pipe Separated
        </button>
        <button onclick="applyPreset('tab')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Tab Separated
        </button>
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="columnComma"
    inputPlaceholder="Enter each item on a new line"
    outputPlaceholder="Comma-separated result will appear here"
    downloadFileName="converted-text.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    Free online tool that converts columns to commas. Simply enter the text and the online tool will replace columns with commas. You can also reverse the process and convert comma-separated values back to columns.
</div>

<!-- Instructions -->
<div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
    <p class="text-sm text-gray-700">
        <strong>Instructions:</strong> <span id="instructionText">Enter your text in the first textarea. Each column should be separated by a new line and the results will be shown in the second textarea.</span>
    </p>
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Column to Comma Example</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before (Column Format)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
                Apple<br>
                Banana<br>
                Orange<br>
                Grapes
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After (Comma-Separated)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
                Apple, Banana, Orange, Grapes
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Column to Comma Converter Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Column to Comma Converter</strong> is a versatile bidirectional tool that converts column-formatted text (one item per line) into comma-separated values, and vice versa. The "Comma to Column" mode also handles converting text with commas to separate lines. Perfect for formatting data, creating lists, preparing CSV files, or converting between different data formats.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use This Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Choose your conversion mode: "Column to Comma" or "Comma to Column"</li>
            <li>Select your separator or delimiter from the dropdown</li>
            <li>Configure your options (quotes, trimming, empty lines, etc.)</li>
            <li>Or click a quick preset for common formats</li>
            <li>Paste your text into the input area</li>
            <li>Get instant results in the output area</li>
            <li>Copy or download the converted text</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Bidirectional Conversion</strong> - Convert column to comma AND comma to column</li>
            <li><strong>Multiple Separators</strong> - Comma, semicolon, pipe, tab, space, or custom</li>
            <li><strong>Quote Support</strong> - Add or remove quotes around items</li>
            <li><strong>Smart Trimming</strong> - Remove extra whitespace from items</li>
            <li><strong>Empty Line Handling</strong> - Skip or include empty entries</li>
            <li><strong>Trailing Separator</strong> - Option to add separator at the end</li>
            <li><strong>6 Quick Presets</strong> - CSV, Array, SQL, JSON, Pipe, Tab formats</li>
            <li>Real-time conversion as you type</li>
            <li>Import/export functionality</li>
            <li>Comprehensive text statistics</li>
            <li>Mobile responsive design</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Quick Preset Examples</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">1. CSV Format</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Output:</strong> item1, item2, item3</li>
            <li><strong>Use case:</strong> Create CSV files or spreadsheet data</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">2. Array Items</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Output:</strong> "item1", "item2", "item3"</li>
            <li><strong>Use case:</strong> JavaScript/Python array formatting</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">3. SQL IN Clause</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Output:</strong> 'item1', 'item2', 'item3'</li>
            <li><strong>Use case:</strong> SQL WHERE IN queries</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">4. JSON Array</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Output:</strong> "item1","item2","item3"</li>
            <li><strong>Use case:</strong> JSON array formatting</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>CSV File Creation</strong> - Convert list items to CSV format (Column to Comma mode)</li>
            <li><strong>Split Comma-Separated Text</strong> - Convert commas to individual lines for easier reading (Comma to Column mode)</li>
            <li><strong>Array Formatting</strong> - Format data for programming arrays</li>
            <li><strong>SQL Queries</strong> - Create IN clauses with quoted values</li>
            <li><strong>Data Cleanup</strong> - Convert between different data formats</li>
            <li><strong>List Formatting</strong> - Change list structure for different uses</li>
            <li><strong>Spreadsheet Import</strong> - Prepare data for Excel/Google Sheets</li>
            <li><strong>Email Lists</strong> - Format email addresses with separators or split into lines</li>
            <li><strong>Tag Lists</strong> - Create comma-separated tag lists or convert back to individual tags</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Example Workflows</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Create SQL IN Clause</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input (Column):</strong></li>
            <li>john@email.com</li>
            <li>jane@email.com</li>
            <li>bob@email.com</li>
            <li><strong>Output:</strong> 'john@email.com', 'jane@email.com', 'bob@email.com'</li>
            <li><strong>Use in SQL:</strong> SELECT * FROM users WHERE email IN ('john@email.com', 'jane@email.com', 'bob@email.com')</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Format JavaScript Array</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> List of fruits (one per line)</li>
            <li><strong>Output:</strong> "Apple", "Banana", "Orange"</li>
            <li><strong>Use in JS:</strong> const fruits = ["Apple", "Banana", "Orange"];</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Conversion Modes</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Column to Comma</h4>
        <p>Converts line-by-line text into a single comma-separated (or other delimiter) string.</p>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Comma to Column</h4>
        <p>Splits comma-separated (or other delimiter) text into separate lines. Each comma-separated value becomes a new line, perfect for converting lists, CSV data, or any delimited text into a column format. <strong>This mode handles all "commas to lines" conversions.</strong></p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>This tool works in both directions - use "Comma to Column" mode to convert commas to lines</li>
            <li>Use "Skip empty lines" to ignore blank entries in your list</li>
            <li>Enable "Trim whitespace" to clean up data with inconsistent spacing</li>
            <li>Add quotes for SQL or programming language compatibility</li>
            <li>Use custom separators for specialized formats (not just commas!)</li>
            <li>The tool handles large lists efficiently</li>
            <li>Presets are great starting points - customize them as needed</li>
            <li>Switch modes easily to reverse the conversion with one click</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let conversionMode = 'column-to-comma';
    let conversionOptions = {
        separator: ', ',
        addQuotes: false,
        skipEmptyLines: true,
        trimItems: true,
        addFinalComma: false,
        splitBy: ',',
        removeQuotes: true,
        customSeparator: '',
        customSplit: ''
    };
    
    // Preset configurations
    const presets = {
        'csv': { separator: ', ', addQuotes: false },
        'array': { separator: ', ', addQuotes: true },
        'sql': { separator: ', ', addQuotes: 'single' },
        'json': { separator: ',', addQuotes: true },
        'pipe': { separator: ' | ', addQuotes: false },
        'tab': { separator: '\t', addQuotes: false }
    };
    
    // Set conversion mode
    window.setConversionMode = function(mode) {
        conversionMode = mode;
        
        // Update button styles
        const btnColumn = document.getElementById('btnColumnToComma');
        const btnComma = document.getElementById('btnCommaToColumn');
        
        if (mode === 'column-to-comma') {
            btnColumn.className = 'px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-l-lg hover:bg-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-500';
            btnComma.className = 'px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500';
            document.getElementById('columnToCommaOptions').style.display = 'block';
            document.getElementById('commaToColumnOptions').style.display = 'none';
            document.getElementById('instructionText').textContent = 'Enter your text in the first textarea. Each column should be separated by a new line and the results will be shown in the second textarea.';
        } else {
            btnColumn.className = 'px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500';
            btnComma.className = 'px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-r-lg hover:bg-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-500';
            document.getElementById('columnToCommaOptions').style.display = 'none';
            document.getElementById('commaToColumnOptions').style.display = 'block';
            document.getElementById('instructionText').textContent = 'Enter comma-separated text in the first textarea and it will be converted to column format (one item per line) in the second textarea.';
        }
        
        updateConversion();
    };
    
    // Apply preset
    window.applyPreset = function(presetName) {
        const preset = presets[presetName];
        if (!preset) return;
        
        document.getElementById('separator').value = preset.separator === '\t' ? '\t' : preset.separator;
        document.getElementById('addQuotes').checked = !!preset.addQuotes;
        
        // Handle SQL preset with single quotes
        if (preset.addQuotes === 'single') {
            document.getElementById('separator').value = 'custom';
            document.getElementById('customSeparator').value = "', '";
            document.getElementById('customSeparatorDiv').style.display = 'block';
        } else {
            document.getElementById('customSeparatorDiv').style.display = 'none';
        }
        
        updateConversion();
    };
    
    // Update conversion
    window.updateConversion = function() {
        const separatorSelect = document.getElementById('separator');
        conversionOptions.separator = separatorSelect.value === 'custom' 
            ? document.getElementById('customSeparator').value 
            : separatorSelect.value;
        
        conversionOptions.addQuotes = document.getElementById('addQuotes').checked;
        conversionOptions.skipEmptyLines = document.getElementById('skipEmptyLines').checked;
        conversionOptions.trimItems = document.getElementById('trimItems').checked;
        conversionOptions.addFinalComma = document.getElementById('addFinalComma').checked;
        
        const splitBySelect = document.getElementById('splitBy');
        conversionOptions.splitBy = splitBySelect.value === 'custom' 
            ? document.getElementById('customSplit').value 
            : splitBySelect.value;
        
        conversionOptions.removeQuotes = document.getElementById('removeQuotes').checked;
        conversionOptions.trimItems2 = document.getElementById('trimItems2').checked;
        conversionOptions.skipEmptyItems = document.getElementById('skipEmptyItems').checked;
        
        // Show/hide custom separator fields
        document.getElementById('customSeparatorDiv').style.display = 
            separatorSelect.value === 'custom' ? 'block' : 'none';
        document.getElementById('customSplitDiv').style.display = 
            splitBySelect.value === 'custom' ? 'block' : 'none';
        
        // Trigger re-conversion
        const inputElement = document.getElementById('columnComma-input');
        if (inputElement) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Set the conversion function
    setColumnCommaConverter(function(text) {
        if (!text || !text.trim()) return '';
        
        if (conversionMode === 'column-to-comma') {
            return columnToComma(text);
        } else {
            return commaToColumn(text);
        }
    });
    
    function columnToComma(text) {
        const lines = text.split('\n');
        
        let items = lines.map(line => {
            let item = conversionOptions.trimItems ? line.trim() : line;
            
            // Skip empty lines if option enabled
            if (!item && conversionOptions.skipEmptyLines) {
                return null;
            }
            
            // Add quotes if option enabled
            if (item && conversionOptions.addQuotes) {
                item = '"' + item + '"';
            }
            
            return item;
        }).filter(item => item !== null);
        
        const result = items.join(conversionOptions.separator);
        
        // Add final separator if option enabled
        if (conversionOptions.addFinalComma && result) {
            return result + conversionOptions.separator;
        }
        
        return result;
    }
    
    function commaToColumn(text) {
        const delimiter = conversionOptions.splitBy;
        const items = text.split(delimiter);
        
        let processedItems = items.map(item => {
            // Trim if option enabled
            if (conversionOptions.trimItems2) {
                item = item.trim();
            }
            
            // Remove quotes if option enabled
            if (conversionOptions.removeQuotes) {
                item = item.replace(/^["']|["']$/g, '');
            }
            
            // Skip empty items if option enabled
            if (!item.trim() && conversionOptions.skipEmptyItems) {
                return null;
            }
            
            return item;
        }).filter(item => item !== null);
        
        return processedItems.join('\n');
    }
    
    // Initialize - Auto-detect mode from URL
    document.addEventListener('DOMContentLoaded', function() {
        const currentUrl = window.location.pathname;
        const initialMode = currentUrl.includes('comma-to-column') ? 'comma-to-column' : 'column-to-comma';
        setConversionMode(initialMode);
    });
</script>
@endpush

