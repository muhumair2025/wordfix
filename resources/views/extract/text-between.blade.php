@extends('layouts.tool')

@section('title', 'Advanced Text Extractor - WordFix')

@section('tool-title', 'Advanced Text Extractor')

@section('tool-description', 'Extract text using delimiters, regex, lines, positions, and more - the ultimate extraction tool')

@section('tool-content')
<!-- Extraction Mode Selector - Compact & Mobile Responsive -->
<div class="mb-6">
    <h3 class="text-sm font-semibold text-gray-900 mb-2">Extraction Mode</h3>
    <div class="grid grid-cols-3 md:grid-cols-6 gap-2">
        <button onclick="setMode('delimiters')" id="mode-delimiters" class="px-3 py-2 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors flex items-center justify-center gap-1.5">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
            </svg>
            <span class="hidden md:inline">Delimiters</span>
        </button>
        <button onclick="setMode('regex')" id="mode-regex" class="px-3 py-2 bg-gray-200 text-gray-700 text-xs font-medium rounded hover:bg-gray-300 transition-colors flex items-center justify-center gap-1.5">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
            </svg>
            <span class="hidden md:inline">Regex</span>
        </button>
        <button onclick="setMode('lines')" id="mode-lines" class="px-3 py-2 bg-gray-200 text-gray-700 text-xs font-medium rounded hover:bg-gray-300 transition-colors flex items-center justify-center gap-1.5">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <span class="hidden md:inline">Lines</span>
        </button>
        <button onclick="setMode('position')" id="mode-position" class="px-3 py-2 bg-gray-200 text-gray-700 text-xs font-medium rounded hover:bg-gray-300 transition-colors flex items-center justify-center gap-1.5">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            <span class="hidden md:inline">Position</span>
        </button>
        <button onclick="setMode('afterbefore')" id="mode-afterbefore" class="px-3 py-2 bg-gray-200 text-gray-700 text-xs font-medium rounded hover:bg-gray-300 transition-colors flex items-center justify-center gap-1.5">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
            </svg>
            <span class="hidden md:inline">After/Before</span>
        </button>
        <button onclick="setMode('words')" id="mode-words" class="px-3 py-2 bg-gray-200 text-gray-700 text-xs font-medium rounded hover:bg-gray-300 transition-colors flex items-center justify-center gap-1.5">
            <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            <span class="hidden md:inline">Words</span>
        </button>
    </div>
</div>

<!-- Mode 1: Delimiters -->
<div id="config-delimiters" class="mb-4 bg-gradient-to-r from-blue-50 to-purple-50 border border-blue-200 rounded-lg p-3">
    <h3 class="text-sm font-semibold text-gray-900 mb-2">Delimiter Configuration</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Start Delimiter</label>
            <input type="text" id="startDelimiter" value="{" 
                class="w-full px-3 py-2 text-sm border border-blue-300 rounded focus:ring-2 focus:ring-blue-500"
                placeholder="e.g., {, [, <"
                oninput="extract()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">End Delimiter</label>
            <input type="text" id="endDelimiter" value="}" 
                class="w-full px-3 py-2 text-sm border border-blue-300 rounded focus:ring-2 focus:ring-blue-500"
                placeholder="e.g., }, ], >"
                oninput="extract()">
        </div>
    </div>
    <div class="mt-2 flex flex-wrap gap-1.5">
        <button onclick="setDelimiters('{', '}')" class="px-2.5 py-1 text-xs bg-blue-100 text-blue-700 rounded hover:bg-blue-200">{ }</button>
        <button onclick="setDelimiters('[', ']')" class="px-2.5 py-1 text-xs bg-green-100 text-green-700 rounded hover:bg-green-200">[ ]</button>
        <button onclick="setDelimiters('<', '>')" class="px-2.5 py-1 text-xs bg-purple-100 text-purple-700 rounded hover:bg-purple-200">&lt; &gt;</button>
        <button onclick="setDelimiters('(', ')')" class="px-2.5 py-1 text-xs bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200">( )</button>
        <button onclick="setDelimiters('\"', '\"')" class="px-2.5 py-1 text-xs bg-pink-100 text-pink-700 rounded hover:bg-pink-200">" "</button>
        <button onclick="setDelimiters('<!--', '-->')" class="px-2.5 py-1 text-xs bg-indigo-100 text-indigo-700 rounded hover:bg-indigo-200">HTML</button>
    </div>
</div>

