@extends('layouts.tool')

@section('title', 'Bold Text Generator - WordFix')

@section('tool-title', 'Bold Text Generator')

@section('tool-description', 'Convert your text into bold Unicode characters - Bold, Bold Italic, and Bold Fraktur styles')

@section('tool-content')
<!-- Conversion Mode Toggle -->
<div class="mb-6">
    <div class="overflow-x-auto pb-2">
        <div class="flex flex-wrap justify-center gap-2 min-w-max px-2">
            <button 
                type="button" 
                id="btnBold"
                onclick="setConversionMode('bold')"
                class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors"
            >
                𝐁𝐨𝐥𝐝
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
                id="btnBoldFraktur"
                onclick="setConversionMode('bold-gothic')"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors"
            >
                𝕭𝖔𝖑𝖉 𝕱𝖗𝖆𝖐𝖙𝖚𝖗
            </button>
            <button 
                type="button" 
                id="btnBoldSans"
                onclick="setConversionMode('bold-sans')"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors"
            >
                𝗕𝗼𝗹𝗱 𝗦𝗮𝗻𝘀
            </button>
            <button 
                type="button" 
                id="btnMonospace"
                onclick="setConversionMode('monospace')"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors"
            >
                𝙼𝚘𝚗𝚘𝚜𝚙𝚊𝚌𝚎
            </button>
            <button 
                type="button" 
                id="btnDoubleStruck"
                onclick="setConversionMode('double-struck')"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors"
            >
                𝔻𝕠𝕦𝕓𝕝𝕖-𝕊𝕥𝕣𝕦𝕔𝕜
            </button>
            <button 
                type="button" 
                id="btnScript"
                onclick="setConversionMode('script')"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors"
            >
                𝒮𝒸𝓇𝒾𝓅𝓉
            </button>
            <button 
                type="button" 
                id="btnSmallCaps"
                onclick="setConversionMode('small-caps')"
                class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 focus:z-10 focus:ring-2 focus:ring-blue-500 transition-colors"
            >
                Sᴍᴀʟʟ Cᴀᴘs
            </button>
        </div>
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="boldText"
    inputPlaceholder="Type or paste your text here"
    outputPlaceholder="Bold Unicode text will appear here"
    downloadFileName="bold-text.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    This tool converts normal text into <strong id="currentStyleName">bold</strong> Unicode characters that work everywhere - social media, messaging apps, and documents.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3"><span id="exampleTitle">Bold Text</span> Example</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before (Normal Text)</p>
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm text-gray-700">
                Hello World 2025
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After (<span id="exampleAfterTitle">Bold</span>)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-base text-gray-900 font-normal" id="exampleOutput" style="font-family: Arial, sans-serif;">
                𝐇𝐞𝐥𝐥𝐨 𝐖𝐨𝐫𝐥𝐝 𝟐𝟎𝟐𝟓
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
            <h4 class="font-semibold text-gray-900">Universal Compatibility</h4>
        </div>
        <p class="text-sm text-gray-700">Works on Instagram, Twitter, Facebook, WhatsApp, and everywhere else</p>
    </div>
    
    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
        <div class="flex items-center mb-2">
            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            <h4 class="font-semibold text-gray-900">Instant Conversion</h4>
        </div>
        <p class="text-sm text-gray-700">Real-time Unicode transformation as you type</p>
    </div>
    
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
        <div class="flex items-center mb-2">
            <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            <h4 class="font-semibold text-gray-900">100% Private</h4>
        </div>
        <p class="text-sm text-gray-700">All processing happens in your browser - no data sent to servers</p>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Bold Text Generator</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Bold Text Generator</strong> converts standard text into Unicode bold characters that work everywhere - Instagram, Discord, WhatsApp, and more. These are real Unicode symbols, not formatting, so they maintain their appearance across all platforms.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">8 Available Text Styles</h3>
        
        <p>Our tool offers 8 different Unicode text styles:</p>
        
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Bold Serif</strong> - Classic bold style for emphasis</li>
            <li><strong>Bold Italic</strong> - Bold with slanted letters</li>
            <li><strong>Bold Fraktur</strong> - Gothic/blackletter style</li>
            <li><strong>Bold Sans-Serif</strong> - Clean modern bold</li>
            <li><strong>Monospace</strong> - Fixed-width typewriter style</li>
            <li><strong>Double-Struck</strong> - Mathematical blackboard style</li>
            <li><strong>Script</strong> - Elegant handwriting cursive</li>
            <li><strong>Small Caps</strong> - Lowercase letters as small capitals</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use</h3>
        <ol class="list-decimal list-inside space-y-1 ml-4">
            <li>Choose your preferred style from the tabs above</li>
            <li>Type or paste your text into the input box</li>
            <li>The text is instantly converted to Unicode</li>
            <li>Click "Copy Results" or "Download" to save</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Where to Use Bold Text</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Social Media:</strong> Instagram bios, Twitter posts, Facebook updates, TikTok captions</li>
            <li><strong>Messaging:</strong> WhatsApp, Telegram, Discord, Messenger, Slack</li>
            <li><strong>Gaming:</strong> Usernames in PUBG, Free Fire, Fortnite, Minecraft</li>
            <li><strong>Other:</strong> Email subjects, YouTube comments, forum posts, documents</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Real Examples</h3>
        
        <div class="space-y-2">
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm">
                <strong>Instagram Bio:</strong><br>
                Photographer 📸 | Travel Lover ✈️<br>
                Capturing moments, one click at a time
            </div>
            
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm">
                <strong>Social Post:</strong><br>
                🎉 NEW PRODUCT LAUNCH! Limited time - 50% off!
            </div>
            
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm">
                <strong>Gaming Username:</strong><br>
                ProGamer2025 | MonoKing
            </div>
        </div>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Why Use Unicode Text?</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Universal:</strong> Works on all platforms that support Unicode</li>
            <li><strong>No Formatting:</strong> The style is part of the character itself</li>
            <li><strong>Copy-Paste:</strong> Maintains appearance when copied anywhere</li>
            <li><strong>Attention-Grabbing:</strong> Makes your text stand out in feeds</li>
        </ul>
        
        <div class="bg-yellow-50 border-l-4 border-yellow-600 p-4 mt-6">
            <p class="text-yellow-900 text-sm">
                <strong>Note:</strong> While Unicode text is great for social media and emphasis, screen readers may not pronounce these characters correctly. For accessibility-critical content, use proper HTML formatting instead.
            </p>
        </div>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Related Tools</h3>
        <p>Explore our other text transformation tools:</p>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><a href="/basic/upper-case" class="text-blue-600 hover:underline">Upper Case</a> - Convert to UPPERCASE</li>
            <li><a href="/basic/title-case" class="text-blue-600 hover:underline">Title Case</a> - Capitalize Each Word</li>
            <li><a href="/basic/strikethrough" class="text-blue-600 hover:underline">Strikethrough</a> - ̶S̶t̶r̶i̶k̶e̶ ̶t̶h̶r̶o̶u̶g̶h̶ text</li>
            <li><a href="/basic/underline" class="text-blue-600 hover:underline">Underline</a> - U̲n̲d̲e̲r̲l̲i̲n̲e̲ text</li>
            <li><a href="/special-effects/italic" class="text-blue-600 hover:underline">Italic</a> - Slanted text</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">FAQ</h3>
        
        <div class="space-y-3">
            <div>
                <h4 class="font-semibold text-gray-900 text-base">Is this tool free?</h4>
                <p class="text-sm">Yes, completely free with unlimited usage. No registration required.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900 text-base">Will it work on all platforms?</h4>
                <p class="text-sm">Unicode bold text works on virtually all modern platforms including Instagram, Twitter, Facebook, WhatsApp, Discord, and more.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900 text-base">Is my data saved?</h4>
                <p class="text-sm">No. All text conversion happens locally in your browser. We don't store or transmit your data.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900 text-base">Can I convert numbers?</h4>
                <p class="text-sm">Yes! Most styles convert both letters (A-Z, a-z) and numbers (0-9) to their Unicode equivalents.</p>
            </div>
        </div>
        
        <p class="mt-6 text-sm text-gray-600 italic">
            Last updated: {{ date('F Y') }}. Our bold text generator is regularly updated for the best experience.
        </p>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let conversionMode = 'bold';
    
    // Character mapping - source characters
    
    // Example outputs for each style (using code points to generate)
    const examples = {
        'bold': String.fromCodePoint(0x1D407, 0x1D41E, 0x1D425, 0x1D425, 0x1D428) + ' ' + 
                String.fromCodePoint(0x1D416, 0x1D428, 0x1D42B, 0x1D425, 0x1D41D) + ' ' +
                String.fromCodePoint(0x1D7CE, 0x1D7CE, 0x1D7CE, 0x1D7D3),
        'bold-italic': String.fromCodePoint(0x1D46F, 0x1D486, 0x1D48D, 0x1D48D, 0x1D490) + ' ' +
                       String.fromCodePoint(0x1D47E, 0x1D490, 0x1D493, 0x1D48D, 0x1D485) + ' ' +
                       String.fromCodePoint(0x1D7CE, 0x1D7CE, 0x1D7CE, 0x1D7D3),
        'bold-gothic': String.fromCodePoint(0x1D573, 0x1D590, 0x1D597, 0x1D597, 0x1D59A) + ' ' +
                       String.fromCodePoint(0x1D582, 0x1D59A, 0x1D59D, 0x1D597, 0x1D58F) + ' ' +
                       String.fromCodePoint(0x1D7CE, 0x1D7CE, 0x1D7CE, 0x1D7D3),
        'bold-sans': String.fromCodePoint(0x1D5D7, 0x1D5F2, 0x1D5F9, 0x1D5F9, 0x1D5FC) + ' ' +
                     String.fromCodePoint(0x1D5E6, 0x1D5EE, 0x1D5FB, 0x1D600) + ' ' +
                     String.fromCodePoint(0x1D7EC, 0x1D7EC, 0x1D7EC, 0x1D7F3),
        'monospace': String.fromCodePoint(0x1D670 + 12, 0x1D68A + 14, 0x1D68A + 13, 0x1D68A + 14, 0x1D68A + 18) + ' ' +
                     String.fromCodePoint(0x1D7F6, 0x1D7F6, 0x1D7F6, 0x1D7FD),
        'double-struck': String.fromCodePoint(0x1D538 + 3, 0x1D552 + 14, 0x1D552 + 20, 0x1D552 + 1, 0x1D552 + 11, 0x1D552 + 4) + ' ' +
                        String.fromCodePoint(0x1D7D8, 0x1D7D8, 0x1D7D8, 0x1D7DF),
        'script': String.fromCodePoint(0x1D4AE, 0x1D4B8, 0x1D4C7, 0x1D4BE, 0x1D4C5, 0x1D4C9) + ' 2025',
        'small-caps': 'Hᴇʟʟᴏ Wᴏʀʟᴅ 2025'
    };
    
    const styleNames = {
        'bold': 'bold serif',
        'bold-italic': 'bold italic',
        'bold-gothic': 'bold Fraktur',
        'bold-sans': 'bold sans-serif',
        'monospace': 'monospace',
        'double-struck': 'double-struck',
        'script': 'script',
        'small-caps': 'small caps'
    };
    
    const exampleTitles = {
        'bold': 'Bold Serif',
        'bold-italic': 'Bold Italic',
        'bold-gothic': 'Bold Fraktur',
        'bold-sans': 'Bold Sans-Serif',
        'monospace': 'Monospace',
        'double-struck': 'Double-Struck',
        'script': 'Script',
        'small-caps': 'Small Caps'
    };

    // Set conversion mode and update UI
    window.setConversionMode = function(mode) {
        conversionMode = mode;
        
        // Update button styles
        const buttons = {
            'bold': document.getElementById('btnBold'),
            'bold-italic': document.getElementById('btnBoldItalic'),
            'bold-gothic': document.getElementById('btnBoldFraktur'),
            'bold-sans': document.getElementById('btnBoldSans'),
            'monospace': document.getElementById('btnMonospace'),
            'double-struck': document.getElementById('btnDoubleStruck'),
            'script': document.getElementById('btnScript'),
            'small-caps': document.getElementById('btnSmallCaps')
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
        document.getElementById('exampleOutput').textContent = examples[mode] || examples['bold'];
        document.getElementById('currentStyleName').textContent = styleNames[mode] || styleNames['bold'];
        document.getElementById('exampleTitle').textContent = exampleTitles[mode] || exampleTitles['bold'];
        document.getElementById('exampleAfterTitle').textContent = exampleTitles[mode] || exampleTitles['bold'];
        
        // Trigger re-conversion if there's input
        const inputElement = document.getElementById('boldText-input');
        if (inputElement && inputElement.value) {
            inputElement.dispatchEvent(new Event('input'));
        }
        
        // Update URL without reload (only for the main 3 styles that have dedicated URLs)
        const urlModes = ['bold', 'bold-italic', 'bold-gothic'];
        if (urlModes.includes(mode)) {
            const newUrl = '/special-effects/' + mode;
            if (window.location.pathname !== newUrl) {
                window.history.pushState({path: newUrl}, '', newUrl);
            }
        }
    };
    
    // Convert text to bold using Unicode code points
    function convertToBold(text) {
        if (!text) return '';
        
        let result = '';
        
        for (let i = 0; i < text.length; i++) {
            const char = text[i];
            const code = char.charCodeAt(0);
            let convertedChar = char;
            
            if (conversionMode === 'bold') {
                // Mathematical Bold (Serif)
                if (code >= 65 && code <= 90) {
                    // A-Z: U+1D400 to U+1D419
                    convertedChar = String.fromCodePoint(0x1D400 + (code - 65));
                } else if (code >= 97 && code <= 122) {
                    // a-z: U+1D41A to U+1D433
                    convertedChar = String.fromCodePoint(0x1D41A + (code - 97));
                } else if (code >= 48 && code <= 57) {
                    // 0-9: U+1D7CE to U+1D7D7
                    convertedChar = String.fromCodePoint(0x1D7CE + (code - 48));
                }
            } else if (conversionMode === 'bold-italic') {
                // Mathematical Bold Italic
                if (code >= 65 && code <= 90) {
                    // A-Z: U+1D468 to U+1D481
                    convertedChar = String.fromCodePoint(0x1D468 + (code - 65));
                } else if (code >= 97 && code <= 122) {
                    // a-z: U+1D482 to U+1D49B
                    convertedChar = String.fromCodePoint(0x1D482 + (code - 97));
                } else if (code >= 48 && code <= 57) {
                    // 0-9: U+1D7CE to U+1D7D7 (same as bold)
                    convertedChar = String.fromCodePoint(0x1D7CE + (code - 48));
                }
            } else if (conversionMode === 'bold-gothic') {
                // Mathematical Bold Fraktur
                if (code >= 65 && code <= 90) {
                    // A-Z: U+1D56C to U+1D585
                    convertedChar = String.fromCodePoint(0x1D56C + (code - 65));
                } else if (code >= 97 && code <= 122) {
                    // a-z: U+1D586 to U+1D59F
                    convertedChar = String.fromCodePoint(0x1D586 + (code - 97));
                } else if (code >= 48 && code <= 57) {
                    // 0-9: U+1D7CE to U+1D7D7 (same as bold)
                    convertedChar = String.fromCodePoint(0x1D7CE + (code - 48));
                }
            } else if (conversionMode === 'bold-sans') {
                // Mathematical Bold Sans-Serif
                if (code >= 65 && code <= 90) {
                    // A-Z: U+1D5D4 to U+1D5ED
                    convertedChar = String.fromCodePoint(0x1D5D4 + (code - 65));
                } else if (code >= 97 && code <= 122) {
                    // a-z: U+1D5EE to U+1D607
                    convertedChar = String.fromCodePoint(0x1D5EE + (code - 97));
                } else if (code >= 48 && code <= 57) {
                    // 0-9: U+1D7EC to U+1D7F5
                    convertedChar = String.fromCodePoint(0x1D7EC + (code - 48));
                }
            } else if (conversionMode === 'monospace') {
                // Monospace
                if (code >= 65 && code <= 90) {
                    // A-Z: U+1D670 to U+1D689
                    convertedChar = String.fromCodePoint(0x1D670 + (code - 65));
                } else if (code >= 97 && code <= 122) {
                    // a-z: U+1D68A to U+1D6A3
                    convertedChar = String.fromCodePoint(0x1D68A + (code - 97));
                } else if (code >= 48 && code <= 57) {
                    // 0-9: U+1D7F6 to U+1D7FF
                    convertedChar = String.fromCodePoint(0x1D7F6 + (code - 48));
                }
            } else if (conversionMode === 'double-struck') {
                // Double-Struck (Blackboard Bold)
                if (code >= 65 && code <= 90) {
                    // A-Z: U+1D538 to U+1D551 (with exceptions)
                    // C, H, N, P, Q, R, Z have special mappings
                    const exceptions = {67: 0x2102, 72: 0x210D, 78: 0x2115, 80: 0x2119, 81: 0x211A, 82: 0x211D, 90: 0x2124};
                    convertedChar = exceptions[code] ? String.fromCodePoint(exceptions[code]) : String.fromCodePoint(0x1D538 + (code - 65));
                } else if (code >= 97 && code <= 122) {
                    // a-z: U+1D552 to U+1D56B
                    convertedChar = String.fromCodePoint(0x1D552 + (code - 97));
                } else if (code >= 48 && code <= 57) {
                    // 0-9: U+1D7D8 to U+1D7E1
                    convertedChar = String.fromCodePoint(0x1D7D8 + (code - 48));
                }
            } else if (conversionMode === 'script') {
                // Script (Cursive)
                if (code >= 65 && code <= 90) {
                    // A-Z: U+1D49C to U+1D4B5 (with exceptions)
                    // B, E, F, H, I, L, M, R have special mappings
                    const exceptions = {66: 0x212C, 69: 0x2130, 70: 0x2131, 72: 0x210B, 73: 0x2110, 76: 0x2112, 77: 0x2133, 82: 0x211B};
                    convertedChar = exceptions[code] ? String.fromCodePoint(exceptions[code]) : String.fromCodePoint(0x1D49C + (code - 65));
                } else if (code >= 97 && code <= 122) {
                    // a-z: U+1D4B6 to U+1D4CF (with exceptions)
                    // e, g, o have special mappings
                    const exceptions = {101: 0x212F, 103: 0x210A, 111: 0x2134};
                    convertedChar = exceptions[code] ? String.fromCodePoint(exceptions[code]) : String.fromCodePoint(0x1D4B6 + (code - 97));
                } else if (code >=48 && code <= 57) {
                    // Numbers remain unchanged in script
                    convertedChar = char;
                }
            } else if (conversionMode === 'small-caps') {
                // Small Caps (using IPA and Latin Extensions)
                const smallCapsMap = {
                    'a': 'ᴀ', 'b': 'ʙ', 'c': 'ᴄ', 'd': 'ᴅ', 'e': 'ᴇ', 'f': 'ꜰ', 'g': 'ɢ', 'h': 'ʜ',
                    'i': 'ɪ', 'j': 'ᴊ', 'k': 'ᴋ', 'l': 'ʟ', 'm': 'ᴍ', 'n': 'ɴ', 'o': 'ᴏ', 'p': 'ᴘ',
                    'q': 'ǫ', 'r': 'ʀ', 's': 's', 't': 'ᴛ', 'u': 'ᴜ', 'v': 'ᴠ', 'w': 'ᴡ', 'x': 'x',
                    'y': 'ʏ', 'z': 'ᴢ'
                };
                // Convert lowercase to small caps, uppercase stays uppercase
                if (code >= 97 && code <= 122) {
                    convertedChar = smallCapsMap[char] || char;
                }
            }
            
            result += convertedChar;
        }
        
        return result;
    }
    
    // Set the conversion function for the component
    setBoldTextConverter(convertToBold);
    
    // Initialize - Auto-detect mode from URL
    document.addEventListener('DOMContentLoaded', function() {
        const currentUrl = window.location.pathname;
        let initialMode = 'bold';
        
        if (currentUrl.includes('bold-italic')) {
            initialMode = 'bold-italic';
        } else if (currentUrl.includes('bold-gothic')) {
            initialMode = 'bold-gothic';
        }
        
        setConversionMode(initialMode);
    });
</script>
@endpush
