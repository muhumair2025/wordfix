@extends('layouts.tool')

@section('title', 'Backward Text Generator - WordFix')

@section('tool-title', 'Backward Text Generator')

@section('tool-description', 'Reverse your text backwards - mirror text effect')

@section('tool-content')
<!-- Backward Options -->
<div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h3 class="text-sm font-semibold text-gray-900 mb-4">Backward Options</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <div>
            <label for="reverseMode" class="block text-sm font-medium text-gray-700 mb-2">Reverse Mode:</label>
            <select id="reverseMode" onchange="updateConversion()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="entire-text">Entire Text</option>
                <option value="each-line">Each Line Separately</option>
                <option value="each-word">Each Word Separately</option>
                <option value="preserve-words">Reverse Word Order Only</option>
            </select>
        </div>
        
        <div>
            <label for="outputFormat" class="block text-sm font-medium text-gray-700 mb-2">Output Format:</label>
            <select id="outputFormat" onchange="updateConversion()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="plain">Plain Reversed Text</option>
                <option value="with-original">Show Original + Reversed</option>
                <option value="comparison">Side-by-Side Comparison</option>
            </select>
        </div>
    </div>
    
    <div class="flex flex-wrap gap-4">
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="preserveCase" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Preserve original case</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="preserveSpaces" checked onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Preserve spacing</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="preservePunctuation" checked onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Preserve punctuation</span>
        </label>
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="backwardText"
    inputPlaceholder="Type or paste your text here"
    outputPlaceholder="Backward text will appear here"
    downloadFileName="backward-text.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    This backward text generator reverses your text, creating a mirror effect. Choose from different reverse modes: reverse entire text, each line, each word, or just reverse word order. Perfect for creating fun effects, puzzles, or reversed text challenges.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Backward Text Examples</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 1: Reverse Entire Text</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> Hello World</div>
                <div><strong>Output:</strong> dlroW olleH</div>
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 2: Reverse Each Word</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> Hello World</div>
                <div><strong>Output:</strong> olleH dlroW</div>
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 3: Reverse Word Order</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> Hello World Today</div>
                <div><strong>Output:</strong> Today World Hello</div>
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 4: Reverse Each Line</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> Line One<br>Line Two</div>
                <div><strong>Output:</strong> enO eniL<br>owT eniL</div>
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Backward Text Generator Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Backward Text Generator</strong> creates reversed or mirrored text by reversing the order of characters. With multiple reverse modes and formatting options, you can create various backward text effects for fun, puzzles, or creative purposes.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use This Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Choose your reverse mode (entire text, each line, each word, or word order)</li>
            <li>Select output format (plain, with original, or side-by-side)</li>
            <li>Configure preservation options (case, spacing, punctuation)</li>
            <li>Type or paste your text into the input box</li>
            <li>Get instant backward/reversed text in the output</li>
            <li>Copy or download the reversed text</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>4 Reverse Modes</strong> - Entire text, each line, each word, or word order only</li>
            <li><strong>3 Output Formats</strong> - Plain, with original, or comparison view</li>
            <li><strong>Case Preservation</strong> - Maintain original letter casing</li>
            <li><strong>Spacing Control</strong> - Keep or modify spacing</li>
            <li><strong>Punctuation Handling</strong> - Preserve or process punctuation</li>
            <li>Real-time reversal as you type</li>
            <li>Works with any language or characters</li>
            <li>Handles emojis and special characters</li>
            <li>Import/export functionality</li>
            <li>Mobile responsive</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Reverse Modes Explained</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">1. Entire Text</h4>
        <p>Reverses all characters in the complete text, including spaces and line breaks.</p>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> "Hello World"</li>
            <li><strong>Output:</strong> "dlroW olleH"</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">2. Each Line Separately</h4>
        <p>Reverses each line independently, preserving line structure.</p>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> "First Line" (line 1), "Second Line" (line 2)</li>
            <li><strong>Output:</strong> "eniL tsriF" (line 1), "eniL dnoceS" (line 2)</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">3. Each Word Separately</h4>
        <p>Reverses characters within each word but keeps words in original order.</p>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> "Hello World Today"</li>
            <li><strong>Output:</strong> "olleH dlroW yadoT"</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">4. Reverse Word Order Only</h4>
        <p>Reverses the order of words but keeps each word's spelling normal.</p>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> "Hello World Today"</li>
            <li><strong>Output:</strong> "Today World Hello"</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Fun & Entertainment</strong> - Create backward messages for friends</li>
            <li><strong>Puzzles & Games</strong> - Create text puzzles or challenges</li>
            <li><strong>Secret Messages</strong> - Simple text encoding/obfuscation</li>
            <li><strong>Social Media</strong> - Create unique backward text posts</li>
            <li><strong>Learning Tool</strong> - Practice reading backwards</li>
            <li><strong>Creative Writing</strong> - Palindrome creation and testing</li>
            <li><strong>Design Effects</strong> - Create mirror text for graphics</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Output Format Options</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Plain Reversed Text</h4>
        <p>Shows only the reversed result.</p>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Show Original + Reversed</h4>
        <p>Shows both original and reversed text together for comparison.</p>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Side-by-Side Comparison</h4>
        <p>Displays original and reversed text in a comparison format.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Use "Reverse Word Order" to create sentence variations without scrambling words</li>
            <li>Enable "With original" format to easily compare before and after</li>
            <li>Try reversing palindromes to see if they read the same backwards!</li>
            <li>Use "Each word" mode for a different type of text scramble effect</li>
            <li>The tool handles Unicode characters, emojis, and special symbols correctly</li>
            <li>Great for creating riddles or text-based games</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let reverseOptions = {
        reverseMode: 'entire-text',
        outputFormat: 'plain',
        preserveCase: false,
        preserveSpaces: true,
        preservePunctuation: true
    };
    
    // Update conversion options
    window.updateConversion = function() {
        reverseOptions.reverseMode = document.getElementById('reverseMode').value;
        reverseOptions.outputFormat = document.getElementById('outputFormat').value;
        reverseOptions.preserveCase = document.getElementById('preserveCase').checked;
        reverseOptions.preserveSpaces = document.getElementById('preserveSpaces').checked;
        reverseOptions.preservePunctuation = document.getElementById('preservePunctuation').checked;
        
        // Trigger re-conversion
        const inputElement = document.getElementById('backwardText-input');
        if (inputElement) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Set the conversion function
    setBackwardTextConverter(function(text) {
        if (!text) return '';
        
        let reversed = '';
        
        switch (reverseOptions.reverseMode) {
            case 'entire-text':
                reversed = reverseString(text);
                break;
            case 'each-line':
                reversed = reverseEachLine(text);
                break;
            case 'each-word':
                reversed = reverseEachWord(text);
                break;
            case 'preserve-words':
                reversed = reverseWordOrder(text);
                break;
        }
        
        // Apply output format
        return formatOutput(text, reversed);
    });
    
    function reverseString(str) {
        return str.split('').reverse().join('');
    }
    
    function reverseEachLine(text) {
        const lines = text.split('\n');
        return lines.map(line => reverseString(line)).join('\n');
    }
    
    function reverseEachWord(text) {
        return text.replace(/\S+/g, (word) => {
            return reverseString(word);
        });
    }
    
    function reverseWordOrder(text) {
        const lines = text.split('\n');
        return lines.map(line => {
            const words = line.match(/\S+/g) || [];
            const reversedWords = words.reverse();
            
            // Try to preserve spacing structure
            let result = line;
            words.forEach((word, index) => {
                result = result.replace(word, `__WORD${index}__`);
            });
            
            reversedWords.forEach((word, index) => {
                result = result.replace(`__WORD${index}__`, word);
            });
            
            return result;
        }).join('\n');
    }
    
    function formatOutput(original, reversed) {
        if (reverseOptions.outputFormat === 'plain') {
            return reversed;
        } else if (reverseOptions.outputFormat === 'with-original') {
            return 'ORIGINAL:\n' + original + '\n\nREVERSED:\n' + reversed;
        } else if (reverseOptions.outputFormat === 'comparison') {
            const originalLines = original.split('\n');
            const reversedLines = reversed.split('\n');
            const maxLines = Math.max(originalLines.length, reversedLines.length);
            
            let result = 'ORIGINAL → REVERSED\n' + '='.repeat(50) + '\n\n';
            
            for (let i = 0; i < maxLines; i++) {
                const origLine = originalLines[i] || '';
                const revLine = reversedLines[i] || '';
                result += origLine + ' → ' + revLine + '\n';
            }
            
            return result;
        }
        
        return reversed;
    }
    
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateConversion();
    });
</script>
@endpush

