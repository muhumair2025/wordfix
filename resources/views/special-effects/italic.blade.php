@extends('layouts.tool')

@section('title', 'Italic Text Generator - WordFix')

@section('tool-title', 'Italic Text Generator')

@section('tool-description', 'Convert your text into italic Unicode characters - slanted text that works everywhere')

@section('tool-content')
<!-- Conversion Mode Toggle -->
<div class="mb-6">
    <div class="overflow-x-auto pb-2">
        <div class="flex flex-wrap justify-center gap-2 min-w-max px-2">
            <button 
                type="button" 
                id="btnItalic"
                onclick="setConversionMode('italic')"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors"
            >
                𝐼𝑡𝑎𝑙𝑖𝑐
            </button>
            <button 
                type="button" 
                id="btnBoldItalic"
                onclick="setConversionMode('bold-italic')"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors"
            >
                𝑩𝒐𝒍𝒅 𝑰𝒕𝒂𝒍𝒊𝒄
            </button>
            <button 
                type="button" 
                id="btnSansItalic"
                onclick="setConversionMode('sans-italic')"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors"
            >
                𝘐𝘵𝘢𝘭𝘪𝘤 𝘚𝘢𝘯𝘴
            </button>
        </div>
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="italicText"
    inputPlaceholder="Type your text here..."
    outputPlaceholder="Italic text will appear here..."
    downloadFileName="italic-text.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6 mt-4">
    This tool converts your text into <span id="currentStyleName">italic</span> Unicode characters - perfect for emphasis and stylish text.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3"><span id="exampleTitle">Italic</span> Example</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before (Normal Text)</p>
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm text-gray-700">
                Hello World
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After (<span id="exampleAfterTitle">Italic</span>)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-xl text-gray-900" id="exampleOutput">
                𝐻𝑒𝑙𝑙𝑜 𝑊𝑜𝑟𝑙𝑑
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
            <h4 class="font-semibold text-gray-900">3 Styles</h4>
        </div>
        <p class="text-sm text-gray-700">Italic, Bold Italic, Sans Italic</p>
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
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Italic Text Generator</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Italic Text Generator</strong> converts text into slanted italic Unicode characters that work universally across platforms.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">3 Italic Styles</h3>
        
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Italic</strong> - Classic slanted serif style</li>
            <li><strong>Bold Italic</strong> - Thick slanted letters</li>
            <li><strong>Sans Italic</strong> - Modern sans-serif slant</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use</h3>
        <ol class="list-decimal list-inside space-y-1 ml-4">
            <li>Choose your italic style</li>
            <li>Type or paste text</li>
            <li>Text converts to Unicode italic</li>
            <li>Copy or download results</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Where to Use Italic Text</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Emphasis:</strong> Highlight important words</li>
            <li><strong>Quotes:</strong> Cite sources or quotes</li>
            <li><strong>Social Media:</strong> Instagram, Twitter, Facebook</li>
            <li><strong>Titles:</strong> Book or article names</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Benefits</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Universal:</strong> Works everywhere</li>
            <li><strong>Professional:</strong> Proper text emphasis</li>
            <li><strong>Stylish:</strong> Slanted aesthetic</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Related Tools</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><a href="/special-effects/bold" class="text-blue-600 hover:underline">Bold Text</a> - Bold Unicode</li>
            <li><a href="/basic/underline" class="text-blue-600 hover:underline">Underline</a> - Underlined text</li>
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
    let conversionMode = 'italic';
    
    const examples = {
        'italic': '𝐻𝑒𝑙𝑙𝑜 𝑊𝑜𝑟𝑙𝑑',
        'bold-italic': '𝑯𝒆𝒍𝒍𝒐 𝑾𝒐𝒓𝒍𝒅',
        'sans-italic': '𝘏𝘦𝘭𝘭𝘰 𝘞𝘰𝘳𝘭𝘥'
    };
    
    const styleNames = {
        'italic': 'italic',
        'bold-italic': 'bold italic',
        'sans-italic': 'sans italic'
    };
    
    const styleTitles = {
        'italic': 'Italic',
        'bold-italic': 'Bold Italic',
        'sans-italic': 'Sans Italic'
    };

    window.setConversionMode = function(mode) {
        conversionMode = mode;
        
        const buttons = {
            'italic': document.getElementById('btnItalic'),
            'bold-italic': document.getElementById('btnBoldItalic'),
            'sans-italic': document.getElementById('btnSansItalic')
        };
        
        const activeClass = 'px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors';
        const inactiveClass = 'px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors';
        
        Object.keys(buttons).forEach(key => {
            if (buttons[key]) {
                buttons[key].className = mode === key ? activeClass : inactiveClass;
            }
        });
        
        document.getElementById('exampleOutput').textContent = examples[mode];
        document.getElementById('currentStyleName').textContent = styleNames[mode];
        document.getElementById('exampleTitle').textContent = styleTitles[mode];
        document.getElementById('exampleAfterTitle').textContent = styleTitles[mode];
        
        const inputElement = document.getElementById('italicText-input');
        if (inputElement && inputElement.value) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    function convertToItalic(text) {
        if (!text) return '';
        
        let result = '';
        
        for (let i = 0; i < text.length; i++) {
            const char = text[i];
            const code = char.charCodeAt(0);
            let convertedChar = char;
            
            if (conversionMode === 'italic') {
                // Mathematical Italic
                if (code >= 65 && code <= 90) {
                    // A-Z: U+1D434 to U+1D44D (with exception for h)
                    const offset = code === 72 ? 0x210E - 72 : 0x1D434 - 65;
                    convertedChar = String.fromCodePoint(code === 72 ? 0x210E : 0x1D434 + (code - 65));
                } else if (code >= 97 && code <= 122) {
                    // a-z: U+1D44E to U+1D467
                    convertedChar = String.fromCodePoint(0x1D44E + (code - 97));
                }
            } else if (conversionMode === 'bold-italic') {
                // Bold Italic
                if (code >= 65 && code <= 90) {
                    // A-Z: U+1D468 to U+1D481
                    convertedChar = String.fromCodePoint(0x1D468 + (code - 65));
                } else if (code >= 97 && code <= 122) {
                    // a-z: U+1D482 to U+1D49B
                    convertedChar = String.fromCodePoint(0x1D482 + (code - 97));
                }
            } else if (conversionMode === 'sans-italic') {
                // Sans-Serif Italic
                if (code >= 65 && code <= 90) {
                    // A-Z: U+1D608 to U+1D621
                    convertedChar = String.fromCodePoint(0x1D608 + (code - 65));
                } else if (code >= 97 && code <= 122) {
                    // a-z: U+1D622 to U+1D63B
                    convertedChar = String.fromCodePoint(0x1D622 + (code - 97));
                }
            }
            
            result += convertedChar;
        }
        
        return result;
    }
    
    setItalicTextConverter(convertToItalic);
    
    document.addEventListener('DOMContentLoaded', function() {
        setConversionMode('italic');
    });
</script>
@endpush
