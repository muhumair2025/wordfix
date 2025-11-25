@extends('layouts.tool')

@section('title', 'Capitalize Words - WordFix')

@section('tool-title', 'Capitalize Words Text Tool')

@section('tool-description', '')

@section('tool-content')
<!-- Text Converter Component -->
<x-text-converter 
    toolId="capitalizeWords"
    inputPlaceholder="Type or paste your content here"
    outputPlaceholder="Capitalized words will appear here"
    downloadFileName="capitalize-words-text.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    This tool capitalizes the first letter of every word in your text.
</div>

<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Capitalize Words Example</h3>
    <div class="mb-3">
        <p class="text-sm font-medium text-gray-700 mb-2">Before</p>
        <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">the capitalize words tool helps you format text properly</div>
    </div>
    <div>
        <p class="text-sm font-medium text-gray-700 mb-2">After</p>
        <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">The Capitalize Words Tool Helps You Format Text Properly</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Capitalize Words Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>capitalize words tool</strong> automatically capitalizes the first letter of every word in your text while converting the rest to lowercase. This formatting style is commonly used in titles, headings, and proper names.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">What Does Capitalizing Words Mean?</h3>
        <p>
            Capitalizing words, also known as "Start Case" or "Capital Case," means making the first letter of each word uppercase while keeping subsequent letters lowercase. This creates a consistent, professional appearance for titles and headings.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use the Capitalize Words Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Paste or type your text in the left input box</li>
            <li>Watch as each word is automatically capitalized in real-time</li>
            <li>Copy the formatted text from the right output box</li>
            <li>Download as a file or share directly</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Professional Documents:</strong> Format headers and section titles</li>
            <li><strong>Names and Titles:</strong> Properly capitalize people's names and job titles</li>
            <li><strong>Marketing Materials:</strong> Create eye-catching headlines</li>
            <li><strong>Social Media:</strong> Format display names and profile bios</li>
            <li><strong>Presentations:</strong> Standardize slide titles and bullet points</li>
            <li><strong>Email Signatures:</strong> Professional name and position formatting</li>
            <li><strong>Product Names:</strong> Consistent branding and catalog entries</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Why Use Our Capitalize Tool?</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Instant Results:</strong> Real-time text transformation</li>
            <li><strong>Batch Processing:</strong> Convert multiple lines at once</li>
            <li><strong>100% Free:</strong> No registration or payment needed</li>
            <li><strong>Privacy First:</strong> All processing happens in your browser</li>
            <li><strong>Mobile Friendly:</strong> Works on all devices</li>
            <li><strong>Unlimited Use:</strong> No restrictions on text length</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Capitalization Rules</h3>
        <p>
            While our tool capitalizes every word, it's important to know proper capitalization rules. In formal writing, articles (a, an, the), coordinating conjunctions (and, but, or), and short prepositions (in, on, at) are often left lowercase unless they're the first or last word of a title.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips for Using Capitalize Words</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Perfect for converting all-caps text to readable format</li>
            <li>Great for cleaning up data imports and CSV files</li>
            <li>Useful for standardizing contact lists and databases</li>
            <li>Ideal for creating consistent product catalogs</li>
            <li>Helpful for fixing improperly formatted names</li>
        </ul>
        
        <div class="bg-blue-50 border-l-4 border-blue-600 p-4 mt-6">
            <p class="text-blue-900">
                <strong>Pro Tip:</strong> Use our <a href="/basic/title-case" class="text-blue-600 hover:underline">title case</a> tool for proper title formatting, or <a href="/basic/sentence-case" class="text-blue-600 hover:underline">sentence case</a> for regular paragraph text.
            </p>
        </div>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Frequently Asked Questions</h3>
        
        <div class="space-y-4">
            <div>
                <h4 class="font-semibold text-gray-900">What's the difference between capitalize words and title case?</h4>
                <p class="text-gray-700">Capitalize Words capitalizes every word, while Title Case follows grammar rules for titles (leaving articles and prepositions lowercase).</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900">Can I process multiple lines at once?</h4>
                <p class="text-gray-700">Yes! Our tool processes all text in the input box, maintaining line breaks and formatting.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900">Is there a character limit?</h4>
                <p class="text-gray-700">No, you can capitalize as much text as you need without any restrictions.</p>
            </div>
        </div>
        
        <p class="mt-6 text-sm text-gray-600 italic">
            Last updated: {{ date('F Y') }}. Our capitalize words tool provides instant, accurate text formatting.
        </p>
    </div>
</article>
@endsection

@push('scripts')
<script>
    setCapitalizeWordsConverter(function(text) {
        return text.replace(/\b\w/g, char => char.toUpperCase());
    });
</script>
@endpush

