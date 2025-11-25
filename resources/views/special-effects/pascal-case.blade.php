@extends('layouts.tool')

@section('title', 'Pascal Case Converter - WordFix')

@section('tool-title', 'Pascal Case Converter')

@section('tool-description', 'Convert text to PascalCase with customizable options - perfect for programming and naming')

@section('tool-content')
<!-- Configuration Options -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Configuration Options</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="removeSpaces" class="w-5 h-5 text-blue-600 rounded focus:ring-2 focus:ring-blue-500" checked onchange="updateOptions()">
                <div class="ml-3">
                    <span class="text-sm font-semibold text-gray-900">Remove Spaces</span>
                    <p class="text-xs text-gray-600">Join words together</p>
                </div>
            </label>
        </div>
        
        <div class="bg-green-50 border border-green-200 rounded-lg p-4">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="removeNumbers" class="w-5 h-5 text-green-600 rounded focus:ring-2 focus:ring-green-500" onchange="updateOptions()">
                <div class="ml-3">
                    <span class="text-sm font-semibold text-gray-900">Remove Numbers</span>
                    <p class="text-xs text-gray-600">Strip out digits</p>
                </div>
            </label>
        </div>
        
        <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="removeSpecial" class="w-5 h-5 text-purple-600 rounded focus:ring-2 focus:ring-purple-500" checked onchange="updateOptions()">
                <div class="ml-3">
                    <span class="text-sm font-semibold text-gray-900">Remove Special Chars</span>
                    <p class="text-xs text-gray-600">Remove @, #, -, _ etc</p>
                </div>
            </label>
        </div>
        
        <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="capitalizeAcronyms" class="w-5 h-5 text-yellow-600 rounded focus:ring-2 focus:ring-yellow-500" onchange="updateOptions()">
                <div class="ml-3">
                    <span class="text-sm font-semibold text-gray-900">Keep Acronyms</span>
                    <p class="text-xs text-gray-600">Preserve all caps: API, HTML</p>
                </div>
            </label>
        </div>
        
        <div class="bg-red-50 border border-red-200 rounded-lg p-4">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="preserveUnderscores" class="w-5 h-5 text-red-600 rounded focus:ring-2 focus:ring-red-500" onchange="updateOptions()">
                <div class="ml-3">
                    <span class="text-sm font-semibold text-gray-900">Keep Underscores</span>
                    <p class="text-xs text-gray-600">Don't remove _ characters</p>
                </div>
            </label>
        </div>
        
        <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-4">
            <label class="flex items-center cursor-pointer">
                <input type="checkbox" id="splitCamelCase" class="w-5 h-5 text-indigo-600 rounded focus:ring-2 focus:ring-indigo-500" onchange="updateOptions()">
                <div class="ml-3">
                    <span class="text-sm font-semibold text-gray-900">Split on Caps</span>
                    <p class="text-xs text-gray-600">thisText → This Text</p>
                </div>
            </label>
        </div>
    </div>
    
    <!-- Quick Presets -->
    <div class="mt-4">
        <p class="text-sm font-medium text-gray-700 mb-2">Quick Presets:</p>
        <div class="flex flex-wrap gap-2">
            <button onclick="setPreset('standard')" class="px-3 py-1.5 text-xs font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                Standard (Programming)
            </button>
            <button onclick="setPreset('strict')" class="px-3 py-1.5 text-xs font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                Strict (No Numbers/Special)
            </button>
            <button onclick="setPreset('preserve')" class="px-3 py-1.5 text-xs font-medium text-white bg-gray-600 rounded hover:bg-gray-700">
                Preserve (Keep All)
            </button>
            <button onclick="setPreset('reset')" class="px-3 py-1.5 text-xs font-medium text-gray-700 bg-white border border-gray-300 rounded hover:bg-gray-50">
                Reset
            </button>
        </div>
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="pascalCase"
    inputPlaceholder="Type your text here... e.g., hello world or user_name"
    outputPlaceholder="PascalCase text will appear here..."
    downloadFileName="pascal-case.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6 mt-4">
    PascalCase capitalizes the first letter of each word and removes spaces - commonly used in programming for class names and identifiers.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Examples</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Before</p>
            <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm text-gray-700 space-y-1">
                <div>hello world</div>
                <div>user_name</div>
                <div>api-response-handler</div>
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">After (PascalCase)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-900 space-y-1">
                <div>HelloWorld</div>
                <div>UserName</div>
                <div>ApiResponseHandler</div>
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
            <h4 class="font-semibold text-gray-900">Configurable</h4>
        </div>
        <p class="text-sm text-gray-700">6 customization options</p>
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
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
            </svg>
            <h4 class="font-semibold text-gray-900">Programming</h4>
        </div>
        <p class="text-sm text-gray-700">Perfect for code</p>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Pascal Case Converter</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            <strong>PascalCase</strong> (also called UpperCamelCase) capitalizes the first letter of each word and removes spaces between them. It's widely used in programming for class names, type names, and identifiers.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">What is PascalCase?</h3>
        <p>
            PascalCase is a naming convention where each word starts with a capital letter and all words are joined together with no spaces or separators. Examples: <code>UserAccount</code>, <code>HttpClient</code>, <code>DatabaseConnection</code>
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Configuration Options</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Remove Spaces:</strong> Join words together (default: on)</li>
            <li><strong>Remove Numbers:</strong> Strip out digits from text</li>
            <li><strong>Remove Special Chars:</strong> Remove @, #, -, etc (default: on)</li>
            <li><strong>Keep Acronyms:</strong> Preserve uppercase acronyms like API, HTML</li>
            <li><strong>Keep Underscores:</strong> Don't remove _ characters</li>
            <li><strong>Split on Caps:</strong> Split existing camelCase text first</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Uses</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Programming:</strong> Class names, type definitions, interfaces</li>
            <li><strong>C#/Java:</strong> Standard naming convention</li>
            <li><strong>TypeScript:</strong> Interface and type names</li>
            <li><strong>React:</strong> Component names</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Examples</h3>
        <div class="bg-gray-50 border border-gray-200 rounded p-3 text-sm space-y-1">
            <div><code>user account</code> → <code>UserAccount</code></div>
            <div><code>http_client</code> → <code>HttpClient</code></div>
            <div><code>api-response-handler</code> → <code>ApiResponseHandler</code></div>
            <div><code>data_base_connection</code> → <code>DataBaseConnection</code></div>
        </div>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">PascalCase vs camelCase</h3>
        <p>
            The difference is simple: PascalCase starts with a capital letter (<code>UserName</code>) while camelCase starts with lowercase (<code>userName</code>). Both capitalize subsequent words.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Related Tools</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><a href="/basic/title-case" class="text-blue-600 hover:underline">Title Case</a> - Capitalize each word</li>
            <li><a href="/basic/upper-case" class="text-blue-600 hover:underline">Upper Case</a> - ALL UPPERCASE</li>
            <li><a href="/basic/lower-case" class="text-blue-600 hover:underline">Lower Case</a> - all lowercase</li>
        </ul>
        
        <p class="mt-6 text-sm text-gray-600 italic">
            Last updated: {{ date('F Y') }}.
        </p>
    </div>
