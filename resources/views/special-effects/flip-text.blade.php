@extends('layouts.tool')

@section('title', 'Flip Text & Flip Words Generator - WordFix')

@section('tool-title', 'Flip Text Generator')

@section('tool-description', 'Flip your text upside down or flip individual words - perfect for fun social media posts')

@section('tool-content')
<!-- Flip Configuration Options -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Flip Options</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Flip Vertical (Upside Down) -->
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="flipVertical" class="w-5 h-5 text-blue-600 rounded focus:ring-2 focus:ring-blue-500" onchange="updateFlipOptions()">
                <div class="ml-3">
                    <span class="text-sm font-semibold text-gray-900">Flip Vertical (Upside Down)</span>
                    <p class="text-xs text-gray-600">Flips characters upside down: a → ɐ</p>
                </div>
            </label>
        </div>
        
        <!-- Flip Horizontal (Mirror) -->
        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="flipHorizontal" class="w-5 h-5 text-green-600 rounded focus:ring-2 focus:ring-green-500" onchange="updateFlipOptions()">
                <div class="ml-3">
                    <span class="text-sm font-semibold text-gray-900">Flip Horizontal (Mirror)</span>
                    <p class="text-xs text-gray-600">Mirrors characters: d → b, p → q</p>
                </div>
            </label>
        </div>
        
        <!-- Reverse Text -->
        <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="reverseText" class="w-5 h-5 text-purple-600 rounded focus:ring-2 focus:ring-purple-500" onchange="updateFlipOptions()">
                <div class="ml-3">
                    <span class="text-sm font-semibold text-gray-900">Reverse Text</span>
                    <p class="text-xs text-gray-600">Reverses entire text: abc → cba</p>
                </div>
            </label>
        </div>
        
        <!-- Reverse Words -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="reverseWords" class="w-5 h-5 text-yellow-600 rounded focus:ring-2 focus:ring-yellow-500" onchange="updateFlipOptions()">
                <div class="ml-3">
                    <span class="text-sm font-semibold text-gray-900">Reverse Word Order</span>
                    <p class="text-xs text-gray-600">Reverses word order: one two → two one</p>
                </div>
            </label>
        </div>
    </div>
    
    <!-- Quick Presets -->
    <div class="mt-4">
        <p class="text-sm font-medium text-gray-700 mb-2">Quick Presets:</p>
        <div class="flex flex-wrap gap-2">
            <button onclick="setPreset('classic')" class="px-3 py-1.5 text-xs font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                Classic Flip (Vertical + Reverse)
            </button>
            <button onclick="setPreset('mirror')" class="px-3 py-1.5 text-xs font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                Mirror (Horizontal + Reverse)
            </button>
            <button onclick="setPreset('wordorder')" class="px-3 py-1.5 text-xs font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                Word Order Only
            </button>
            <button onclick="setPreset('reset')" class="px-3 py-1.5 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">
                Reset All
            </button>
        </div>
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="flipText"
    inputPlaceholder="Type or paste your text here..."
    outputPlaceholder="Flipped text will appear here..."
    downloadFileName="flipped-text.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6 mt-4">
    <strong id="currentModeTitle">Flip Text</strong>: <span id="currentModeDesc">Reverses and flips your entire text upside down</span>
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3"><span id="exampleTitle">Flip Text</span> Example</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before (Normal Text)</p>
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm text-gray-700">
                Hello World 2025
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After (<span id="exampleAfterTitle">Flipped</span>)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-lg text-gray-900" id="exampleOutput" style="font-family: Arial, sans-serif;">
                ߌↄ0ᒿ plɹoM ollǝH
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
            <h4 class="font-semibold text-gray-900">2 Flip Modes</h4>
        </div>
        <p class="text-sm text-gray-700">Flip entire text or individual words</p>
    </div>
    
    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
        <div class="flex items-center mb-2">
            <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
            </svg>
            <h4 class="font-semibold text-gray-900">Instant</h4>
        </div>
        <p class="text-sm text-gray-700">Real-time flipping as you type</p>
    </div>
    
    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
        <div class="flex items-center mb-2">
            <svg class="w-5 h-5 text-purple-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
            </svg>
            <h4 class="font-semibold text-gray-900">Private</h4>
        </div>
        <p class="text-sm text-gray-700">All processing in browser</p>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Flip Text Generator</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Flip Text Generator</strong> creates upside-down text using Unicode characters. Choose between flipping your entire text or just individual words for fun and creative social media posts.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">2 Flip Modes</h3>
        
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Flip Text</strong> - Reverses and flips entire text upside down (characters + order)</li>
            <li><strong>Reverse Word Order</strong> - Only reverses the order of words (no character flipping)</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use</h3>
        <ol class="list-decimal list-inside space-y-1 ml-4">
            <li>Choose "Flip Text" or "Flip Words" mode</li>
            <li>Type or paste your text</li>
            <li>Text flips instantly using Unicode</li>
            <li>Click "Copy Results" to use it</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Where to Use Flipped Text</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Social Media:</strong> Instagram, Twitter, Facebook for fun posts</li>
            <li><strong>Comments:</strong> Stand out in YouTube or Reddit comments</li>
            <li><strong>Messages:</strong> Surprise friends on WhatsApp or Discord</li>
            <li><strong>Memes:</strong> Create funny upside-down content</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Real Examples</h3>
        
        <div class="space-y-2">
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm">
                <strong>Flip Text:</strong><br>
                Normal: umair khan<br>
                Flipped: uɐɥʞ ɹıɐɯn
            </div>
            
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm">
                <strong>Reverse Word Order:</strong><br>
                Normal: umair khan<br>
                Reversed: khan umair
            </div>
            
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm">
                <strong>Fun Post:</strong><br>
                ɯoʇʇoq ǝɥʇ ʇɐ ʇɹɐʇs s,ʇǝ˥
            </div>
        </div>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Difference Between Modes</h3>
        
        <div class="bg-blue-50 border border-blue-200 rounded p-4">
            <p class="text-sm">
                <strong>Flip Text:</strong> "umair khan" becomes "uɐɥʞ ɹıɐɯn" (reversed + upside down)<br>
                <strong>Reverse Word Order:</strong> "umair khan" becomes "khan umair" (only word order reversed)
            </p>
        </div>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Benefits</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Fun & Creative:</strong> Add humor to your posts</li>
            <li><strong>Attention-Grabbing:</strong> Unique text stands out</li>
            <li><strong>Universal:</strong> Works on all Unicode platforms</li>
            <li><strong>Easy:</strong> One-click flip conversion</li>
        </ul>
        
        <div class="bg-yellow-50 border-l-4 border-yellow-600 p-4 mt-6">
            <p class="text-yellow-900 text-sm">
                <strong>Note:</strong> Flipped text is fun but harder to read. Use for creative posts, not important information.
            </p>
        </div>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Related Tools</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><a href="/special-effects/backward" class="text-blue-600 hover:underline">Backward Text</a> - Reverse text</li>
            <li><a href="/special-effects/upside-down" class="text-blue-600 hover:underline">Upside Down</a> - Flip text upside down</li>
            <li><a href="/basic/invert-case" class="text-blue-600 hover:underline">Invert Case</a> - Swap upper/lowercase</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">FAQ</h3>
        
        <div class="space-y-3">
            <div>
                <h4 class="font-semibold text-gray-900 text-base">Is this free?</h4>
                <p class="text-sm">Yes, completely free with unlimited usage.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900 text-base">What's the difference between the two modes?</h4>
                <p class="text-sm">Flip Text reverses and flips everything. Flip Words flips each word individually while keeping word order.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900 text-base">Does it work on mobile?</h4>
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
    // Flip character mappings
    const verticalFlipMap = {
        'a': 'ɐ', 'b': 'q', 'c': 'ɔ', 'd': 'p', 'e': 'ǝ', 'f': 'ɟ', 'g': 'ƃ', 'h': 'ɥ',
        'i': 'ı', 'j': 'ɾ', 'k': 'ʞ', 'l': 'l', 'm': 'ɯ', 'n': 'u', 'o': 'o', 'p': 'd',
        'q': 'b', 'r': 'ɹ', 's': 's', 't': 'ʇ', 'u': 'n', 'v': 'ʌ', 'w': 'ʍ', 'x': 'x',
        'y': 'ʎ', 'z': 'z',
        'A': '∀', 'B': 'q', 'C': 'Ɔ', 'D': 'D', 'E': 'Ǝ', 'F': 'Ⅎ', 'G': '⅁', 'H': 'H',
        'I': 'I', 'J': 'ſ', 'K': '⋊', 'L': '˥', 'M': 'W', 'N': 'N', 'O': 'O', 'P': 'Ԁ',
        'Q': 'Ό', 'R': 'ɹ', 'S': 'S', 'T': '⊥', 'U': '∩', 'V': 'Λ', 'W': 'M', 'X': 'X',
        'Y': '⅄', 'Z': 'Z',
        '0': '0', '1': 'Ɩ', '2': 'ᄅ', '3': 'Ɛ', '4': 'ㄣ', '5': 'ϛ', '6': '9', '7': 'ㄥ',
        '8': '8', '9': '6',
        '.': '˙', ',': '\'', '!': '¡', '?': '¿', '(': ')', ')': '(', '[': ']', ']': '[',
        '{': '}', '}': '{', '<': '>', '>': '<', '&': '⅋', '_': '‾', ';': '؛', '"': '„',
        '\'': ',', '/': '\\', '\\': '/', ':': ':'
    };
    
    const horizontalFlipMap = {
        'b': 'd', 'd': 'b', 'p': 'q', 'q': 'p',
        'B': 'ᗺ', 'D': 'ᗡ', 'P': 'ꟼ', 'Q': 'Ꝺ',
        '(': ')', ')': '(', '[': ']', ']': '[',
        '{': '}', '}': '{', '<': '>', '>': '<',
        '/': '\\', '\\': '/'
    };
    
    // Apply vertical flip to a character
    function applyVerticalFlip(char) {
        return verticalFlipMap[char] || char;
    }
    
    // Apply horizontal flip to a character
    function applyHorizontalFlip(char) {
        return horizontalFlipMap[char] || char;
    }
    
    // Update flip options and trigger conversion
    function updateFlipOptions() {
        const inputElement = document.getElementById('flipText-input');
        if (inputElement && inputElement.value) {
            inputElement.dispatchEvent(new Event('input'));
        }
    }
    
    // Set preset configurations
    window.setPreset = function(preset) {
        const flipVertical = document.getElementById('flipVertical');
        const flipHorizontal = document.getElementById('flipHorizontal');
        const reverseText = document.getElementById('reverseText');
        const reverseWords = document.getElementById('reverseWords');
        
        // Reset all
        flipVertical.checked = false;
        flipHorizontal.checked = false;
        reverseText.checked = false;
        reverseWords.checked = false;
        
        // Apply preset
        if (preset === 'classic') {
            // Classic flip text (vertical + reverse)
            flipVertical.checked = true;
            reverseText.checked = true;
        } else if (preset === 'mirror') {
            // Mirror (horizontal + reverse)
            flipHorizontal.checked = true;
            reverseText.checked = true;
        } else if (preset === 'wordorder') {
            // Just reverse word order
            reverseWords.checked = true;
        }
        // 'reset' keeps everything unchecked
        
        updateFlipOptions();
    };
    
    // Main conversion function
    function convertToFlipped(text) {
        if (!text) return '';
        
        // Get current options
        const doFlipVertical = document.getElementById('flipVertical')?.checked || false;
        const doFlipHorizontal = document.getElementById('flipHorizontal')?.checked || false;
        const doReverseText = document.getElementById('reverseText')?.checked || false;
        const doReverseWords = document.getElementById('reverseWords')?.checked || false;
        
        let result = text;
        
        // Step 1: Apply character flips (vertical and/or horizontal)
        if (doFlipVertical || doFlipHorizontal) {
            result = result.split('').map(char => {
                let newChar = char;
                if (doFlipVertical) {
                    newChar = applyVerticalFlip(newChar);
                }
                if (doFlipHorizontal) {
                    newChar = applyHorizontalFlip(newChar);
                }
                return newChar;
            }).join('');
        }
        
        // Step 2: Reverse text (entire string)
        if (doReverseText) {
            result = result.split('').reverse().join('');
        }
        
        // Step 3: Reverse word order (must be done after text reverse if both are selected)
        if (doReverseWords && !doReverseText) {
            result = result.split(' ').reverse().join(' ');
        }
        
        return result;
    }
    
    // Set the conversion function for the component
    setFlipTextConverter(convertToFlipped);
    
    // Initialize with classic flip preset on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Check URL to determine initial state
        const currentUrl = window.location.pathname;
        
        if (currentUrl.includes('flip-words')) {
            // Reverse word order mode
            setPreset('wordorder');
        } else {
            // Default to classic flip
            setPreset('classic');
        }
    });
</script>
@endpush
