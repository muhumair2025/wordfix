@extends('layouts.tool')

@section('title', 'Outline Text Generator - WordFix')

@section('tool-title', 'Outline Text Generator')

@section('tool-description', 'Convert your text into outline/hollow Unicode characters - stylish bordered text')

@section('tool-content')
<!-- Text Converter Component -->
<x-text-converter 
    toolId="outlineText"
    inputPlaceholder="Type your text here..."
    outputPlaceholder="Outline text will appear here..."
    downloadFileName="outline-text.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6 mt-4">
    This tool converts your text into outline Unicode characters - hollow letters with borders for a stylish look.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Outline Text Example</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before (Normal Text)</p>
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm text-gray-700">
                Hello World
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After (Outlined)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-xl text-gray-900" id="exampleOutput">
                ℍ𝕖𝕝𝕝𝕠 𝕎𝕠𝕣𝕝𝕕
            </div>
        </div>
    </div>
</div>

<!-- Feature Highlights -->
<div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-center mb-2">
            <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <h4 class="font-semibold text-gray-900">Hollow Style</h4>
        </div>
        <p class="text-sm text-gray-700">Outlined bordered letters</p>
    </div>
    
    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
        <div class="flex items-center mb-2">
            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            <h4 class="font-semibold text-gray-900">Instant</h4>
        </div>
        <p class="text-sm text-gray-700">Real-time conversion</p>
    </div>
    
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
        <div class="flex items-center mb-2">
            <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            <h4 class="font-semibold text-gray-900">Private</h4>
        </div>
        <p class="text-sm text-gray-700">Browser processing</p>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Outline Text Generator</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Outline Text Generator</strong> converts text into double-struck (outlined) Unicode characters with a hollow, bordered appearance.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use</h3>
        <ol class="list-decimal list-inside space-y-1 ml-4">
            <li>Type or paste your text</li>
            <li>Text converts to outline style</li>
            <li>Click "Copy Results" or "Download"</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Where to Use Outline Text</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Headers:</strong> Eye-catching titles</li>
            <li><strong>Social Media:</strong> Stand out posts</li>
            <li><strong>Design:</strong> Artistic text effects</li>
            <li><strong>Branding:</strong> Unique logo text</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Benefits</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Unique Style:</strong> Hollow bordered look</li>
            <li><strong>Universal:</strong> Works everywhere</li>
            <li><strong>Eye-Catching:</strong> Stands out visually</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Related Tools</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><a href="/special-effects/bold" class="text-blue-600 hover:underline">Bold Text</a> - Bold Unicode</li>
            <li><a href="/special-effects/circled" class="text-blue-600 hover:underline">Circled Text</a> - Enclosed characters</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">FAQ</h3>
        
        <div class="space-y-3">
            <div>
                <h4 class="font-semibold text-gray-900 text-base">Is this free?</h4>
                <p class="text-sm">Yes, completely free.</p>
            </div>
        </div>
        
        <p class="mt-6 text-sm text-gray-600 italic">
            Last updated: {{ date('F Y') }}.
        </p>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function convertToOutline(text) {
        if (!text) return '';
        
        let result = '';
        
        for (let i = 0; i < text.length; i++) {
            const char = text[i];
            const code = char.charCodeAt(0);
            let convertedChar = char;
            
            // Double-Struck (Outline/Blackboard Bold)
            if (code >= 65 && code <= 90) {
                // A-Z: U+1D538 to U+1D551 (with exceptions)
                const exceptions = {67: 0x2102, 72: 0x210D, 78: 0x2115, 80: 0x2119, 81: 0x211A, 82: 0x211D, 90: 0x2124};
                convertedChar = exceptions[code] ? String.fromCodePoint(exceptions[code]) : String.fromCodePoint(0x1D538 + (code - 65));
            } else if (code >= 97 && code <= 122) {
                // a-z: U+1D552 to U+1D56B
                convertedChar = String.fromCodePoint(0x1D552 + (code - 97));
            } else if (code >= 48 && code <= 57) {
                // 0-9: U+1D7D8 to U+1D7E1
                convertedChar = String.fromCodePoint(0x1D7D8 + (code - 48));
            }
            
            result += convertedChar;
        }
        
        return result;
    }
    
    setOutlineTextConverter(convertToOutline);
</script>
@endpush
