@props([
    'toolId' => 'textConverter',
    'inputPlaceholder' => 'Type or paste your content here',
    'outputPlaceholder' => 'Converted text will appear here',
    'showStats' => true,
    'downloadFileName' => 'converted-text.txt'
])

<div class="text-converter-wrapper">
    <!-- Textareas Grid - Mobile Responsive -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
        <!-- Input Section -->
        <div>
            <textarea 
                id="{{ $toolId }}-input"
                class="w-full h-64 p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none text-sm"
                placeholder="{{ $inputPlaceholder }}"
            ></textarea>
            <!-- Input Buttons - Compact Icons -->
            <div class="flex flex-wrap gap-1.5 mt-2">
                <button 
                    onclick="{{ $toolId }}ImportFile()" 
                    title="Import From File"
                    class="w-8 h-8 flex items-center justify-center bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                    </svg>
                </button>
                <button 
                    onclick="{{ $toolId }}Clear()" 
                    title="Clear"
                    class="w-8 h-8 flex items-center justify-center bg-red-600 text-white rounded hover:bg-red-700 transition-colors"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </div>
        </div>

        @if($showStats)
        <!-- Stats Section - Compact Mobile View -->
        <div class="lg:hidden border-t border-gray-200 pt-3 pb-3">
            <div class="grid grid-cols-2 gap-x-3 gap-y-1.5 text-xs text-gray-600">
                <div><span class="font-medium text-gray-700">Chars:</span> <span id="{{ $toolId }}-charCount-mobile">0</span></div>
                <div><span class="font-medium text-gray-700">Chars (no space):</span> <span id="{{ $toolId }}-charCountNoSpace-mobile">0</span></div>
                <div><span class="font-medium text-gray-700">Words:</span> <span id="{{ $toolId }}-wordCount-mobile">0</span></div>
                <div><span class="font-medium text-gray-700">Sentences:</span> <span id="{{ $toolId }}-sentenceCount-mobile">0</span></div>
                <div><span class="font-medium text-gray-700">Paragraphs:</span> <span id="{{ $toolId }}-paragraphCount-mobile">0</span></div>
                <div><span class="font-medium text-gray-700">Lines:</span> <span id="{{ $toolId }}-lineCount-mobile">0</span></div>
            </div>
        </div>
        @endif
        
        <!-- Output Section -->
        <div>
            <textarea 
                id="{{ $toolId }}-output"
                class="w-full h-64 p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none text-sm bg-gray-50"
                placeholder="{{ $outputPlaceholder }}"
                readonly
            ></textarea>
            <!-- Output Buttons - Compact Icons -->
            <div class="flex flex-wrap gap-1.5 mt-2">
                <button 
                    onclick="{{ $toolId }}Copy()" 
                    title="Copy Results"
                    class="w-8 h-8 flex items-center justify-center bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                </button>
                <button 
                    onclick="{{ $toolId }}ClearOutput()" 
                    title="Clear"
                    class="w-8 h-8 flex items-center justify-center bg-red-600 text-white rounded hover:bg-red-700 transition-colors"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
                <button 
                    onclick="{{ $toolId }}Download()" 
                    title="Download"
                    class="w-8 h-8 flex items-center justify-center bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    @if($showStats)
    <!-- Stats Section - Compact Desktop View -->
    <div class="hidden lg:block border-t border-gray-200 pt-3 mb-4">
        <div class="flex flex-wrap gap-3 text-xs text-gray-600">
            <div><span class="font-medium text-gray-700">Chars:</span> <span id="{{ $toolId }}-charCount">0</span></div>
            <div><span class="font-medium text-gray-700">Chars (no space):</span> <span id="{{ $toolId }}-charCountNoSpace">0</span></div>
            <div><span class="font-medium text-gray-700">Words:</span> <span id="{{ $toolId }}-wordCount">0</span></div>
            <div><span class="font-medium text-gray-700">Sentences:</span> <span id="{{ $toolId }}-sentenceCount">0</span></div>
            <div><span class="font-medium text-gray-700">Paragraphs:</span> <span id="{{ $toolId }}-paragraphCount">0</span></div>
            <div><span class="font-medium text-gray-700">Lines:</span> <span id="{{ $toolId }}-lineCount">0</span></div>
        </div>
    </div>
    @endif
