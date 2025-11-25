@extends('layouts.tool')

@section('title', 'Strikethrough Text - WordFix')

@section('tool-title', 'Strikethrough Text Tool')

@section('tool-description', '')

@section('tool-content')
<!-- Custom Text Converter with Div Output -->
<div class="text-converter-wrapper">
    <!-- Textareas Grid - Mobile Responsive -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
        <!-- Input Section -->
        <div>
            <textarea 
                id="strikethrough-input"
                class="w-full h-64 p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none text-sm"
                placeholder="Type or paste your content here"
            ></textarea>
            <!-- Input Buttons -->
            <div class="flex flex-wrap gap-2 mt-3">
                <button 
                    onclick="strikethroughImportFile()" 
                    class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors"
                >
                    Import From File
                </button>
                <button 
                    onclick="strikethroughClear()" 
                    class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors"
                >
                    Clear
                </button>
            </div>
        </div>

        <!-- Stats Section - Shows between textareas on mobile, hidden on desktop -->
        <div class="lg:hidden border-t border-gray-200 pt-4 pb-4">
            <div class="flex flex-wrap gap-4 text-xs text-gray-600">
                <div><span class="font-medium">Stats:</span></div>
                <div>
                    <span class="font-medium">Character Count:</span>
                    <span id="strikethrough-charCount-mobile">0</span>
                </div>
                <div>
                    <span class="font-medium">Character Count (without spaces):</span>
                    <span id="strikethrough-charCountNoSpace-mobile">0</span>
                </div>
                <div>
                    <span class="font-medium">Word Count:</span>
                    <span id="strikethrough-wordCount-mobile">0</span>
                </div>
                <div>
                    <span class="font-medium">Sentence Count:</span>
                    <span id="strikethrough-sentenceCount-mobile">0</span>
                </div>
                <div>
                    <span class="font-medium">Paragraph Count:</span>
                    <span id="strikethrough-paragraphCount-mobile">0</span>
                </div>
                <div>
                    <span class="font-medium">Line Count:</span>
                    <span id="strikethrough-lineCount-mobile">0</span>
                </div>
            </div>
        </div>
        
        <!-- Output Section - DIV instead of textarea -->
        <div>
            <div 
                id="strikethrough-output"
                class="w-full h-64 p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm bg-gray-50 overflow-auto whitespace-pre-wrap break-words text-gray-400"
                style="cursor: text; font-family: Arial, Helvetica, 'Segoe UI', sans-serif; line-height: 1.6;"
                data-placeholder="S̶t̶r̶i̶k̶e̶t̶h̶r̶o̶u̶g̶h̶ text will appear here"
            ></div>
            <!-- Output Buttons -->
            <div class="flex flex-wrap gap-2 mt-3">
                <button 
                    onclick="strikethroughCopy()" 
                    class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors"
                >
                    Copy Results
                </button>
                <button 
                    onclick="strikethroughClearOutput()" 
                    class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors"
                >
                    Clear
                </button>
                <button 
                    onclick="strikethroughDownload()" 
                    class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors"
                >
                    Download
                </button>
            </div>
        </div>
    </div>

    <!-- Stats Section - Shows after textareas on desktop, hidden on mobile -->
    <div class="hidden lg:block border-t border-gray-200 pt-4 mb-6">
        <div class="flex flex-wrap gap-4 text-xs text-gray-600">
            <div><span class="font-medium">Stats:</span></div>
            <div>
                <span class="font-medium">Character Count:</span>
                <span id="strikethrough-charCount">0</span>
            </div>
            <div>
                <span class="font-medium">Character Count (without spaces):</span>
                <span id="strikethrough-charCountNoSpace">0</span>
            </div>
            <div>
                <span class="font-medium">Word Count:</span>
                <span id="strikethrough-wordCount">0</span>
            </div>
            <div>
                <span class="font-medium">Sentence Count:</span>
                <span id="strikethrough-sentenceCount">0</span>
            </div>
            <div>
                <span class="font-medium">Paragraph Count:</span>
                <span id="strikethrough-paragraphCount">0</span>
            </div>
            <div>
                <span class="font-medium">Line Count:</span>
                <span id="strikethrough-lineCount">0</span>
            </div>
        </div>
    </div>
