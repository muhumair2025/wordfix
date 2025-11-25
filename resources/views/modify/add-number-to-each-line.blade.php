@extends('layouts.tool')

@section('title', 'Add Number to Each Line Tool - WordFix')

@section('tool-title', 'Auto Number Each Line Tool')

@section('tool-description', 'Automatically add numbers to the beginning of each line')

@section('tool-content')
<!-- Numbering Options -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <div>
        <label for="numberStyle" class="block text-sm font-medium text-gray-700 mb-2">Style:</label>
        <select id="numberStyle" onchange="updateNumbering()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
            <option value="1-">1-</option>
            <option value="1)">1)</option>
            <option value="1.">1.</option>
            <option value="(1)">(1)</option>
            <option value="[1]">[1]</option>
            <option value="1:">1:</option>
            <option value="Line 1:">Line 1:</option>
            <option value="Line 1 -">Line 1 -</option>
        </select>
    </div>
    <div>
        <label for="startFrom" class="block text-sm font-medium text-gray-700 mb-2">Start list from:</label>
        <input 
            type="number" 
            id="startFrom" 
            value="1" 
            min="0"
            onchange="updateNumbering()"
            class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
        />
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="addNumberLine"
    inputPlaceholder="Type or paste your content here"
    outputPlaceholder="Numbered lines will appear here"
    downloadFileName="numbered-lines.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    This numbering tool quickly adds numbers to the beginning of each line. You can easily adjust the starting number (i.e. 1-10) and choose from 8 different numbering styles.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Add a Number to Each Line Example</h3>
    
    <div class="mb-3">
        <p class="text-sm font-medium text-gray-700 mb-2">Before</p>
        <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
            Learn how to put a number in front of each line.<br>
            This tool automatically adds a number without the need to retype.
        </div>
    </div>
    
    <div>
        <p class="text-sm font-medium text-gray-700 mb-2">After</p>
        <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
            1. Learn how to put a number in front of each line.<br>
            2. This tool automatically adds a number without the need to retype.
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Add Number to Each Line Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Add Number to Each Line</strong> tool automatically adds sequential numbers to the beginning of each line in your text. Perfect for creating numbered lists, organizing content, or preparing structured documents.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use the Number Each Line Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Choose your preferred numbering style from the dropdown (1-, 1), 1., etc.)</li>
            <li>Set the starting number (default is 1, but you can start from any number)</li>
            <li>Type or paste your text into the input box</li>
            <li>The tool automatically adds numbers to each line in real-time</li>
            <li>Copy the numbered text or download it as a file</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Available Numbering Styles</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>1-</strong> - Number with dash (1- First line, 2- Second line)</li>
            <li><strong>1)</strong> - Number with closing parenthesis (1) First line, 2) Second line)</li>
            <li><strong>1.</strong> - Number with period (1. First line, 2. Second line)</li>
            <li><strong>(1)</strong> - Number in parentheses ((1) First line, (2) Second line)</li>
            <li><strong>[1]</strong> - Number in square brackets ([1] First line, [2] Second line)</li>
            <li><strong>1:</strong> - Number with colon (1: First line, 2: Second line)</li>
            <li><strong>Line 1:</strong> - With "Line" prefix (Line 1: First line, Line 2: Second line)</li>
            <li><strong>Line 1 -</strong> - With "Line" prefix and dash (Line 1 - First line, Line 2 - Second line)</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>8 different numbering style options</li>
            <li>Start numbering from any value (0, 1, 10, 100, etc.)</li>
            <li>Real-time numbering as you type</li>
            <li>Handles empty lines (skips numbering for blank lines)</li>
            <li>Preserves original text spacing and formatting</li>
            <li>Import text from files</li>
            <li>Download numbered text</li>
            <li>Copy to clipboard functionality</li>
            <li>Comprehensive text statistics</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Creating numbered lists for documents</li>
            <li>Organizing steps in instructions or tutorials</li>
            <li>Numbering lines in poems or song lyrics</li>
            <li>Preparing numbered items for presentations</li>
            <li>Creating ordered task lists</li>
            <li>Numbering code lines for reference</li>
            <li>Organizing meeting agendas or minutes</li>
            <li>Creating quiz or test questions</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Empty lines are skipped by default - only non-empty lines get numbers</li>
            <li>Use "Start list from" to continue numbering from a previous list</li>
            <li>The "Line 1:" and "Line 1 -" styles are great for code documentation</li>
            <li>Period style (1.) is most commonly used for formal documents</li>
            <li>You can change the style at any time and see the results instantly</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let numberingOptions = {
        style: '1-',
        startFrom: 1
    };
    
    // Update numbering options
    window.updateNumbering = function() {
        numberingOptions.style = document.getElementById('numberStyle').value;
        numberingOptions.startFrom = parseInt(document.getElementById('startFrom').value) || 1;
        
        // Trigger re-conversion
        const inputElement = document.getElementById('addNumberLine-input');
        if (inputElement) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Set the conversion function for the component
    setAddNumberLineConverter(function(text) {
        if (!text || !text.trim()) return '';
        
        const lines = text.split('\n');
        let currentNumber = numberingOptions.startFrom;
        
        const numberedLines = lines.map(line => {
            // Skip empty lines (don't number them)
            if (!line.trim()) {
                return line;
            }
            
            // Format number based on style
            let prefix = '';
            switch (numberingOptions.style) {
                case '1-':
                    prefix = `${currentNumber}- `;
                    break;
                case '1)':
                    prefix = `${currentNumber}) `;
                    break;
                case '1.':
                    prefix = `${currentNumber}. `;
                    break;
                case '(1)':
                    prefix = `(${currentNumber}) `;
                    break;
                case '[1]':
                    prefix = `[${currentNumber}] `;
                    break;
                case '1:':
                    prefix = `${currentNumber}: `;
                    break;
                case 'Line 1:':
                    prefix = `Line ${currentNumber}: `;
                    break;
                case 'Line 1 -':
                    prefix = `Line ${currentNumber} - `;
                    break;
                default:
                    prefix = `${currentNumber}. `;
            }
            
            currentNumber++;
            return prefix + line;
        });
        
        return numberedLines.join('\n');
    });
    
    // Initialize with default values
    updateNumbering();
</script>
@endpush

