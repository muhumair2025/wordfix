@extends('layouts.tool')

@section('title', 'Random Email Generator - WordFix')

@section('tool-title', 'Random Email Generator')

@section('tool-description', 'Generate random email addresses for testing')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-blue-50 border border-blue-200 rounded-lg p-3">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Count</label>
            <input type="number" id="count" value="10" min="1" max="1000" class="w-full px-3 py-2 text-sm border border-blue-300 rounded focus:ring-2 focus:ring-blue-500" onchange="generateEmails()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Custom Domain (Optional)</label>
            <input type="text" id="customDomain" placeholder="e.g. example.com" class="w-full px-3 py-2 text-sm border border-blue-300 rounded focus:ring-2 focus:ring-blue-500" oninput="generateEmails()">
        </div>
        <div class="flex items-end pb-2">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="includeNumbers" class="w-4 h-4 text-blue-600 rounded" checked onchange="generateEmails()">
                <span class="ml-2 text-xs font-medium text-gray-700">Include Numbers in Username</span>
            </label>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="emailGenerator"
    inputPlaceholder=""
    outputPlaceholder="Generated emails will appear here..."
    downloadFileName="random-emails.txt"
    :showStats="true"
/>

<!-- Stats -->
<div id="statsSection" class="hidden mt-4 grid grid-cols-2 md:grid-cols-4 gap-3">
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
        <div class="text-xl font-bold text-blue-600" id="generatedCount">0</div>
        <div class="text-xs text-gray-600">Emails Generated</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Random Email Generator</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Generate random email addresses for testing purposes, database population, or privacy protection.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Generate bulk email addresses</li>
            <li>Specify custom domains</li>
            <li>Option to include numbers in usernames</li>
            <li>Realistic username generation</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    const NAMES = [
        "james", "mary", "john", "patricia", "robert", "jennifer", "michael", "linda", "william", "elizabeth",
        "david", "barbara", "richard", "susan", "joseph", "jessica", "thomas", "sarah", "charles", "karen",
        "christopher", "nancy", "daniel", "lisa", "matthew", "betty", "anthony", "margaret", "mark", "sandra",
        "donald", "ashley", "steven", "kimberly", "paul", "emily", "andrew", "donna", "joshua", "michelle",
        "kenneth", "dorothy", "kevin", "carol", "brian", "amanda", "george", "melissa", "edward", "deborah"
    ];
    
    const DOMAINS = [
        "gmail.com", "yahoo.com", "hotmail.com", "outlook.com", "icloud.com", "aol.com", "protonmail.com", "mail.com", "zoho.com", "yandex.com"
    ];

    function generateEmails() {
        const output = document.getElementById('emailGenerator-output');
        if (!output) return;

        const count = parseInt(document.getElementById('count').value) || 10;
        const customDomain = document.getElementById('customDomain').value.trim();
        const includeNumbers = document.getElementById('includeNumbers').checked;

        let emails = [];
        
        for (let i = 0; i < count; i++) {
            const firstName = NAMES[Math.floor(Math.random() * NAMES.length)];
            const lastName = NAMES[Math.floor(Math.random() * NAMES.length)];
            let username = '';
            
            // Random username format
            const format = Math.floor(Math.random() * 3);
            if (format === 0) username = `${firstName}.${lastName}`;
            else if (format === 1) username = `${firstName}${lastName}`;
            else username = `${firstName.charAt(0)}${lastName}`;
            
            if (includeNumbers) {
                username += Math.floor(Math.random() * 1000);
            }
            
            const domain = customDomain || DOMAINS[Math.floor(Math.random() * DOMAINS.length)];
            
            emails.push(`${username}@${domain}`);
        }

        output.value = emails.join('\n');
        
        // Update stats
        document.getElementById('generatedCount').textContent = count;
        document.getElementById('statsSection').classList.remove('hidden');
        
        // Trigger input update for stats
        const input = document.getElementById('emailGenerator-input');
        if (input) {
            input.value = output.value;
            input.dispatchEvent(new Event('input'));
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', generateEmails);
    
    // Override converter
    setEmailGeneratorConverter(text => text);
</script>

<style>
    /* Hide input area for generator */
    #emailGenerator-input {
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