</article>
@endsection

@push('scripts')
<script>
    function updateOptions() {
        const inputElement = document.getElementById('pascalCase-input');
        if (inputElement && inputElement.value) {
            inputElement.dispatchEvent(new Event('input'));
        }
    }
    
    window.setPreset = function(preset) {
        const removeSpaces = document.getElementById('removeSpaces');
        const removeNumbers = document.getElementById('removeNumbers');
        const removeSpecial = document.getElementById('removeSpecial');
        const capitalizeAcronyms = document.getElementById('capitalizeAcronyms');
        const preserveUnderscores = document.getElementById('preserveUnderscores');
        const splitCamelCase = document.getElementById('splitCamelCase');
        
        if (preset === 'standard') {
            // Standard programming mode
            removeSpaces.checked = true;
            removeNumbers.checked = false;
            removeSpecial.checked = true;
            capitalizeAcronyms.checked = false;
            preserveUnderscores.checked = false;
            splitCamelCase.checked = false;
        } else if (preset === 'strict') {
            // Strict mode - only letters
            removeSpaces.checked = true;
            removeNumbers.checked = true;
            removeSpecial.checked = true;
            capitalizeAcronyms.checked = false;
            preserveUnderscores.checked = false;
            splitCamelCase.checked = false;
        } else if (preset === 'preserve') {
            // Preserve mode - keep everything
            removeSpaces.checked = true;
            removeNumbers.checked = false;
            removeSpecial.checked = false;
            capitalizeAcronyms.checked = true;
            preserveUnderscores.checked = true;
            splitCamelCase.checked = false;
        } else if (preset === 'reset') {
            // Reset to defaults
            removeSpaces.checked = true;
            removeNumbers.checked = false;
            removeSpecial.checked = true;
            capitalizeAcronyms.checked = false;
            preserveUnderscores.checked = false;
            splitCamelCase.checked = false;
        }
        
        updateOptions();
    };
    
    function convertToPascalCase(text) {
        if (!text) return '';
        
        // Get options
        const removeSpaces = document.getElementById('removeSpaces')?.checked ?? true;
        const removeNumbers = document.getElementById('removeNumbers')?.checked ?? false;
        const removeSpecial = document.getElementById('removeSpecial')?.checked ?? true;
        const capitalizeAcronyms = document.getElementById('capitalizeAcronyms')?.checked ?? false;
        const preserveUnderscores = document.getElementById('preserveUnderscores')?.checked ?? false;
        const splitCamelCase = document.getElementById('splitCamelCase')?.checked ?? false;
        
        let result = text;
        
        // Step 1: Split on capital letters if splitCamelCase is enabled
        if (splitCamelCase) {
            result = result.replace(/([a-z])([A-Z])/g, '$1 $2');
        }
        
        // Step 2: Replace special characters with spaces (unless preserving)
        if (removeSpecial) {
            if (preserveUnderscores) {
                // Replace everything except underscores
                result = result.replace(/[^a-zA-Z0-9_\s]/g, ' ');
            } else {
                // Replace all special characters including underscores
                result = result.replace(/[^a-zA-Z0-9\s]/g, ' ');
            }
        } else {
            // Only replace common separators
            result = result.replace(/[-_]/g, ' ');
        }
        
        // Step 3: Remove numbers if requested
        if (removeNumbers) {
            result = result.replace(/[0-9]/g, '');
        }
        
        // Step 4: Split into words
        let words = result.split(/\s+/).filter(word => word.length > 0);
        
        // Step 5: Capitalize each word
        words = words.map(word => {
            // Check if word is all uppercase (acronym) and preserve if requested
            if (capitalizeAcronyms && word === word.toUpperCase() && word.length > 1) {
                return word; // Keep acronym as-is
            }
            
            // Normal capitalization
            return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
        });
        
        // Step 6: Join words
        result = removeSpaces ? words.join('') : words.join(' ');
        
        return result;
    }
    
    setPascalCaseConverter(convertToPascalCase);
    
    // Initialize with standard preset
    document.addEventListener('DOMContentLoaded', function() {
        setPreset('standard');
    });
</script>
@endpush
