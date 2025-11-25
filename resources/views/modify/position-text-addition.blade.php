@extends('layouts.tool')

@section('title', 'Specified Position Text Addition - WordFix')

@section('tool-title', 'Specified Position Text Addition')

@section('tool-description', 'Add text at a specific character position in your content')

@section('tool-content')
<!-- Position Options -->
<div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h3 class="text-sm font-semibold text-gray-900 mb-4">Text Insertion Configuration</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div>
            <label for="insertText" class="block text-sm font-medium text-gray-700 mb-2">Text to Insert:</label>
            <input 
                type="text" 
                id="insertText"
                placeholder="Enter text to insert (e.g., | or - or <br>)"
                oninput="updateConversion()"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
            <p class="text-xs text-gray-500 mt-1">Tip: Use <code class="bg-gray-200 px-1 rounded">\n</code> for line break</p>
        </div>
        
        <div>
            <label for="position" class="block text-sm font-medium text-gray-700 mb-2">Position (character index):</label>
            <input 
                type="number" 
                id="position"
                value="10"
                min="0"
                oninput="updateConversion()"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
            <p class="text-xs text-gray-500 mt-1">Position 0 = beginning, 1 = after first character</p>
        </div>
        
        <div>
            <label for="applyTo" class="block text-sm font-medium text-gray-700 mb-2">Apply to:</label>
            <select id="applyTo" onchange="updateConversion()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="each-line">Each line separately</option>
                <option value="entire-text">Entire text once</option>
            </select>
        </div>
    </div>
    
    <div class="flex flex-wrap gap-4">
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="fromEnd" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Count position from end (negative index)</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="skipShortLines" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Skip lines shorter than position</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="skipEmptyLines" checked onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Skip empty lines</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="multiplePositions" onchange="toggleMultiplePositions()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Insert at multiple positions</span>
        </label>
    </div>
</div>