</div>

<div class="text-sm text-blue-600 mb-6">
    This tool adds a strikethrough line through your text using Unicode characters.
</div>

<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Strikethrough Text Example</h3>
    <div class="mb-3">
        <p class="text-sm font-medium text-gray-700 mb-2">Before</p>
        <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">This is normal text</div>
    </div>
    <div>
        <p class="text-sm font-medium text-gray-700 mb-2">After</p>
        <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">T̶h̶i̶s̶ ̶i̶s̶ ̶s̶t̶r̶i̶k̶e̶t̶h̶r̶o̶u̶g̶h̶ ̶t̶e̶x̶t̶</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Strikethrough Text Generator</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>strikethrough text generator</strong> adds a line through your text using Unicode combining characters. This creates text with a strikethrough effect that works on social media, messaging apps, and most websites.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">What is Strikethrough Text?</h3>
        <p>
            Strikethrough text displays with a horizontal line running through the middle of the characters. It's commonly used to indicate deleted content, completed tasks, outdated information, or to create a stylistic effect in digital communication.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use the Strikethrough Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Type or paste your text in the input box</li>
            <li>The tool automatically applies strikethrough formatting</li>
            <li>Copy the strikethrough text from the output</li>
            <li>Paste anywhere that supports Unicode text</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Popular Uses for Strikethrough Text</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Social Media:</strong> Facebook, Twitter/X, Instagram posts and comments</li>
            <li><strong>Messaging Apps:</strong> WhatsApp, Discord, Slack, Telegram</li>
            <li><strong>Todo Lists:</strong> Mark completed tasks visually</li>
            <li><strong>Price Comparisons:</strong> Show original vs sale prices</li>
            <li><strong>Corrections:</strong> Indicate edited or updated information</li>
            <li><strong>Humor:</strong> Create comedic effect by "crossing out" text</li>
            <li><strong>Creative Writing:</strong> Show character thoughts or corrections</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Where Does Strikethrough Work?</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>✅ Facebook posts and comments</li>
            <li>✅ Twitter/X tweets and replies</li>
            <li>✅ Instagram bios and comments</li>
            <li>✅ WhatsApp messages</li>
            <li>✅ Discord chat and usernames</li>
            <li>✅ Reddit posts and comments</li>
            <li>✅ Email clients (most)</li>
            <li>✅ Text messages (SMS/iMessage)</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How Does It Work?</h3>
        <p>
            Our tool uses Unicode combining characters (specifically U+0336) to add a strikethrough line to each character. This creates genuine strikethrough text that's part of the Unicode standard and works across platforms without requiring special formatting or HTML.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Creative Applications</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Show "before and after" comparisons</li>
            <li>Create playful or sarcastic posts</li>
            <li>Highlight mistakes in a humorous way</li>
            <li>Design unique profile bios</li>
            <li>Create visual emphasis in text</li>
            <li>Make attention-grabbing headlines</li>
        </ul>
        
        <div class="bg-blue-50 border-l-4 border-blue-600 p-4 mt-6">
            <p class="text-blue-900">
                <strong>Pro Tip:</strong> Combine strikethrough with regular text for powerful visual effects like showing price reductions or corrections!
            </p>
        </div>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Frequently Asked Questions</h3>
        
        <div class="space-y-4">
            <div>
                <h4 class="font-semibold text-gray-900">Will strikethrough text work on all platforms?</h4>
                <p class="text-gray-700">It works on most platforms that support Unicode text, including major social media sites and messaging apps.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900">Can I remove strikethrough formatting?</h4>
                <p class="text-gray-700">Yes, simply copy the original text without the Unicode combining characters, or use our tool in reverse.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900">Is this different from HTML strikethrough?</h4>
                <p class="text-gray-700">Yes! This uses Unicode characters that work in plain text, while HTML strikethrough only works on web pages.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900">Can I use strikethrough in my username?</h4>
                <p class="text-gray-700">It depends on the platform. Some allow Unicode in usernames, while others restrict special characters.</p>
            </div>
        </div>
        
        <p class="mt-6 text-sm text-gray-600 italic">
            Last updated: {{ date('F Y') }}. Create strikethrough text that works everywhere with our free tool.
        </p>
    </div>
