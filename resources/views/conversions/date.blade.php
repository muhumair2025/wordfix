@extends('layouts.tool')

@section('title', 'Date Conversion - WordFix')

@section('tool-title', 'Date Conversion')

@section('tool-description', 'Convert dates between different formats and timezones')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-green-50 border border-green-200 rounded-lg p-3">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Output Format</label>
            <select id="outputFormat" onchange="convertDate()" class="w-full px-3 py-2 text-sm border border-green-300 rounded focus:ring-2 focus:ring-green-500">
                <option value="iso">ISO 8601 (YYYY-MM-DD HH:mm:ss)</option>
                <option value="us">US (MM/DD/YYYY HH:mm:ss)</option>
                <option value="eu">EU (DD/MM/YYYY HH:mm:ss)</option>
                <option value="full">Full Date (Day, Month DD, YYYY)</option>
                <option value="timestamp">Unix Timestamp (Seconds)</option>
                <option value="timestamp_ms">Unix Timestamp (Milliseconds)</option>
            </select>
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Timezone</label>
            <select id="timezone" onchange="convertDate()" class="w-full px-3 py-2 text-sm border border-green-300 rounded focus:ring-2 focus:ring-green-500">
                <option value="UTC">UTC</option>
                <option value="local">Local Time</option>
            </select>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="dateConverter"
    inputPlaceholder="Enter date (e.g., 2023-12-25, now, 1704067200)..."
    outputPlaceholder="Converted date will appear here..."
    downloadFileName="converted-date.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="yearVal">-</div>
        <div class="text-xs text-gray-600">Year</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="monthVal">-</div>
        <div class="text-xs text-gray-600">Month</div>
    </div>
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-purple-600" id="dayVal">-</div>
        <div class="text-xs text-gray-600">Day</div>
    </div>
    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-yellow-600" id="validDate">Yes</div>
        <div class="text-xs text-gray-600">Valid Date</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Date Conversion</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Convert dates and times between various formats. Supports ISO, US, EU formats, and Unix timestamps.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Supported Inputs</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>ISO 8601 (2023-12-25)</li>
            <li>Unix Timestamp (1704067200)</li>
            <li>Natural language (now, today) - limited support</li>
            <li>Common formats (12/25/2023)</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function convertDate() {
        const input = document.getElementById('dateConverter-input');
        const output = document.getElementById('dateConverter-output');
        if (!input || !output) return;
        
        let text = input.value.trim();
        
        if (!text) {
            output.value = '';
            document.getElementById('statsSection').classList.add('hidden');
            return;
        }

        const format = document.getElementById('outputFormat')?.value || 'iso';
        const timezone = document.getElementById('timezone')?.value || 'UTC';
        
        try {
            let date;
            
            // Handle "now"
            if (text.toLowerCase() === 'now') {
                date = new Date();
            } 
            // Handle timestamp (numeric string)
            else if (/^\d+$/.test(text)) {
                // Check if seconds or milliseconds
                if (text.length <= 10) {
                    date = new Date(parseInt(text) * 1000);
                } else {
                    date = new Date(parseInt(text));
                }
            }
            // Handle standard date string
            else {
                date = new Date(text);
            }
            
            if (isNaN(date.getTime())) {
                throw new Error("Invalid Date");
            }
            
            let result = '';
            
            if (format === 'timestamp') {
                result = Math.floor(date.getTime() / 1000).toString();
            } else if (format === 'timestamp_ms') {
                result = date.getTime().toString();
            } else {
                const options = {};
                if (timezone === 'UTC') {
                    options.timeZone = 'UTC';
                }
                
                if (format === 'iso') {
                    result = date.toISOString().replace('T', ' ').split('.')[0];
                } else if (format === 'us') {
                    options.year = 'numeric'; options.month = '2-digit'; options.day = '2-digit';
                    options.hour = '2-digit'; options.minute = '2-digit'; options.second = '2-digit';
                    result = date.toLocaleString('en-US', options);
                } else if (format === 'eu') {
                    options.year = 'numeric'; options.month = '2-digit'; options.day = '2-digit';
                    options.hour = '2-digit'; options.minute = '2-digit'; options.second = '2-digit';
                    result = date.toLocaleString('en-GB', options);
                } else if (format === 'full') {
                    options.weekday = 'long'; options.year = 'numeric'; options.month = 'long'; options.day = 'numeric';
                    options.hour = '2-digit'; options.minute = '2-digit'; options.second = '2-digit';
                    result = date.toLocaleString('en-US', options);
                }
            }
            
            output.value = result;
            
            // Update stats
            document.getElementById('yearVal').textContent = date.getFullYear();
            document.getElementById('monthVal').textContent = date.getMonth() + 1;
            document.getElementById('dayVal').textContent = date.getDate();
            document.getElementById('validDate').textContent = 'Yes';
            document.getElementById('validDate').className = 'text-xl font-bold text-green-600';
            document.getElementById('statsSection').classList.remove('hidden');
            
        } catch (e) {
            output.value = "Error: Invalid Date Format";
            document.getElementById('validDate').textContent = 'No';
            document.getElementById('validDate').className = 'text-xl font-bold text-red-600';
            document.getElementById('statsSection').classList.remove('hidden');
        }
    }
    
    setDateConverterConverter(text => {
        convertDate();
        return document.getElementById('dateConverter-output').value;
    });
</script>
@endpush
