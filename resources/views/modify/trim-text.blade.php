@extends('layouts.tool')

@section('title', 'Trim Text Tool - WordFix')

@section('tool-title', 'Trim Text Tool')

@section('tool-description', 'Remove leading and trailing whitespace or specific characters from your text')

@section('tool-content')
<!-- Trim Options -->
<div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h3 class="text-sm font-semibold text-gray-900 mb-4">Trim Options</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div>
            <label for="trimMode" class="block text-sm font-medium text-gray-700 mb-2">Trim Mode:</label>
            <select id="trimMode" onchange="updateConversion()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="both">Both sides (leading & trailing)</option>
                <option value="start">Leading only (left side)</option>
                <option value="end">Trailing only (right side)</option>
            </select>
        </div>
        
        <div>
            <label for="trimType" class="block text-sm font-medium text-gray-700 mb-2">Trim Type:</label>
            <select id="trimType" onchange="updateConversion()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="whitespace">Whitespace (spaces, tabs, newlines)</option>
                <option value="spaces">Spaces only</option>
                <option value="tabs">Tabs only</option>
                <option value="newlines">Newlines only</option>
                <option value="custom">Custom characters...</option>
            </select>
        </div>
        
        <div id="customCharDiv" style="display: none;">
            <label for="customChars" class="block text-sm font-medium text-gray-700 mb-2">Custom Characters to Trim:</label>
            <input 
                type="text" 
                id="customChars"
                placeholder="e.g., .,;:!? or -_"
                oninput="updateConversion()"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
        </div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <label for="applyTo" class="block text-sm font-medium text-gray-700 mb-2">Apply to:</label>
            <select id="applyTo" onchange="updateConversion()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="each-line">Each line separately</option>
                <option value="entire-text">Entire text once</option>
                <option value="each-word">Each word separately</option>
            </select>
        </div>
        
        <div>
            <label for="wordSeparator" class="block text-sm font-medium text-gray-700 mb-2">Word separator (for word mode):</label>
            <select id="wordSeparator" onchange="updateConversion()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value=" ">Space</option>
                <option value=", ">Comma with space</option>
                <option value="\n">New line</option>
            </select>
        </div>
    </div>
    
    <div class="flex flex-wrap gap-4">
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="removeEmptyLines" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Remove empty lines after trimming</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="normalizeSpaces" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Also normalize internal spaces (multiple → single)</span>
        </label>
    </div>
</div>

