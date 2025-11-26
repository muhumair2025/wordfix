@extends('layouts.tool')

@section('title', 'URL Slug Generator - WordFix')

@section('tool-title', 'URL Slug Generator')

@section('tool-description', 'Convert text into URL-friendly slugs')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-purple-50 border border-purple-200 rounded-lg p-3">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Separator</label>
            <select id="separator" class="w-full px-3 py-2 text-sm border border-purple-300 rounded focus:ring-2 focus:ring-purple-500" onchange="generateSlug()">
                <option value="-">Dash (-)</option>
                <option value="_">Underscore (_)</option>
                <option value=".">Dot (.)</option>
                <option value="">None</option>
            </select>
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-700 mb-1">Casing</label>
            <select id="casing" class="w-full px-3 py-2 text-sm border border-purple-300 rounded focus:ring-2 focus:ring-purple-500" onchange="generateSlug()">
                <option value="lower">Lowercase</option>
                <option value="upper">Uppercase</option>
                <option value="title">Title Case</option>
                <option value="original">Maintain Original</option>
            </select>
        </div>
        <div class="flex items-end pb-2">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="strict" class="w-4 h-4 text-purple-600 rounded" checked onchange="generateSlug()">
                <span class="ml-2 text-xs font-medium text-gray-700">Strict (Remove Special Chars)</span>
            </label>
        </div>
    </div>
</div>

<x-text-converter 
    toolId="slugGenerator"
    inputPlaceholder="Type text to convert to slug..."
    outputPlaceholder="Generated slug will appear here..."
    downloadFileName="url-slugs.txt"
    :showStats="true"
/>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About URL Slug Generator</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Convert any text into a URL-friendly slug. Perfect for creating readable URLs for blog posts, products, or pages.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Custom separators (dash, underscore, etc.)</li>
            <li>Case conversion options</li>
            <li>Strict mode to remove special characters</li>
            <li>Handles multiple lines</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function generateSlug() {
        const input = document.getElementById('slugGenerator-input');
        const output = document.getElementById('slugGenerator-output');
        if (!input || !output) return;

        const text = input.value;
        const separator = document.getElementById('separator').value;
        const casing = document.getElementById('casing').value;
        const strict = document.getElementById('strict').checked;

        const lines = text.split('\n');
        const slugs = lines.map(line => {
            if (!line.trim()) return '';
            
            let slug = line.trim();
            
            // Handle casing
            if (casing === 'lower') slug = slug.toLowerCase();
            else if (casing === 'upper') slug = slug.toUpperCase();
            else if (casing === 'title') {
                slug = slug.toLowerCase().split(' ').map(word => word.charAt(0).toUpperCase() + word.slice(1)).join(' ');
            }
            
            // Replace spaces with separator
            // First, normalize spaces
            slug = slug.replace(/\s+/g, separator);
            
            if (strict) {
                // Remove special chars (keep alphanumeric and separator)
                const regex = new RegExp(`[^a-zA-Z0-9${separator === '.' ? '\\.' : separator}]`, 'g');
                slug = slug.replace(regex, '');
            }
            
            // Remove duplicate separators
            if (separator) {
                const dupRegex = new RegExp(`\\${separator}+`, 'g');
                slug = slug.replace(dupRegex, separator);
                // Trim separator from ends
                const startRegex = new RegExp(`^\\${separator}`);
                const endRegex = new RegExp(`\\${separator}$`);
                slug = slug.replace(startRegex, '').replace(endRegex, '');
            }
            
            return slug;
        });

        output.value = slugs.join('\n');
        
        // Stats are handled by x-text-converter automatically for input
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', () => {
        const input = document.getElementById('slugGenerator-input');
        if (input) {
            input.addEventListener('input', generateSlug);
        }
    });
    
    // Override converter
    setSlugGeneratorConverter(text => text);
</script>
@endpush
