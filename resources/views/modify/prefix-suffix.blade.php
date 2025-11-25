@extends('layouts.tool')

@section('title', 'Prefix Suffix Tool - WordFix')

@section('tool-title', 'Prefix Suffix Tool')

@section('tool-description', 'Add prefix and suffix to your text - wrap text with custom strings')

@section('tool-content')
<!-- Prefix/Suffix Options -->
<div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h3 class="text-sm font-semibold text-gray-900 mb-4">Prefix & Suffix Configuration</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <label for="prefixText" class="block text-sm font-medium text-gray-700 mb-2">Prefix (Add to beginning):</label>
            <input 
                type="text" 
                id="prefixText"
                placeholder="e.g., https://, $, <tag>, etc."
                oninput="updateConversion()"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
        </div>
        
        <div>
            <label for="suffixText" class="block text-sm font-medium text-gray-700 mb-2">Suffix (Add to ending):</label>
            <input 
                type="text" 
                id="suffixText"
                placeholder="e.g., .com, %, </tag>, etc."
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
                <option value="each-word">Each word separately</option>
                <option value="entire-text">Entire text once</option>
            </select>
        </div>
        
        <div>
            <label for="wordSeparator" class="block text-sm font-medium text-gray-700 mb-2">Word separator (for word mode):</label>
            <select id="wordSeparator" onchange="updateConversion()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value=" ">Space</option>
                <option value=", ">Comma with space</option>
                <option value="\n">New line</option>
                <option value=" | ">Pipe with spaces</option>
            </select>
        </div>
    </div>
    
    <div class="flex flex-wrap gap-4">
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="skipEmptyLines" checked onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Skip empty lines/words</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="trimItems" checked onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Trim whitespace</span>
        </label>
    </div>
</div>