<!-- Multiple Positions Input (Hidden by default) -->
<div id="multiplePositionsDiv" class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-lg" style="display: none;">
    <h3 class="text-sm font-semibold text-gray-900 mb-3">Multiple Positions (comma-separated):</h3>
    <input 
        type="text" 
        id="multiplePositionsList"
        placeholder="e.g., 5, 10, 15, 20 (will insert at all these positions)"
        oninput="updateConversion()"
        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
    />
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="positionText"
    inputPlaceholder="Type or paste your text here"
    outputPlaceholder="Text with insertions will appear here"
    downloadFileName="position-modified-text.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    This tool inserts text at a specific character position in your content. You can insert at any position, count from the beginning or end, and even insert at multiple positions simultaneously. Perfect for adding separators, inserting markers, or formatting data at precise locations.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Specified Position Text Addition Examples</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 1: Insert at Position 10</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> Lorem Ipsum is simply dummy text</div>
                <div class="mb-2"><strong>Insert:</strong> " | " at position 10</div>
                <div><strong>Output:</strong> Lorem Ipsu | m is simply dummy text</div>
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 2: Format Credit Card</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> 1234567890123456</div>
                <div class="mb-2"><strong>Positions:</strong> 4, 8, 12 with " " (space)</div>
                <div><strong>Output:</strong> 1234 5678 9012 3456</div>
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 3: From End (-5)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> Hello World</div>
                <div class="mb-2"><strong>Insert:</strong> "!" at position 5 from end</div>
                <div><strong>Output:</strong> Hello ! World</div>
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 4: Each Line</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> Line one<br>Line two</div>
                <div class="mb-2"><strong>Insert:</strong> "..." at position 4</div>
                <div><strong>Output:</strong> Line... one<br>Line... two</div>
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Specified Position Text Addition Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Specified Position Text Addition</strong> tool allows you to insert text at exact character positions within your content. With support for single or multiple insertion points, forward or backward counting, and line-by-line or whole-text processing, this tool offers precise text manipulation control.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use This Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Enter the text you want to insert</li>
            <li>Specify the character position (0 = beginning, 1 = after first character, etc.)</li>
            <li>Choose whether to apply to each line or entire text</li>
            <li>Optionally:
                <ul class="list-disc list-inside ml-6 mt-2">
                    <li>Enable "Count from end" to insert relative to the end</li>
                    <li>Enable "Multiple positions" to insert at several points at once</li>
                </ul>
            </li>
            <li>Paste your text into the input box</li>
            <li>Get instant results with text inserted at specified positions</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Precise Positioning</strong> - Insert at any character index</li>
            <li><strong>Forward/Backward Counting</strong> - Count from start or end</li>
            <li><strong>Multiple Positions</strong> - Insert at several positions simultaneously</li>
            <li><strong>Two Application Modes</strong> - Per line or entire text</li>
            <li><strong>Short Line Handling</strong> - Skip or process lines shorter than position</li>
            <li><strong>Empty Line Control</strong> - Skip blank lines</li>
            <li><strong>Escape Sequences</strong> - Use \n for line breaks, \t for tabs</li>
            <li>Real-time insertion as you type</li>
            <li>Import/export functionality</li>
            <li>Mobile responsive</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Position Index Explained</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Position 0:</strong> Before first character (beginning)</li>
            <li><strong>Position 1:</strong> After first character</li>
            <li><strong>Position 5:</strong> After fifth character</li>
            <li><strong>From end -1:</strong> Before last character</li>
            <li><strong>From end -5:</strong> 5 characters from the end</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Format Numbers</strong> - Add spaces or dashes at specific positions (credit cards, phone numbers)</li>
            <li><strong>Insert Separators</strong> - Add dividers at regular intervals</li>
            <li><strong>Data Formatting</strong> - Insert markers or delimiters in structured data</li>
            <li><strong>Code Formatting</strong> - Insert characters at specific code positions</li>
            <li><strong>Text Markers</strong> - Add reference markers at precise locations</li>
            <li><strong>Serial Number Formatting</strong> - Add hyphens or spaces in product codes</li>
            <li><strong>Break Long Lines</strong> - Insert line breaks at character limits</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Advanced Examples</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Format Credit Card Number</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> 1234567890123456</li>
            <li><strong>Text to Insert:</strong> " " (space)</li>
            <li><strong>Multiple Positions:</strong> 4, 8, 12</li>
            <li><strong>Output:</strong> 1234 5678 9012 3456</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Format Phone Number</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> 1234567890</li>
            <li><strong>Text to Insert:</strong> "-"</li>
            <li><strong>Multiple Positions:</strong> 3, 6</li>
            <li><strong>Output:</strong> 123-456-7890</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Add Line Break at Character Limit</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> Very long sentence that needs to be broken into multiple lines</li>
            <li><strong>Text to Insert:</strong> \n (line break)</li>
            <li><strong>Positions:</strong> 25, 50</li>
            <li><strong>Output:</strong> Multi-line text</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Insert from End</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> document.txt</li>
            <li><strong>Text to Insert:</strong> "_backup"</li>
            <li><strong>Position from end:</strong> 4 (before .txt)</li>
            <li><strong>Output:</strong> document_backup.txt</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Application Modes</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Each Line Separately</h4>
        <p>Inserts text at the specified position in every line independently. Perfect for formatting lists or multi-line data.</p>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Entire Text Once</h4>
        <p>Inserts text at the specified position in the complete text as a whole. Perfect for single insertions or entire document modifications.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Multiple Positions Feature</h3>
        <p>
            Enable "Insert at multiple positions" to add text at several positions simultaneously. Enter positions as comma-separated values (e.g., 4, 8, 12). This is perfect for:
        </p>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Formatting credit card numbers with spaces every 4 digits</li>
            <li>Adding dashes to phone numbers at multiple points</li>
            <li>Breaking long text into chunks at regular intervals</li>
            <li>Inserting multiple separators or markers in one go</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Position 0 inserts at the very beginning (before first character)</li>
            <li>Use "Count from end" when you need to insert relative to the end of text</li>
            <li>Multiple positions are processed from right to left to maintain accuracy</li>
            <li>Enable "Skip short lines" to avoid errors with varying line lengths</li>
            <li>Use <code>\n</code> to insert actual line breaks</li>
            <li>Combine with "Each line" mode to format structured data consistently</li>
            <li>Great for batch formatting of IDs, codes, or serial numbers</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let conversionOptions = {
        insertText: '',
        position: 10,
        applyTo: 'each-line',
        fromEnd: false,
        skipShortLines: false,
        skipEmptyLines: true,
        multiplePositions: false,
        positionsList: []
    };
    
    // Toggle multiple positions
    window.toggleMultiplePositions = function() {
        conversionOptions.multiplePositions = document.getElementById('multiplePositions').checked;
        document.getElementById('multiplePositionsDiv').style.display = 
            conversionOptions.multiplePositions ? 'block' : 'none';
        updateConversion();
    };
    
    // Update conversion options
    window.updateConversion = function() {
        let insertText = document.getElementById('insertText').value;
        
        // Replace escape sequences
        conversionOptions.insertText = insertText
            .replace(/\\n/g, '\n')
            .replace(/\\t/g, '\t')
            .replace(/\\r/g, '\r');
        
        conversionOptions.position = parseInt(document.getElementById('position').value) || 0;
        conversionOptions.applyTo = document.getElementById('applyTo').value;
        conversionOptions.fromEnd = document.getElementById('fromEnd').checked;
        conversionOptions.skipShortLines = document.getElementById('skipShortLines').checked;
        conversionOptions.skipEmptyLines = document.getElementById('skipEmptyLines').checked;
        
        // Parse multiple positions
        if (conversionOptions.multiplePositions) {
            const positionsInput = document.getElementById('multiplePositionsList').value;
            conversionOptions.positionsList = positionsInput
                .split(',')
                .map(p => parseInt(p.trim()))
                .filter(p => !isNaN(p))
                .sort((a, b) => b - a); // Sort descending for correct insertion
        }
        
        // Trigger re-conversion
        const inputElement = document.getElementById('positionText-input');
        if (inputElement) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Set the conversion function
    setPositionTextConverter(function(text) {
        if (!text) return '';
        if (!conversionOptions.insertText) return text;
        
        if (conversionOptions.applyTo === 'each-line') {
            const lines = text.split('\n');
            return lines.map(line => {
                if (!line.trim() && conversionOptions.skipEmptyLines) {
                    return line;
                }
                return insertAtPosition(line);
            }).join('\n');
        } else {
            return insertAtPosition(text);
        }
    });
    
    function insertAtPosition(text) {
        if (conversionOptions.multiplePositions && conversionOptions.positionsList.length > 0) {
            // Insert at multiple positions (from right to left to maintain positions)
            let result = text;
            conversionOptions.positionsList.forEach(pos => {
                result = insertAtSinglePosition(result, pos);
            });
            return result;
        } else {
            return insertAtSinglePosition(text, conversionOptions.position);
        }
    }
    
    function insertAtSinglePosition(text, position) {
        // Skip if line is too short
        if (conversionOptions.skipShortLines && text.length < position) {
            return text;
        }
        
        let insertPos = position;
        
        // Handle from end
        if (conversionOptions.fromEnd) {
            insertPos = Math.max(0, text.length - position);
        }
        
        // Ensure position is within bounds
        insertPos = Math.max(0, Math.min(insertPos, text.length));
        
        // Insert text at position
        return text.substring(0, insertPos) + conversionOptions.insertText + text.substring(insertPos);
    }
    
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateConversion();
    });
</script>
@endpush

