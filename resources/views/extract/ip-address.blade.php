@extends('layouts.tool')

@section('title', 'IP Address Extractor - WordFix')

@section('tool-title', 'IP Address Extractor')

@section('tool-description', 'Extract IPv4 and IPv6 addresses from logs, text, or configuration files')

@section('tool-content')
<!-- Text Input -->
<div class="mb-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">Paste Your Text/Logs</label>
    <textarea 
        id="ipInput" 
        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none font-mono text-sm"
        rows="8"
        placeholder="Paste server logs, config files, or text containing IP addresses like 192.168.1.1 or 2001:0db8::1"
        oninput="extractIPs()"
    ></textarea>
</div>

<!-- Results Section -->
<div id="resultsSection" class="hidden">
    <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <h3 class="text-lg font-semibold text-gray-900">
            Found <span id="ipCount" class="text-blue-600">0</span> IP Address(es)
        </h3>
        <div class="flex flex-wrap gap-2">
            <button onclick="copyIPs()" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                Copy All
            </button>
            <button onclick="downloadIPs()" class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                Download
            </button>
            <button onclick="clearAll()" class="px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
                Clear
            </button>
        </div>
    </div>
    
    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-blue-600" id="ipv4Count">0</div>
            <div class="text-xs text-gray-600">IPv4</div>
        </div>
        <div class="bg-green-50 border border-green-200 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-green-600" id="ipv6Count">0</div>
            <div class="text-xs text-gray-600">IPv6</div>
        </div>
        <div class="bg-purple-50 border border-purple-200 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-purple-600" id="uniqueCount">0</div>
            <div class="text-xs text-gray-600">Unique</div>
        </div>
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 text-center">
            <div class="text-2xl font-bold text-yellow-600" id="privateCount">0</div>
            <div class="text-xs text-gray-600">Private</div>
        </div>
    </div>
    
    <!-- IP List -->
    <div class="bg-gray-50 border border-gray-200 rounded-lg p-4 max-h-96 overflow-y-auto">
        <ul id="ipList" class="space-y-2"></ul>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About IP Address Extractor</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>IP Address Extractor</strong> finds and extracts all IPv4 and IPv6 addresses from logs, configuration files, or any text. Perfect for network analysis and security audits.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Extracts both IPv4 and IPv6 addresses</li>
            <li>Identifies private vs public IP ranges</li>
            <li>Duplicate detection and unique count</li>
            <li>Type classification (v4/v6)</li>
            <li>Export to text file</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Uses</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Security:</strong> Analyze server logs for threats</li>
            <li><strong>Networking:</strong> Extract IPs from config files</li>
            <li><strong>Monitoring:</strong> Track visitor IPs</li>
            <li><strong>Forensics:</strong> Investigate security incidents</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Supported Formats</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>IPv4: <code>192.168.1.1</code></li>
            <li>IPv6: <code>2001:0db8::1</code></li>
            <li>Private ranges: 10.x.x.x, 172.16-31.x.x, 192.168.x.x</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let extractedIPs = [];
    
    function extractIPs() {
        const text = document.getElementById('ipInput').value;
        const ipv4Regex = /\b(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\b/g;
        const ipv6Regex = /\b(?:[0-9a-fA-F]{1,4}:){7}[0-9a-fA-F]{1,4}\b|\b(?:[0-9a-fA-F]{1,4}:){1,7}:\b|\b::(?:[0-9a-fA-F]{1,4}:){0,6}[0-9a-fA-F]{1,4}\b/g;
        
        const ipv4s = text.match(ipv4Regex) || [];
        const ipv6s = text.match(ipv6Regex) || [];
        
        extractedIPs = [...ipv4s.map(ip => ({ip, type: 'IPv4'})), ...ipv6s.map(ip => ({ip, type: 'IPv6'}))];
        
        if (extractedIPs.length > 0) {
            displayResults();
        } else {
            document.getElementById('resultsSection').classList.add('hidden');
        }
    }
    
    function isPrivateIP(ip) {
        if (ip.startsWith('10.')) return true;
        if (ip.startsWith('192.168.')) return true;
        const parts = ip.split('.');
        if (parts[0] === '172' && parseInt(parts[1]) >= 16 && parseInt(parts[1]) <= 31) return true;
        return false;
    }
    
    function displayResults() {
        const uniqueIPs = [...new Set(extractedIPs.map(item => item.ip))];
        const ipv4Count = extractedIPs.filter(item => item.type === 'IPv4').length;
        const ipv6Count = extractedIPs.filter(item => item.type === 'IPv6').length;
        const privateCount = uniqueIPs.filter(isPrivateIP).length;
        
        document.getElementById('ipCount').textContent = uniqueIPs.length;
        document.getElementById('ipv4Count').textContent = ipv4Count;
        document.getElementById('ipv6Count').textContent = ipv6Count;
        document.getElementById('uniqueCount').textContent = uniqueIPs.length;
        document.getElementById('privateCount').textContent = privateCount;
        
        const listHTML = uniqueIPs.map(ip => {
            const type = extractedIPs.find(item => item.ip === ip).type;
            const isPrivate = isPrivateIP(ip);
            const badge = type === 'IPv4' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700';
            const privateBadge = isPrivate ? '<span class="ml-2 px-2 py-0.5 bg-yellow-100 text-yellow-700 text-xs rounded">Private</span>' : '';
            
            return `<li class="flex items-center justify-between bg-white p-3 rounded border border-gray-200">
                <div class="flex items-center gap-2">
                    <span class="text-sm font-mono text-gray-900">${ip}</span>
                    <span class="px-2 py-0.5 ${badge} text-xs rounded">${type}</span>
                    ${privateBadge}
                </div>
                <button onclick="copyIP('${ip}')" class="text-blue-600 hover:text-blue-700 text-xs">Copy</button>
            </li>`;
        }).join('');
        
        document.getElementById('ipList').innerHTML = listHTML;
        document.getElementById('resultsSection').classList.remove('hidden');
    }
    
    function copyIP(ip) {
        navigator.clipboard.writeText(ip);
    }
    
    function copyIPs() {
        const unique = [...new Set(extractedIPs.map(item => item.ip))];
        navigator.clipboard.writeText(unique.join('\n'));
        alert('IP addresses copied to clipboard!');
    }
    
    function downloadIPs() {
        const unique = [...new Set(extractedIPs.map(item => item.ip))];
        const blob = new Blob([unique.join('\n')], { type: 'text/plain' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'ip-addresses.txt';
        a.click();
    }
    
    function clearAll() {
        document.getElementById('ipInput').value = '';
        extractedIPs = [];
        document.getElementById('resultsSection').classList.add('hidden');
    }
</script>
@endpush
