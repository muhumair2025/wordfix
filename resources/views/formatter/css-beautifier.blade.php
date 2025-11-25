@extends('layouts.tool')

@section('title', 'Online CSS Beautifier Tool - WordFix')

@section('tool-title', 'Online CSS Beautifier Tool')

@section('tool-description', 'Format and beautify your CSS code with proper indentation')

@section('tool-content')
<!-- Text Converter Component -->
<x-text-converter 
    toolId="cssBeautifier"
    inputPlaceholder="Paste your minified or unformatted CSS code here"
    outputPlaceholder="Beautified CSS will appear here"
    downloadFileName="beautified.css"
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
                <input type="checkbox" id="addSpaceBeforeBrace" checked onchange="updateFormatting()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Space before brace</span>
            </label>
        </div>
        <div class="flex items-end">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="preserveNewlines" checked onchange="updateFormatting()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Preserve empty lines</span>
            </label>
        </div>
    </div>
</div>

<div class="text-sm text-blue-600 mb-6">
    This CSS beautifier formats your minified or messy CSS code into a clean, readable format with proper indentation and structure.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">CSS Beautifier Example</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before (Minified CSS)</p>
            <div class="bg-red-50 border border-red-200 rounded p-3 text-xs text-gray-700 font-mono overflow-x-auto">
                .container{background-color:#f5f5f5;border:1px solid #ccc;border-radius:5px;padding:20px}h1{font-size:36px;color:#333;text-align:center}button{background-color:#007bff;color:#fff;border:none;padding:10px 20px}
            </div>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After (Beautified CSS)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-xs text-gray-700 font-mono">
                .container {<br>
                &nbsp;&nbsp;&nbsp;&nbsp;background-color: #f5f5f5;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;border: 1px solid #ccc;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;border-radius: 5px;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;padding: 20px;<br>
                }<br><br>
                h1 {<br>
                &nbsp;&nbsp;&nbsp;&nbsp;font-size: 36px;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;color: #333;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;text-align: center;<br>
                }<br><br>
                button {<br>
                &nbsp;&nbsp;&nbsp;&nbsp;background-color: #007bff;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;color: #fff;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;border: none;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;padding: 10px 20px;<br>
                }
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About CSS Beautifier Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>CSS Beautifier</strong> is a powerful formatting tool that transforms minified, compressed, or messy CSS code into a clean, readable, and properly indented format. It helps developers maintain consistent code style and improves code readability.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use the CSS Beautifier</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Paste your minified or unformatted CSS code into the input box</li>
            <li>Choose your preferred formatting options (indent size, spacing preferences)</li>
            <li>The tool automatically beautifies your CSS in real-time</li>
            <li>Copy the formatted CSS or download it as a .css file</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Automatic indentation with customizable indent size (2 or 4 spaces, or tabs)</li>
            <li>Proper spacing around selectors, properties, and values</li>
            <li>Line breaks between CSS rules for better readability</li>
            <li>Handles nested selectors and media queries</li>
            <li>Preserves important CSS comments</li>
            <li>Option to add space before opening braces</li>
            <li>Option to preserve empty lines between rules</li>
            <li>Real-time formatting as you type</li>
            <li>Import CSS from files</li>
            <li>Download beautified CSS</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Formatting minified CSS from production builds</li>
            <li>Cleaning up CSS copied from various sources</li>
            <li>Standardizing CSS code style across teams</li>
            <li>Making third-party CSS libraries more readable</li>
            <li>Debugging and understanding complex CSS</li>
            <li>Preparing CSS for code review</li>
            <li>Learning CSS by examining formatted code</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">What Gets Formatted</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Selectors:</strong> Each selector on a new line when comma-separated</li>
            <li><strong>Properties:</strong> Each property-value pair on its own line</li>
            <li><strong>Braces:</strong> Opening braces with optional spacing, closing braces on new lines</li>
            <li><strong>Indentation:</strong> Nested rules and properties properly indented</li>
            <li><strong>Spacing:</strong> Consistent spacing around colons and semicolons</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>The tool works with CSS3, including flexbox, grid, and custom properties</li>
            <li>Media queries and keyframe animations are properly formatted</li>
            <li>Use 2-space indentation for compact code, 4-space for maximum readability</li>
            <li>The beautifier can handle very large CSS files efficiently</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let formatOptions = {
        indentSize: 4,
        indentChar: ' ',
        addSpaceBeforeBrace: true,
        preserveNewlines: true
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
        
        formatOptions.addSpaceBeforeBrace = document.getElementById('addSpaceBeforeBrace').checked;
        formatOptions.preserveNewlines = document.getElementById('preserveNewlines').checked;
        
        // Trigger re-conversion
        const inputElement = document.getElementById('cssBeautifier-input');
        if (inputElement) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Set the conversion function for the component
    setCssBeautifierConverter(function(css) {
        if (!css || !css.trim()) return '';
        return beautifyCSS(css, formatOptions);
    });
    
    function beautifyCSS(css, options) {
        // Remove existing formatting
        css = css.trim();
        
        // Preserve comments temporarily
        const comments = [];
        css = css.replace(/\/\*[\s\S]*?\*\//g, (match) => {
            comments.push(match);
            return `___COMMENT_${comments.length - 1}___`;
        });
        
        // Remove all unnecessary whitespace
        css = css.replace(/\s+/g, ' ');
        
        // Add line breaks and indentation
        let result = '';
        let indentLevel = 0;
        const indent = options.indentChar.repeat(options.indentSize);
        let inSelector = false;
        let buffer = '';
        
        for (let i = 0; i < css.length; i++) {
            const char = css[i];
            const nextChar = css[i + 1];
            const prevChar = css[i - 1];
            
            if (char === '{') {
                // Handle opening brace
                buffer = buffer.trim();
                if (buffer) {
                    // Handle multiple selectors
                    const selectors = buffer.split(',').map(s => s.trim());
                    result += selectors.join(',\n' + indent.repeat(indentLevel)) + (options.addSpaceBeforeBrace ? ' ' : '') + '{\n';
                    buffer = '';
                }
                indentLevel++;
                inSelector = false;
            } else if (char === '}') {
                // Handle closing brace
                if (buffer.trim()) {
                    result += indent.repeat(indentLevel) + buffer.trim() + '\n';
                    buffer = '';
                }
                indentLevel--;
                result += indent.repeat(indentLevel) + '}';
                
                // Add double line break between rules if preserveNewlines is true
                if (options.preserveNewlines && nextChar && nextChar !== '}') {
                    result += '\n\n';
                } else {
                    result += '\n';
                }
            } else if (char === ';') {
                // Handle semicolon (end of property)
                buffer += char;
                result += indent.repeat(indentLevel) + buffer.trim() + '\n';
                buffer = '';
            } else if (char === ':' && indentLevel > 0) {
                // Handle colon in property
                buffer += char + ' ';
            } else {
                buffer += char;
            }
        }
        
        // Handle any remaining buffer
        if (buffer.trim()) {
            result += buffer.trim();
        }
        
        // Restore comments
        comments.forEach((comment, index) => {
            result = result.replace(`___COMMENT_${index}___`, comment);
        });
        
        // Clean up extra blank lines
        if (!options.preserveNewlines) {
            result = result.replace(/\n{3,}/g, '\n\n');
        }
        
        // Handle media queries and keyframes
        result = result.replace(/@media([^{]+){/g, '@media$1{\n');
        result = result.replace(/@keyframes([^{]+){/g, '@keyframes$1{\n');
        
        return result.trim();
    }
</script>
@endpush

