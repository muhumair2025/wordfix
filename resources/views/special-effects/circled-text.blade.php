@extends('layouts.tool')

@section('title', 'Circle Text Generator - WordFix')

@section('tool-title', 'Circle Text Generator')

@section('tool-description', 'Convert your text into circled and enclosed Unicode characters - perfect for social media and decoration')

@section('tool-content')
<!-- Conversion Mode Toggle -->
<div class="mb-6">
    <div class="overflow-x-auto pb-2">
        <div class="flex flex-wrap justify-center gap-2 min-w-max px-2">
            <button 
                type="button" 
                id="btnCircled"
                onclick="setConversionMode('circled')"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors"
            >
                Ⓒⓘⓡⓒⓛⓔⓓ
            </button>
            <button 
                type="button" 
                id="btnNegativeCircled"
                onclick="setConversionMode('negative-circled')"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors"
            >
                🅝🅔🅖🅐🅣🅘🅥🅔
            </button>
            <button 
                type="button" 
                id="btnSquared"
                onclick="setConversionMode('squared')"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors"
            >
                🅂🅀🅄🄰🅁🄴
            </button>
            <button 
                type="button" 
                id="btnNegativeSquared"
                onclick="setConversionMode('negative-squared')"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors"
            >
                🅽🅴🅶 🆂🆀
            </button>
            <button 
                type="button" 
                id="btnParenthesized"
                onclick="setConversionMode('parenthesized')"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors"
            >
                ⒫⒜⒭⒠⒩
            </button>
        </div>
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="circleText"
    inputPlaceholder="Type your text here..."
    outputPlaceholder="Circled text will appear here..."
    downloadFileName="circle-text.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6 mt-4">
    This tool converts your normal text into <span id="currentStyleName">circled</span> Unicode characters that you can copy and paste anywhere.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3"><span id="exampleTitle">Circled Text</span> Example</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before (Normal Text)</p>
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm text-gray-700">
                Hello 2025
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After (<span id="exampleAfterTitle">Circled</span>)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-lg text-gray-900" id="exampleOutput" style="font-family: Arial, sans-serif;">
                Ⓗⓔⓛⓛⓞ ②⓪②⑤
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
            <h4 class="font-semibold text-gray-900">5 Styles</h4>
        </div>
        <p class="text-sm text-gray-700">Choose from circled, negative, squared, and more</p>
    </div>
    
    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
        <div class="flex items-center mb-2">
            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            <h4 class="font-semibold text-gray-900">Instant</h4>
        </div>
        <p class="text-sm text-gray-700">Real-time conversion as you type</p>
    </div>
    
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
        <div class="flex items-center mb-2">
            <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            <h4 class="font-semibold text-gray-900">Private</h4>
        </div>
        <p class="text-sm text-gray-700">All processing in your browser</p>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Circle Text Generator</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Circle Text Generator</strong> converts standard text into circled and enclosed Unicode characters. These special symbols work everywhere - Instagram, Twitter, Discord, and more.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">5 Available Circle Styles</h3>
        
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Circled</strong> - Characters enclosed in circles</li>
            <li><strong>Negative Circled</strong> - White text on black circles</li>
            <li><strong>Squared</strong> - Characters in square boxes</li>
            <li><strong>Negative Squared</strong> - White text on black squares</li>
            <li><strong>Parenthesized</strong> - Characters with parentheses</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use</h3>
        <ol class="list-decimal list-inside space-y-1 ml-4">
            <li>Choose your preferred circle style from the tabs</li>
            <li>Type or paste your text</li>
            <li>Text is instantly converted to Unicode</li>
            <li>Click "Copy Results" or "Download"</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Where to Use Circle Text</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Social Media:</strong> Instagram posts, Twitter bios, Facebook updates</li>
            <li><strong>Lists:</strong> Create numbered or lettered lists that stand out</li>
            <li><strong>Messaging:</strong> WhatsApp, Discord, Telegram</li>
            <li><strong>Decoration:</strong> Make headers and titles more eye-catching</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Real Examples</h3>
        
        <div class="space-y-2">
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm">
                <strong>Steps/Tutorial:</strong><br>
                ① Open the app<br>
                ② Click settings<br>
                ③ Enable notifications
            </div>
            
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm">
                <strong>Social Media Post:</strong><br>
                🎯 Ⓝⓔⓦ Ⓖⓞⓐⓛⓢ for 2025!
            </div>
            
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm">
                <strong>List Items:</strong><br>
                🅐 First option | 🅑 Second choice | 🅒 Third item
            </div>
        </div>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Benefits</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Universal:</strong> Works on all Unicode-supporting platforms</li>
            <li><strong>Eye-Catching:</strong> Makes text stand out in feeds</li>
            <li><strong>No Images:</strong> Pure text, not graphics</li>
            <li><strong>Copy-Paste:</strong> Maintains appearance when copied</li>
        </ul>
        
        <div class="bg-yellow-50 border-l-4 border-yellow-600 p-4 mt-6">
            <p class="text-yellow-900 text-sm">
                <strong>Note:</strong> Not all letters have circled versions. Letters without Unicode equivalents will remain unchanged.
            </p>
        </div>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Related Tools</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><a href="/special-effects/bold" class="text-blue-600 hover:underline">Bold Text</a> - Bold Unicode characters</li>
            <li><a href="/basic/strikethrough" class="text-blue-600 hover:underline">Strikethrough</a> - Strike through text</li>
            <li><a href="/basic/underline" class="text-blue-600 hover:underline">Underline</a> - Underlined text</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">FAQ</h3>
        
        <div class="space-y-3">
            <div>
                <h4 class="font-semibold text-gray-900 text-base">Is this free?</h4>
                <p class="text-sm">Yes, completely free with unlimited usage.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900 text-base">Do all letters work?</h4>
                <p class="text-sm">Most common letters and numbers have circled versions. Some special characters may not convert.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900 text-base">Can I use this on mobile?</h4>
                <p class="text-sm">Yes! Works perfectly on smartphones and tablets.</p>
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
    let conversionMode = 'circled';
    
    // Example outputs for each style
    const examples = {
        'circled': 'Ⓗⓔⓛⓛⓞ ②⓪②⑤',
        'negative-circled': '🅗🅔🅛🅛🅞 ②⓪②⑤',
        'squared': '🄷🄴🄻🄻🄾 ②⓪②⑤',
        'negative-squared': '🅷🅴🅻🅻🅾 ②⓪②⑤',
        'parenthesized': '⒣⒠⒧⒧⒪ ②⓪②⑤'
    };
    
    const styleNames = {
        'circled': 'circled',
        'negative-circled': 'negative circled',
        'squared': 'squared',
        'negative-squared': 'negative squared',
        'parenthesized': 'parenthesized'
    };
    
    const exampleTitles = {
        'circled': 'Circled Text',
        'negative-circled': 'Negative Circled',
        'squared': 'Squared Text',
        'negative-squared': 'Negative Squared',
        'parenthesized': 'Parenthesized'
    };

    // Set conversion mode and update UI
    window.setConversionMode = function(mode) {
        conversionMode = mode;
        
        // Update button styles
        const buttons = {
            'circled': document.getElementById('btnCircled'),
            'negative-circled': document.getElementById('btnNegativeCircled'),
            'squared': document.getElementById('btnSquared'),
            'negative-squared': document.getElementById('btnNegativeSquared'),
            'parenthesized': document.getElementById('btnParenthesized')
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
        document.getElementById('exampleOutput').textContent = examples[mode] || examples['circled'];
        document.getElementById('currentStyleName').textContent = styleNames[mode] || styleNames['circled'];
        document.getElementById('exampleTitle').textContent = exampleTitles[mode] || exampleTitles['circled'];
        document.getElementById('exampleAfterTitle').textContent = exampleTitles[mode] || exampleTitles['circled'];
        
        // Trigger re-conversion if there's input
        const inputElement = document.getElementById('circleText-input');
        if (inputElement && inputElement.value) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Convert text to circled characters
    function convertToCircled(text) {
        if (!text) return '';
        
        let result = '';
        
        for (let i = 0; i < text.length; i++) {
            const char = text[i];
            const code = char.charCodeAt(0);
            let convertedChar = char;
            
            if (conversionMode === 'circled') {
                // Circled letters and numbers
                if (code >= 65 && code <= 90) {
                    // A-Z: U+24B6 to U+24CF
                    convertedChar = String.fromCodePoint(0x24B6 + (code - 65));
                } else if (code >= 97 && code <= 122) {
                    // a-z: U+24D0 to U+24E9
                    convertedChar = String.fromCodePoint(0x24D0 + (code - 97));
                } else if (code >= 48 && code <= 57) {
                    // 0-9: U+2460 to U+2469 (but 0 is U+24EA)
                    if (code === 48) {
                        convertedChar = String.fromCodePoint(0x24EA);
                    } else {
                        convertedChar = String.fromCodePoint(0x2460 + (code - 49));
                    }
                }
            } else if (conversionMode === 'negative-circled') {
                // Negative circled (white on black)
                if (code >= 65 && code <= 90) {
                    // A-Z: U+1F150 to U+1F169
                    convertedChar = String.fromCodePoint(0x1F150 + (code - 65));
                } else if (code >= 97 && code <= 122) {
                    // Lowercase uses same as uppercase for negative circled
                    convertedChar = String.fromCodePoint(0x1F150 + (code - 97));
                } else if (code >= 48 && code <= 57) {
                    // Numbers use regular circled
                    if (code === 48) {
                        convertedChar = String.fromCodePoint(0x24EA);
                    } else {
                        convertedChar = String.fromCodePoint(0x2460 + (code - 49));
                    }
                }
            } else if (conversionMode === 'squared') {
                // Squared letters
                if (code >= 65 && code <= 90) {
                    // A-Z: U+1F130 to U+1F149
                    convertedChar = String.fromCodePoint(0x1F130 + (code - 65));
                } else if (code >= 97 && code <= 122) {
                    // Lowercase uses same as uppercase
                    convertedChar = String.fromCodePoint(0x1F130 + (code - 97));
                } else if (code >= 48 && code <= 57) {
                    // Numbers use circled
                    if (code === 48) {
                        convertedChar = String.fromCodePoint(0x24EA);
                    } else {
                        convertedChar = String.fromCodePoint(0x2460 + (code - 49));
                    }
                }
            } else if (conversionMode === 'negative-squared') {
                // Negative squared (white on black)
                if (code >= 65 && code <= 90) {
                    // A-Z: U+1F170 to U+1F189
                    convertedChar = String.fromCodePoint(0x1F170 + (code - 65));
                } else if (code >= 97 && code <= 122) {
                    // Lowercase uses same as uppercase
                    convertedChar = String.fromCodePoint(0x1F170 + (code - 97));
                } else if (code >= 48 && code <= 57) {
                    // Numbers use circled
                    if (code === 48) {
                        convertedChar = String.fromCodePoint(0x24EA);
                    } else {
                        convertedChar = String.fromCodePoint(0x2460 + (code - 49));
                    }
                }
            } else if (conversionMode === 'parenthesized') {
                // Parenthesized letters and numbers
                if (code >= 65 && code <= 90) {
                    // A-Z: U+249C to U+24B5
                    convertedChar = String.fromCodePoint(0x249C + (code - 65));
                } else if (code >= 97 && code <= 122) {
                    // a-z: same as uppercase
                    convertedChar = String.fromCodePoint(0x249C + (code - 97));
                } else if (code >= 49 && code <= 57) {
                    // 1-9: U+2474 to U+247C
                    convertedChar = String.fromCodePoint(0x2474 + (code - 49));
                }
            }
            
            result += convertedChar;
        }
        
        return result;
    }
    
    // Set the conversion function for the component
    setCircleTextConverter(convertToCircled);
    
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        setConversionMode('circled');
    });
</script>
@endpush
