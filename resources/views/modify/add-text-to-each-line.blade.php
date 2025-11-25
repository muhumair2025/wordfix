@extends('layouts.tool')

@section('title', 'Add Text to Each Line Tool - WordFix')

@section('tool-title', 'Add Text to Each Line Tool')

@section('tool-description', 'Add custom text or prefix/suffix to the beginning and ending of each line')

@section('tool-content')
<!-- Custom Options -->
<div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h3 class="text-sm font-semibold text-gray-900 mb-4">Text Addition Options</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="prefixText" class="block text-sm font-medium text-gray-700 mb-2">Add to beginning of each line:</label>
            <input 
                type="text" 
                id="prefixText"
                placeholder="Enter prefix (e.g., > or • or <p>)"
                oninput="updateConversion()"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
            <p class="text-xs text-gray-500 mt-1">Example: &lt;li&gt; or # or " or &gt;</p>
        </div>
        
        <div>
            <label for="suffixText" class="block text-sm font-medium text-gray-700 mb-2">Add to ending of each line:</label>
            <input 
                type="text" 
                id="suffixText"
                placeholder="Enter suffix (e.g., ; or , or </p>)"
                oninput="updateConversion()"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
            <p class="text-xs text-gray-500 mt-1">Example: &lt;/li&gt; or ; or , or ...</p>
        </div>
    </div>
    
    <div class="mt-4 flex flex-wrap gap-4">
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="skipEmptyLines" checked onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Skip empty lines</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="trimLines" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Trim whitespace from lines</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="addSpaceAfterPrefix" checked onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Add space after prefix</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="addSpaceBeforeSuffix" checked onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Add space before suffix</span>
        </label>
    </div>
</div>