<!-- Quick Presets -->
<div class="mb-6">
    <h3 class="text-sm font-semibold text-gray-900 mb-3">Quick Presets:</h3>
    <div class="flex flex-wrap gap-2">
        <button onclick="applyPreset('url')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Add https:// prefix
        </button>
        <button onclick="applyPreset('dollar')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Add $ prefix
        </button>
        <button onclick="applyPreset('percent')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Add % suffix
        </button>
        <button onclick="applyPreset('parentheses')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Wrap in (...)
        </button>
        <button onclick="applyPreset('brackets')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Wrap in [...]
        </button>
        <button onclick="applyPreset('quotes')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Wrap in "..."
        </button>
        <button onclick="applyPreset('code')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Wrap in `...`
        </button>
        <button onclick="applyPreset('html-bold')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            HTML Bold &lt;b&gt;...&lt;/b&gt;
        </button>
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="prefixSuffix"
    inputPlaceholder="Type or paste your text here"
    outputPlaceholder="Text with prefix/suffix will appear here"
    downloadFileName="prefix-suffix-text.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    This tool adds prefix (text at the beginning) and suffix (text at the ending) to your content. You can apply to each line, each word, or the entire text. Perfect for wrapping text in HTML tags, adding symbols, creating URLs, or formatting data.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Prefix Suffix Examples</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 1: Add URL Protocol</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> example.com</div>
                <div class="mb-2"><strong>Prefix:</strong> https://</div>
                <div><strong>Output:</strong> https://example.com</div>
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 2: Wrap in Quotes</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> Hello World</div>
                <div class="mb-2"><strong>Prefix:</strong> " &nbsp; <strong>Suffix:</strong> "</div>
                <div><strong>Output:</strong> "Hello World"</div>
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 3: HTML Tags (Each Line)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> Item 1<br>Item 2</div>
                <div class="mb-2"><strong>Prefix:</strong> &lt;li&gt; &nbsp; <strong>Suffix:</strong> &lt;/li&gt;</div>
                <div><strong>Output:</strong> &lt;li&gt;Item 1&lt;/li&gt;<br>&lt;li&gt;Item 2&lt;/li&gt;</div>
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 4: Each Word</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> apple banana orange</div>
                <div class="mb-2"><strong>Prefix:</strong> # &nbsp; <strong>Apply to:</strong> Each word</div>
                <div><strong>Output:</strong> #apple #banana #orange</div>
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Prefix Suffix Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Prefix Suffix Tool</strong> allows you to add text at the beginning (prefix) and/or end (suffix) of your content. With three different application modes and quick presets, you can wrap, tag, or format your text exactly as needed.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use This Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Enter your prefix text (what to add at the beginning)</li>
            <li>Enter your suffix text (what to add at the ending)</li>
            <li>Choose how to apply: Each Line, Each Word, or Entire Text</li>
            <li>Or click a quick preset for common patterns</li>
            <li>Paste your text into the input box</li>
            <li>Get instant results with prefix/suffix applied</li>
            <li>Copy or download the result</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Application Modes</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Each Line Separately</h4>
        <p>Adds prefix/suffix to every line of text.</p>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Best for:</strong> List formatting, HTML tags per line, line numbering</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Each Word Separately</h4>
        <p>Adds prefix/suffix to every word in the text.</p>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Best for:</strong> Hashtags, @mentions, word tagging</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Entire Text Once</h4>
        <p>Adds prefix/suffix to the complete text as a whole.</p>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Best for:</strong> Wrapping entire content, adding headers/footers</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>8 Quick Presets</strong> - Common patterns ready to use</li>
            <li><strong>3 Application Modes</strong> - Line, Word, or Entire text</li>
            <li><strong>Flexible Input</strong> - Add any text as prefix or suffix</li>
            <li><strong>Smart Empty Handling</strong> - Skip or include blank entries</li>
            <li><strong>Trim Option</strong> - Clean whitespace automatically</li>
            <li><strong>Word Separator Control</strong> - Choose output format for word mode</li>
            <li>Real-time conversion as you type</li>
            <li>Import/export functionality</li>
            <li>Mobile responsive</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Quick Preset Examples</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">1. Add HTTPS Prefix</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> example.com, google.com</li>
            <li><strong>Output:</strong> https://example.com, https://google.com</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">2. Wrap in Parentheses</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> optional, required, deprecated</li>
            <li><strong>Output:</strong> (optional), (required), (deprecated)</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">3. Create Hashtags (Word Mode)</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> coding javascript webdev</li>
            <li><strong>Prefix:</strong> #</li>
            <li><strong>Mode:</strong> Each word</li>
            <li><strong>Output:</strong> #coding #javascript #webdev</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>URL Formatting</strong> - Add https:// or www. to domain names</li>
            <li><strong>Currency Symbols</strong> - Add $ or other currency symbols to amounts</li>
            <li><strong>HTML Tags</strong> - Wrap text in HTML tags (&lt;p&gt;, &lt;li&gt;, &lt;div&gt;)</li>
            <li><strong>Code Wrapping</strong> - Add backticks or code tags</li>
            <li><strong>Brackets/Quotes</strong> - Wrap items in parentheses, brackets, or quotes</li>
            <li><strong>Social Media</strong> - Add # for hashtags or @ for mentions</li>
            <li><strong>File Paths</strong> - Add directory prefixes or file extensions</li>
            <li><strong>Data Formatting</strong> - Add units, symbols, or identifiers</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Advanced Examples</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Create File Paths</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Prefix:</strong> /var/www/html/</li>
            <li><strong>Suffix:</strong> .php</li>
            <li><strong>Input:</strong> index, about, contact</li>
            <li><strong>Output:</strong> /var/www/html/index.php, /var/www/html/about.php, /var/www/html/contact.php</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Create SQL Column List</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Prefix:</strong> `</li>
            <li><strong>Suffix:</strong> `</li>
            <li><strong>Input:</strong> id, name, email</li>
            <li><strong>Output:</strong> `id`, `name`, `email`</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Use "Each line" mode for processing lists or multi-line content</li>
            <li>Use "Each word" mode for creating hashtags or tagging individual words</li>
            <li>Use "Entire text" mode to wrap complete paragraphs or documents</li>
            <li>Quick presets are starting points - customize them as needed</li>
            <li>You can use only prefix, only suffix, or both together</li>
            <li>Combine with other tools for complex text transformations</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let conversionOptions = {
        prefix: '',
        suffix: '',
        applyTo: 'each-line',
        wordSeparator: ' ',
        skipEmptyLines: true,
        trimItems: true
    };
    
    // Preset configurations
    const presets = {
        'url': { prefix: 'https://', suffix: '', applyTo: 'each-line' },
        'dollar': { prefix: '$', suffix: '', applyTo: 'each-line' },
        'percent': { prefix: '', suffix: '%', applyTo: 'each-line' },
        'parentheses': { prefix: '(', suffix: ')', applyTo: 'each-line' },
        'brackets': { prefix: '[', suffix: ']', applyTo: 'each-line' },
        'quotes': { prefix: '"', suffix: '"', applyTo: 'each-line' },
        'code': { prefix: '`', suffix: '`', applyTo: 'each-word' },
        'html-bold': { prefix: '<b>', suffix: '</b>', applyTo: 'each-line' }
    };
    
    // Apply preset
    window.applyPreset = function(presetName) {
        const preset = presets[presetName];
        if (!preset) return;
        
        document.getElementById('prefixText').value = preset.prefix;
        document.getElementById('suffixText').value = preset.suffix;
        document.getElementById('applyTo').value = preset.applyTo;
        
        updateConversion();
    };
    
    // Update conversion options
    window.updateConversion = function() {
        conversionOptions.prefix = document.getElementById('prefixText').value;
        conversionOptions.suffix = document.getElementById('suffixText').value;
        conversionOptions.applyTo = document.getElementById('applyTo').value;
        conversionOptions.wordSeparator = document.getElementById('wordSeparator').value;
        conversionOptions.skipEmptyLines = document.getElementById('skipEmptyLines').checked;
        conversionOptions.trimItems = document.getElementById('trimItems').checked;
        
        // Trigger re-conversion
        const inputElement = document.getElementById('prefixSuffix-input');
        if (inputElement) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Set the conversion function
    setPrefixSuffixConverter(function(text) {
        if (!text) return '';
        
        if (conversionOptions.applyTo === 'each-line') {
            return applyToLines(text);
        } else if (conversionOptions.applyTo === 'each-word') {
            return applyToWords(text);
        } else {
            return applyToEntireText(text);
        }
    });
    
    function applyToLines(text) {
        const lines = text.split('\n');
        
        const processedLines = lines.map(line => {
            // Skip empty lines if option enabled
            if (!line.trim() && conversionOptions.skipEmptyLines) {
                return line;
            }
            
            let processedLine = conversionOptions.trimItems ? line.trim() : line;
            return conversionOptions.prefix + processedLine + conversionOptions.suffix;
        });
        
        return processedLines.join('\n');
    }
    
    function applyToWords(text) {
        // Split by whitespace
        const words = text.split(/\s+/);
        
        const processedWords = words.map(word => {
            if (!word.trim() && conversionOptions.skipEmptyLines) {
                return null;
            }
            
            let processedWord = conversionOptions.trimItems ? word.trim() : word;
            return conversionOptions.prefix + processedWord + conversionOptions.suffix;
        }).filter(word => word !== null);
        
        return processedWords.join(conversionOptions.wordSeparator);
    }
    
    function applyToEntireText(text) {
        let processedText = conversionOptions.trimItems ? text.trim() : text;
        return conversionOptions.prefix + processedText + conversionOptions.suffix;
    }
    
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateConversion();
    });
</script>
@endpush

