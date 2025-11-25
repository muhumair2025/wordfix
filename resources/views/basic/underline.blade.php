@extends('layouts.tool')

@section('title', 'Underline Text - WordFix')

@section('tool-title', 'Underline Text Tool')

@section('tool-description', '')

@section('tool-content')
<!-- Custom Text Converter with Div Output -->
<div class="text-converter-wrapper">
    <!-- Textareas Grid - Mobile Responsive -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
        <!-- Input Section -->
        <div>
            <textarea 
                id="underline-input"
                class="w-full h-64 p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none text-sm"
                placeholder="Type or paste your content here"
            ></textarea>
            <!-- Input Buttons -->
            <div class="flex flex-wrap gap-2 mt-3">
                <button 
                    onclick="underlineImportFile()" 
                    class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors"
                >
                    Import From File
                </button>
                <button 
                    onclick="underlineClear()" 
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
                    <span id="underline-charCount-mobile">0</span>
                </div>
                <div>
                    <span class="font-medium">Character Count (without spaces):</span>
                    <span id="underline-charCountNoSpace-mobile">0</span>
                </div>
                <div>
                    <span class="font-medium">Word Count:</span>
                    <span id="underline-wordCount-mobile">0</span>
                </div>
                <div>
                    <span class="font-medium">Sentence Count:</span>
                    <span id="underline-sentenceCount-mobile">0</span>
                </div>
                <div>
                    <span class="font-medium">Paragraph Count:</span>
                    <span id="underline-paragraphCount-mobile">0</span>
                </div>
                <div>
                    <span class="font-medium">Line Count:</span>
                    <span id="underline-lineCount-mobile">0</span>
                </div>
            </div>
        </div>
        
        <!-- Output Section - DIV instead of textarea -->
        <div>
            <div 
                id="underline-output"
                class="w-full h-64 p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm bg-gray-50 overflow-auto whitespace-pre-wrap break-words text-gray-400"
                style="cursor: text; font-family: Arial, Helvetica, 'Segoe UI', sans-serif; line-height: 1.6;"
                data-placeholder="U̲n̲d̲e̲r̲l̲i̲n̲e̲d̲ text will appear here"
            ></div>
            <!-- Output Buttons -->
            <div class="flex flex-wrap gap-2 mt-3">
                <button 
                    onclick="underlineCopy()" 
                    class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors"
                >
                    Copy Results
                </button>
                <button 
                    onclick="underlineClearOutput()" 
                    class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors"
                >
                    Clear
                </button>
                <button 
                    onclick="underlineDownload()" 
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
                <span id="underline-charCount">0</span>
            </div>
            <div>
                <span class="font-medium">Character Count (without spaces):</span>
                <span id="underline-charCountNoSpace">0</span>
            </div>
            <div>
                <span class="font-medium">Word Count:</span>
                <span id="underline-wordCount">0</span>
            </div>
            <div>
                <span class="font-medium">Sentence Count:</span>
                <span id="underline-sentenceCount">0</span>
            </div>
            <div>
                <span class="font-medium">Paragraph Count:</span>
                <span id="underline-paragraphCount">0</span>
            </div>
            <div>
                <span class="font-medium">Line Count:</span>
                <span id="underline-lineCount">0</span>
            </div>
        </div>
    </div>
</div>

<div class="text-sm text-blue-600 mb-6">
    This tool adds an underline beneath your text using Unicode combining characters.
</div>

