@extends('layouts.tool')

@section('title', 'Upper Case - WordFix')

@section('tool-title', 'Upper Case Text Tool')

@section('tool-description', '')

@section('tool-content')
<!-- Text Converter Component -->
<x-text-converter 
    toolId="upperCase"
    inputPlaceholder="Type or paste your content here"
    outputPlaceholder="UPPERCASE text will appear here"
    downloadFileName="uppercase-text.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    This upper casing tool converts texts to "UPPERCASE" or all caps.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">UPPERCASE Text Example</h3>
    
    <div class="mb-3">
        <p class="text-sm font-medium text-gray-700 mb-2">Before</p>
        <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
            The upper case text tool helps you change text to upper case just like this
        </div>
    </div>
    
    <div>
        <p class="text-sm font-medium text-gray-700 mb-2">After</p>
        <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
            THE UPPER CASE TEXT TOOL HELPS YOU CHANGE TEXT TO UPPER CASE JUST LIKE THIS
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Upper Case Converter Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>upper case converter</strong> is a simple yet powerful text transformation tool that converts any text into UPPERCASE letters instantly. Whether you're working with documents, social media posts, or programming code, this tool helps you quickly transform your text to all capital letters.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">What is Upper Case?</h3>
        <p>
            Upper case, also known as capital letters or majuscules, refers to the larger form of letters in the alphabet. In English and most other languages, upper case letters are used at the beginning of sentences, for proper nouns, acronyms, and when you want to emphasize text.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use the Upper Case Tool</h3>
        <p>
            Using our upper case converter is incredibly simple:
        </p>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Type or paste your text into the input box on the left side</li>
            <li>The tool automatically converts your text to UPPERCASE in real-time</li>
            <li>Copy the converted text from the output box on the right</li>
            <li>Use the download button to save your converted text as a file</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases for Upper Case Text</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Headings and Titles:</strong> Make your headers stand out in documents and presentations</li>
            <li><strong>Acronyms:</strong> Convert organization names or technical terms to standard acronym format</li>
            <li><strong>Emphasis:</strong> Draw attention to important information or warnings</li>
            <li><strong>Social Media:</strong> Create eye-catching posts and captions</li>
            <li><strong>Programming:</strong> Format constants and environment variables</li>
            <li><strong>Legal Documents:</strong> Highlight key terms and conditions</li>
            <li><strong>Database Management:</strong> Standardize data entry formats</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Benefits of Using Our Tool</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Instant Conversion:</strong> Real-time text transformation as you type</li>
            <li><strong>Free to Use:</strong> No registration or payment required</li>
            <li><strong>Privacy Protected:</strong> All text processing happens in your browser</li>
            <li><strong>Mobile Friendly:</strong> Works perfectly on phones, tablets, and desktops</li>
            <li><strong>Unlimited Usage:</strong> Convert as much text as you need</li>
            <li><strong>Easy Sharing:</strong> Share converted text via social media or email</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Upper Case vs Lower Case</h3>
        <p>
            While upper case letters are great for emphasis and readability in headings, it's important to use them appropriately. Overuse of upper case in body text can make content harder to read and may come across as "shouting" in digital communication. Our tool gives you the flexibility to convert text when needed while maintaining proper text formatting practices.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips for Using Upper Case Text</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Use upper case sparingly in body text for better readability</li>
            <li>Perfect for creating consistent formatting in spreadsheets and databases</li>
            <li>Great for converting addresses, labels, and forms to standard formats</li>
            <li>Useful for creating hashtags and social media handles</li>
            <li>Helpful for fixing improperly formatted text from various sources</li>
        </ul>
        
        <div class="bg-blue-50 border-l-4 border-blue-600 p-4 mt-6">
            <p class="text-blue-900">
                <strong>Pro Tip:</strong> You can also use our other text case tools like <a href="/basic/lower-case" class="text-blue-600 hover:underline">lower case</a>, <a href="/basic/title-case" class="text-blue-600 hover:underline">title case</a>, and <a href="/basic/sentence-case" class="text-blue-600 hover:underline">sentence case</a> for complete text formatting control.
            </p>
        </div>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Frequently Asked Questions</h3>
        
        <div class="space-y-4">
            <div>
                <h4 class="font-semibold text-gray-900">Is this tool free to use?</h4>
                <p class="text-gray-700">Yes, our upper case converter is completely free with no limits on usage.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900">Does it work on mobile devices?</h4>
                <p class="text-gray-700">Absolutely! Our tool is fully responsive and works seamlessly on smartphones and tablets.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900">Is my text data saved or stored?</h4>
                <p class="text-gray-700">No, all text processing happens locally in your browser. We don't store or transmit your data.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900">Can I convert text from a file?</h4>
                <p class="text-gray-700">Yes, use the "Import From File" button to upload and convert text from .txt files.</p>
            </div>
        </div>
        
        <p class="mt-6 text-sm text-gray-600 italic">
            Last updated: {{ date('F Y') }}. Our upper case converter tool is constantly updated to provide the best user experience.
        </p>
    </div>
</article>
@endsection

@push('scripts')
<script>
    setUpperCaseConverter(function(text) {
        return text.toUpperCase();
    });
    
</script>
@endpush

