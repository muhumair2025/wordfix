@extends('layouts.app')

@section('title', 'WordFix - Free Online Text Tools')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Search Tools Component -->
        @include('components.search-tools')
        
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Text Editor Tool
            </h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                Convert text instantly between different letter cases: lower case, UPPER CASE, Sentence case, Capitalized Case, 
                <span class="font-semibold">aLtErNaTiNg cAsE</span> and much more.
            </p>
        </div>
        
        <!-- Main Tool Card -->
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden">
            <!-- Textarea -->
            <div class="p-6">
                <textarea 
                    id="inputText"
                    class="w-full h-64 p-4 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent resize-none"
                    placeholder="Type or paste your content here"
                ></textarea>
            </div>
            
            <!-- Action Buttons -->
            <div class="px-6 pb-4">
                <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                    Import From File
                </button>
            </div>
            
            <!-- Tool Buttons -->
            <div class="border-t border-gray-200 p-4 bg-gray-50">
                <div class="flex flex-wrap gap-2">
                    <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                        Sentence case
                    </button>
                    <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                        lower case
                    </button>
                    <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                        UPPER CASE
                    </button>
                    <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                        Capitalized Case
                    </button>
                    <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                        aLtErNaTiNg cAsE
                    </button>
                    <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                        Title Case
                    </button>
                    <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                        InVeRsE Case
                    </button>
                    <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                        Copy Results
                    </button>
                    <button class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                        Download
                    </button>
                    <button class="px-4 py-2 bg-red-600 text-white text-sm font-medium rounded-md hover:bg-red-700 transition-colors">
                        Clear
                    </button>
                </div>
            </div>
            
            <!-- Stats -->
            <div class="border-t border-gray-200 px-6 py-3 bg-gray-50">
                <div class="flex flex-wrap gap-6 text-sm text-gray-600">
                    <div>
                        <span class="font-medium">Stats:</span>
                    </div>
                    <div>
                        <span class="font-medium">Character Count:</span> <span id="charCount">0</span>
                    </div>
                    <div>
                        <span class="font-medium">Character Count (without spaces):</span> <span id="charCountNoSpace">0</span>
                    </div>
                    <div>
                        <span class="font-medium">Word Count:</span> <span id="wordCount">0</span>
                    </div>
                    <div>
                        <span class="font-medium">Sentence Count:</span> <span id="sentenceCount">0</span>
                    </div>
                    <div>
                        <span class="font-medium">Paragraph Count:</span> <span id="paragraphCount">0</span>
                    </div>
                    <div>
                        <span class="font-medium">Line Count:</span> <span id="lineCount">0</span>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

@push('scripts')
<script>
    // Character counter functionality
    const textarea = document.getElementById('inputText');
    
    textarea.addEventListener('input', function() {
        const text = this.value;
        
        // Character count
        document.getElementById('charCount').textContent = text.length;
        
        // Character count without spaces
        document.getElementById('charCountNoSpace').textContent = text.replace(/\s/g, '').length;
        
        // Word count
        const words = text.trim().split(/\s+/).filter(word => word.length > 0);
        document.getElementById('wordCount').textContent = words.length;
        
        // Sentence count
        const sentences = text.split(/[.!?]+/).filter(s => s.trim().length > 0);
        document.getElementById('sentenceCount').textContent = sentences.length;
        
        // Paragraph count
        const paragraphs = text.split(/\n\n+/).filter(p => p.trim().length > 0);
        document.getElementById('paragraphCount').textContent = paragraphs.length;
        
        // Line count
        const lines = text.split('\n').filter(l => l.length > 0);
        document.getElementById('lineCount').textContent = lines.length;
    });
</script>
@endpush
@endsection

