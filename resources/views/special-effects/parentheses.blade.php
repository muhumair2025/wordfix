@extends('layouts.tool')

@section('title', 'Parentheses Around Letters - WordFix')

@section('tool-title', 'Parentheses Around Letters')

@section('tool-description', 'Wrap each letter in parentheses for unique stylized text')

@section('tool-content')
<!-- Configuration Options -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Bracket Type</h3>
    
    <!-- Preset Bracket Types -->
    <div class="mb-4">
        <p class="text-sm font-medium text-gray-700 mb-2">Choose Bracket Style:</p>
        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-2">
            <button onclick="setBracketType('(', ')')" class="px-4 py-3 text-center border-2 border-blue-300 rounded-lg hover:bg-blue-50 hover:border-blue-500 transition-colors" id="preset-paren">
                <div class="text-lg font-semibold">(  )</div>
                <div class="text-xs text-gray-600">Parentheses</div>
            </button>
            <button onclick="setBracketType('[', ']')" class="px-4 py-3 text-center border-2 border-gray-300 rounded-lg hover:bg-blue-50 hover:border-blue-500 transition-colors" id="preset-square">
                <div class="text-lg font-semibold">[  ]</div>
                <div class="text-xs text-gray-600">Square</div>
            </button>
            <button onclick="setBracketType('{', '}')" class="px-4 py-3 text-center border-2 border-gray-300 rounded-lg hover:bg-blue-50 hover:border-blue-500 transition-colors" id="preset-curly">
                <div class="text-lg font-semibold">{  }</div>
                <div class="text-xs text-gray-600">Curly</div>
            </button>
            <button onclick="setBracketType('<', '>')" class="px-4 py-3 text-center border-2 border-gray-300 rounded-lg hover:bg-blue-50 hover:border-blue-500 transition-colors" id="preset-angle">
                <div class="text-lg font-semibold">&lt;  &gt;</div>
                <div class="text-xs text-gray-600">Angle</div>
            </button>
            <button onclick="setBracketType('«', '»')" class="px-4 py-3 text-center border-2 border-gray-300 rounded-lg hover:bg-blue-50 hover:border-blue-500 transition-colors" id="preset-guillemet">
                <div class="text-lg font-semibold">«  »</div>
                <div class="text-xs text-gray-600">Guillemet</div>
            </button>
            <button onclick="setBracketType('⟨', '⟩')" class="px-4 py-3 text-center border-2 border-gray-300 rounded-lg hover:bg-blue-50 hover:border-blue-500 transition-colors" id="preset-math">
                <div class="text-lg font-semibold">⟨  ⟩</div>
                <div class="text-xs text-gray-600">Math</div>
            </button>
            <button onclick="setBracketType('⦃', '⦄')" class="px-4 py-3 text-center border-2 border-gray-300 rounded-lg hover:bg-blue-50 hover:border-blue-500 transition-colors" id="preset-white">
                <div class="text-lg font-semibold">⦃  ⦄</div>
                <div class="text-xs text-gray-600">White Curly</div>
            </button>
            <button onclick="setBracketType('⦗', '⦘')" class="px-4 py-3 text-center border-2 border-gray-300 rounded-lg hover:bg-blue-50 hover:border-blue-500 transition-colors" id="preset-double">
                <div class="text-lg font-semibold">⦗  ⦘</div>
                <div class="text-xs text-gray-600">Double</div>
            </button>
            <button onclick="setBracketType('❨', '❩')" class="px-4 py-3 text-center border-2 border-gray-300 rounded-lg hover:bg-blue-50 hover:border-blue-500 transition-colors" id="preset-ornament">
                <div class="text-lg font-semibold">❨  ❩</div>
                <div class="text-xs text-gray-600">Ornamental</div>
            </button>
            <button onclick="setBracketType('⟦', '⟧')" class="px-4 py-3 text-center border-2 border-gray-300 rounded-lg hover:bg-blue-50 hover:border-blue-500 transition-colors" id="preset-bracket">
                <div class="text-lg font-semibold">⟦  ⟧</div>
                <div class="text-xs text-gray-600">Bracket</div>
            </button>
            <button onclick="setBracketType('⦅', '⦆')" class="px-4 py-3 text-center border-2 border-gray-300 rounded-lg hover:bg-blue-50 hover:border-blue-500 transition-colors" id="preset-white-paren">
                <div class="text-lg font-semibold">⦅  ⦆</div>
                <div class="text-xs text-gray-600">White Paren</div>
            </button>
            <button onclick="setBracketType('⸨', '⸩')" class="px-4 py-3 text-center border-2 border-gray-300 rounded-lg hover:bg-blue-50 hover:border-blue-500 transition-colors" id="preset-double-paren">
                <div class="text-lg font-semibold">⸨  ⸩</div>
                <div class="text-xs text-gray-600">Double Paren</div>
            </button>
        </div>
    </div>
    
    <!-- Custom Brackets Input -->
    <div class="bg-gradient-to-r from-purple-50 to-pink-50 border-2 border-purple-300 rounded-lg p-4">
        <h4 class="text-sm font-semibold text-gray-900 mb-3">Custom Brackets</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Opening Bracket</label>
                <input 
                    type="text" 
                    id="customOpen" 
                    maxlength="3"
                    placeholder="e.g., ( or ** or ❤"
                    class="w-full px-3 py-2 border border-purple-300 rounded focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                    oninput="useCustomBrackets()"
                >
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-700 mb-1">Closing Bracket</label>
                <input 
                    type="text" 
                    id="customClose" 
                    maxlength="3"
                    placeholder="e.g., ) or ** or ❤"
                    class="w-full px-3 py-2 border border-purple-300 rounded focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                    oninput="useCustomBrackets()"
                >
            </div>
        </div>
        <p class="text-xs text-purple-700 mt-2">💡 Tip: You can use any characters, emojis, or symbols!</p>
    </div>
    
    <!-- Additional Options -->
    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="includeSpaces" class="w-5 h-5 text-blue-600 rounded focus:ring-2 focus:ring-blue-500" onchange="updateOptions()">
                <div class="ml-3">
                    <span class="text-sm font-semibold text-gray-900">Wrap Spaces</span>
                    <p class="text-xs text-gray-600">Add brackets around spaces too</p>
                </div>
            </label>
        </div>
        
        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="includeNumbers" class="w-5 h-5 text-green-600 rounded focus:ring-2 focus:ring-green-500" checked onchange="updateOptions()">
                <div class="ml-3">
                    <span class="text-sm font-semibold text-gray-900">Wrap Numbers</span>
                    <p class="text-xs text-gray-600">Add brackets around numbers</p>
                </div>
            </label>
        </div>
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="parenthesesText"
    inputPlaceholder="Type your text here..."
    outputPlaceholder="Text with parentheses will appear here..."
    downloadFileName="parentheses-text.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6 mt-4">
    This tool wraps each letter in parentheses for a unique decorative effect.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Example</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before</p>
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm text-gray-700">
                Hello 2025
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-base text-gray-900">
                ⒣⒠⒧⒧⒪ ⒉⒪⒉⒌
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
            <h4 class="font-semibold text-gray-900">Unique Style</h4>
        </div>
        <p class="text-sm text-gray-700">Decorative parenthesized letters</p>
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
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Parentheses Around Letters</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            <strong>Parentheses Around Letters</strong> wraps each character in decorative Unicode parentheses for unique, stylized text.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use</h3>
        <ol class="list-decimal list-inside space-y-1 ml-4">
            <li>Configure options (spaces, numbers)</li>
            <li>Type or paste text</li>
            <li>Each letter gets parentheses</li>
            <li>Copy or download results</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Where to Use</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Social Media:</strong> Unique post styling</li>
            <li><strong>Headers:</strong> Decorative titles</li>
            <li><strong>Art:</strong> Creative text designs</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Related Tools</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><a href="/special-effects/circled" class="text-blue-600 hover:underline">Circled Text</a> - Circled characters</li>
            <li><a href="/special-effects/bold" class="text-blue-600 hover:underline">Bold Text</a> - Bold Unicode</li>
        </ul>
        
        <p class="mt-6 text-sm text-gray-600 italic">
            Last updated: {{ date('F Y') }}.
        </p>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let currentOpenBracket = '(';
    let currentCloseBracket = ')';
    
    // Set bracket type from preset
    window.setBracketType = function(open, close) {
        currentOpenBracket = open;
        currentCloseBracket = close;
        
        // Update custom inputs to show current selection
        document.getElementById('customOpen').value = open;
        document.getElementById('customClose').value = close;
        
        // Update all preset button styles
        const allPresets = document.querySelectorAll('[id^="preset-"]');
        allPresets.forEach(btn => {
            btn.className = 'px-4 py-3 text-center border-2 border-gray-300 rounded-lg hover:bg-blue-50 hover:border-blue-500 transition-colors';
        });
        
        // Highlight the selected preset (find which button was clicked)
        const presetMap = {
            '()': 'preset-paren',
            '[]': 'preset-square',
            '{}': 'preset-curly',
            '<>': 'preset-angle',
            '«»': 'preset-guillemet',
            '⟨⟩': 'preset-math',
            '⦃⦄': 'preset-white',
            '⦗⦘': 'preset-double',
            '❨❩': 'preset-ornament',
            '⟦⟧': 'preset-bracket',
            '⦅⦆': 'preset-white-paren',
            '⸨⸩': 'preset-double-paren'
        };
        
        const key = open + close;
        if (presetMap[key]) {
            const selectedBtn = document.getElementById(presetMap[key]);
            if (selectedBtn) {
                selectedBtn.className = 'px-4 py-3 text-center border-2 border-blue-500 bg-blue-50 rounded-lg transition-colors';
            }
        }
        
        updateOptions();
    };
    
    // Use custom brackets from input
    window.useCustomBrackets = function() {
        const customOpen = document.getElementById('customOpen').value;
        const customClose = document.getElementById('customClose').value;
        
        if (customOpen || customClose) {
            currentOpenBracket = customOpen || '(';
            currentCloseBracket = customClose || ')';
            
            // Remove highlight from all presets when using custom
            const allPresets = document.querySelectorAll('[id^="preset-"]');
            allPresets.forEach(btn => {
                btn.className = 'px-4 py-3 text-center border-2 border-gray-300 rounded-lg hover:bg-blue-50 hover:border-blue-500 transition-colors';
            });
            
            updateOptions();
        }
    };
    
    function updateOptions() {
        const inputElement = document.getElementById('parenthesesText-input');
        if (inputElement && inputElement.value) {
            inputElement.dispatchEvent(new Event('input'));
        }
    }
    
    function convertToParentheses(text) {
        if (!text) return '';
        
        const includeSpaces = document.getElementById('includeSpaces')?.checked || false;
        const includeNumbers = document.getElementById('includeNumbers')?.checked || false;
        
        let result = '';
        
        for (let i = 0; i < text.length; i++) {
            const char = text[i];
            
            // Handle spaces
            if (char === ' ') {
                result += includeSpaces ? (currentOpenBracket + ' ' + currentCloseBracket) : ' ';
                continue;
            }
            
            // Handle numbers
            if (char >= '0' && char <= '9') {
                if (includeNumbers) {
                    result += currentOpenBracket + char + currentCloseBracket;
                } else {
                    result += char;
                }
                continue;
            }
            
            // Handle all other characters (letters, symbols, etc.)
            if (char.trim()) {  // Only wrap non-whitespace characters
                result += currentOpenBracket + char + currentCloseBracket;
            } else {
                result += char;  // Preserve other whitespace
            }
        }
        
        return result;
    }
    
    setParenthesesTextConverter(convertToParentheses);
    
    // Initialize with default parentheses
    document.addEventListener('DOMContentLoaded', function() {
        setBracketType('(', ')');
    });
</script>
@endpush