<!-- Mode 2: Regex -->
<div id="config-regex" class="mb-4 bg-gradient-to-r from-green-50 to-blue-50 border border-green-200 rounded-lg p-3 hidden">
    <h3 class="text-sm font-semibold text-gray-900 mb-2">Regex Pattern</h3>
    <div class="mb-2">
        <label class="block text-xs font-medium text-gray-700 mb-1">Regular Expression</label>
        <input type="text" id="regexPattern" value="(\d+)" 
            class="w-full px-3 py-2 text-sm border border-green-300 rounded focus:ring-2 focus:ring-green-500 font-mono"
            placeholder="e.g., (\d+), ([A-Z]+), (https?://\S+)"
            oninput="extract()">
        <p class="text-xs text-gray-600 mt-1">Use parentheses () to capture groups</p>
    </div>
    <div class="flex flex-wrap gap-1.5">
        <button onclick="setRegex('(\\d+)')" class="px-2.5 py-1 text-xs bg-green-100 text-green-700 rounded hover:bg-green-200">Numbers</button>
        <button onclick="setRegex('([A-Za-z]+@[A-Za-z0-9.-]+)')" class="px-2.5 py-1 text-xs bg-blue-100 text-blue-700 rounded hover:bg-blue-200">Emails</button>
        <button onclick="setRegex('(https?://\\S+)')" class="px-2.5 py-1 text-xs bg-purple-100 text-purple-700 rounded hover:bg-purple-200">URLs</button>
        <button onclick="setRegex('(#[0-9A-Fa-f]{6})')" class="px-2.5 py-1 text-xs bg-yellow-100 text-yellow-700 rounded hover:bg-yellow-200">Hex Colors</button>
    </div>
</div>

<!-- Mode 3: Lines -->
<div id="config-lines" class="mb-4 bg-gradient-to-r from-purple-50 to-pink-50 border border-purple-200 rounded-lg p-3 hidden">
    <h3 class="text-sm font-semibold text-gray-900 mb-2">Line Selection</h3>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">From Line</label>
            <input type="number" id="fromLine" value="1" min="1"
                class="w-full px-3 py-2 text-sm border border-purple-300 rounded focus:ring-2 focus:ring-purple-500"
                oninput="extract()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">To Line</label>
            <input type="number" id="toLine" value="10" min="1"
                class="w-full px-3 py-2 text-sm border border-purple-300 rounded focus:ring-2 focus:ring-purple-500"
                oninput="extract()">
        </div>
        <div>
            <label class="flex items-center cursor-pointer bg-white border border-purple-200 rounded px-3 py-2">
                <input type="checkbox" id="skipEmpty" class="w-4 h-4 text-purple-600 rounded">
                <span class="ml-2 text-xs font-medium">Skip Empty</span>
            </label>
        </div>
    </div>
</div>

<!-- Mode 4: Position -->
<div id="config-position" class="mb-4 bg-gradient-to-r from-yellow-50 to-orange-50 border border-yellow-200 rounded-lg p-3 hidden">
    <h3 class="text-sm font-semibold text-gray-900 mb-2">Character Position</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Start Position</label>
            <input type="number" id="startPos" value="0" min="0"
                class="w-full px-3 py-2 text-sm border border-yellow-300 rounded focus:ring-2 focus:ring-yellow-500"
                oninput="extract()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">End Position (0 = end)</label>
            <input type="number" id="endPos" value="0" min="0"
                class="w-full px-3 py-2 text-sm border border-yellow-300 rounded focus:ring-2 focus:ring-yellow-500"
                oninput="extract()">
        </div>
    </div>
</div>

<!-- Mode 5: After/Before -->
<div id="config-afterbefore" class="mb-4 bg-gradient-to-r from-indigo-50 to-blue-50 border border-indigo-200 rounded-lg p-3 hidden">
    <h3 class="text-sm font-semibold text-gray-900 mb-2">Extract After/Before Text</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-2">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Extract After</label>
            <input type="text" id="afterText" placeholder="e.g., Name:"
                class="w-full px-3 py-2 text-sm border border-indigo-300 rounded focus:ring-2 focus:ring-indigo-500"
                oninput="extract()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Extract Before</label>
            <input type="text" id="beforeText" placeholder="e.g., \n or , or ;"
                class="w-full px-3 py-2 text-sm border border-indigo-300 rounded focus:ring-2 focus:ring-indigo-500"
                oninput="extract()">
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
        <label class="flex items-center cursor-pointer bg-white border border-indigo-200 rounded px-3 py-1.5">
            <input type="checkbox" id="includeAfter" class="w-4 h-4 text-indigo-600 rounded" onchange="extract()">
            <span class="ml-2 text-xs font-medium">Include "After" in Result</span>
        </label>
        <label class="flex items-center cursor-pointer bg-white border border-indigo-200 rounded px-3 py-1.5">
            <input type="checkbox" id="includeBefore" class="w-4 h-4 text-indigo-600 rounded" onchange="extract()">
            <span class="ml-2 text-xs font-medium">Include "Before" in Result</span>
        </label>
    </div>
    <p class="text-xs text-gray-600 mt-2">Extract text between two patterns</p>