<!-- Quick Presets -->
<div class="mb-6">
    <h3 class="text-sm font-semibold text-gray-900 mb-3">Quick Presets:</h3>
    <div class="flex flex-wrap gap-2">
        <button onclick="applyPreset('standard')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Standard Trim (spaces & tabs)
        </button>
        <button onclick="applyPreset('full-cleanup')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Full Cleanup (all whitespace)
        </button>
        <button onclick="applyPreset('punctuation')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Remove Punctuation (.,;:!?)
        </button>
        <button onclick="applyPreset('quotes')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Remove Quotes ("'`)
        </button>
        <button onclick="applyPreset('dashes')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Remove Dashes/Underscores
        </button>
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="trimText"
    inputPlaceholder="Type or paste your text here"
    outputPlaceholder="Trimmed text will appear here"
    downloadFileName="trimmed-text.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    This tool trims (removes) leading and trailing whitespace or specific characters from your text. Perfect for cleaning up copied text, formatting data, removing unwanted characters, or standardizing text format.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Trim Text Examples</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 1: Trim Whitespace</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> "   Hello World   " (with spaces)</div>
                <div><strong>Output:</strong> "Hello World"</div>
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 2: Trim Each Line</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> "  Line 1  "<br>"  Line 2  "</div>
                <div><strong>Output:</strong> "Line 1"<br>"Line 2"</div>
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 3: Trim Custom Characters</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> "...Hello..."</div>
                <div class="mb-2"><strong>Custom Chars:</strong> .</div>
                <div><strong>Output:</strong> "Hello"</div>
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 4: Remove Punctuation</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> "!!!Hello!!!"</div>
                <div class="mb-2"><strong>Custom Chars:</strong> !.,;:</div>
                <div><strong>Output:</strong> "Hello"</div>
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Trim Text Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Trim Text Tool</strong> removes unwanted leading (left side) and trailing (right side) characters from your text. While commonly used for removing whitespace, it can also trim any custom characters you specify, making it perfect for data cleaning and text formatting.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use This Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Choose your trim mode (both sides, leading only, or trailing only)</li>
            <li>Select what to trim (whitespace, spaces, tabs, or custom characters)</li>
            <li>Choose where to apply (each line, entire text, or each word)</li>
            <li>Or click a quick preset for common trimming scenarios</li>
            <li>Paste your text into the input box</li>
            <li>Get instant trimmed results</li>
            <li>Copy or download the cleaned text</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>3 Trim Modes</strong> - Both sides, leading only, or trailing only</li>
            <li><strong>5 Trim Types</strong> - Whitespace, spaces, tabs, newlines, or custom characters</li>
            <li><strong>3 Application Modes</strong> - Each line, entire text, or each word</li>
            <li><strong>Custom Character Trimming</strong> - Remove any specific characters from edges</li>
            <li><strong>5 Quick Presets</strong> - Common trimming scenarios</li>
            <li><strong>Remove Empty Lines</strong> - Clean up blank lines after trimming</li>
            <li><strong>Normalize Spaces</strong> - Convert multiple internal spaces to single</li>
            <li>Real-time trimming as you type</li>
            <li>Import/export functionality</li>
            <li>Mobile responsive</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Trim Modes Explained</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Both Sides</h4>
        <p>Removes characters from both the beginning and end.</p>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> "  Hello  "</li>
            <li><strong>Output:</strong> "Hello"</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Leading Only (Left Side)</h4>
        <p>Removes characters from the beginning only.</p>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> "  Hello  "</li>
            <li><strong>Output:</strong> "Hello  "</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Trailing Only (Right Side)</h4>
        <p>Removes characters from the end only.</p>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> "  Hello  "</li>
            <li><strong>Output:</strong> "  Hello"</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Clean Copied Text</strong> - Remove extra spaces from PDF or web content</li>
            <li><strong>Format Lists</strong> - Clean up list items with irregular spacing</li>
            <li><strong>Data Cleaning</strong> - Prepare CSV or database data</li>
            <li><strong>Remove Punctuation</strong> - Strip punctuation from text edges</li>
            <li><strong>Code Cleanup</strong> - Remove whitespace from code lines</li>
            <li><strong>Email Formatting</strong> - Clean up email addresses with spaces</li>
            <li><strong>Remove Quotes</strong> - Strip quotes from quoted text</li>
            <li><strong>Standardize Format</strong> - Ensure consistent spacing</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Custom Character Trimming</h3>
        <p>
            You can trim any specific characters from the edges of your text. Enter the characters you want to remove in the "Custom Characters" field.
        </p>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Example: Remove Dots</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> "...Hello..."</li>
            <li><strong>Custom Chars:</strong> .</li>
            <li><strong>Output:</strong> "Hello"</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Example: Remove Multiple Characters</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> "###Hello###"</li>
            <li><strong>Custom Chars:</strong> #</li>
            <li><strong>Output:</strong> "Hello"</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Application Modes</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Each Line Separately</h4>
        <p>Trims every line independently. Perfect for cleaning up multi-line lists or data.</p>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Entire Text Once</h4>
        <p>Trims the complete text as a whole. Perfect for cleaning up paragraphs or documents.</p>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Each Word Separately</h4>
        <p>Trims every word individually. Perfect for cleaning up word lists or tags.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Quick Presets</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">1. Standard Trim</h4>
        <p>Removes spaces and tabs from both sides of each line.</p>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">2. Full Cleanup</h4>
        <p>Removes all whitespace, removes empty lines, and normalizes internal spaces.</p>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">3. Remove Punctuation</h4>
        <p>Strips common punctuation marks (.,;:!?) from edges.</p>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">4. Remove Quotes</h4>
        <p>Removes all types of quotes ("'`) from edges.</p>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">5. Remove Dashes/Underscores</h4>
        <p>Strips dashes and underscores from edges.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Use "Each line" mode when cleaning up lists or multi-line data</li>
            <li>Enable "Remove empty lines" to clean up blank lines created after trimming</li>
            <li>Use "Normalize internal spaces" to also clean up spacing within text</li>
            <li>Custom character trimming is powerful - you can remove any unwanted edge characters</li>
            <li>Leading-only trim is useful for removing indentation</li>
            <li>Trailing-only trim is useful for removing line-ending spaces or punctuation</li>
            <li>Combine with other tools for comprehensive text cleaning workflows</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let trimOptions = {
        trimMode: 'both',
        trimType: 'whitespace',
        customChars: '',
        applyTo: 'each-line',
        wordSeparator: ' ',
        removeEmptyLines: false,
        normalizeSpaces: false
    };
    
    // Preset configurations
    const presets = {
        'standard': { trimType: 'whitespace', trimMode: 'both', applyTo: 'each-line', removeEmpty: false, normalize: false },
        'full-cleanup': { trimType: 'whitespace', trimMode: 'both', applyTo: 'each-line', removeEmpty: true, normalize: true },
        'punctuation': { trimType: 'custom', customChars: '.,;:!?', trimMode: 'both', applyTo: 'each-line' },
        'quotes': { trimType: 'custom', customChars: '"\'""`', trimMode: 'both', applyTo: 'each-line' },
        'dashes': { trimType: 'custom', customChars: '-_', trimMode: 'both', applyTo: 'each-line' }
    };
    
    // Apply preset
    window.applyPreset = function(presetName) {
        const preset = presets[presetName];
        if (!preset) return;
        
        document.getElementById('trimMode').value = preset.trimMode;
        document.getElementById('trimType').value = preset.trimType;
        document.getElementById('applyTo').value = preset.applyTo;
        
        if (preset.customChars) {
            document.getElementById('customChars').value = preset.customChars;
            document.getElementById('customCharDiv').style.display = 'block';
        }
        
        if (preset.removeEmpty !== undefined) {
            document.getElementById('removeEmptyLines').checked = preset.removeEmpty;
        }
        
        if (preset.normalize !== undefined) {
            document.getElementById('normalizeSpaces').checked = preset.normalize;
        }
        
        updateConversion();
    };
    
    // Update conversion options
    window.updateConversion = function() {
        trimOptions.trimMode = document.getElementById('trimMode').value;
        trimOptions.trimType = document.getElementById('trimType').value;
        trimOptions.applyTo = document.getElementById('applyTo').value;
        trimOptions.wordSeparator = document.getElementById('wordSeparator').value;
        trimOptions.removeEmptyLines = document.getElementById('removeEmptyLines').checked;
        trimOptions.normalizeSpaces = document.getElementById('normalizeSpaces').checked;
        
        if (trimOptions.trimType === 'custom') {
            trimOptions.customChars = document.getElementById('customChars').value;
            document.getElementById('customCharDiv').style.display = 'block';
        } else {
            document.getElementById('customCharDiv').style.display = 'none';
        }
        
        // Trigger re-conversion
        const inputElement = document.getElementById('trimText-input');
        if (inputElement) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Set the conversion function
    setTrimTextConverter(function(text) {
        if (!text) return '';
        
        if (trimOptions.applyTo === 'each-line') {
            return trimLines(text);
        } else if (trimOptions.applyTo === 'each-word') {
            return trimWords(text);
        } else {
            return trimSingleText(text);
        }
    });
    
    function trimLines(text) {
        let lines = text.split('\n');
        
        lines = lines.map(line => trimSingleText(line));
        
        // Remove empty lines if option enabled
        if (trimOptions.removeEmptyLines) {
            lines = lines.filter(line => line.trim());
        }
        
        return lines.join('\n');
    }
    
    function trimWords(text) {
        const words = text.split(/\s+/);
        const trimmedWords = words.map(word => trimSingleText(word)).filter(w => w);
        return trimmedWords.join(trimOptions.wordSeparator);
    }
    
    function trimSingleText(text) {
        let result = text;
        
        // Apply normalization if enabled
        if (trimOptions.normalizeSpaces) {
            result = result.replace(/\s+/g, ' ');
        }
        
        // Determine what to trim
        let trimChars = '';
        
        switch (trimOptions.trimType) {
            case 'whitespace':
                result = trimWhitespace(result, trimOptions.trimMode);
                return result;
            case 'spaces':
                trimChars = ' ';
                break;
            case 'tabs':
                trimChars = '\t';
                break;
            case 'newlines':
                trimChars = '\n\r';
                break;
            case 'custom':
                trimChars = trimOptions.customChars;
                break;
        }
        
        return trimCustomChars(result, trimChars, trimOptions.trimMode);
    }
    
    function trimWhitespace(text, mode) {
        if (mode === 'both') return text.trim();
        if (mode === 'start') return text.replace(/^\s+/, '');
        if (mode === 'end') return text.replace(/\s+$/, '');
        return text;
    }
    
    function trimCustomChars(text, chars, mode) {
        if (!chars) return text;
        
        const escapedChars = chars.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, '\\$&');
        
        if (mode === 'both' || mode === 'start') {
            const regex = new RegExp(`^[${escapedChars}]+`);
            text = text.replace(regex, '');
        }
        
        if (mode === 'both' || mode === 'end') {
            const regex = new RegExp(`[${escapedChars}]+$`);
            text = text.replace(regex, '');
        }
        
        return text;
    }
    
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateConversion();
    });
</script>
@endpush

