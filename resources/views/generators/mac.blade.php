@extends('layouts.tool')

@section('title', 'Random MAC Address Generator - WordFix')

@section('tool-title', 'Random MAC Address Generator')

@section('tool-description', 'Generate random MAC addresses')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-gray-50 border border-gray-200 rounded-lg p-3">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Count</label>
            <input type="number" id="count" value="10" min="1" max="1000" class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-gray-500" onchange="generateMAC()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Separator</label>
            <select id="separator" class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-gray-500" onchange="generateMAC()">
                <option value=":">Colon (:)</option>
                <option value="-">Dash (-)</option>
                <option value="">None</option>
            </select>
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Case</label>
            <select id="case" class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-gray-500" onchange="generateMAC()">
                <option value="upper">Uppercase (00:1A...)</option>
                <option value="lower">Lowercase (00:1a...)</option>
            </select>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="macGenerator"
    inputPlaceholder=""
    outputPlaceholder="Generated MAC addresses will appear here..."
    downloadFileName="random-mac-addresses.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-gray-50 border border-gray-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-gray-600" id="generatedCount">0</div>
        <div class="text-xs text-gray-600">MACs Generated</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Random MAC Address Generator</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Generate random MAC (Media Access Control) addresses for network testing, simulation, or spoofing.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Generate random MAC addresses</li>
            <li>Custom separators (colon, dash, or none)</li>
            <li>Uppercase or lowercase formatting</li>
            <li>Bulk generation</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function generateMAC() {
        const output = document.getElementById('macGenerator-output');
        if (!output) return;

        const count = parseInt(document.getElementById('count').value) || 10;
        const separator = document.getElementById('separator').value;
        const letterCase = document.getElementById('case').value;

        let macs = [];
        
        for (let i = 0; i < count; i++) {
            let octets = [];
            for (let j = 0; j < 6; j++) {
                let octet = Math.floor(Math.random() * 256).toString(16);
                if (octet.length < 2) octet = '0' + octet;
                octets.push(octet);
            }
            
            let mac = octets.join(separator);
            
            if (letterCase === 'upper') {
                mac = mac.toUpperCase();
            } else {
                mac = mac.toLowerCase();
            }
            
            macs.push(mac);
        }

        output.value = macs.join('\n');
        
        // Update stats
        document.getElementById('generatedCount').textContent = count;
        document.getElementById('statsSection').classList.remove('hidden');
        
        // Trigger input update for stats
        const input = document.getElementById('macGenerator-input');
        if (input) {
            input.value = output.value;
            input.dispatchEvent(new Event('input'));
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', generateMAC);
    
    // Override converter
    setMacGeneratorConverter(text => text);
</script>

<style>
    /* Hide input area for generator */
    #macGenerator-input {
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