</div>

<!-- Mode 6: Words -->
<div id="config-words" class="mb-4 bg-gradient-to-r from-pink-50 to-red-50 border border-pink-200 rounded-lg p-3 hidden">
    <h3 class="text-sm font-semibold text-gray-900 mb-2">Word Range</h3>
    <div class="grid grid-cols-2 md:grid-cols-3 gap-3">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">From Word</label>
            <input type="number" id="fromWord" value="1" min="1"
                class="w-full px-3 py-2 text-sm border border-pink-300 rounded focus:ring-2 focus:ring-pink-500"
                oninput="extract()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">To Word</label>
            <input type="number" id="toWord" value="5" min="1"
                class="w-full px-3 py-2 text-sm border border-pink-300 rounded focus:ring-2 focus:ring-pink-500"
                oninput="extract()">
        </div>
        <div>
            <label class="flex items-center cursor-pointer bg-white border border-pink-200 rounded px-3 py-2">
                <input type="checkbox" id="perLine" class="w-4 h-4 text-pink-600 rounded" checked>
                <span class="ml-2 text-xs font-medium">Per Line</span>
            </label>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="textExtractor"
    inputPlaceholder="Paste your text here..."
    outputPlaceholder="Extracted text will appear here..."
    downloadFileName="extracted-text.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-blue-600" id="matchCount">0</div>
        <div class="text-xs text-gray-600">Matches</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-green-600" id="uniqueCount">0</div>
        <div class="text-xs text-gray-600">Unique</div>
    </div>
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-purple-600" id="avgLength">0</div>
        <div class="text-xs text-gray-600">Avg Length</div>
    </div>
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">
        <div class="text-2xl font-bold text-yellow-600" id="totalChars">0</div>
        <div class="text-xs text-gray-600">Total Chars</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Advanced Text Extractor</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>The ultimate text extraction tool with 6 powerful modes for extracting any text pattern you need.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Extraction Modes</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Delimiters:</strong> Extract between custom start/end markers</li>
            <li><strong>Regex:</strong> Use regular expressions for complex patterns</li>
            <li><strong>Lines:</strong> Extract specific line ranges</li>
            <li><strong>Position:</strong> Extract by character position</li>
            <li><strong>After/Before:</strong> Extract text between two patterns</li>
            <li><strong>Words:</strong> Extract word ranges from text</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Uses</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Data Processing:</strong> Parse structured data</li>
            <li><strong>Web Scraping:</strong> Extract HTML content</li>
            <li><strong>Log Analysis:</strong> Extract specific log entries</li>
            <li><strong>Code Parsing:</strong> Extract functions, variables</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let currentMode = 'delimiters';
    
    function setMode(mode) {
        currentMode = mode;
        
        // Update button styles
        ['delimiters', 'regex', 'lines', 'position', 'afterbefore', 'words'].forEach(m => {
            const btn = document.getElementById(`mode-${m}`);
            if (btn) {
                btn.className = m === mode
                    ? 'px-3 py-2 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors flex items-center justify-center gap-1.5'
                    : 'px-3 py-2 bg-gray-200 text-gray-700 text-xs font-medium rounded hover:bg-gray-300 transition-colors flex items-center justify-center gap-1.5';
            }
        });
        
        // Show/hide config panels
        ['delimiters', 'regex', 'lines', 'position', 'afterbefore', 'words'].forEach(m => {
            const panel = document.getElementById(`config-${m}`);
            if (panel) {
                panel.classList.toggle('hidden', m !== mode);
            }
        });
        
        extract();
    }
    
    function escapeRegex(str) {
        return str.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
    }
    
    function setDelimiters(start, end) {
        document.getElementById('startDelimiter').value = start;
        document.getElementById('endDelimiter').value = end;
        extract();
    }
    
    function setRegex(pattern) {
        document.getElementById('regexPattern').value = pattern;
        extract();
    }
    
    function extract() {
        const input = document.getElementById('textExtractor-input');
        const output = document.getElementById('textExtractor-output');
        if (!input || !output) return;
        
        const text = input.value;
        let results = [];
        
        try {
            switch (currentMode) {
                case 'delimiters':
                    results = extractByDelimiters(text);
                    break;
                case 'regex':
                    results = extractByRegex(text);
                    break;
                case 'lines':
                    results = extractByLines(text);
                    break;
                case 'position':
                    results = extractByPosition(text);
                    break;
                case 'afterbefore':
                    results = extractAfterBefore(text);
                    break;
                case 'words':
                    results = extractByWords(text);
                    break;
            }
        } catch (e) {
            output.value = 'Error: ' + e.message;
            return;
        }
        
        output.value = results.join('\n');
        updateStats(results);
    }
    
    function extractByDelimiters(text) {
        const start = document.getElementById('startDelimiter')?.value || '';
        const end = document.getElementById('endDelimiter')?.value || '';
        if (!start || !end) return [];
        
        const escapedStart = escapeRegex(start);
        const escapedEnd = escapeRegex(end);
        const regex = new RegExp(escapedStart + '(.*?)' + escapedEnd, 'gs');
        
        const matches = [];
        let match;
        while ((match = regex.exec(text)) !== null) {
            matches.push(match[1]);
        }
        return matches;
    }
    
    function extractByRegex(text) {
        const pattern = document.getElementById('regexPattern')?.value || '';
        if (!pattern) return [];
        
        const regex = new RegExp(pattern, 'g');
        const matches = [];
        let match;
        while ((match = regex.exec(text)) !== null) {
            matches.push(match[1] || match[0]);
        }
        return matches;
    }
    
    function extractByLines(text) {
        const fromLine = parseInt(document.getElementById('fromLine')?.value || 1);
        const toLine = parseInt(document.getElementById('toLine')?.value || 10);
        const skipEmpty = document.getElementById('skipEmpty')?.checked || false;
        
        let lines = text.split('\n');
        if (skipEmpty) {
            lines = lines.filter(line => line.trim().length > 0);
        }
        
        return lines.slice(Math.max(0, fromLine - 1), toLine);
    }
    
    function extractByPosition(text) {
        const startPos = parseInt(document.getElementById('startPos')?.value || 0);
        const endPos = parseInt(document.getElementById('endPos')?.value || 0);
        
        const end = endPos === 0 ? text.length : endPos;
        return [text.substring(startPos, end)];
    }
    
    function extractAfterBefore(text) {
        const after = document.getElementById('afterText')?.value || '';
        const before = document.getElementById('beforeText')?.value || '';
        const includeAfter = document.getElementById('includeAfter')?.checked || false;
        const includeBefore = document.getElementById('includeBefore')?.checked || false;
        
        if (!after && !before) return [];
        
        let pattern = '';
        if (after && before) {
            pattern = escapeRegex(after) + '(.*?)' + escapeRegex(before);
        } else if (after) {
            pattern = escapeRegex(after) + '(.*)';
        } else {
            pattern = '(.*)' + escapeRegex(before);
        }
        
        const regex = new RegExp(pattern, 'gs');
        const matches = [];
        let match;
        while ((match = regex.exec(text)) !== null) {
            let result = match[1].trim();
            
            // Add "after" text if requested
            if (includeAfter && after) {
                result = after + result;
            }
            
            // Add "before" text if requested
            if (includeBefore && before) {
                result = result + before;
            }
            
            matches.push(result);
        }
        return matches;
    }
    
    function extractByWords(text) {
        const fromWord = parseInt(document.getElementById('fromWord')?.value || 1);
        const toWord = parseInt(document.getElementById('toWord')?.value || 5);
        const perLine = document.getElementById('perLine')?.checked || false;
        
        if (perLine) {
            const lines = text.split('\n');
            return lines.map(line => {
                const words = line.trim().split(/\s+/);
                return words.slice(Math.max(0, fromWord - 1), toWord).join(' ');
            }).filter(line => line.length > 0);
        } else {
            const words = text.split(/\s+/);
            return [words.slice(Math.max(0, fromWord - 1), toWord).join(' ')];
        }
    }
    
    function updateStats(results) {
        const unique = [...new Set(results)];
        const avgLen = results.length > 0 ? results.reduce((sum, r) => sum + r.length, 0) / results.length : 0;
        const totalChars = results.reduce((sum, r) => sum + r.length, 0);
        
        document.getElementById('matchCount').textContent = results.length;
        document.getElementById('uniqueCount').textContent = unique.length;
        document.getElementById('avgLength').textContent = avgLen.toFixed(1);
        document.getElementById('totalChars').textContent = totalChars;
        document.getElementById('statsSection').classList.remove('hidden');
    }
    
    setTextExtractorConverter(text => {
        extract();
        return document.getElementById('textExtractor-output').value;
    });
    
    // Initialize
    setMode('delimiters');
</script>
@endpush
