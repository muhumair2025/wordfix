@extends('layouts.tool')

@section('title', 'Random User-Agent Generator - WordFix')

@section('tool-title', 'Random User-Agent Generator')

@section('tool-description', 'Generate random User-Agent strings for testing')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-indigo-50 border border-indigo-200 rounded-lg p-3">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Count</label>
            <input type="number" id="count" value="10" min="1" max="100" class="w-full px-3 py-2 text-sm border border-indigo-300 rounded focus:ring-2 focus:ring-indigo-500" onchange="generateUA()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Device Type</label>
            <select id="deviceType" class="w-full px-3 py-2 text-sm border border-indigo-300 rounded focus:ring-2 focus:ring-indigo-500" onchange="generateUA()">
                <option value="all">All Devices</option>
                <option value="desktop">Desktop</option>
                <option value="mobile">Mobile</option>
                <option value="tablet">Tablet</option>
            </select>
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Browser</label>
            <select id="browser" class="w-full px-3 py-2 text-sm border border-indigo-300 rounded focus:ring-2 focus:ring-indigo-500" onchange="generateUA()">
                <option value="all">All Browsers</option>
                <option value="chrome">Chrome</option>
                <option value="firefox">Firefox</option>
                <option value="safari">Safari</option>
                <option value="edge">Edge</option>
            </select>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="uaGenerator"
    inputPlaceholder=""
    outputPlaceholder="Generated User-Agents will appear here..."
    downloadFileName="user-agents.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-indigo-600" id="generatedCount">0</div>
        <div class="text-xs text-gray-600">UAs Generated</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Random User-Agent Generator</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Generate random User-Agent strings to simulate different browsers, operating systems, and devices.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Generate valid User-Agent strings</li>
            <li>Filter by Device (Desktop, Mobile, Tablet)</li>
            <li>Filter by Browser (Chrome, Firefox, Safari, Edge)</li>
            <li>Bulk generation</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    const UA_DATA = {
        desktop: {
            chrome: [
                "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36",
                "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36",
                "Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36"
            ],
            firefox: [
                "Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0",
                "Mozilla/5.0 (Macintosh; Intel Mac OS X 10.15; rv:121.0) Gecko/20100101 Firefox/121.0"
            ],
            safari: [
                "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.2 Safari/605.1.15"
            ],
            edge: [
                "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36 Edg/120.0.0.0"
            ]
        },
        mobile: {
            chrome: [
                "Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Mobile Safari/537.36",
                "Mozilla/5.0 (iPhone; CPU iPhone OS 17_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/120.0.6099.119 Mobile/15E148 Safari/604.1"
            ],
            firefox: [
                "Mozilla/5.0 (Android 14; Mobile; rv:121.0) Gecko/121.0 Firefox/121.0",
                "Mozilla/5.0 (iPhone; CPU iPhone OS 17_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) FxiOS/121.0 Mobile/15E148 Safari/605.1.15"
            ],
            safari: [
                "Mozilla/5.0 (iPhone; CPU iPhone OS 17_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.2 Mobile/15E148 Safari/604.1"
            ]
        },
        tablet: {
            chrome: [
                "Mozilla/5.0 (Linux; Android 10; SM-T500) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36",
                "Mozilla/5.0 (iPad; CPU OS 17_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) CriOS/120.0.6099.119 Mobile/15E148 Safari/604.1"
            ],
            safari: [
                "Mozilla/5.0 (iPad; CPU OS 17_2 like Mac OS X) AppleWebKit/605.1.15 (KHTML, like Gecko) Version/17.2 Mobile/15E148 Safari/604.1"
            ]
        }
    };

    function generateUA() {
        const output = document.getElementById('uaGenerator-output');
        if (!output) return;

        const count = parseInt(document.getElementById('count').value) || 10;
        const deviceType = document.getElementById('deviceType').value;
        const browser = document.getElementById('browser').value;

        let uas = [];
        
        for (let i = 0; i < count; i++) {
            // Select Device Type
            let selectedDevice = deviceType;
            if (selectedDevice === 'all') {
                const types = Object.keys(UA_DATA);
                selectedDevice = types[Math.floor(Math.random() * types.length)];
            }
            
            // Select Browser
            let selectedBrowser = browser;
            const availableBrowsers = Object.keys(UA_DATA[selectedDevice]);
            
            if (selectedBrowser === 'all' || !availableBrowsers.includes(selectedBrowser)) {
                selectedBrowser = availableBrowsers[Math.floor(Math.random() * availableBrowsers.length)];
            }
            
            // Select UA
            const templates = UA_DATA[selectedDevice][selectedBrowser];
            let ua = templates[Math.floor(Math.random() * templates.length)];
            
            // Add some randomness to versions to make them unique
            ua = ua.replace(/(\d+)\.(\d+)/g, (match, p1, p2) => {
                // 10% chance to slightly modify version
                if (Math.random() > 0.9) {
                    return p1 + '.' + (parseInt(p2) + Math.floor(Math.random() * 5));
                }
                return match;
            });
            
            uas.push(ua);
        }

        output.value = uas.join('\n');
        
        // Update stats
        document.getElementById('generatedCount').textContent = count;
        document.getElementById('statsSection').classList.remove('hidden');
        
        // Trigger input update for stats
        const input = document.getElementById('uaGenerator-input');
        if (input) {
            input.value = output.value;
            input.dispatchEvent(new Event('input'));
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', generateUA);
    
    // Override converter
    setUaGeneratorConverter(text => text);
</script>

<style>
    /* Hide input area for generator */
    #uaGenerator-input {
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
