@extends('layouts.tool')

@section('title', 'Merge Text or Lists Tool - WordFix')

@section('tool-title', 'Merge Text or Lists Tool')

@section('tool-description', 'Merge multiple text lists or columns into a single combined list')

@section('tool-content')
<!-- Merge Options Panel -->
<div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h3 class="text-sm font-semibold text-gray-900 mb-4">Merge Options</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div>
            <label for="mergeMode" class="block text-sm font-medium text-gray-700 mb-2">Merge Mode:</label>
            <select id="mergeMode" onchange="updateConversion()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="alternate">Alternate (A1, B1, A2, B2...)</option>
                <option value="sequential">Sequential (All A, then All B)</option>
                <option value="side-by-side">Side by Side (A1 B1, A2 B2...)</option>
            </select>
        </div>
        
        <div>
            <label for="separator" class="block text-sm font-medium text-gray-700 mb-2">Separator (for side-by-side):</label>
            <select id="separator" onchange="updateConversion()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value=" ">Space</option>
                <option value=", ">Comma with space</option>
                <option value=" | ">Pipe with spaces</option>
                <option value="\t">Tab</option>
                <option value=" - ">Dash with spaces</option>
                <option value="custom">Custom...</option>
            </select>
        </div>
        
        <div id="customSeparatorDiv" style="display: none;">
            <label for="customSeparator" class="block text-sm font-medium text-gray-700 mb-2">Custom Separator:</label>
            <input 
                type="text" 
                id="customSeparator"
                placeholder="Enter separator"
                oninput="updateConversion()"
                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent"
            />
        </div>
    </div>
    
    <div class="flex flex-wrap gap-4">
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="removeDuplicates" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Remove duplicate lines</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="skipEmptyLines" checked onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Skip empty lines</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="trimLines" checked onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Trim whitespace</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="sortResult" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Sort merged result alphabetically</span>
        </label>
    </div>
</div>

<!-- Multiple Input Areas -->
<div class="mb-6">
    <h3 class="text-sm font-semibold text-gray-900 mb-3">Enter Your Lists to Merge:</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <label for="list1" class="block text-xs font-medium text-gray-700 mb-1">List 1:</label>
            <textarea 
                id="list1"
                class="w-full h-48 p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none text-sm"
                placeholder="Enter first list (one item per line)"
                oninput="updateConversion()"
            ></textarea>
        </div>
        
        <div>
            <label for="list2" class="block text-xs font-medium text-gray-700 mb-1">List 2:</label>
            <textarea 
                id="list2"
                class="w-full h-48 p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none text-sm"
                placeholder="Enter second list (one item per line)"
                oninput="updateConversion()"
            ></textarea>
        </div>
        
        <div>
            <label for="list3" class="block text-xs font-medium text-gray-700 mb-1">List 3 (Optional):</label>
            <textarea 
                id="list3"
                class="w-full h-48 p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none text-sm"
                placeholder="Enter third list (optional)"
                oninput="updateConversion()"
            ></textarea>
        </div>
        
        <div>
            <label for="list4" class="block text-xs font-medium text-gray-700 mb-1">List 4 (Optional):</label>
            <textarea 
                id="list4"
                class="w-full h-48 p-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none text-sm"
                placeholder="Enter fourth list (optional)"
                oninput="updateConversion()"
            ></textarea>
        </div>
    </div>
</div>

<!-- Output Area -->
<div class="mb-6">
    <h3 class="text-sm font-semibold text-gray-900 mb-3">Merged Result:</h3>
    <textarea 
        id="mergeOutput"
        class="w-full h-64 p-4 border border-gray-300 rounded-md bg-gray-50 resize-none text-sm"
        placeholder="Merged result will appear here"
        readonly
    ></textarea>
    
    <div class="flex flex-wrap gap-2 mt-3">
        <button 
            onclick="copyOutput()" 
            class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors"
        >
            Copy Results
        </button>
        <button 
            onclick="clearAll()" 
            class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors"
        >
            Clear All
        </button>
        <button 
            onclick="downloadOutput()" 
            class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors"
        >
            Download
        </button>
    </div>
</div>

<!-- Stats -->
<div class="mb-6 border-t border-gray-200 pt-4">
    <div class="flex flex-wrap gap-4 text-xs text-gray-600">
        <div><span class="font-medium">Stats:</span></div>
        <div>
            <span class="font-medium">Total Lines:</span>
            <span id="totalLines">0</span>
        </div>
        <div>
            <span class="font-medium">List 1 Lines:</span>
            <span id="list1Count">0</span>
        </div>
        <div>
            <span class="font-medium">List 2 Lines:</span>
            <span id="list2Count">0</span>
        </div>
        <div>
            <span class="font-medium">List 3 Lines:</span>
            <span id="list3Count">0</span>
        </div>
        <div>
            <span class="font-medium">List 4 Lines:</span>
            <span id="list4Count">0</span>
        </div>
    </div>
</div>

