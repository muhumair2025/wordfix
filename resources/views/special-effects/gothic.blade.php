@extends('layouts.tool')

@section('title', 'Gothic Text Generator - WordFix')

@section('tool-title', 'Gothic Text Generator')

@section('tool-description', 'Convert your text into beautiful Gothic and Fraktur Unicode styles')

@section('tool-content')
<!-- Conversion Mode Toggle -->
<div class="mb-6">
    <div class="overflow-x-auto pb-2">
        <div class="flex flex-wrap justify-center gap-2 min-w-max px-2">
            <button 
                type="button" 
                id="btnGothic"
                onclick="setConversionMode('gothic')"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors"
            >
                𝔊𝔬𝔱𝔥𝔦𝔠
            </button>
            <button 
                type="button" 
                id="btnBoldGothic"
                onclick="setConversionMode('bold-gothic')"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors"
            >
                𝕭𝖔𝖑𝖉 𝕲𝖔𝖙𝖍𝖎𝖈
            </button>
        </div>
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="gothicText"
    inputPlaceholder="Type your text here..."
    outputPlaceholder="Gothic text will appear here..."
    downloadFileName="gothic-text.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6 mt-4">
    This tool converts your text into <span id="currentStyleName">Gothic</span> Unicode characters - perfect for vintage and artistic designs.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3"><span id="exampleTitle">Gothic</span> Example</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before (Normal Text)</p>
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm text-gray-700">
                Hello World
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After (<span id="exampleAfterTitle">Gothic</span>)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-xl text-gray-900" id="exampleOutput">
                𝔊𝔬𝔱𝔥𝔦𝔠 𝔗𝔢𝔵𝔱
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
            <h4 class="font-semibold text-gray-900">2 Styles</h4>
        </div>
        <p class="text-sm text-gray-700">Gothic and Bold Gothic</p>
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
        <p class="text-sm text-gray-700">Browser processing only</p>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Gothic Text Generator</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Gothic Text Generator</strong> converts text into Gothic (Fraktur/Blackletter) Unicode styles. Perfect for vintage designs, medieval themes, and artistic posts.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">2 Gothic Styles</h3>
        
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Gothic (Fraktur)</strong> - Classic blackletter style</li>
            <li><strong>Bold Gothic</strong> - Thicker, more prominent version</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use</h3>
        <ol class="list-decimal list-inside space-y-1 ml-4">
            <li>Choose Gothic or Bold Gothic style</li>
            <li>Type or paste your text</li>
            <li>Text converts to Unicode Gothic</li>
            <li>Click "Copy Results" or "Download"</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Where to Use Gothic Text</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Vintage Designs:</strong> Medieval or old-style aesthetics</li>
            <li><strong>Band Names:</strong> Metal, rock, or gothic music</li>
            <li><strong>Gaming:</strong> Fantasy game usernames</li>
            <li><strong>Social Media:</strong> Unique artistic posts</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Real Examples</h3>
        
        <div class="space-y-2">
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm">
                <strong>Band Name:</strong><br>
                Dark Knights
            </div>
            
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm">
                <strong>Gaming Username:</strong><br>
                Shadow Warrior
            </div>
        </div>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Benefits</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Artistic:</strong> Medieval blackletter appearance</li>
            <li><strong>Unique:</strong> Stand out with vintage style</li>
            <li><strong>Universal:</strong> Works on all Unicode platforms</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Related Tools</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><a href="/special-effects/bold" class="text-blue-600 hover:underline">Bold Text</a> - Bold Unicode</li>
            <li><a href="/special-effects/cursive-bold" class="text-blue-600 hover:underline">Cursive Bold</a> - Elegant script</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">FAQ</h3>
        
        <div class="space-y-3">
            <div>
                <h4 class="font-semibold text-gray-900 text-base">Is this free?</h4>
                <p class="text-sm">Yes, completely free.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900 text-base">What is Fraktur?</h4>
                <p class="text-sm">Fraktur is a Gothic blackletter typeface used in medieval Europe.</p>
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
    let conversionMode = 'gothic';
    
    const examples = {
        'gothic': '𝔊𝔬𝔱𝔥𝔦𝔠 𝔗𝔢𝔵𝔱',
        'bold-gothic': '𝕲𝖔𝖙𝖍𝖎𝖈 𝕿𝖊𝖝𝖙'
    };
    
    const styleNames = {
        'gothic': 'Gothic',
        'bold-gothic': 'Bold Gothic'
    };

    window.setConversionMode = function(mode) {
        conversionMode = mode;
        
        const buttons = {
            'gothic': document.getElementById('btnGothic'),
            'bold-gothic': document.getElementById('btnBoldGothic')
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
        document.getElementById('exampleTitle').textContent = styleNames[mode];
        document.getElementById('exampleAfterTitle').textContent = styleNames[mode];
        
        const inputElement = document.getElementById('gothicText-input');
        if (inputElement && inputElement.value) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    function convertToGothic(text) {
        if (!text) return '';
        
        let result = '';
        
        for (let i = 0; i < text.length; i++) {
            const char = text[i];
            const code = char.charCodeAt(0);
            let convertedChar = char;
            
            if (conversionMode === 'gothic') {
                // Fraktur
                if (code >= 65 && code <= 90) {
                    // A-Z: U+1D504 to U+1D51D (with exceptions)
                    const exceptions = {67: 0x212D, 72: 0x210C, 73: 0x2111, 82: 0x211C, 90: 0x2128};
                    convertedChar = exceptions[code] ? String.fromCodePoint(exceptions[code]) : String.fromCodePoint(0x1D504 + (code - 65));
                } else if (code >= 97 && code <= 122) {
                    // a-z: U+1D51E to U+1D537
                    convertedChar = String.fromCodePoint(0x1D51E + (code - 97));
                }
            } else if (conversionMode === 'bold-gothic') {
                // Bold Fraktur
                if (code >= 65 && code <= 90) {
                    // A-Z: U+1D56C to U+1D585
                    convertedChar = String.fromCodePoint(0x1D56C + (code - 65));
                } else if (code >= 97 && code <= 122) {
                    // a-z: U+1D586 to U+1D59F
                    convertedChar = String.fromCodePoint(0x1D586 + (code - 97));
                }
            }
            
            result += convertedChar;
        }
        
        return result;
    }
    
    setGothicTextConverter(convertToGothic);
    
    document.addEventListener('DOMContentLoaded', function() {
        setConversionMode('gothic');
    });
</script>
@endpush