</div>

<script>
(function() {
    const toolId = '{{ $toolId }}';
    const inputText = document.getElementById(toolId + '-input');
    const outputText = document.getElementById(toolId + '-output');
    const downloadFileName = '{{ $downloadFileName }}';
    
    // Conversion function (will be set from parent)
    let conversionFunction = (text) => text;
    
    // Set conversion function globally
    window['set' + toolId.charAt(0).toUpperCase() + toolId.slice(1) + 'Converter'] = function(fn) {
        conversionFunction = fn;
    };
    
    // Main conversion
    function convert() {
        if (inputText && outputText && typeof conversionFunction === 'function') {
            outputText.value = conversionFunction(inputText.value);
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
        @if($showStats)
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
        const charCount = document.getElementById(toolId + '-charCount');
        if (charCount) charCount.textContent = charCountValue;
        
        const charCountNoSpace = document.getElementById(toolId + '-charCountNoSpace');
        if (charCountNoSpace) charCountNoSpace.textContent = charCountNoSpaceValue;
        
        const wordCount = document.getElementById(toolId + '-wordCount');
        if (wordCount) wordCount.textContent = wordCountValue;
        
        const sentenceCount = document.getElementById(toolId + '-sentenceCount');
        if (sentenceCount) sentenceCount.textContent = sentenceCountValue;
        
        const paragraphCount = document.getElementById(toolId + '-paragraphCount');
        if (paragraphCount) paragraphCount.textContent = paragraphCountValue;
        
        const lineCount = document.getElementById(toolId + '-lineCount');
        if (lineCount) lineCount.textContent = lineCountValue;
        
        // Update mobile stats
        const charCountMobile = document.getElementById(toolId + '-charCount-mobile');
        if (charCountMobile) charCountMobile.textContent = charCountValue;
        
        const charCountNoSpaceMobile = document.getElementById(toolId + '-charCountNoSpace-mobile');
        if (charCountNoSpaceMobile) charCountNoSpaceMobile.textContent = charCountNoSpaceValue;
        
        const wordCountMobile = document.getElementById(toolId + '-wordCount-mobile');
        if (wordCountMobile) wordCountMobile.textContent = wordCountValue;
        
        const sentenceCountMobile = document.getElementById(toolId + '-sentenceCount-mobile');
        if (sentenceCountMobile) sentenceCountMobile.textContent = sentenceCountValue;
        
        const paragraphCountMobile = document.getElementById(toolId + '-paragraphCount-mobile');
        if (paragraphCountMobile) paragraphCountMobile.textContent = paragraphCountValue;
        
        const lineCountMobile = document.getElementById(toolId + '-lineCount-mobile');
        if (lineCountMobile) lineCountMobile.textContent = lineCountValue;
        @endif
    }
    
    // Global functions for buttons
    window[toolId + 'ImportFile'] = function() {
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
    
    window[toolId + 'Copy'] = function() {
        if (!outputText.value) {
            showToast('No text to copy!', 'error');
            return;
        }
        
        // Try modern clipboard API first
        if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(outputText.value).then(() => {
                showToast('Text copied to clipboard!', 'success');
            }).catch(() => {
                // Fallback to old method
                outputText.select();
                document.execCommand('copy');
                showToast('Text copied to clipboard!', 'success');
            });
        } else {
            // Fallback for older browsers
            outputText.select();
            document.execCommand('copy');
            showToast('Text copied to clipboard!', 'success');
        }
    };
    
    window[toolId + 'Download'] = function() {
        const text = outputText.value;
        if (!text) {
            showToast('No text to download!', 'error');
            return;
        }
        const blob = new Blob([text], { type: 'text/plain' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = downloadFileName;
        a.click();
        URL.revokeObjectURL(url);
        showToast('File downloaded successfully!', 'success');
    };
    
    window[toolId + 'Clear'] = function() {
        inputText.value = '';
        outputText.value = '';
        updateStats();
    };
    
    window[toolId + 'ClearOutput'] = function() {
        outputText.value = '';
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