</article>
@endsection

@push('scripts')
<script>
(function() {
    const inputText = document.getElementById('strikethrough-input');
    const outputDiv = document.getElementById('strikethrough-output');
    
    // Conversion function
    function convertToStrikethrough(text) {
        return text.split('').map(char => char + '\u0336').join('');
    }
    
    // Main conversion
    function convert() {
        if (inputText && outputDiv) {
            const converted = convertToStrikethrough(inputText.value);
            if (converted) {
                outputDiv.textContent = converted;
                outputDiv.classList.remove('text-gray-400');
                outputDiv.classList.add('text-gray-900');
            } else {
                outputDiv.textContent = outputDiv.getAttribute('data-placeholder');
                outputDiv.classList.remove('text-gray-900');
                outputDiv.classList.add('text-gray-400');
            }
            updateStats();
        }
    }
    
    // Event listeners
    if (inputText) {
        inputText.addEventListener('input', convert);
        inputText.addEventListener('paste', function() {
            setTimeout(convert, 10);
        });
    }
    
    // Update statistics
    function updateStats() {
        const text = inputText.value;
        
        // Calculate all stats
        const charCountValue = text.length;
        const charCountNoSpaceValue = text.replace(/\s/g, '').length;
        const words = text.trim().split(/\s+/).filter(word => word.length > 0);
        const wordCountValue = text.trim().length === 0 ? 0 : words.length;
        const sentences = text.split(/[.!?]+/).filter(s => s.trim().length > 0);
        const sentenceCountValue = sentences.length;
        const paragraphs = text.split(/\n\n+/).filter(p => p.trim().length > 0);
        const paragraphCountValue = text.trim().length === 0 ? 0 : Math.max(paragraphs.length, 1);
        const lineCountValue = text.split('\n').length;
        
        // Update desktop stats
        const charCount = document.getElementById('strikethrough-charCount');
        if (charCount) charCount.textContent = charCountValue;
        
        const charCountNoSpace = document.getElementById('strikethrough-charCountNoSpace');
        if (charCountNoSpace) charCountNoSpace.textContent = charCountNoSpaceValue;
        
        const wordCount = document.getElementById('strikethrough-wordCount');
        if (wordCount) wordCount.textContent = wordCountValue;
        
        const sentenceCount = document.getElementById('strikethrough-sentenceCount');
        if (sentenceCount) sentenceCount.textContent = sentenceCountValue;
        
        const paragraphCount = document.getElementById('strikethrough-paragraphCount');
        if (paragraphCount) paragraphCount.textContent = paragraphCountValue;
        
        const lineCount = document.getElementById('strikethrough-lineCount');
        if (lineCount) lineCount.textContent = lineCountValue;
        
        // Update mobile stats
        const charCountMobile = document.getElementById('strikethrough-charCount-mobile');
        if (charCountMobile) charCountMobile.textContent = charCountValue;
        
        const charCountNoSpaceMobile = document.getElementById('strikethrough-charCountNoSpace-mobile');
        if (charCountNoSpaceMobile) charCountNoSpaceMobile.textContent = charCountNoSpaceValue;
        
        const wordCountMobile = document.getElementById('strikethrough-wordCount-mobile');
        if (wordCountMobile) wordCountMobile.textContent = wordCountValue;
        
        const sentenceCountMobile = document.getElementById('strikethrough-sentenceCount-mobile');
        if (sentenceCountMobile) sentenceCountMobile.textContent = sentenceCountValue;
        
        const paragraphCountMobile = document.getElementById('strikethrough-paragraphCount-mobile');
        if (paragraphCountMobile) paragraphCountMobile.textContent = paragraphCountValue;
        
        const lineCountMobile = document.getElementById('strikethrough-lineCount-mobile');
        if (lineCountMobile) lineCountMobile.textContent = lineCountValue;
    }
    
    // Global functions for buttons
    window.strikethroughImportFile = function() {
        const input = document.createElement('input');
        input.type = 'file';
        input.accept = '.txt';
        input.onchange = function(e) {
            const file = e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function(event) {
                inputText.value = event.target.result;
                convert();
                showToast('File imported successfully!', 'success');
            };
            reader.onerror = function() {
                showToast('Error reading file!', 'error');
            };
            reader.readAsText(file);
        };
        input.click();
    };
    
    window.strikethroughCopy = function() {
        const text = outputDiv.textContent;
        const placeholder = outputDiv.getAttribute('data-placeholder');
        if (!text || text === placeholder || outputDiv.classList.contains('text-gray-400')) {
            showToast('No text to copy!', 'error');
            return;
        }
        
        // Try modern clipboard API first
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(text).then(() => {
                showToast('Text copied to clipboard!', 'success');
            }).catch(() => {
                // Fallback to old method
                fallbackCopy(text);
            });
        } else {
            // Fallback for older browsers
            fallbackCopy(text);
        }
    };
    
    function fallbackCopy(text) {
        const textArea = document.createElement('textarea');
        textArea.value = text;
        textArea.style.position = 'fixed';
        textArea.style.left = '-9999px';
        document.body.appendChild(textArea);
        textArea.select();
        try {
            document.execCommand('copy');
            showToast('Text copied to clipboard!', 'success');
        } catch (err) {
            showToast('Failed to copy text!', 'error');
        }
        document.body.removeChild(textArea);
    }
    
    window.strikethroughDownload = function() {
        const text = outputDiv.textContent;
        const placeholder = outputDiv.getAttribute('data-placeholder');
        if (!text || text === placeholder || outputDiv.classList.contains('text-gray-400')) {
            showToast('No text to download!', 'error');
            return;
        }
        const blob = new Blob([text], { type: 'text/plain' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'strikethrough-text.txt';
        a.click();
        URL.revokeObjectURL(url);
        showToast('File downloaded successfully!', 'success');
    };
    
    window.strikethroughClear = function() {
        inputText.value = '';
        outputDiv.textContent = outputDiv.getAttribute('data-placeholder');
        outputDiv.classList.remove('text-gray-900');
        outputDiv.classList.add('text-gray-400');
        updateStats();
    };
    
    window.strikethroughClearOutput = function() {
        outputDiv.textContent = outputDiv.getAttribute('data-placeholder');
        outputDiv.classList.remove('text-gray-900');
        outputDiv.classList.add('text-gray-400');
    };
    
    // Toast notification function
    function showToast(message, type = 'success') {
        const toast = document.createElement('div');
        const bgColor = type === 'success' ? 'bg-green-500' : 'bg-red-500';
        toast.className = `fixed bottom-6 left-1/2 transform -translate-x-1/2 ${bgColor} text-white px-6 py-3 rounded shadow-lg text-sm z-50 animate-fade-in`;
        toast.style.minWidth = '250px';
        toast.style.textAlign = 'center';
        toast.textContent = message;
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.classList.remove('animate-fade-in');
            toast.classList.add('animate-fade-out');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    }
    
    // Initialize
    outputDiv.textContent = outputDiv.getAttribute('data-placeholder');
    updateStats();
})();
</script>

<style>
@keyframes fade-in {
    from { 
        opacity: 0; 
        transform: translate(-50%, 10px);
    }
    to { 
        opacity: 1; 
        transform: translate(-50%, 0);
    }
}
@keyframes fade-out {
    from { 
        opacity: 1; 
        transform: translate(-50%, 0);
    }
    to { 
        opacity: 0; 
        transform: translate(-50%, 10px);
    }
}
.animate-fade-in { 
    animation: fade-in 0.3s ease-out forwards;
}
.animate-fade-out { 
    animation: fade-out 0.3s ease-out forwards;
}
</style>
@endpush

