@extends('layouts.tool')

@section('title', 'Cursive Bold Text Generator - WordFix')

@section('tool-title', 'Cursive Bold Text Generator')

@section('tool-description', 'Convert your text into beautiful cursive and script Unicode styles')

@section('tool-content')
<!-- Conversion Mode Toggle -->
<div class="mb-6">
    <div class="overflow-x-auto pb-2">
        <div class="flex flex-wrap justify-center gap-2 min-w-max px-2">
            <button 
                type="button" 
                id="btnCursiveBold"
                onclick="setConversionMode('cursive-bold')"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors"
            >
                𝓒𝓾𝓻𝓼𝓲𝓿𝓮 𝓑𝓸𝓵𝓭
            </button>
            <button 
                type="button" 
                id="btnScriptBold"
                onclick="setConversionMode('script-bold')"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors"
            >
                𝓢𝓬𝓻𝓲𝓹𝓽 𝓑𝓸𝓵𝓭
            </button>
            <button 
                type="button" 
                id="btnCursive"
                onclick="setConversionMode('cursive')"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors"
            >
                𝒞𝓊𝓇𝓈𝒾𝓋ℯ
            </button>
        </div>
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="cursiveText"
    inputPlaceholder="Type your text here..."
    outputPlaceholder="Cursive text will appear here..."
    downloadFileName="cursive-text.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6 mt-4">
    This tool converts your normal text into <span id="currentStyleName">cursive bold</span> Unicode characters - perfect for elegant signatures and stylish posts.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3"><span id="exampleTitle">Cursive Bold</span> Example</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before (Normal Text)</p>
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm text-gray-700">
                Hello World
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After (<span id="exampleAfterTitle">Cursive Bold</span>)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-xl text-gray-900" id="exampleOutput" style="font-family: Arial, sans-serif;">
                𝓗𝓮𝓵𝓵𝓸 𝓦𝓸𝓻𝓵𝓭
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
            <h4 class="font-semibold text-gray-900">Elegant Styles</h4>
        </div>
        <p class="text-sm text-gray-700">Beautiful cursive and script fonts</p>
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
        <p class="text-sm text-gray-700">Browser-only processing</p>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Cursive Bold Generator</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Cursive Bold Text Generator</strong> converts standard text into elegant cursive and script Unicode characters. Perfect for creating stylish social media posts, elegant signatures, and eye-catching headers.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">3 Available Cursive Styles</h3>
        
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Cursive Bold</strong> - Bold handwriting style, thick and elegant</li>
            <li><strong>Script Bold</strong> - Alternative bold script variation</li>
            <li><strong>Cursive</strong> - Light elegant cursive style</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use</h3>
        <ol class="list-decimal list-inside space-y-1 ml-4">
            <li>Choose your preferred cursive style</li>
            <li>Type or paste your text</li>
            <li>Text converts instantly to Unicode cursive</li>
            <li>Click "Copy Results" or "Download"</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Where to Use Cursive Text</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Social Media:</strong> Instagram bios, Twitter names, Facebook posts</li>
            <li><strong>Signatures:</strong> Digital signatures and sign-offs</li>
            <li><strong>Invitations:</strong> Event invites and announcements</li>
            <li><strong>Quotes:</strong> Beautiful quote graphics</li>
            <li><strong>Headers:</strong> Elegant section titles</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Real Examples</h3>
        
        <div class="space-y-2">
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm">
                <strong>Instagram Bio:</strong><br>
                Fashion Designer | NYC<br>
                Creating beauty, one design at a time
            </div>
            
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm">
                <strong>Email Signature:</strong><br>
                Best Regards,<br>
                Sarah Anderson
            </div>
            
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm">
                <strong>Quote Post:</strong><br>
                Dream Big, Work Hard, Stay Focused
            </div>
        </div>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Benefits</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Elegant:</strong> Sophisticated handwriting appearance</li>
            <li><strong>Universal:</strong> Works everywhere Unicode is supported</li>
            <li><strong>Unique:</strong> Stand out with stylish text</li>
            <li><strong>Professional:</strong> Great for signatures and formal content</li>
        </ul>
        
        <div class="bg-yellow-50 border-l-4 border-yellow-600 p-4 mt-6">
            <p class="text-yellow-900 text-sm">
                <strong>Note:</strong> Cursive text is decorative and may be harder to read for some users. Use for emphasis, not body text.
            </p>
        </div>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Related Tools</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><a href="/special-effects/bold" class="text-blue-600 hover:underline">Bold Text</a> - Bold Unicode styles</li>
            <li><a href="/special-effects/italic" class="text-blue-600 hover:underline">Italic</a> - Italic text</li>
            <li><a href="/basic/title-case" class="text-blue-600 hover:underline">Title Case</a> - Capitalize words</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">FAQ</h3>
        
        <div class="space-y-3">
            <div>
                <h4 class="font-semibold text-gray-900 text-base">Is this free?</h4>
                <p class="text-sm">Yes, completely free with unlimited usage.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900 text-base">Do all characters convert?</h4>
                <p class="text-sm">Most letters convert to cursive. Some special characters may remain unchanged.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900 text-base">Is it readable?</h4>
                <p class="text-sm">Cursive is decorative and best for short text like names and quotes. Avoid long paragraphs.</p>
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
    let conversionMode = 'cursive-bold';
    
    // Example outputs for each style
    const examples = {
        'cursive-bold': '𝓗𝓮𝓵𝓵𝓸 𝓦𝓸𝓻𝓵𝓭',
        'script-bold': '𝓗𝓮𝓵𝓵𝓸 𝓦𝓸𝓻𝓵𝓭',
        'cursive': '𝒽𝑒𝓁𝓁𝑜 𝓌𝑜𝓇𝓁𝒹'
    };
    
    const styleNames = {
        'cursive-bold': 'cursive bold',
        'script-bold': 'script bold',
        'cursive': 'cursive'
    };
    
    const exampleTitles = {
        'cursive-bold': 'Cursive Bold',
        'script-bold': 'Script Bold',
        'cursive': 'Cursive'
    };

    // Set conversion mode and update UI
    window.setConversionMode = function(mode) {
        conversionMode = mode;
        
        // Update button styles
        const buttons = {
            'cursive-bold': document.getElementById('btnCursiveBold'),
            'script-bold': document.getElementById('btnScriptBold'),
            'cursive': document.getElementById('btnCursive')
        };
        
        const activeClass = 'px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors';
        const inactiveClass = 'px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors';
        
        // Update all buttons
        Object.keys(buttons).forEach(key => {
            if (buttons[key]) {
                buttons[key].className = mode === key ? activeClass : inactiveClass;
            }
        });
        
        // Update example output
        document.getElementById('exampleOutput').textContent = examples[mode] || examples['cursive-bold'];
        document.getElementById('currentStyleName').textContent = styleNames[mode] || styleNames['cursive-bold'];
        document.getElementById('exampleTitle').textContent = exampleTitles[mode] || exampleTitles['cursive-bold'];
        document.getElementById('exampleAfterTitle').textContent = exampleTitles[mode] || exampleTitles['cursive-bold'];
        
        // Trigger re-conversion if there's input
        const inputElement = document.getElementById('cursiveText-input');
        if (inputElement && inputElement.value) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Convert text to cursive
    function convertToCursive(text) {
        if (!text) return '';
        
        let result = '';
        
        for (let i = 0; i < text.length; i++) {
            const char = text[i];
            const code = char.charCodeAt(0);
            let convertedChar = char;
            
            if (conversionMode === 'cursive-bold') {
                // Mathematical Bold Script
                if (code >= 65 && code <= 90) {
                    // A-Z: U+1D4D0 to U+1D4E9
                    convertedChar = String.fromCodePoint(0x1D4D0 + (code - 65));
                } else if (code >= 97 && code <= 122) {
                    // a-z: U+1D4EA to U+1D503
                    convertedChar = String.fromCodePoint(0x1D4EA + (code - 97));
                }
            } else if (conversionMode === 'script-bold') {
                // Same as cursive-bold (alternative name)
                if (code >= 65 && code <= 90) {
                    convertedChar = String.fromCodePoint(0x1D4D0 + (code - 65));
                } else if (code >= 97 && code <= 122) {
                    convertedChar = String.fromCodePoint(0x1D4EA + (code - 97));
                }
            } else if (conversionMode === 'cursive') {
                // Mathematical Script (not bold)
                if (code >= 65 && code <= 90) {
                    // A-Z: U+1D49C to U+1D4B5 (with exceptions)
                    const exceptions = {66: 0x212C, 69: 0x2130, 70: 0x2131, 72: 0x210B, 73: 0x2110, 76: 0x2112, 77: 0x2133, 82: 0x211B};
                    convertedChar = exceptions[code] ? String.fromCodePoint(exceptions[code]) : String.fromCodePoint(0x1D49C + (code - 65));
                } else if (code >= 97 && code <= 122) {
                    // a-z: U+1D4B6 to U+1D4CF (with exceptions)
                    const exceptions = {101: 0x212F, 103: 0x210A, 111: 0x2134};
                    convertedChar = exceptions[code] ? String.fromCodePoint(exceptions[code]) : String.fromCodePoint(0x1D4B6 + (code - 97));
                }
            }
            
            result += convertedChar;
        }
        
        return result;
    }
    
    // Set the conversion function for the component
    setCursiveTextConverter(convertToCursive);
    
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        setConversionMode('cursive-bold');
    });
</script>
@endpush
