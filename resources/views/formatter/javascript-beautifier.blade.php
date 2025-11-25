@extends('layouts.tool')

@section('title', 'Online JavaScript Beautifier Tool - WordFix')

@section('tool-title', 'Online JavaScript Beautifier Tool')

@section('tool-description', 'Format and beautify your JavaScript code with proper indentation')

@section('tool-content')
<!-- Text Converter Component -->
<x-text-converter 
    toolId="jsBeautifier"
    inputPlaceholder="Paste your minified or unformatted JavaScript code here"
    outputPlaceholder="Beautified JavaScript will appear here"
    downloadFileName="beautified.js"
    :showStats="true"
/>

<!-- Formatting Options -->
<div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h3 class="text-sm font-semibold text-gray-900 mb-3">Formatting Options</h3>
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
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
                <input type="checkbox" id="addSemicolons" checked onchange="updateFormatting()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Add semicolons</span>
            </label>
        </div>
        <div class="flex items-end">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="preserveComments" checked onchange="updateFormatting()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Preserve comments</span>
            </label>
        </div>
    </div>
</div>

<div class="text-sm text-blue-600 mb-6">
    This JavaScript beautifier formats your minified or messy JavaScript code into a clean, readable format with proper indentation. Supports ES6+, arrow functions, async/await, and modern JavaScript syntax.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">JavaScript Beautifier Example</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before (Minified JavaScript)</p>
            <div class="bg-red-50 border border-red-200 rounded p-3 text-xs text-gray-700 font-mono overflow-x-auto">
                function calculateTotal(items){let total=0;items.forEach(item=>{total+=item.price});return total}const result=calculateTotal([{price:10},{price:20}]);console.log(result);
            </div>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After (Beautified JavaScript)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-xs text-gray-700 font-mono overflow-y-auto" style="max-height: 300px;">
                function calculateTotal(items) {<br>
                &nbsp;&nbsp;&nbsp;&nbsp;let total = 0;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;items.forEach(item => {<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;total += item.price;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;});<br>
                &nbsp;&nbsp;&nbsp;&nbsp;return total;<br>
                }<br><br>
                const result = calculateTotal([<br>
                &nbsp;&nbsp;&nbsp;&nbsp;{ price: 10 },<br>
                &nbsp;&nbsp;&nbsp;&nbsp;{ price: 20 }<br>
                ]);<br>
                console.log(result);
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About JavaScript Beautifier Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>JavaScript Beautifier</strong> is a powerful formatting tool that transforms minified, compressed, or messy JavaScript code into a clean, readable, and properly indented format. Perfect for debugging, learning, and maintaining JavaScript code.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use the JavaScript Beautifier</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Paste your minified or unformatted JavaScript code into the input box</li>
            <li>Choose your preferred formatting options (indent size, spacing, semicolons)</li>
            <li>The tool automatically beautifies your JavaScript in real-time</li>
            <li>Copy the formatted code or download it as a .js file</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Modern JavaScript Support</strong> - Handles ES6+, arrow functions, async/await, destructuring, spread operators</li>
            <li>Automatic indentation with customizable indent size (2 or 4 spaces, or tabs)</li>
            <li>Smart brace placement with optional spacing</li>
            <li>Option to add missing semicolons automatically</li>
            <li>Preserves or removes comments based on preference</li>
            <li>Proper formatting of functions, classes, objects, and arrays</li>
            <li>Handles template literals and multi-line strings</li>
            <li>Formats callback functions and promises correctly</li>
            <li>Real-time formatting as you type</li>
            <li>Import JavaScript from files</li>
            <li>Download beautified JavaScript</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Supported JavaScript Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>ES6+ Syntax:</strong> Arrow functions, const/let, template literals</li>
            <li><strong>Async/Await:</strong> Asynchronous functions and promises</li>
            <li><strong>Classes:</strong> Class declarations and methods</li>
            <li><strong>Destructuring:</strong> Object and array destructuring</li>
            <li><strong>Spread Operators:</strong> ... syntax for arrays and objects</li>
            <li><strong>Modules:</strong> Import/export statements</li>
            <li><strong>JSX:</strong> Basic React JSX syntax support</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Formatting minified JavaScript from production builds</li>
            <li>Cleaning up JavaScript copied from various sources</li>
            <li>Standardizing JavaScript code style across teams</li>
            <li>Debugging minified third-party libraries</li>
            <li>Learning JavaScript by examining formatted code</li>
            <li>Preparing JavaScript for code review</li>
            <li>Converting between coding styles (semicolons, spacing, etc.)</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Use 2-space indentation for compact code, 4-space for maximum readability</li>
            <li>Enable "Add semicolons" to ensure consistent semicolon usage</li>
            <li>Keep "Preserve comments" enabled to maintain documentation</li>
            <li>Works great with frameworks like React, Vue, Angular, and Node.js code</li>
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
        addSemicolons: true,
        preserveComments: true
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
        formatOptions.addSemicolons = document.getElementById('addSemicolons').checked;
        formatOptions.preserveComments = document.getElementById('preserveComments').checked;
        
        // Trigger re-conversion
        const inputElement = document.getElementById('jsBeautifier-input');
        if (inputElement) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Set the conversion function for the component
    setJsBeautifierConverter(function(js) {
        if (!js || !js.trim()) return '';
        return beautifyJS(js, formatOptions);
    });
    
    function beautifyJS(js, options) {
        js = js.trim();
        const indent = options.indentChar.repeat(options.indentSize);
        
        let result = '';
        let indentLevel = 0;
        let inString = false;
        let stringChar = '';
        let inComment = false;
        let inMultiLineComment = false;
        let inRegex = false;
        let buffer = '';
        let i = 0;
        
        while (i < js.length) {
            const char = js[i];
            const nextChar = js[i + 1];
            const prevChar = js[i - 1];
            
            // Handle strings (including template literals)
            if ((char === '"' || char === "'" || char === '`') && prevChar !== '\\' && !inComment && !inMultiLineComment) {
                if (!inString) {
                    inString = true;
                    stringChar = char;
                    buffer += char;
                } else if (char === stringChar) {
                    inString = false;
                    stringChar = '';
                    buffer += char;
                } else {
                    buffer += char;
                }
                i++;
                continue;
            }
            
            if (inString) {
                buffer += char;
                i++;
                continue;
            }
            
            // Handle single-line comments
            if (char === '/' && nextChar === '/' && !inMultiLineComment) {
                const lineEnd = js.indexOf('\n', i);
                const comment = lineEnd !== -1 ? js.substring(i, lineEnd) : js.substring(i);
                
                if (options.preserveComments) {
                    if (buffer.trim()) {
                        result += indent.repeat(indentLevel) + buffer.trim() + '\n';
                        buffer = '';
                    }
                    result += indent.repeat(indentLevel) + comment + '\n';
                }
                
                i = lineEnd !== -1 ? lineEnd + 1 : js.length;
                continue;
            }
            
            // Handle multi-line comments
            if (char === '/' && nextChar === '*' && !inMultiLineComment) {
                inMultiLineComment = true;
                const commentEnd = js.indexOf('*/', i);
                if (commentEnd !== -1) {
                    const comment = js.substring(i, commentEnd + 2);
                    if (options.preserveComments) {
                        if (buffer.trim()) {
                            result += indent.repeat(indentLevel) + buffer.trim() + '\n';
                            buffer = '';
                        }
                        result += indent.repeat(indentLevel) + comment + '\n';
                    }
                    i = commentEnd + 2;
                    inMultiLineComment = false;
                    continue;
                }
            }
            
            // Handle opening braces
            if (char === '{' && !inComment && !inMultiLineComment) {
                buffer = buffer.trim();
                const spaceBeforeBrace = options.addSpaceBeforeBrace ? ' ' : '';
                
                if (buffer) {
                    result += indent.repeat(indentLevel) + buffer + spaceBeforeBrace + '{\n';
                } else {
                    result += indent.repeat(indentLevel) + '{\n';
                }
                buffer = '';
                indentLevel++;
                i++;
                continue;
            }
            
            // Handle closing braces
            if (char === '}' && !inComment && !inMultiLineComment) {
                if (buffer.trim()) {
                    result += indent.repeat(indentLevel) + buffer.trim() + '\n';
                    buffer = '';
                }
                indentLevel = Math.max(0, indentLevel - 1);
                result += indent.repeat(indentLevel) + '}';
                
                // Check if we need a semicolon or newline after
                if (nextChar && nextChar !== ';' && nextChar !== ',' && nextChar !== ')' && nextChar !== '}') {
                    result += '\n';
                }
                i++;
                continue;
            }
            
            // Handle semicolons
            if (char === ';' && !inComment && !inMultiLineComment) {
                buffer += char;
                result += indent.repeat(indentLevel) + buffer.trim() + '\n';
                buffer = '';
                i++;
                continue;
            }
            
            // Handle operators with spacing
            if (['+', '-', '*', '/', '=', '>', '<', '!', '&', '|'].includes(char) && !inComment && !inMultiLineComment) {
                // Check for multi-character operators
                const twoChar = char + nextChar;
                const threeChar = char + nextChar + js[i + 2];
                
                if (['===', '!==', '>>>'].includes(threeChar)) {
                    buffer += ' ' + threeChar + ' ';
                    i += 3;
                    continue;
                } else if (['==', '!=', '<=', '>=', '&&', '||', '++', '--', '=>', '+=', '-=', '*=', '/=', '<<', '>>'].includes(twoChar)) {
                    buffer += ' ' + twoChar + ' ';
                    i += 2;
                    continue;
                } else if (char === '=' || char === '<' || char === '>') {
                    buffer += ' ' + char + ' ';
                    i++;
                    continue;
                }
            }
            
            // Handle commas
            if (char === ',' && !inComment && !inMultiLineComment) {
                buffer += char + ' ';
                i++;
                continue;
            }
            
            // Skip excessive whitespace
            if ((char === '\n' || char === '\r' || char === '\t') && !inComment && !inMultiLineComment) {
                i++;
                continue;
            }
            
            buffer += char;
            i++;
        }
        
        // Handle remaining buffer
        if (buffer.trim()) {
            let finalBuffer = buffer.trim();
            if (options.addSemicolons && !finalBuffer.endsWith(';') && !finalBuffer.endsWith('}') && !finalBuffer.endsWith('{')) {
                finalBuffer += ';';
            }
            result += indent.repeat(indentLevel) + finalBuffer + '\n';
        }
        
        // Clean up excessive blank lines
        result = result.replace(/\n{3,}/g, '\n\n');
        
        return result.trim();
    }
</script>
@endpush

