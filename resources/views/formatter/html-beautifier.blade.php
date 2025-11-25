@extends('layouts.tool')

@section('title', 'Online HTML Beautifier Tool - WordFix')

@section('tool-title', 'Online HTML Beautifier Tool')

@section('tool-description', 'Format and beautify your HTML code with proper indentation')

@section('tool-content')
<!-- Text Converter Component -->
<x-text-converter 
    toolId="htmlBeautifier"
    inputPlaceholder="Paste your minified or unformatted HTML code here"
    outputPlaceholder="Beautified HTML will appear here"
    downloadFileName="beautified.html"
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
                <input type="checkbox" id="wrapAttributes" onchange="updateFormatting()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                <span class="ml-2 text-sm text-gray-700">Wrap long attributes</span>
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
    This HTML beautifier formats your minified or messy HTML code into a clean, readable format with proper indentation and structure. <strong>Toggle "Wrap long attributes"</strong> to put each attribute on its own line for better readability. <strong>Enable "Preserve empty lines"</strong> to maintain spacing between sections.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">HTML Beautifier Example</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before (Minified HTML)</p>
            <div class="bg-red-50 border border-red-200 rounded p-3 text-xs text-gray-700 font-mono overflow-x-auto">
                &lt;div class="container" id="main" data-value="test"&gt;&lt;h1&gt;Welcome&lt;/h1&gt;&lt;p&gt;Paragraph text.&lt;/p&gt;&lt;button class="btn btn-primary" onclick="handleClick()"&gt;Click&lt;/button&gt;&lt;/div&gt;
            </div>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After (Beautified, with wrapped attributes)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-xs text-gray-700 font-mono overflow-y-auto" style="max-height: 250px;">
                &lt;div<br>
                &nbsp;&nbsp;&nbsp;&nbsp;class="container"<br>
                &nbsp;&nbsp;&nbsp;&nbsp;id="main"<br>
                &nbsp;&nbsp;&nbsp;&nbsp;data-value="test"<br>
                &gt;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&lt;h1&gt;Welcome&lt;/h1&gt;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&lt;p&gt;Paragraph text.&lt;/p&gt;<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&lt;button<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;class="btn btn-primary"<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;onclick="handleClick()"<br>
                &nbsp;&nbsp;&nbsp;&nbsp;&gt;Click&lt;/button&gt;<br>
                &lt;/div&gt;
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About HTML Beautifier Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>HTML Beautifier</strong> is a powerful formatting tool that transforms minified, compressed, or messy HTML code into a clean, readable, and properly indented format. It helps developers maintain consistent code style and improves code readability.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use the HTML Beautifier</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Paste your minified or unformatted HTML code into the input box</li>
            <li>Choose your preferred formatting options (indent size, attribute wrapping)</li>
            <li>The tool automatically beautifies your HTML in real-time</li>
            <li>Copy the formatted HTML or download it as a .html file</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Automatic indentation with customizable indent size (2 or 4 spaces, or tabs)</li>
            <li>Proper nesting and hierarchy visualization</li>
            <li>Smart handling of inline vs block elements</li>
            <li><strong>Wrap long attributes</strong> - Automatically puts each attribute on its own indented line for elements with multiple attributes (great for readability!)</li>
            <li><strong>Preserve empty lines</strong> - Maintains blank lines in your source HTML for section separation</li>
            <li>Preserves HTML comments and DOCTYPE declarations</li>
            <li>Handles self-closing tags correctly</li>
            <li>Supports HTML5, including custom elements and data attributes</li>
            <li>Real-time formatting as you type</li>
            <li>Import HTML from files</li>
            <li>Download beautified HTML</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Formatting minified HTML from production builds</li>
            <li>Cleaning up HTML copied from various sources</li>
            <li>Standardizing HTML code style across teams</li>
            <li>Making third-party HTML templates more readable</li>
            <li>Debugging and understanding complex HTML structures</li>
            <li>Preparing HTML for code review</li>
            <li>Learning HTML by examining formatted code</li>
            <li>Fixing indentation issues in HTML files</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">What Gets Formatted</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Tags:</strong> Opening and closing tags properly indented</li>
            <li><strong>Nesting:</strong> Child elements indented relative to parents</li>
            <li><strong>Attributes:</strong> Properly spaced with optional line wrapping</li>
            <li><strong>Content:</strong> Text content preserved with appropriate spacing</li>
            <li><strong>Self-closing tags:</strong> Recognized and formatted (img, br, input, etc.)</li>
            <li><strong>Comments:</strong> HTML comments preserved and properly formatted</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Supported HTML Elements</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>All standard HTML5 elements</li>
            <li>Custom elements and web components</li>
            <li>SVG and MathML embedded in HTML</li>
            <li>Script and style tags with embedded code</li>
            <li>Data attributes and ARIA attributes</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Use 2-space indentation for compact HTML, 4-space for maximum readability</li>
            <li>Enable "Wrap long attributes" for better readability of elements with many attributes</li>
            <li>The beautifier handles inline elements intelligently to avoid unwanted whitespace</li>
            <li>Works great with React JSX and Vue templates (as long as the syntax is HTML-compatible)</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let formatOptions = {
        indentSize: 4,
        indentChar: ' ',
        wrapAttributes: false,
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
        
        formatOptions.wrapAttributes = document.getElementById('wrapAttributes').checked;
        formatOptions.preserveNewlines = document.getElementById('preserveNewlines').checked;
        
        // Trigger re-conversion
        const inputElement = document.getElementById('htmlBeautifier-input');
        if (inputElement) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Set the conversion function for the component
    setHtmlBeautifierConverter(function(html) {
        if (!html || !html.trim()) return '';
        return beautifyHTML(html, formatOptions);
    });
    
    function beautifyHTML(html, options) {
        html = html.trim();
        
        // Self-closing tags
        const selfClosingTags = ['area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input', 'link', 'meta', 'param', 'source', 'track', 'wbr'];
        
        // Block-level elements
        const blockElements = ['address', 'article', 'aside', 'blockquote', 'canvas', 'dd', 'div', 'dl', 'dt', 'fieldset', 'figcaption', 'figure', 'footer', 'form', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'header', 'hgroup', 'hr', 'li', 'main', 'nav', 'noscript', 'ol', 'output', 'p', 'pre', 'section', 'table', 'tbody', 'td', 'tfoot', 'th', 'thead', 'tr', 'ul', 'video'];
        
        const indent = options.indentChar.repeat(options.indentSize);
        let result = '';
        let indentLevel = 0;
        let emptyLineCount = 0;
        
        // Parse HTML into tokens
        const tokens = parseHTMLTokens(html);
        
        for (let i = 0; i < tokens.length; i++) {
            const token = tokens[i];
            
            if (token.type === 'empty-line') {
                if (options.preserveNewlines) {
                    emptyLineCount++;
                    if (emptyLineCount <= 1) {
                        result += '\n';
                    }
                }
            } else if (token.type === 'comment') {
                result += indent.repeat(indentLevel) + token.content + '\n';
                emptyLineCount = 0;
            } else if (token.type === 'doctype') {
                result += token.content + '\n';
                emptyLineCount = 0;
            } else if (token.type === 'opening-tag') {
                const formattedTag = formatTag(token, indentLevel, indent, options);
                result += formattedTag + '\n';
                
                if (!isSelfClosing(token.name, token.content)) {
                    indentLevel++;
                }
                emptyLineCount = 0;
            } else if (token.type === 'closing-tag') {
                indentLevel = Math.max(0, indentLevel - 1);
                result += indent.repeat(indentLevel) + token.content + '\n';
                emptyLineCount = 0;
            } else if (token.type === 'text') {
                const trimmedText = token.content.trim();
                if (trimmedText) {
                    result += indent.repeat(indentLevel) + trimmedText + '\n';
                    emptyLineCount = 0;
                }
            }
        }
        
        // Clean up excessive blank lines if not preserving
        if (!options.preserveNewlines) {
            result = result.replace(/\n{3,}/g, '\n\n');
        }
        
        return result.trim();
    }
    
    function parseHTMLTokens(html) {
        const tokens = [];
        let position = 0;
        let lastWasNewline = false;
        
        while (position < html.length) {
            const char = html[position];
            
            // Check for empty lines (multiple newlines)
            if (char === '\n' || char === '\r') {
                let newlineCount = 0;
                while (position < html.length && (html[position] === '\n' || html[position] === '\r' || html[position] === ' ' || html[position] === '\t')) {
                    if (html[position] === '\n') newlineCount++;
                    position++;
                }
                
                if (newlineCount > 1) {
                    tokens.push({ type: 'empty-line' });
                }
                continue;
            }
            
            // Check for comments
            if (html.substr(position, 4) === '<!--') {
                const commentEnd = html.indexOf('-->', position);
                if (commentEnd !== -1) {
                    const comment = html.substring(position, commentEnd + 3);
                    tokens.push({ type: 'comment', content: comment });
                    position = commentEnd + 3;
                    continue;
                }
            }
            
            // Check for DOCTYPE
            if (html.substr(position, 9).toLowerCase() === '<!doctype') {
                const doctypeEnd = html.indexOf('>', position);
                if (doctypeEnd !== -1) {
                    const doctype = html.substring(position, doctypeEnd + 1);
                    tokens.push({ type: 'doctype', content: doctype });
                    position = doctypeEnd + 1;
                    continue;
                }
            }
            
            // Check for tags
            if (char === '<') {
                const tagEnd = html.indexOf('>', position);
                if (tagEnd !== -1) {
                    const tagContent = html.substring(position, tagEnd + 1);
                    const isClosing = html[position + 1] === '/';
                    
                    if (isClosing) {
                        tokens.push({ 
                            type: 'closing-tag', 
                            content: tagContent,
                            name: tagContent.match(/<\/([^\s>]+)/)?.[1] || ''
                        });
                    } else {
                        const tagNameMatch = tagContent.match(/<([^\s>/]+)/);
                        const tagName = tagNameMatch ? tagNameMatch[1] : '';
                        
                        tokens.push({ 
                            type: 'opening-tag', 
                            content: tagContent,
                            name: tagName
                        });
                    }
                    
                    position = tagEnd + 1;
                    continue;
                }
            }
            
            // Text content
            let textContent = '';
            while (position < html.length && html[position] !== '<') {
                textContent += html[position];
                position++;
            }
            
            if (textContent.trim()) {
                tokens.push({ type: 'text', content: textContent });
            }
        }
        
        return tokens;
    }
    
    function formatTag(token, indentLevel, indent, options) {
        const tagContent = token.content;
        const indentStr = indent.repeat(indentLevel);
        
        // Extract tag name and attributes
        const match = tagContent.match(/<([^\s>/]+)([\s\S]*?)(\/?)\s*>/);
        if (!match) return indentStr + tagContent;
        
        const tagName = match[1];
        const attributesStr = match[2].trim();
        const selfClosing = match[3];
        
        if (!attributesStr) {
            return indentStr + `<${tagName}${selfClosing}>`;
        }
        
        // Parse attributes
        const attributes = parseAttributes(attributesStr);
        
        // Check if we should wrap attributes
        const shouldWrap = options.wrapAttributes && (attributesStr.length > 60 || attributes.length > 3);
        
        if (shouldWrap) {
            let result = indentStr + `<${tagName}`;
            attributes.forEach(attr => {
                result += '\n' + indentStr + indent + attr;
            });
            result += selfClosing ? '\n' + indentStr + '/>' : '\n' + indentStr + '>';
            return result;
        } else {
            return indentStr + `<${tagName} ${attributes.join(' ')}${selfClosing}>`;
        }
    }
    
    function parseAttributes(attributesStr) {
        const attributes = [];
        let current = '';
        let inQuote = false;
        let quoteChar = '';
        
        for (let i = 0; i < attributesStr.length; i++) {
            const char = attributesStr[i];
            
            if ((char === '"' || char === "'") && attributesStr[i - 1] !== '\\') {
                if (!inQuote) {
                    inQuote = true;
                    quoteChar = char;
                    current += char;
                } else if (char === quoteChar) {
                    inQuote = false;
                    quoteChar = '';
                    current += char;
                } else {
                    current += char;
                }
            } else if (char === ' ' && !inQuote) {
                if (current.trim()) {
                    attributes.push(current.trim());
                    current = '';
                }
            } else {
                current += char;
            }
        }
        
        if (current.trim()) {
            attributes.push(current.trim());
        }
        
        return attributes;
    }
    
    function isSelfClosing(tagName, tagContent) {
        const selfClosingTags = ['area', 'base', 'br', 'col', 'embed', 'hr', 'img', 'input', 'link', 'meta', 'param', 'source', 'track', 'wbr'];
        return selfClosingTags.includes(tagName.toLowerCase()) || tagContent.includes('/>');
    }
</script>
@endpush

