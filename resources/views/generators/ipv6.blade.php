@extends('layouts.tool')

@section('title', 'Random IPv6 Generator - WordFix')

@section('tool-title', 'Random IPv6 Generator')

@section('tool-description', 'Generate random IPv6 addresses')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-indigo-50 border border-indigo-200 rounded-lg p-3">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Count</label>
            <input type="number" id="count" value="10" min="1" max="1000" class="w-full px-3 py-2 text-sm border border-indigo-300 rounded focus:ring-2 focus:ring-indigo-500" onchange="generateIPv6()">
        </div>
        <div class="flex items-end pb-2">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="compress" class="w-4 h-4 text-indigo-600 rounded" checked onchange="generateIPv6()">
                <span class="ml-2 text-xs font-medium text-gray-700">Compress Zeros (::)</span>
            </label>
        </div>
        <div class="flex items-end pb-2">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="uppercase" class="w-4 h-4 text-indigo-600 rounded" onchange="generateIPv6()">
                <span class="ml-2 text-xs font-medium text-gray-700">Uppercase (A-F)</span>
            </label>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="ipv6Generator"
    inputPlaceholder=""
    outputPlaceholder="Generated IPv6 addresses will appear here..."
    downloadFileName="random-ipv6.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-indigo-600" id="generatedCount">0</div>
        <div class="text-xs text-gray-600">IPs Generated</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Random IPv6 Generator</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Generate random IPv6 addresses for network testing and simulation. Supports standard notation and zero compression.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Generate random IPv6 addresses</li>
            <li>Zero compression support (::)</li>
            <li>Uppercase/Lowercase formatting</li>
            <li>Bulk generation</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function generateIPv6() {
        const output = document.getElementById('ipv6Generator-output');
        if (!output) return;

        const count = parseInt(document.getElementById('count').value) || 10;
        const compress = document.getElementById('compress').checked;
        const uppercase = document.getElementById('uppercase').checked;

        let ips = [];
        
        for (let i = 0; i < count; i++) {
            // Generate 8 groups of 16-bit hex values
            let groups = [];
            for (let j = 0; j < 8; j++) {
                groups.push(Math.floor(Math.random() * 65536).toString(16));
            }
            
            let ip = groups.join(':');
            
            if (compress) {
                // Find longest sequence of zeros
                // Simple compression: replace first occurrence of "0:0:..." with "::"
                // Or better, replace longest sequence
                // For randomness, we can just randomly inject some zeros to make compression visible
                // But let's stick to valid random IPs. Random IPs rarely have long zero sequences.
                // To make it interesting, let's force some zeros occasionally?
                // No, true random is better.
                
                // Standard compression logic
                // Replace longest run of zeros
                const parts = ip.split(':');
                let bestStart = -1;
                let bestLen = 0;
                let currentStart = -1;
                let currentLen = 0;
                
                for (let k = 0; k < 8; k++) {
                    if (parts[k] === '0') {
                        if (currentStart === -1) currentStart = k;
                        currentLen++;
                    } else {
                        if (currentLen > bestLen) {
                            bestLen = currentLen;
                            bestStart = currentStart;
                        }
                        currentStart = -1;
                        currentLen = 0;
                    }
                }
                if (currentLen > bestLen) {
                    bestLen = currentLen;
                    bestStart = currentStart;
                }
                
                if (bestLen >= 2) {
                    // Replace with ::
                    parts.splice(bestStart, bestLen, '');
                    if (bestStart === 0) parts.unshift('');
                    if (bestStart + bestLen === 8) parts.push('');
                    ip = parts.join(':');
                    // Fix double colon edge cases
                    ip = ip.replace(/^:/, '::').replace(/:$/, '::').replace(/:::/, '::');
                }
            }
            
            if (uppercase) {
                ip = ip.toUpperCase();
            }
            
            ips.push(ip);
        }

        output.value = ips.join('\n');
        
        // Update stats
        document.getElementById('generatedCount').textContent = count;
        document.getElementById('statsSection').classList.remove('hidden');
        
        // Trigger input update for stats
        const input = document.getElementById('ipv6Generator-input');
        if (input) {
            input.value = output.value;
            input.dispatchEvent(new Event('input'));
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', generateIPv6);
    
    // Override converter
    setIpv6GeneratorConverter(text => text);
</script>

<style>
    /* Hide input area for generator */
    #ipv6Generator-input {
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
