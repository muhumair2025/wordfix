@extends('layouts.tool')

@section('title', 'Binary Code to Text Converter - WordFix')

@section('tool-title', 'Binary Code to Text Converter')

@section('tool-description', 'Convert binary code (0s and 1s) to readable text')

@section('tool-content')
<!-- Conversion Mode Toggle -->
<div class="mb-6 flex justify-center">
    <div class="inline-flex rounded-md shadow-sm" role="group">
        <button 
            type="button" 
            id="btnBinaryToText"
            onclick="setConversionMode('binary-to-text')"
            class="px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-l-lg hover:bg-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-500"
        >
            Binary → Text
        </button>
        <button 
            type="button" 
            id="btnTextToBinary"
            onclick="setConversionMode('text-to-binary')"
            class="px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500"
        >
            Text → Binary
        </button>
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="binaryText"
    inputPlaceholder="Enter binary code (e.g., 01001000 01100101 01101100 01101100 01101111)"
    outputPlaceholder="Converted text will appear here"
    downloadFileName="binary-conversion.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    <span id="toolDescription">This tool converts binary code (0s and 1s) to readable text. Simply paste your binary code and get instant text output. Also works in reverse - convert text to binary!</span>
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3"><span id="exampleTitle">Binary to Text Example</span></h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before (Binary)</p>
            <div id="exampleBefore" class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700 font-mono">
                01001000 01100101 01101100 01101100 01101111
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After (Text)</p>
            <div id="exampleAfter" class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
                Hello
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Binary Code to Text Converter Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Binary Code to Text Converter</strong> is a simple tool that converts binary numbers (0s and 1s) into readable text characters, and vice versa. Perfect for learning about binary encoding, decoding messages, or understanding how computers represent text.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use This Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Choose your conversion mode: Binary → Text or Text → Binary</li>
            <li>Paste your binary code (or text) into the input box</li>
            <li>Get instant conversion in the output</li>
            <li>Copy or download the result</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Bidirectional Conversion</strong> - Convert both ways (Binary ↔ Text)</li>
            <li><strong>Automatic Formatting</strong> - Handles spaces between binary groups</li>
            <li><strong>8-bit Encoding</strong> - Uses standard ASCII encoding</li>
            <li>Real-time conversion as you type</li>
            <li>Supports all ASCII characters</li>
            <li>Import/export functionality</li>
            <li>Clean and simple interface</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Binary Format</h3>
        <p>
            Binary code should be in 8-bit groups (bytes) separated by spaces. Each group of 8 digits represents one character.
        </p>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Valid format:</strong> 01001000 01100101 01101100 01101100 01101111</li>
            <li><strong>Result:</strong> "Hello"</li>
            <li><strong>Each character:</strong> Represented by 8 bits (0s and 1s)</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Learning Binary</strong> - Understand how text is stored in computers</li>
            <li><strong>Decode Messages</strong> - Convert binary messages to readable text</li>
            <li><strong>Encode Messages</strong> - Create binary-encoded secret messages</li>
            <li><strong>Programming Education</strong> - Learn about character encoding</li>
            <li><strong>Data Analysis</strong> - Examine binary data representations</li>
            <li><strong>CTF Challenges</strong> - Solve capture-the-flag puzzles</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Examples</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Binary to Text</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> 01001000 01101001</li>
            <li><strong>Output:</strong> "Hi"</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Text to Binary</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> "Hi"</li>
            <li><strong>Output:</strong> 01001000 01101001</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Binary code should be in 8-digit groups (octets) for proper conversion</li>
            <li>Spaces between binary groups are automatically handled</li>
            <li>Works with uppercase and lowercase letters, numbers, and symbols</li>
            <li>Toggle modes easily to reverse the conversion</li>
            <li>Perfect for educational purposes and understanding computer encoding</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let conversionMode = 'binary-to-text';
    
    // Set conversion mode
    window.setConversionMode = function(mode) {
        conversionMode = mode;
        
        // Update button styles
        const btnBinaryToText = document.getElementById('btnBinaryToText');
        const btnTextToBinary = document.getElementById('btnTextToBinary');
        const inputElement = document.getElementById('binaryText-input');
        
        if (mode === 'binary-to-text') {
            btnBinaryToText.className = 'px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-l-lg hover:bg-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-500';
            btnTextToBinary.className = 'px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-r-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500';
            
            inputElement.placeholder = 'Enter binary code (e.g., 01001000 01100101 01101100 01101100 01101111)';
            document.getElementById('toolDescription').textContent = 'This tool converts binary code (0s and 1s) to readable text. Simply paste your binary code and get instant text output.';
            document.getElementById('exampleTitle').textContent = 'Binary to Text Example';
            document.getElementById('exampleBefore').innerHTML = '01001000 01100101 01101100 01101100 01101111';
            document.getElementById('exampleAfter').innerHTML = 'Hello';
        } else {
            btnBinaryToText.className = 'px-6 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-l-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500';
            btnTextToBinary.className = 'px-6 py-2.5 text-sm font-medium text-white bg-blue-600 rounded-r-lg hover:bg-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-500';
            
            inputElement.placeholder = 'Enter text to convert to binary';
            document.getElementById('toolDescription').textContent = 'This tool converts regular text to binary code (0s and 1s). Simply paste your text and get instant binary code output.';
            document.getElementById('exampleTitle').textContent = 'Text to Binary Example';
            document.getElementById('exampleBefore').innerHTML = 'Hello';
            document.getElementById('exampleAfter').innerHTML = '01001000 01100101 01101100 01101100 01101111';
        }
        
        // Trigger conversion
        if (inputElement) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Set the conversion function
    setBinaryTextConverter(function(text) {
        if (!text || !text.trim()) return '';
        
        if (conversionMode === 'binary-to-text') {
            return binaryToText(text);
        } else {
            return textToBinary(text);
        }
    });
    
    function binaryToText(binary) {
        try {
            // Remove extra spaces and split into 8-bit chunks
            const cleanBinary = binary.replace(/\s+/g, '');
            
            // Check if valid binary
            if (!/^[01]+$/.test(cleanBinary)) {
                return 'Error: Invalid binary code. Please use only 0s and 1s.';
            }
            
            let result = '';
            
            // Process in 8-bit chunks
            for (let i = 0; i < cleanBinary.length; i += 8) {
                const byte = cleanBinary.substr(i, 8);
                
                if (byte.length === 8) {
                    const charCode = parseInt(byte, 2);
                    result += String.fromCharCode(charCode);
                }
            }
            
            return result;
        } catch (error) {
            return 'Error: Could not convert binary to text.';
        }
    }
    
    function textToBinary(text) {
        try {
            let result = '';
            
            for (let i = 0; i < text.length; i++) {
                const charCode = text.charCodeAt(i);
                const binary = charCode.toString(2).padStart(8, '0');
                result += binary + ' ';
            }
            
            return result.trim();
        } catch (error) {
            return 'Error: Could not convert text to binary.';
        }
    }
    
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        setConversionMode('binary-to-text');
    });
</script>
@endpush

