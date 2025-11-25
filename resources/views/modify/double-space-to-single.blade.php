@extends('layouts.tool')

@section('title', 'Convert Double Space to Single Space / Single to Double - WordFix')

@section('tool-title', 'Double Space ↔ Single Space Converter')

@section('tool-description', 'Convert between double and single spacing in your text - bidirectional converter')

@section('tool-content')
<!-- Conversion Mode Toggle -->
<div class="mb-6 flex justify-center">
    <div class="inline-flex rounded-md shadow-sm" role="group">
        <button 
            type="button" 
            id="btnDoubleToSingle"
            onclick="setConversionMode('double-to-single')"
            class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-l-lg hover:bg-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-500"
        >
            Double → Single Space
        </button>
        <button 
            type="button" 
            id="btnSingleToDouble"
            onclick="setConversionMode('single-to-double')"
            class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500"
        >
            Single → Double Space
        </button>
    </div>
</div>

<!-- Conversion Options -->
<div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h3 class="text-sm font-semibold text-gray-900 mb-4">Conversion Options</h3>
    
    <div class="flex flex-wrap gap-4">
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="normalizeSpaces" checked onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Normalize all multiple spaces</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="preserveLineBreaks" checked onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Preserve line breaks</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="trimLines" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Trim leading/trailing spaces</span>
        </label>
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="spaceConverter"
    inputPlaceholder="Type or paste your text here"
    outputPlaceholder="Converted text will appear here"
    downloadFileName="space-converted.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    <span id="toolDescription">This tool converts double spaces to single spaces in your text, removing extra spacing for cleaner formatting. Perfect for cleaning up copied text or fixing formatting issues.</span>
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3"><span id="exampleTitle">Convert Double Space to Single Space Example</span></h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before</p>
            <div id="exampleBefore" class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
                This  text  has  double  spaces  between  words.
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After</p>
            <div id="exampleAfter" class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
                This text has double spaces between words.
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Double Space to Single Space Converter Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Double Space to Single Space Converter</strong> is a versatile tool that can both remove extra spaces (double to single) and add spacing (single to double) in your text. Perfect for cleaning up documents, fixing formatting issues, or adjusting text spacing for different purposes.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use This Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Choose your conversion mode: "Double → Single" or "Single → Double"</li>
            <li>Configure your options:
                <ul class="list-disc list-inside ml-6 mt-2">
                    <li><strong>Normalize all multiple spaces</strong> - Convert any multiple spaces (3, 4, 5+) to target spacing</li>
                    <li><strong>Preserve line breaks</strong> - Keep paragraph structure intact</li>
                    <li><strong>Trim leading/trailing spaces</strong> - Remove spaces at line edges</li>
                </ul>
            </li>
            <li>Paste your text into the input box</li>
            <li>Get instant results with proper spacing</li>
            <li>Copy or download the converted text</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Conversion Modes</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Double Space to Single Space</h4>
        <p>
            Removes extra spaces from your text by converting double spaces (or any multiple spaces) into single spaces. Perfect for:
        </p>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Cleaning up copied text from PDFs or websites</li>
            <li>Fixing accidental double-spacing in documents</li>
            <li>Preparing text for web publishing</li>
            <li>Standardizing spacing in code or data files</li>
            <li>Reducing file size by removing unnecessary spaces</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Single Space to Double Space</h4>
        <p>
            Adds extra spacing between words by converting single spaces into double spaces. Perfect for:
        </p>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Creating traditional manuscript formatting</li>
            <li>Improving readability for certain documents</li>
            <li>Meeting specific formatting requirements</li>
            <li>Creating vintage typewriter-style text</li>
            <li>Academic or formal document formatting</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Bidirectional Conversion</strong> - Switch between double and single spacing instantly</li>
            <li><strong>Smart Normalization</strong> - Handles 3, 4, 5+ spaces, not just double</li>
            <li><strong>Line Break Preservation</strong> - Maintains paragraph structure</li>
            <li><strong>Trim Option</strong> - Remove unwanted edge spacing</li>
            <li><strong>Real-time Conversion</strong> - See results as you type</li>
            <li>Works with any text length</li>
            <li>Preserves punctuation and special characters</li>
            <li>Import/export functionality</li>
            <li>Mobile responsive design</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>PDF Text Cleanup</strong> - Fix spacing issues from PDF extraction</li>
            <li><strong>Web Content</strong> - Prepare text for web publishing with single spacing</li>
            <li><strong>Document Formatting</strong> - Adjust spacing for different style guides</li>
            <li><strong>Code Cleanup</strong> - Fix spacing in configuration files or data</li>
            <li><strong>Email Formatting</strong> - Clean up forwarded or quoted emails</li>
            <li><strong>Manuscript Preparation</strong> - Add double spacing for submissions</li>
            <li><strong>Data Processing</strong> - Normalize spacing in CSV or text data</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Examples</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Example 1: Clean Up PDF Text</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> "This  text  has   irregular    spacing"</li>
            <li><strong>Mode:</strong> Double → Single, Normalize enabled</li>
            <li><strong>Output:</strong> "This text has irregular spacing"</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Example 2: Format Manuscript</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> "This is a sentence."</li>
            <li><strong>Mode:</strong> Single → Double</li>
            <li><strong>Output:</strong> "This  is  a  sentence."</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Enable "Normalize all multiple spaces" to handle any amount of spacing (not just double)</li>
            <li>Use "Preserve line breaks" to maintain your paragraph structure</li>
            <li>Enable "Trim leading/trailing spaces" to clean up line edges</li>
            <li>The tool handles tabs and other whitespace characters</li>
            <li>Switch modes easily to reverse the conversion if needed</li>
            <li>Works great on large documents or entire articles</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let conversionMode = 'double-to-single';
    let conversionOptions = {
        normalizeSpaces: true,
        preserveLineBreaks: true,
        trimLines: false
    };
    
    // Set conversion mode
    window.setConversionMode = function(mode) {
        conversionMode = mode;
        
        // Update button styles
        const btnDouble = document.getElementById('btnDoubleToSingle');
        const btnSingle = document.getElementById('btnSingleToDouble');
        
        if (mode === 'double-to-single') {
            btnDouble.className = 'px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-l-lg hover:bg-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-500';
            btnSingle.className = 'px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500';
            
            // Update descriptions
            document.getElementById('toolDescription').innerHTML = 'This tool converts double spaces to single spaces in your text, removing extra spacing for cleaner formatting. Perfect for cleaning up copied text or fixing formatting issues.';
            document.getElementById('exampleTitle').textContent = 'Convert Double Space to Single Space Example';
            document.getElementById('exampleBefore').innerHTML = 'This  text  has  double  spaces  between  words.';
            document.getElementById('exampleAfter').innerHTML = 'This text has single spaces between words.';
        } else {
            btnDouble.className = 'px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500';
            btnSingle.className = 'px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-r-lg hover:bg-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-500';
            
            // Update descriptions
            document.getElementById('toolDescription').innerHTML = 'This tool converts single spaces to double spaces in your text, adding extra spacing for traditional formatting. Perfect for manuscript formatting or meeting specific spacing requirements.';
            document.getElementById('exampleTitle').textContent = 'Convert Single Space to Double Space Example';
            document.getElementById('exampleBefore').innerHTML = 'This text has single spaces between words.';
            document.getElementById('exampleAfter').innerHTML = 'This  text  has  double  spaces  between  words.';
        }
        
        updateConversion();
    };
    
    // Update conversion options
    window.updateConversion = function() {
        conversionOptions.normalizeSpaces = document.getElementById('normalizeSpaces').checked;
        conversionOptions.preserveLineBreaks = document.getElementById('preserveLineBreaks').checked;
        conversionOptions.trimLines = document.getElementById('trimLines').checked;
        
        // Trigger re-conversion
        const inputElement = document.getElementById('spaceConverter-input');
        if (inputElement) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Set the conversion function
    setSpaceConverterConverter(function(text) {
        if (!text) return '';
        
        if (conversionMode === 'double-to-single') {
            return doubleToSingle(text);
        } else {
            return singleToDouble(text);
        }
    });
    
    function doubleToSingle(text) {
        let result = text;
        
        if (conversionOptions.normalizeSpaces) {
            // Replace any multiple spaces with single space
            result = result.replace(/ {2,}/g, ' ');
        } else {
            // Replace only double spaces with single space
            result = result.replace(/  /g, ' ');
        }
        
        // Trim lines if option enabled
        if (conversionOptions.trimLines) {
            if (conversionOptions.preserveLineBreaks) {
                const lines = result.split('\n');
                result = lines.map(line => line.trim()).join('\n');
            } else {
                result = result.trim();
            }
        }
        
        return result;
    }
    
    function singleToDouble(text) {
        let result = text;
        
        if (conversionOptions.preserveLineBreaks) {
            // Process line by line to preserve line breaks
            const lines = result.split('\n');
            result = lines.map(line => {
                // Trim if option enabled
                let processedLine = conversionOptions.trimLines ? line.trim() : line;
                // Replace single spaces with double spaces
                return processedLine.replace(/ /g, '  ');
            }).join('\n');
        } else {
            // Process entire text
            if (conversionOptions.trimLines) {
                result = result.trim();
            }
            result = result.replace(/ /g, '  ');
        }
        
        return result;
    }
    
    // Initialize - Auto-detect mode from URL
    document.addEventListener('DOMContentLoaded', function() {
        const currentUrl = window.location.pathname;
        const initialMode = currentUrl.includes('single-space-to-double') ? 'single-to-double' : 'double-to-single';
        setConversionMode(initialMode);
    });
</script>
@endpush