<div class="text-sm text-blue-600 mb-6">
    This tool merges multiple text lists into a single combined list. Choose from different merge modes: alternate between lists, combine sequentially, or place side-by-side. Perfect for combining data, merging columns, or creating combined lists.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Merge Lists Example</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">List 1</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
                Apple<br>
                Banana<br>
                Orange
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">List 2</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
                Red<br>
                Yellow<br>
                Orange
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Result (Alternate)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
                Apple<br>
                Red<br>
                Banana<br>
                Yellow<br>
                Orange<br>
                Orange
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Merge Text or Lists Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Merge Text or Lists</strong> tool combines multiple text lists into a single unified list. With three different merge modes and various options, you can merge data exactly how you need it.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use This Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Choose your merge mode (Alternate, Sequential, or Side-by-Side)</li>
            <li>Configure your options (duplicates, empty lines, sorting)</li>
            <li>Paste your first list into List 1 textarea</li>
            <li>Paste your second list into List 2 textarea</li>
            <li>Optionally add List 3 and List 4</li>
            <li>The merged result appears automatically in the output area</li>
            <li>Copy or download the merged result</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Merge Modes Explained</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">1. Alternate Mode</h4>
        <p>Takes items from each list in rotation.</p>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Lists:</strong> [A, B, C] and [1, 2, 3]</li>
            <li><strong>Result:</strong> A, 1, B, 2, C, 3</li>
            <li><strong>Use case:</strong> Interleaving data, creating paired lists</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">2. Sequential Mode</h4>
        <p>Combines all items from first list, then all from second list, etc.</p>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Lists:</strong> [A, B, C] and [1, 2, 3]</li>
            <li><strong>Result:</strong> A, B, C, 1, 2, 3</li>
            <li><strong>Use case:</strong> Combining separate lists, appending data</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">3. Side-by-Side Mode</h4>
        <p>Places items from each list on the same line with a separator.</p>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Lists:</strong> [A, B, C] and [1, 2, 3]</li>
            <li><strong>Result:</strong> A 1, B 2, C 3 (each on separate lines)</li>
            <li><strong>Use case:</strong> Creating key-value pairs, combining columns</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>4 Input Lists</strong> - Merge up to 4 different lists simultaneously</li>
            <li><strong>3 Merge Modes</strong> - Alternate, Sequential, or Side-by-Side</li>
            <li><strong>Custom Separators</strong> - Choose how to separate side-by-side items</li>
            <li><strong>Remove Duplicates</strong> - Automatically remove duplicate entries</li>
            <li><strong>Smart Empty Line Handling</strong> - Skip or include blank lines</li>
            <li><strong>Alphabetical Sorting</strong> - Option to sort final merged result</li>
            <li><strong>Trim Whitespace</strong> - Clean up line spacing</li>
            <li><strong>Individual List Counts</strong> - See stats for each input list</li>
            <li>Real-time merging as you type</li>
            <li>Download merged results</li>
            <li>Mobile responsive multi-list interface</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Combine Data Columns</strong> - Merge CSV columns or database fields</li>
            <li><strong>Create Name Lists</strong> - Merge first names and last names</li>
            <li><strong>Combine Categories</strong> - Merge multiple category lists</li>
            <li><strong>Email List Merging</strong> - Combine multiple email lists</li>
            <li><strong>Key-Value Pairs</strong> - Create paired data with side-by-side mode</li>
            <li><strong>Inventory Merging</strong> - Combine product lists from different sources</li>
            <li><strong>Contact Lists</strong> - Merge contact information</li>
            <li><strong>Data Integration</strong> - Combine data from multiple sources</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Advanced Examples</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Create Full Names (Side-by-Side)</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>List 1:</strong> John, Jane, Bob</li>
            <li><strong>List 2:</strong> Doe, Smith, Johnson</li>
            <li><strong>Mode:</strong> Side-by-Side with space separator</li>
            <li><strong>Result:</strong> John Doe, Jane Smith, Bob Johnson</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Combine Shopping Lists (Sequential)</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>List 1:</strong> Milk, Bread, Eggs</li>
            <li><strong>List 2:</strong> Apples, Oranges, Bananas</li>
            <li><strong>Mode:</strong> Sequential with remove duplicates</li>
            <li><strong>Result:</strong> Milk, Bread, Eggs, Apples, Oranges, Bananas</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Create Q&A Pairs (Alternate)</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>List 1:</strong> What is HTML?, What is CSS?</li>
            <li><strong>List 2:</strong> Markup language, Styling language</li>
            <li><strong>Mode:</strong> Alternate</li>
            <li><strong>Result:</strong> Alternates questions and answers</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Use Alternate mode to create paired or interleaved data</li>
            <li>Use Sequential mode to simply combine all lists into one</li>
            <li>Use Side-by-Side mode to create CSV-like data or key-value pairs</li>
            <li>Enable "Remove duplicates" when merging lists that may have overlapping items</li>
            <li>Sort alphabetically to organize the final merged result</li>
            <li>Lists 3 and 4 are optional - use only what you need</li>
            <li>Different length lists are handled gracefully in all modes</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let mergeOptions = {
        mergeMode: 'alternate',
        separator: ' ',
        removeDuplicates: false,
        skipEmptyLines: true,
        trimLines: true,
        sortResult: false,
        customSeparator: ''
    };
    
    // Update conversion options
    window.updateConversion = function() {
        mergeOptions.mergeMode = document.getElementById('mergeMode').value;
        
        const separatorSelect = document.getElementById('separator');
        if (separatorSelect.value === 'custom') {
            mergeOptions.separator = document.getElementById('customSeparator').value;
            document.getElementById('customSeparatorDiv').style.display = 'block';
        } else {
            mergeOptions.separator = separatorSelect.value;
            document.getElementById('customSeparatorDiv').style.display = 'none';
        }
        
        mergeOptions.removeDuplicates = document.getElementById('removeDuplicates').checked;
        mergeOptions.skipEmptyLines = document.getElementById('skipEmptyLines').checked;
        mergeOptions.trimLines = document.getElementById('trimLines').checked;
        mergeOptions.sortResult = document.getElementById('sortResult').checked;
        
        performMerge();
    };
    
    function performMerge() {
        // Get all lists
        const lists = [];
        for (let i = 1; i <= 4; i++) {
            const listElement = document.getElementById('list' + i);
            if (listElement && listElement.value.trim()) {
                let lines = listElement.value.split('\n');
                
                // Process lines
                lines = lines.map(line => mergeOptions.trimLines ? line.trim() : line);
                
                if (mergeOptions.skipEmptyLines) {
                    lines = lines.filter(line => line.trim());
                }
                
                lists.push(lines);
            }
        }
        
        if (lists.length === 0) {
            document.getElementById('mergeOutput').value = '';
            updateStats(lists);
            return;
        }
        
        let result = [];
        
        // Merge based on mode
        if (mergeOptions.mergeMode === 'alternate') {
            // Alternate mode
            const maxLength = Math.max(...lists.map(list => list.length));
            for (let i = 0; i < maxLength; i++) {
                lists.forEach(list => {
                    if (i < list.length) {
                        result.push(list[i]);
                    }
                });
            }
        } else if (mergeOptions.mergeMode === 'sequential') {
            // Sequential mode
            lists.forEach(list => {
                result = result.concat(list);
            });
        } else if (mergeOptions.mergeMode === 'side-by-side') {
            // Side-by-side mode
            const maxLength = Math.max(...lists.map(list => list.length));
            for (let i = 0; i < maxLength; i++) {
                const items = lists.map(list => list[i] || '').filter(item => item);
                if (items.length > 0) {
                    result.push(items.join(mergeOptions.separator));
                }
            }
        }
        
        // Remove duplicates if option enabled
        if (mergeOptions.removeDuplicates) {
            result = [...new Set(result)];
        }
        
        // Sort if option enabled
        if (mergeOptions.sortResult) {
            result.sort();
        }
        
        document.getElementById('mergeOutput').value = result.join('\n');
        updateStats(lists);
    }
    
    function updateStats(lists) {
        const totalLines = lists.reduce((sum, list) => sum + list.length, 0);
        document.getElementById('totalLines').textContent = totalLines;
        
        for (let i = 1; i <= 4; i++) {
            const count = lists[i - 1] ? lists[i - 1].length : 0;
            document.getElementById('list' + i + 'Count').textContent = count;
        }
    }
    
    window.copyOutput = function() {
        const output = document.getElementById('mergeOutput');
        if (!output.value) {
            showToast('No text to copy!', 'error');
            return;
        }
        
        output.select();
        navigator.clipboard.writeText(output.value).then(() => {
            showToast('Text copied to clipboard!', 'success');
        }).catch(() => {
            document.execCommand('copy');
            showToast('Text copied to clipboard!', 'success');
        });
    };
    
    window.clearAll = function() {
        document.getElementById('list1').value = '';
        document.getElementById('list2').value = '';
        document.getElementById('list3').value = '';
        document.getElementById('list4').value = '';
        document.getElementById('mergeOutput').value = '';
        updateStats([]);
    };
    
    window.downloadOutput = function() {
        const text = document.getElementById('mergeOutput').value;
        if (!text) {
            showToast('No text to download!', 'error');
            return;
        }
        
        const blob = new Blob([text], { type: 'text/plain' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'merged-lists.txt';
        a.click();
        URL.revokeObjectURL(url);
        showToast('File downloaded successfully!', 'success');
    };
    
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
        toast.className = `fixed bottom-6 left-1/2 transform -translate-x-1/2 ${bgColor} text-white px-6 py-3 rounded shadow-lg text-sm z-50`;
        toast.style.minWidth = '250px';
        toast.style.textAlign = 'center';
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }
    
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateConversion();
    });
</script>
@endpush

