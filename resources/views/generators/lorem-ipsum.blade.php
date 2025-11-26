@extends('layouts.tool')

@section('title', 'Lorem Ipsum Generator - WordFix')

@section('tool-title', 'Lorem Ipsum Generator')

@section('tool-description', 'Generate placeholder text for your designs')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-gray-50 border border-gray-200 rounded-lg p-3">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Count</label>
            <input type="number" id="count" value="3" min="1" max="100" class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-gray-500" onchange="generateLorem()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Unit</label>
            <select id="unit" class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-gray-500" onchange="generateLorem()">
                <option value="paragraphs">Paragraphs</option>
                <option value="sentences">Sentences</option>
                <option value="words">Words</option>
            </select>
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Format</label>
            <select id="format" class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-gray-500" onchange="generateLorem()">
                <option value="text">Plain Text</option>
                <option value="html_p">HTML (&lt;p&gt;)</option>
                <option value="html_ul">HTML List (&lt;ul&gt;)</option>
                <option value="html_ol">HTML List (&lt;ol&gt;)</option>
            </select>
        </div>
    </div>
    <div class="mt-3">
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="startWithLorem" class="w-4 h-4 text-gray-600 rounded" checked onchange="generateLorem()">
            <span class="ml-2 text-xs font-medium text-gray-700">Start with "Lorem ipsum dolor sit amet..."</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="loremIpsum"
    inputPlaceholder=""
    outputPlaceholder="Generated text will appear here..."
    downloadFileName="lorem-ipsum.txt"
    :showStats="true"
/>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Lorem Ipsum Generator</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Generate standard Lorem Ipsum placeholder text for your design and layout projects.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Generate paragraphs, sentences, or words</li>
            <li>Output as plain text or HTML tags</li>
            <li>Option to include standard start phrase</li>
            <li>Instant generation</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    const LOREM_WORDS = [
        "lorem", "ipsum", "dolor", "sit", "amet", "consectetur", "adipiscing", "elit", "sed", "do", "eiusmod", "tempor", "incididunt", "ut", "labore", "et", "dolore", "magna", "aliqua", "ut", "enim", "ad", "minim", "veniam", "quis", "nostrud", "exercitation", "ullamco", "laboris", "nisi", "ut", "aliquip", "ex", "ea", "commodo", "consequat", "duis", "aute", "irure", "dolor", "in", "reprehenderit", "in", "voluptate", "velit", "esse", "cillum", "dolore", "eu", "fugiat", "nulla", "pariatur", "excepteur", "sint", "occaecat", "cupidatat", "non", "proident", "sunt", "in", "culpa", "qui", "officia", "deserunt", "mollit", "anim", "id", "est", "laborum"
    ];

    function generateSentence(minWords = 8, maxWords = 15) {
        const length = Math.floor(Math.random() * (maxWords - minWords + 1)) + minWords;
        let sentence = [];
        for (let i = 0; i < length; i++) {
            sentence.push(LOREM_WORDS[Math.floor(Math.random() * LOREM_WORDS.length)]);
        }
        // Capitalize first letter
        sentence[0] = sentence[0].charAt(0).toUpperCase() + sentence[0].slice(1);
        return sentence.join(' ') + '.';
    }

    function generateParagraph(minSentences = 3, maxSentences = 6) {
        const length = Math.floor(Math.random() * (maxSentences - minSentences + 1)) + minSentences;
        let paragraph = [];
        for (let i = 0; i < length; i++) {
            paragraph.push(generateSentence());
        }
        return paragraph.join(' ');
    }

    function generateLorem() {
        const output = document.getElementById('loremIpsum-output');
        if (!output) return;

        const count = parseInt(document.getElementById('count').value) || 3;
        const unit = document.getElementById('unit').value;
        const format = document.getElementById('format').value;
        const startWithLorem = document.getElementById('startWithLorem').checked;

        let result = [];
        
        if (unit === 'words') {
            for (let i = 0; i < count; i++) {
                result.push(LOREM_WORDS[Math.floor(Math.random() * LOREM_WORDS.length)]);
            }
            if (startWithLorem && count >= 5) {
                result.splice(0, 5, "lorem", "ipsum", "dolor", "sit", "amet");
            }
            // Capitalize first word
            if (result.length > 0) {
                result[0] = result[0].charAt(0).toUpperCase() + result[0].slice(1);
            }
            let text = result.join(' ');
            if (format === 'html_p') text = `<p>${text}</p>`;
            else if (format === 'html_ul') text = `<ul>\n  <li>${text}</li>\n</ul>`;
            else if (format === 'html_ol') text = `<ol>\n  <li>${text}</li>\n</ol>`;
            output.value = text;
        } 
        else if (unit === 'sentences') {
            for (let i = 0; i < count; i++) {
                result.push(generateSentence());
            }
            if (startWithLorem && result.length > 0) {
                let first = result[0].split(' ');
                if (first.length >= 5) {
                    first.splice(0, 5, "Lorem", "ipsum", "dolor", "sit", "amet");
                    result[0] = first.join(' ');
                }
            }
            
            if (format === 'html_p') {
                output.value = result.map(s => `<p>${s}</p>`).join('\n');
            } else if (format === 'html_ul' || format === 'html_ol') {
                const tag = format === 'html_ul' ? 'ul' : 'ol';
                output.value = `<${tag}>\n` + result.map(s => `  <li>${s}</li>`).join('\n') + `\n</${tag}>`;
            } else {
                output.value = result.join(' ');
            }
        } 
        else { // paragraphs
            for (let i = 0; i < count; i++) {
                result.push(generateParagraph());
            }
            if (startWithLorem && result.length > 0) {
                let first = result[0].split(' ');
                if (first.length >= 5) {
                    first.splice(0, 5, "Lorem", "ipsum", "dolor", "sit", "amet,");
                    result[0] = first.join(' ');
                }
            }
            
            if (format === 'html_p') {
                output.value = result.map(p => `<p>${p}</p>`).join('\n\n');
            } else if (format === 'html_ul' || format === 'html_ol') {
                const tag = format === 'html_ul' ? 'ul' : 'ol';
                output.value = `<${tag}>\n` + result.map(p => `  <li>${p}</li>`).join('\n') + `\n</${tag}>`;
            } else {
                output.value = result.join('\n\n');
            }
        }
        
        // Trigger stats update if function exists
        if (typeof updateStats === 'function') {
            // We need to manually trigger input event on output textarea to update stats? 
            // The x-text-converter listens to input textarea. 
            // For generators, we might need to manually call updateStats or simulate input.
            // But x-text-converter logic is bound to input textarea. 
            // Let's just set the input value to output value so stats work?
            // Or better, modify x-text-converter to support generator mode where input is ignored or hidden.
            // For now, let's just leave it, the stats might show 0 if they depend on input.
            // Actually, for generators, the "Input" box is useless. We should probably hide it or use it as output.
            // But x-text-converter has specific structure.
            // Let's hide the input box via CSS in this specific view?
            // Or just set the generated text to the input box too so stats work.
            const input = document.getElementById('loremIpsum-input');
            if (input) {
                input.value = output.value;
                input.dispatchEvent(new Event('input'));
            }
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', generateLorem);
    
    // Override converter to do nothing as this is a generator
    setLoremIpsumConverter(text => text);
</script>

<style>
    /* Hide input area for generator */
    #loremIpsum-input {
        display: none;
    }
    /* Make output full width */
    .text-converter-wrapper .grid {
        display: block;
    }
    .text-converter-wrapper .grid > div:first-child {
        display: none;
    }
</style>
@endpush