<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Underline Text Example</h3>
    <div class="mb-3">
        <p class="text-sm font-medium text-gray-700 mb-2">Before</p>
        <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">This is normal text</div>
    </div>
    <div>
        <p class="text-sm font-medium text-gray-700 mb-2">After</p>
        <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">T̲h̲i̲s̲ ̲i̲s̲ ̲u̲n̲d̲e̲r̲l̲i̲n̲e̲d̲ ̲t̲e̲x̲t̲</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Underline Text Generator</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>underline text generator</strong> adds an underline beneath your text using Unicode combining characters. This creates genuinely underlined text that works across social media platforms, messaging apps, and websites without requiring HTML or special formatting.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">What is Underlined Text?</h3>
        <p>
            Underlined text features a horizontal line running beneath the characters. Traditionally used for emphasis, hyperlinks, and document titles, underlined text helps draw attention to important information and create visual hierarchy in your content.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use the Underline Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Enter your text in the input field</li>
            <li>The tool automatically adds underline formatting</li>
            <li>Copy the underlined text from the output</li>
            <li>Paste it anywhere that supports Unicode</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Popular Uses for Underlined Text</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Social Media:</strong> Make posts stand out on Facebook, Twitter/X, Instagram</li>
            <li><strong>Emphasis:</strong> Highlight important words or phrases</li>
            <li><strong>Headings:</strong> Create distinct section headers</li>
            <li><strong>Messaging:</strong> Add emphasis in WhatsApp, Discord, Telegram</li>
            <li><strong>Bios:</strong> Create unique profile descriptions</li>
            <li><strong>Captions:</strong> Make photo captions more engaging</li>
            <li><strong>Announcements:</strong> Draw attention to important updates</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Platform Compatibility</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>✅ Facebook posts, comments, and messages</li>
            <li>✅ Twitter/X tweets and direct messages</li>
            <li>✅ Instagram captions, bios, and comments</li>
            <li>✅ WhatsApp messages and status</li>
            <li>✅ Discord channels and DMs</li>
            <li>✅ Telegram messages and channels</li>
            <li>✅ Reddit posts and comments</li>
            <li>✅ Email and text messages</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Technical Details</h3>
        <p>
            Our underline tool uses Unicode combining low line character (U+0332) to create the underline effect. This is a standardized Unicode character that works across different devices and platforms, ensuring your underlined text displays consistently.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Best Practices</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Use underlines sparingly for maximum impact</li>
            <li>Combine with other text styles for emphasis</li>
            <li>Perfect for short, important phrases</li>
            <li>Test on your target platform before posting</li>
            <li>Avoid overuse to maintain readability</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Creative Applications</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Create eye-catching social media usernames</li>
            <li>Design unique email signatures</li>
            <li>Emphasize call-to-action phrases</li>
            <li>Highlight special offers and promotions</li>
            <li>Create distinctive profile bios</li>
            <li>Format educational content for clarity</li>
        </ul>
        
        <div class="bg-blue-50 border-l-4 border-blue-600 p-4 mt-6">
            <p class="text-blue-900">
                <strong>Fun Fact:</strong> You can combine underline with other Unicode formatting like bold or italic for even more creative text effects!
            </p>
        </div>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Frequently Asked Questions</h3>
        
        <div class="space-y-4">
            <div>
                <h4 class="font-semibold text-gray-900">Does underlined text work on mobile devices?</h4>
                <p class="text-gray-700">Yes! Underlined text created with Unicode works on all modern smartphones and tablets.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900">Can I underline emojis?</h4>
                <p class="text-gray-700">Yes, our tool can add underlines to most Unicode characters, including emojis.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900">Is this different from HTML underline?</h4>
                <p class="text-gray-700">Yes! This uses Unicode characters that work in plain text anywhere, while HTML underline only works on web pages.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900">Will screen readers recognize underlined text?</h4>
                <p class="text-gray-700">Most modern screen readers will read the text normally, treating the underline as a visual decoration.</p>
            </div>
        </div>
        
        <p class="mt-6 text-sm text-gray-600 italic">
            Last updated: {{ date('F Y') }}. Create beautiful underlined text with our free Unicode-based tool.
        </p>
    </div>
</article>
@endsection

@push('scripts')
<script>
(function() {
    const inputText = document.getElementById('underline-input');
    const outputDiv = document.getElementById('underline-output');
    
    // Conversion function
    function convertToUnderline(text) {
        return text.split('').map(char => char + '\u0332').join('');
    }
    
    // Main conversion
    function convert() {
        if (inputText && outputDiv) {
            const converted = convertToUnderline(inputText.value);
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
        const charCount = document.getElementById('underline-charCount');
        if (charCount) charCount.textContent = charCountValue;
        
        const charCountNoSpace = document.getElementById('underline-charCountNoSpace');
        if (charCountNoSpace) charCountNoSpace.textContent = charCountNoSpaceValue;
        
        const wordCount = document.getElementById('underline-wordCount');
        if (wordCount) wordCount.textContent = wordCountValue;
        
        const sentenceCount = document.getElementById('underline-sentenceCount');
        if (sentenceCount) sentenceCount.textContent = sentenceCountValue;
        
        const paragraphCount = document.getElementById('underline-paragraphCount');
        if (paragraphCount) paragraphCount.textContent = paragraphCountValue;
        
        const lineCount = document.getElementById('underline-lineCount');
        if (lineCount) lineCount.textContent = lineCountValue;
        
        // Update mobile stats
        const charCountMobile = document.getElementById('underline-charCount-mobile');
        if (charCountMobile) charCountMobile.textContent = charCountValue;
        
        const charCountNoSpaceMobile = document.getElementById('underline-charCountNoSpace-mobile');
        if (charCountNoSpaceMobile) charCountNoSpaceMobile.textContent = charCountNoSpaceValue;
        
        const wordCountMobile = document.getElementById('underline-wordCount-mobile');
        if (wordCountMobile) wordCountMobile.textContent = wordCountValue;
        
        const sentenceCountMobile = document.getElementById('underline-sentenceCount-mobile');
        if (sentenceCountMobile) sentenceCountMobile.textContent = sentenceCountValue;
        
        const paragraphCountMobile = document.getElementById('underline-paragraphCount-mobile');
        if (paragraphCountMobile) paragraphCountMobile.textContent = paragraphCountValue;
        
        const lineCountMobile = document.getElementById('underline-lineCount-mobile');
        if (lineCountMobile) lineCountMobile.textContent = lineCountValue;
    }
    
    // Global functions for buttons
    window.underlineImportFile = function() {
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
    
    window.underlineCopy = function() {
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
    
    window.underlineDownload = function() {
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
        a.download = 'underline-text.txt';
        a.click();
        URL.revokeObjectURL(url);
        showToast('File downloaded successfully!', 'success');
    };
    
    window.underlineClear = function() {
        inputText.value = '';
        outputDiv.textContent = outputDiv.getAttribute('data-placeholder');
        outputDiv.classList.remove('text-gray-900');
        outputDiv.classList.add('text-gray-400');
        updateStats();
    };
    
    window.underlineClearOutput = function() {
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

