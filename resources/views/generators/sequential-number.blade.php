@extends('layouts.tool')

@section('title', 'Sequential Number Generator - WordFix')

@section('tool-title', 'Sequential Number Generator')

@section('tool-description', 'Generate sequences of numbers')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-blue-50 border border-blue-200 rounded-lg p-3">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Start</label>
            <input type="number" id="start" value="1" class="w-full px-3 py-2 text-sm border border-blue-300 rounded focus:ring-2 focus:ring-blue-500" onchange="generateSequence()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">End / Count</label>
            <input type="number" id="end" value="100" class="w-full px-3 py-2 text-sm border border-blue-300 rounded focus:ring-2 focus:ring-blue-500" onchange="generateSequence()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Step</label>
            <input type="number" id="step" value="1" class="w-full px-3 py-2 text-sm border border-blue-300 rounded focus:ring-2 focus:ring-blue-500" onchange="generateSequence()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Padding (Zeros)</label>
            <input type="number" id="padding" value="0" min="0" max="10" class="w-full px-3 py-2 text-sm border border-blue-300 rounded focus:ring-2 focus:ring-blue-500" onchange="generateSequence()">
        </div>
    </div>
    <div class="mt-3">
        <label class="block text-xs font-medium text-gray-700 mb-1">Separator</label>
        <div class="flex gap-4">
            <label class="flex items-center cursor-pointer">
                <input type="radio" name="separator" value="newline" class="w-4 h-4 text-blue-600" checked onchange="generateSequence()">
                <span class="ml-2 text-xs text-gray-700">New Line</span>
            </label>
            <label class="flex items-center cursor-pointer">
                <input type="radio" name="separator" value="comma" class="w-4 h-4 text-blue-600" onchange="generateSequence()">
                <span class="ml-2 text-xs text-gray-700">Comma</span>
            </label>
            <label class="flex items-center cursor-pointer">
                <input type="radio" name="separator" value="space" class="w-4 h-4 text-blue-600" onchange="generateSequence()">
                <span class="ml-2 text-xs text-gray-700">Space</span>
            </label>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="seqGenerator"
    inputPlaceholder=""
    outputPlaceholder="Generated sequence will appear here..."
    downloadFileName="sequential-numbers.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="generatedCount">0</div>
        <div class="text-xs text-gray-600">Count</div>
    </div>
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="sum">0</div>
        <div class="text-xs text-gray-600">Sum</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Sequential Number Generator</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Generate ordered sequences of numbers with custom start, end, step, and formatting options.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Define Start and End points</li>
            <li>Custom Step value (increment/decrement)</li>
            <li>Zero-padding support (e.g., 001, 002)</li>
            <li>Custom separators (newline, comma, space)</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function generateSequence() {
        const output = document.getElementById('seqGenerator-output');
        if (!output) return;

        const start = parseInt(document.getElementById('start').value) || 1;
        const end = parseInt(document.getElementById('end').value) || 100;
        const step = parseInt(document.getElementById('step').value) || 1;
        const padding = parseInt(document.getElementById('padding').value) || 0;
        const separatorType = document.querySelector('input[name="separator"]:checked').value;

        let separator = '\n';
        if (separatorType === 'comma') separator = ', ';
        if (separatorType === 'space') separator = ' ';

        let numbers = [];
        let current = start;
        
        // Safety check for infinite loops
        if (step === 0) {
            output.value = "Error: Step cannot be 0";
            return;
        }
        if ((start < end && step < 0) || (start > end && step > 0)) {
            output.value = "Error: Step direction does not match Start/End values";
            return;
        }
        
        // Limit max count to prevent browser crash
        const maxCount = 10000;
        let count = 0;

        while ((step > 0 && current <= end) || (step < 0 && current >= end)) {
            let numStr = current.toString();
            if (padding > 0) {
                numStr = numStr.padStart(padding, '0');
            }
            numbers.push(numStr);
            current += step;
            count++;
            if (count >= maxCount) break;
        }

        output.value = numbers.join(separator);
        
        // Update stats
        const sum = (count * (start + (current - step))) / 2; // Arithmetic series sum formula
        
        document.getElementById('generatedCount').textContent = count;
        document.getElementById('sum').textContent = sum;
        document.getElementById('statsSection').classList.remove('hidden');
        
        // Trigger input update for stats
        const input = document.getElementById('seqGenerator-input');
        if (input) {
            input.value = output.value;
            input.dispatchEvent(new Event('input'));
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', generateSequence);
    
    // Override converter
    setSeqGeneratorConverter(text => text);
</script>

<style>
    /* Hide input area for generator */
    #seqGenerator-input {
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
