@extends('layouts.tool')

@section('title', 'SEO Friendly URL Generator - WordFix')

@section('tool-title', 'SEO Friendly URL Generator')

@section('tool-description', 'Convert titles into SEO-optimized URLs')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-green-50 border border-green-200 rounded-lg p-3">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
        <div class="col-span-1 md:col-span-2">
            <label class="block text-xs font-medium text-gray-700 mb-1">Domain Prefix (Optional)</label>
            <input type="text" id="domain" placeholder="https://example.com/blog/" class="w-full px-3 py-2 text-sm border border-green-300 rounded focus:ring-2 focus:ring-green-500" oninput="generateUrl()">
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Separator</label>
            <select id="separator" class="w-full px-3 py-2 text-sm border border-green-300 rounded focus:ring-2 focus:ring-green-500" onchange="generateUrl()">
                <option value="-">Dash (-)</option>
                <option value="_">Underscore (_)</option>
                <option value="+">Plus (+)</option>
            </select>
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Max Length</label>
            <input type="number" id="maxLength" value="60" min="10" max="200" class="w-full px-3 py-2 text-sm border border-green-300 rounded focus:ring-2 focus:ring-green-500" onchange="generateUrl()">
        </div>
    </div>
    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mt-3">
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="removeStopWords" class="w-4 h-4 text-green-600 rounded" checked onchange="generateUrl()">
            <span class="ml-2 text-xs font-medium text-gray-700">Remove Stop Words</span>
        </label>
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="transliterate" class="w-4 h-4 text-green-600 rounded" checked onchange="generateUrl()">
            <span class="ml-2 text-xs font-medium text-gray-700">Transliterate (ASCII)</span>
        </label>
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="lowercase" class="w-4 h-4 text-green-600 rounded" checked onchange="generateUrl()">
            <span class="ml-2 text-xs font-medium text-gray-700">Force Lowercase</span>
        </label>
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="addDate" class="w-4 h-4 text-green-600 rounded" onchange="generateUrl()">
            <span class="ml-2 text-xs font-medium text-gray-700">Add Date Prefix</span>
        </label>
    </div>
</div>

<x-text-converter 
    toolId="seoUrl"
    inputPlaceholder="Enter your article title or page name here..."
    outputPlaceholder="Generated URL will appear here..."
    downloadFileName="seo-urls.txt"
    :showStats="true"
/>