<!-- Quick Presets -->
<div class="mb-6">
    <h3 class="text-sm font-semibold text-gray-900 mb-3">Quick Presets:</h3>
    <div class="flex flex-wrap gap-2">
        <button onclick="applyPreset('html-list')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            HTML List (&lt;li&gt;...&lt;/li&gt;)
        </button>
        <button onclick="applyPreset('html-paragraph')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            HTML Paragraph (&lt;p&gt;...&lt;/p&gt;)
        </button>
        <button onclick="applyPreset('markdown-quote')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Markdown Quote (&gt;)
        </button>
        <button onclick="applyPreset('markdown-list')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Markdown List (-)
        </button>
        <button onclick="applyPreset('bullet')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Bullet Point (•)
        </button>
        <button onclick="applyPreset('code-comment')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Code Comment (//)
        </button>
        <button onclick="applyPreset('quotes')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Double Quotes ("...")
        </button>
        <button onclick="applyPreset('array')" class="px-3 py-1.5 text-xs bg-white border border-gray-300 rounded hover:bg-gray-50 transition-colors">
            Array Items ("...",)
        </button>
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="addTextLine"
    inputPlaceholder="Type or paste your content here"
    outputPlaceholder="Modified text will appear here"
    downloadFileName="modified-lines.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    This text tool quickly adds text to the beginning and ending of each line. Add a prefix string to the beginning of each line or at the ending. Perfect for adding HTML tags, code comments, quotes, or any custom text pattern.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Add Text to Each Line Example</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
                Learn how to put a text or code to each line<br>
                This tool automatically adds text without the need to retype
            </div>
            <p class="text-xs text-gray-500 mt-2">
                Settings: Prefix "&lt;a&gt;" and Suffix "&lt;/a&gt;"
            </p>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700 font-mono text-xs">
                &lt;a&gt;Learn how to put a text or code to each line&lt;/a&gt;<br>
                &lt;a&gt;This tool automatically adds text without the need to retype&lt;/a&gt;
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Add Text to Each Line Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Add Text to Each Line</strong> tool allows you to quickly add prefix text (at the beginning) and suffix text (at the ending) to every line in your content. Perfect for adding HTML tags, code comments, formatting characters, or any repeated text pattern.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use This Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Enter the text you want to add at the beginning in "Add to beginning of each line"</li>
            <li>Enter the text you want to add at the end in "Add to ending of each line"</li>
            <li>Or click one of the quick presets for common patterns</li>
            <li>Configure your options:
                <ul class="list-disc list-inside ml-6 mt-2">
                    <li><strong>Skip empty lines</strong> - Don't add text to blank lines</li>
                    <li><strong>Trim whitespace</strong> - Remove extra spaces from line edges</li>
                    <li><strong>Add space after prefix</strong> - Automatically add a space after prefix text</li>
                    <li><strong>Add space before suffix</strong> - Automatically add a space before suffix text</li>
                </ul>
            </li>
            <li>Type or paste your text into the input box</li>
            <li>The modified text appears automatically in the output</li>
            <li>Copy or download the result</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Dual Input</strong> - Add text to both beginning and ending simultaneously</li>
            <li><strong>8 Quick Presets</strong> - Common patterns for HTML, Markdown, and code</li>
            <li><strong>Smart Spacing</strong> - Optional automatic spacing around prefix/suffix</li>
            <li><strong>Empty Line Handling</strong> - Choose to skip or include blank lines</li>
            <li><strong>Whitespace Control</strong> - Trim option for clean output</li>
            <li><strong>HTML Support</strong> - Perfect for wrapping lines in HTML tags</li>
            <li>Real-time conversion as you type</li>
            <li>Import text from files</li>
            <li>Download modified text</li>
            <li>Comprehensive text statistics</li>
            <li>Mobile responsive design</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Quick Preset Examples</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">1. HTML List Items</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Preset:</strong> HTML List</li>
            <li><strong>Adds:</strong> &lt;li&gt; at start and &lt;/li&gt; at end</li>
            <li><strong>Use case:</strong> Convert plain list to HTML unordered list items</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">2. HTML Paragraphs</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Preset:</strong> HTML Paragraph</li>
            <li><strong>Adds:</strong> &lt;p&gt; at start and &lt;/p&gt; at end</li>
            <li><strong>Use case:</strong> Wrap each line in paragraph tags</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">3. Markdown Blockquote</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Preset:</strong> Markdown Quote</li>
            <li><strong>Adds:</strong> &gt; at start</li>
            <li><strong>Use case:</strong> Format text as Markdown blockquote</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">4. Code Comments</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Preset:</strong> Code Comment</li>
            <li><strong>Adds:</strong> // at start</li>
            <li><strong>Use case:</strong> Comment out multiple lines of code</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>HTML Conversion</strong> - Wrap lines in HTML tags (&lt;li&gt;, &lt;p&gt;, &lt;div&gt;, etc.)</li>
            <li><strong>Code Commenting</strong> - Add // or # to comment out code lines</li>
            <li><strong>Markdown Formatting</strong> - Add &gt; for quotes, - for lists, # for headers</li>
            <li><strong>SQL/CSV</strong> - Add quotes and commas for data formatting</li>
            <li><strong>Array Creation</strong> - Format lines as array items with proper syntax</li>
            <li><strong>Text Decoration</strong> - Add bullets, dashes, or other decorative characters</li>
            <li><strong>Email Formatting</strong> - Add &gt; for email reply quotes</li>
            <li><strong>Documentation</strong> - Add consistent prefixes to documentation lines</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Advanced Examples</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Create JavaScript Array</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Prefix:</strong> "</li>
            <li><strong>Suffix:</strong> ",</li>
            <li><strong>Result:</strong> Each line becomes "line content",</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Create HTML Anchor Tags</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Prefix:</strong> &lt;a href="#"&gt;</li>
            <li><strong>Suffix:</strong> &lt;/a&gt;</li>
            <li><strong>Result:</strong> Each line becomes a clickable link</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Python Comment Block</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Prefix:</strong> #</li>
            <li><strong>Suffix:</strong> (empty)</li>
            <li><strong>Result:</strong> Python commented lines</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Use "Skip empty lines" to maintain paragraph breaks without adding tags</li>
            <li>Enable "Trim whitespace" when working with copied text that has irregular spacing</li>
            <li>Disable spacing options when working with code or when precise formatting is needed</li>
            <li>Quick presets are great starting points - you can modify them after applying</li>
            <li>For HTML, remember to add closing tags as suffix (&lt;/tag&gt;)</li>
            <li>You can use special characters like • (bullet), → (arrow), ✓ (checkmark)</li>
            <li>Combine with other tools for advanced text manipulation workflows</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let conversionOptions = {
        prefix: '',
        suffix: '',
        skipEmptyLines: true,
        trimLines: false,
        addSpaceAfterPrefix: true,
        addSpaceBeforeSuffix: true
    };
    
    // Preset configurations
    const presets = {
        'html-list': { prefix: '<li>', suffix: '</li>', spaceAfter: false, spaceBefore: false },
        'html-paragraph': { prefix: '<p>', suffix: '</p>', spaceAfter: false, spaceBefore: false },
        'markdown-quote': { prefix: '>', suffix: '', spaceAfter: true, spaceBefore: false },
        'markdown-list': { prefix: '-', suffix: '', spaceAfter: true, spaceBefore: false },
        'bullet': { prefix: '•', suffix: '', spaceAfter: true, spaceBefore: false },
        'code-comment': { prefix: '//', suffix: '', spaceAfter: true, spaceBefore: false },
        'quotes': { prefix: '"', suffix: '"', spaceAfter: false, spaceBefore: false },
        'array': { prefix: '"', suffix: '",', spaceAfter: false, spaceBefore: false }
    };
    
    // Apply preset
    window.applyPreset = function(presetName) {
        const preset = presets[presetName];
        if (!preset) return;
        
        document.getElementById('prefixText').value = preset.prefix;
        document.getElementById('suffixText').value = preset.suffix;
        document.getElementById('addSpaceAfterPrefix').checked = preset.spaceAfter;
        document.getElementById('addSpaceBeforeSuffix').checked = preset.spaceBefore;
        
        updateConversion();
    };
    
    // Update conversion options
    window.updateConversion = function() {
        conversionOptions.prefix = document.getElementById('prefixText').value;
        conversionOptions.suffix = document.getElementById('suffixText').value;
        conversionOptions.skipEmptyLines = document.getElementById('skipEmptyLines').checked;
        conversionOptions.trimLines = document.getElementById('trimLines').checked;
        conversionOptions.addSpaceAfterPrefix = document.getElementById('addSpaceAfterPrefix').checked;
        conversionOptions.addSpaceBeforeSuffix = document.getElementById('addSpaceBeforeSuffix').checked;
        
        // Trigger re-conversion
        const inputElement = document.getElementById('addTextLine-input');
        if (inputElement) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Set the conversion function for the component
    setAddTextLineConverter(function(text) {
        if (!text) return '';
        
        const lines = text.split('\n');
        
        const modifiedLines = lines.map(line => {
            // Handle empty lines
            if (!line.trim() && conversionOptions.skipEmptyLines) {
                return line;
            }
            
            // Trim if option enabled
            let processedLine = conversionOptions.trimLines ? line.trim() : line;
            
            // Build the modified line
            let result = '';
            
            // Add prefix
            if (conversionOptions.prefix) {
                result += conversionOptions.prefix;
                if (conversionOptions.addSpaceAfterPrefix && processedLine) {
                    result += ' ';
                }
            }
            
            // Add original line
            result += processedLine;
            
            // Add suffix
            if (conversionOptions.suffix && processedLine) {
                if (conversionOptions.addSpaceBeforeSuffix) {
                    result += ' ';
                }
                result += conversionOptions.suffix;
            }
            
            return result;
        });
        
        return modifiedLines.join('\n');
    });
    
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateConversion();
    });
</script>
@endpush

