@extends('layouts.tool')

@section('title', 'Number of Characters in Each Line of Text - WordFix')

@section('tool-title', 'Number of Characters in Each Line of Text')

@section('tool-description', 'Count the number of characters in each line of your text')

@section('tool-content')
<!-- Text Converter Component -->
<x-text-converter 
    toolId="countEachLine"
    inputPlaceholder="Type or paste your content here"
    outputPlaceholder="Results will appear here"
    downloadFileName="line-count-results.txt"
    :showStats="true"
/>

<!-- Display Mode Buttons -->
<div class="flex flex-wrap gap-2 mb-6">
    <button 
        id="btnShowBoth"
        onclick="setDisplayMode('both')" 
        class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors"
    >
        Show Line Count & Line Content
    </button>
    <button 
        id="btnShowCountOnly"
        onclick="setDisplayMode('countOnly')" 
        class="px-4 py-2 bg-gray-300 text-gray-700 text-sm font-medium rounded hover:bg-gray-400 transition-colors"
    >
        Show Only Line Count
    </button>
</div>

<div class="text-sm text-blue-600 mb-6">
    This tool counts the number of characters in each line of your text. You can choose to display just the count or the count with the line content.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Example</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Input Text</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
                What is lorem ipsum?<br>
                The standard lorem ipsum passage has been a printer's friend.<br>
                <br>
                It served as a placeholder for actual content.
            </div>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Output (with Line Count & Content)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
                Line 1: 21 characters [What is lorem ipsum?]<br>
                Line 2: 62 characters [The standard lorem ipsum...]<br>
                Line 3: 0 characters []<br>
                Line 4: 47 characters [It served as a placeholder...]
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Count Each Line Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Count Each Line</strong> tool helps you analyze text by counting the number of characters in each individual line. This is useful for text formatting, content analysis, and ensuring consistency in line lengths.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use the Count Each Line Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Type or paste your text into the input box</li>
            <li>Choose your display mode:
                <ul class="list-disc list-inside ml-6 mt-1">
                    <li><strong>Show Line Count & Line Content</strong> - Shows character count and the actual text of each line</li>
                    <li><strong>Show Only Line Count</strong> - Shows just the character count for each line</li>
                </ul>
            </li>
            <li>View the results in the output area with line-by-line character counts</li>
            <li>Copy or download the results for future use</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Real-time counting as you type</li>
            <li>Two display modes: with or without line content</li>
            <li>Handles empty lines (shows 0 characters)</li>
            <li>Comprehensive text statistics</li>
            <li>Import text from files</li>
            <li>Copy results to clipboard</li>
            <li>Download results as a text file</li>
            <li>Clean and easy-to-read output format</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Analyzing text file structures</li>
            <li>Checking line length consistency</li>
            <li>Formatting poetry or lyrics</li>
            <li>Code review and formatting</li>
            <li>SMS or tweet character limit checking per line</li>
            <li>Content editing and proofreading</li>
            <li>Database or CSV data analysis</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let displayMode = 'both'; // 'both' or 'countOnly'
    
    // Set the conversion function for the component
    setCountEachLineConverter(function(text) {
        if (!text) return '';
        
        const lines = text.split('\n');
        let result = '';
        
        lines.forEach((line, index) => {
            const charCount = line.length;
            const lineNumber = index + 1;
            
            if (displayMode === 'both') {
                // Show line number, character count, and line content
                result += `Line ${lineNumber}: ${charCount} characters [${line}]\n`;
            } else {
                // Show only line number and character count
                result += `Line ${lineNumber}: ${charCount} characters\n`;
            }
        });
        
        return result.trim();
    });
    
    // Set display mode function
    window.setDisplayMode = function(mode) {
        displayMode = mode;
        
        // Update button styles
        const btnShowBoth = document.getElementById('btnShowBoth');
        const btnShowCountOnly = document.getElementById('btnShowCountOnly');
        
        if (mode === 'both') {
            btnShowBoth.className = 'px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors';
            btnShowCountOnly.className = 'px-4 py-2 bg-gray-300 text-gray-700 text-sm font-medium rounded hover:bg-gray-400 transition-colors';
        } else {
            btnShowBoth.className = 'px-4 py-2 bg-gray-300 text-gray-700 text-sm font-medium rounded hover:bg-gray-400 transition-colors';
            btnShowCountOnly.className = 'px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors';
        }
        
        // Trigger re-conversion
        const inputElement = document.getElementById('countEachLine-input');
        if (inputElement) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
</script>
@endpush