<!-- Live Preview -->
<div class="mt-4 bg-white p-4 rounded-lg shadow-sm border border-gray-200">
    <h3 class="text-sm font-medium text-gray-700 mb-2">Google Search Preview</h3>
    <div class="font-sans max-w-2xl">
        <div class="flex items-center gap-2 mb-1">
            <div class="w-7 h-7 bg-gray-100 rounded-full flex items-center justify-center text-xs text-gray-500">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/></svg>
            </div>
            <div class="flex flex-col">
                <span class="text-xs text-gray-800 font-medium">Example Site</span>
                <span class="text-xs text-gray-500 truncate" id="previewUrl">https://example.com/blog/page-title</span>
            </div>
        </div>
        <div class="text-xl text-blue-800 hover:underline cursor-pointer mb-1 truncate" id="previewTitle">Page Title</div>
        <div class="text-sm text-gray-600 line-clamp-2">
            This is how your page might appear in search engine results. The URL structure is clean, readable, and optimized for search engines to improve your click-through rate.
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About SEO Friendly URL Generator</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Convert article titles and page names into clean, SEO-friendly URLs (slugs). Optimized URLs improve search engine rankings and user experience.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Smart Slug Generation:</strong> Automatically removes special characters and optimizes structure.</li>
            <li><strong>Stop Word Removal:</strong> Filters out common words (a, an, the, etc.) to keep URLs concise.</li>
            <li><strong>Transliteration:</strong> Converts non-ASCII characters (e.g., "café") to safe ASCII equivalents ("cafe").</li>
            <li><strong>Custom Formatting:</strong> Choose separators, casing, and date prefixes.</li>
            <li><strong>SERP Preview:</strong> See exactly how your URL will look in Google search results.</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    const STOP_WORDS = [
        'a', 'an', 'the', 'and', 'but', 'or', 'for', 'nor', 'on', 'at', 'to', 'from', 'by', 'with', 'in', 'out', 'of', 'off', 'up', 'down', 'is', 'are', 'was', 'were', 'be', 'been', 'being'
    ];

    // Simple transliteration map
    const CHAR_MAP = {
        'à':'a','á':'a','â':'a','ã':'a','ä':'a','å':'a','æ':'ae','ç':'c','è':'e','é':'e','ê':'e','ë':'e',
        'ì':'i','í':'i','î':'i','ï':'i','ð':'d','ñ':'n','ò':'o','ó':'o','ô':'o','õ':'o','ö':'o','ø':'o',
        'ù':'u','ú':'u','û':'u','ü':'u','ý':'y','þ':'th','ÿ':'y','ß':'ss'
    };

    function transliterateText(text) {
        return text.split('').map(char => CHAR_MAP[char] || char).join('');
    }

    function generateUrl() {
        const input = document.getElementById('seoUrl-input');
        const output = document.getElementById('seoUrl-output');
        if (!input || !output) return;

        const text = input.value;
        const domain = document.getElementById('domain').value.trim();
        const maxLength = parseInt(document.getElementById('maxLength').value) || 60;
        const separator = document.getElementById('separator').value;
        const removeStopWords = document.getElementById('removeStopWords').checked;
        const doTransliterate = document.getElementById('transliterate').checked;
        const forceLowercase = document.getElementById('lowercase').checked;
        const addDate = document.getElementById('addDate').checked;

        // Get current date prefix if needed
        let datePrefix = '';
        if (addDate) {
            const d = new Date();
            const year = d.getFullYear();
            const month = String(d.getMonth() + 1).padStart(2, '0');
            const day = String(d.getDate()).padStart(2, '0');
            datePrefix = `${year}/${month}/${day}/`;
        }

        // Process line by line
        const lines = text.split('\n');
        const urls = lines.map(line => {
            if (!line.trim()) return '';
            
            let slug = line.trim();
            
            if (forceLowercase) slug = slug.toLowerCase();
            if (doTransliterate) slug = transliterateText(slug);
            
            // Remove special chars (keep alphanumeric and spaces)
            slug = slug.replace(/[^a-z0-9\s-]/gi, '');
            
            // Remove stop words
            if (removeStopWords) {
                slug = slug.split(/\s+/).filter(word => !STOP_WORDS.includes(word.toLowerCase())).join(' ');
            }
            
            // Convert spaces to separator
            slug = slug.trim().replace(/\s+/g, separator);
            
            // Truncate
            if (slug.length > maxLength) {
                slug = slug.substring(0, maxLength);
                // Don't cut in middle of word if possible
                const lastSep = slug.lastIndexOf(separator);
                if (lastSep > maxLength * 0.8) {
                    slug = slug.substring(0, lastSep);
                }
            }
            
            // Add domain and date
            let finalUrl = slug;
            if (addDate) finalUrl = datePrefix + finalUrl;
            
            if (domain) {
                // Ensure domain ends with slash if not empty
                let prefix = domain;
                if (!prefix.endsWith('/')) prefix += '/';
                // If domain already has http/https, good. If not, maybe add? No, let user decide.
                finalUrl = prefix + finalUrl;
            }
            
            return finalUrl;
        });

        output.value = urls.join('\n');
        
        // Update Preview (use first line)
        const firstLine = lines.find(l => l.trim()) || 'Page Title';
        const firstUrl = urls.find(u => u) || 'https://example.com/blog/page-title';
        
        document.getElementById('previewTitle').textContent = firstLine.length > 60 ? firstLine.substring(0, 57) + '...' : firstLine;
        document.getElementById('previewUrl').textContent = firstUrl;
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
        const input = document.getElementById('seoUrl-input');
        if (input) {
            input.addEventListener('input', generateUrl);
        }
    });
    
    // Override converter
    setSeoUrlConverter(text => text);
</script>
@endpush
