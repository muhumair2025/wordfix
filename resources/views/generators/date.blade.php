@extends('layouts.tool')

@section('title', 'Random Date Generator - WordFix')

@section('tool-title', 'Random Date Generator')

@section('tool-description', 'Generate random dates within a specific range')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-green-50 border border-green-200 rounded-lg p-3">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Start Date</label>
            <input type="date" id="startDate" class="w-full px-3 py-2 text-sm border border-green-300 rounded focus:ring-2 focus:ring-green-500" onchange="generateDates()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">End Date</label>
            <input type="date" id="endDate" class="w-full px-3 py-2 text-sm border border-green-300 rounded focus:ring-2 focus:ring-green-500" onchange="generateDates()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Count</label>
            <input type="number" id="count" value="10" min="1" max="100" class="w-full px-3 py-2 text-sm border border-green-300 rounded focus:ring-2 focus:ring-green-500" onchange="generateDates()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Format</label>
            <select id="format" class="w-full px-3 py-2 text-sm border border-green-300 rounded focus:ring-2 focus:ring-green-500" onchange="generateDates()">
                <option value="iso">YYYY-MM-DD</option>
                <option value="us">MM/DD/YYYY</option>
                <option value="eu">DD/MM/YYYY</option>
                <option value="full">Full Date</option>
                <option value="timestamp">Timestamp</option>
            </select>
        </div>
    </div>
    <div class="mt-3 flex gap-4">
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="includeTime" class="w-4 h-4 text-green-600 rounded" onchange="generateDates()">
            <span class="ml-2 text-xs font-medium text-gray-700">Include Time</span>
        </label>
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="sortDates" class="w-4 h-4 text-green-600 rounded" onchange="generateDates()">
            <span class="ml-2 text-xs font-medium text-gray-700">Sort Ascending</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="randomDate"
    inputPlaceholder=""
    outputPlaceholder="Generated dates will appear here..."
    downloadFileName="random-dates.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-green-600" id="generatedCount">0</div>
        <div class="text-xs text-gray-600">Dates Generated</div>
    </div>
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="rangeDays">0</div>
        <div class="text-xs text-gray-600">Range (Days)</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Random Date Generator</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Generate a list of random dates within a specified range. Useful for testing, populating databases, or planning.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Custom start and end date range</li>
            <li>Multiple output formats (ISO, US, EU, etc.)</li>
            <li>Option to include random times</li>
            <li>Sort generated dates chronologically</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function generateDates() {
        const output = document.getElementById('randomDate-output');
        if (!output) return;

        const startInput = document.getElementById('startDate');
        const endInput = document.getElementById('endDate');
        
        // Set defaults if empty
        if (!startInput.value) {
            const d = new Date();
            d.setFullYear(d.getFullYear() - 1);
            startInput.value = d.toISOString().split('T')[0];
        }
        if (!endInput.value) {
            endInput.value = new Date().toISOString().split('T')[0];
        }

        const start = new Date(startInput.value).getTime();
        const end = new Date(endInput.value).getTime();
        const count = parseInt(document.getElementById('count').value) || 10;
        const format = document.getElementById('format').value;
        const includeTime = document.getElementById('includeTime').checked;
        const sortDates = document.getElementById('sortDates').checked;

        let dates = [];
        
        for (let i = 0; i < count; i++) {
            // Random timestamp between start and end
            let randomTime = start + Math.random() * (end - start);
            
            // Add random time of day if requested, otherwise noon
            if (includeTime) {
                // Already random within range, but let's ensure full day spread if start=end
                // Actually start/end inputs are just dates (00:00:00 UTC usually)
                // Let's add random ms for time of day (0 to 86400000)
                // But wait, start/end are timestamps.
                // If start=2023-01-01 and end=2023-01-02, diff is 24h.
                // So random() * diff covers time.
                // If includeTime is false, we might want to strip time?
            }
            
            dates.push(new Date(randomTime));
        }

        if (sortDates) {
            dates.sort((a, b) => a - b);
        }

        const formattedDates = dates.map(date => {
            if (format === 'timestamp') {
                return Math.floor(date.getTime() / 1000);
            }
            
            const options = {};
            if (includeTime) {
                options.hour = '2-digit'; options.minute = '2-digit'; options.second = '2-digit';
            }
            
            if (format === 'iso') {
                let iso = date.toISOString();
                return includeTime ? iso.replace('T', ' ').split('.')[0] : iso.split('T')[0];
            } else if (format === 'us') {
                options.year = 'numeric'; options.month = '2-digit'; options.day = '2-digit';
                return date.toLocaleString('en-US', options);
            } else if (format === 'eu') {
                options.year = 'numeric'; options.month = '2-digit'; options.day = '2-digit';
                return date.toLocaleString('en-GB', options);
            } else if (format === 'full') {
                options.weekday = 'short'; options.year = 'numeric'; options.month = 'long'; options.day = 'numeric';
                return date.toLocaleString('en-US', options);
            }
            return date.toString();
        });

        output.value = formattedDates.join('\n');
        
        // Update stats
        const diffDays = Math.ceil((end - start) / (1000 * 60 * 60 * 24));
        document.getElementById('generatedCount').textContent = count;
        document.getElementById('rangeDays').textContent = diffDays;
        document.getElementById('statsSection').classList.remove('hidden');
        
        // Trigger input update for stats
        const input = document.getElementById('randomDate-input');
        if (input) {
            input.value = output.value;
            input.dispatchEvent(new Event('input'));
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', generateDates);
    
    // Override converter
    setRandomDateConverter(text => text);
</script>

<style>
    /* Hide input area for generator */
    #randomDate-input {
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
