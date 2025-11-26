@extends('layouts.tool')

@section('title', 'Random IP Generator - WordFix')

@section('tool-title', 'Random IP Generator')

@section('tool-description', 'Generate random IPv4 addresses')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-cyan-50 border border-cyan-200 rounded-lg p-3">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Count</label>
            <input type="number" id="count" value="10" min="1" max="1000" class="w-full px-3 py-2 text-sm border border-cyan-300 rounded focus:ring-2 focus:ring-cyan-500" onchange="generateIPs()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">IP Class</label>
            <select id="ipClass" class="w-full px-3 py-2 text-sm border border-cyan-300 rounded focus:ring-2 focus:ring-cyan-500" onchange="generateIPs()">
                <option value="any">Any</option>
                <option value="A">Class A (1.0.0.0 - 126.0.0.0)</option>
                <option value="B">Class B (128.0.0.0 - 191.255.0.0)</option>
                <option value="C">Class C (192.0.0.0 - 223.255.255.0)</option>
                <option value="private">Private (Local Network)</option>
            </select>
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">CIDR Range (Optional)</label>
            <input type="text" id="cidr" placeholder="e.g. 192.168.1.0/24" class="w-full px-3 py-2 text-sm border border-cyan-300 rounded focus:ring-2 focus:ring-cyan-500" onchange="generateIPs()">
        </div>
    </div>
</div>

<x-text-converter 
    toolId="ipGenerator"
    inputPlaceholder=""
    outputPlaceholder="Generated IP addresses will appear here..."
    downloadFileName="random-ips.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-cyan-50 border border-cyan-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-cyan-600" id="generatedCount">0</div>
        <div class="text-xs text-gray-600">IPs Generated</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Random IP Generator</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Generate random IPv4 addresses for network testing, firewall configuration, or simulation.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Generate random IPv4 addresses</li>
            <li>Filter by Class A, B, C, or Private ranges</li>
            <li>Generate IPs within a specific CIDR block</li>
            <li>Bulk generation support</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function ipToLong(ip) {
        return ip.split('.').reduce((acc, octet) => (acc << 8) + parseInt(octet, 10), 0) >>> 0;
    }

    function longToIp(long) {
        return [
            (long >>> 24) & 255,
            (long >>> 16) & 255,
            (long >>> 8) & 255,
            long & 255
        ].join('.');
    }

    function generateIPs() {
        const output = document.getElementById('ipGenerator-output');
        if (!output) return;

        const count = parseInt(document.getElementById('count').value) || 10;
        const ipClass = document.getElementById('ipClass').value;
        const cidr = document.getElementById('cidr').value.trim();

        let ips = [];
        
        // CIDR Parsing
        let minIp = 0;
        let maxIp = 4294967295; // 255.255.255.255
        
        if (cidr && cidr.includes('/')) {
            try {
                const [ip, bits] = cidr.split('/');
                const mask = ~(Math.pow(2, 32 - parseInt(bits)) - 1);
                const longIp = ipToLong(ip);
                minIp = (longIp & mask) >>> 0;
                maxIp = (minIp | ~mask) >>> 0;
            } catch (e) {
                // Invalid CIDR, ignore
            }
        } else if (ipClass !== 'any') {
            if (ipClass === 'A') { minIp = ipToLong('1.0.0.0'); maxIp = ipToLong('126.255.255.255'); }
            else if (ipClass === 'B') { minIp = ipToLong('128.0.0.0'); maxIp = ipToLong('191.255.255.255'); }
            else if (ipClass === 'C') { minIp = ipToLong('192.0.0.0'); maxIp = ipToLong('223.255.255.255'); }
            else if (ipClass === 'private') {
                // Private is tricky as it's multiple ranges. We'll pick one range randomly per IP.
                // 10.0.0.0/8, 172.16.0.0/12, 192.168.0.0/16
            }
        }

        for (let i = 0; i < count; i++) {
            let ipLong;
            
            if (ipClass === 'private' && !cidr) {
                const range = Math.random();
                if (range < 0.33) { // 10.0.0.0/8
                    ipLong = ipToLong('10.0.0.0') + Math.floor(Math.random() * (ipToLong('10.255.255.255') - ipToLong('10.0.0.0')));
                } else if (range < 0.66) { // 172.16.0.0/12
                    ipLong = ipToLong('172.16.0.0') + Math.floor(Math.random() * (ipToLong('172.31.255.255') - ipToLong('172.16.0.0')));
                } else { // 192.168.0.0/16
                    ipLong = ipToLong('192.168.0.0') + Math.floor(Math.random() * (ipToLong('192.168.255.255') - ipToLong('192.168.0.0')));
                }
            } else {
                ipLong = minIp + Math.floor(Math.random() * (maxIp - minIp + 1));
            }
            
            ips.push(longToIp(ipLong));
        }

        output.value = ips.join('\n');
        
        // Update stats
        document.getElementById('generatedCount').textContent = count;
        document.getElementById('statsSection').classList.remove('hidden');
        
        // Trigger input update for stats
        const input = document.getElementById('ipGenerator-input');
        if (input) {
            input.value = output.value;
            input.dispatchEvent(new Event('input'));
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', generateIPs);
    
    // Override converter
    setIpGeneratorConverter(text => text);
</script>

<style>
    /* Hide input area for generator */
    #ipGenerator-input {
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
