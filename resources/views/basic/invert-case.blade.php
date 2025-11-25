@extends('layouts.tool')

@section('title', 'Invert Case - WordFix')

@section('tool-title', 'Invert Case Text Tool')

@section('tool-description', '')

@section('tool-content')
<!-- Text Converter Component -->
<x-text-converter 
    toolId="invertCase"
    inputPlaceholder="Type or paste your content here"
    outputPlaceholder="Inverted text will appear here"
    downloadFileName="inverted-case-text.txt"
    :showStats="true"
/>

<script>
(function () {
    if (typeof window.setInvertCaseConverter === "function") {
        window.setInvertCaseConverter((text) =>
            text.split("").map(c =>
                c >= "A" && c <= "Z" ? c.toLowerCase() :
                c >= "a" && c <= "z" ? c.toUpperCase() :
                c
            ).join("")
        );
    } else {
        console.warn("setInvertCaseConverter not found.");
    }
})();
</script>


<div class="text-sm text-blue-600 mb-6">
    This tool inverts the case of your text - uppercase becomes lowercase and vice versa.
</div>

<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Invert Case Example</h3>
    <div class="mb-3">
        <p class="text-sm font-medium text-gray-700 mb-2">Before</p>
        <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">The Invert Case Tool Swaps Letter Cases</div>
    </div>
    <div>
        <p class="text-sm font-medium text-gray-700 mb-2">After</p>
        <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">tHE iNVERT cASE tOOL sWAPS lETTER cASES</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Invert Case Converter Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>invert case converter</strong> reverses the case of every letter in your text. Uppercase letters become lowercase, and lowercase letters become uppercase, creating an inverted version of your original text.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">What is Invert Case?</h3>
        <p>
            Invert case, also called "toggle case" or "swap case," is a text transformation that flips the case of each letter. If a letter is uppercase, it becomes lowercase, and if it's lowercase, it becomes uppercase. Numbers and special characters remain unchanged.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use the Invert Case Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Enter your text in the input field</li>
            <li>The tool instantly inverts all letter cases</li>
            <li>Review the transformed text in the output box</li>
            <li>Copy, download, or share your inverted text</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Design Projects:</strong> Create unique text effects</li>
            <li><strong>Creative Writing:</strong> Add stylistic elements</li>
            <li><strong>Gaming:</strong> Unique character names and chat styles</li>
            <li><strong>Testing:</strong> Check case-sensitivity in applications</li>
            <li><strong>Coding:</strong> Test case handling in software</li>
            <li><strong>Social Media:</strong> Create attention-grabbing posts</li>
            <li><strong>Typography:</strong> Experimental text layouts</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Benefits of Using Invert Case</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Quick Transformation:</strong> Instant case inversion</li>
            <li><strong>Perfect Accuracy:</strong> Every letter is correctly inverted</li>
            <li><strong>Preserves Formatting:</strong> Maintains spaces and punctuation</li>
            <li><strong>Free Tool:</strong> No registration or payment required</li>
            <li><strong>Privacy Safe:</strong> All processing done in your browser</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Technical Applications</h3>
        <p>
            Developers often use invert case functionality to test case-sensitivity in applications, validate input handling, and ensure proper string manipulation. It's also useful for debugging text processing functions and creating test datasets.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Creative Uses</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Create unique artistic text effects</li>
            <li>Generate passwords with mixed case patterns</li>
            <li>Design typography experiments</li>
            <li>Develop encoding schemes</li>
            <li>Create visual puzzles and challenges</li>
        </ul>
        
        <div class="bg-blue-50 border-l-4 border-blue-600 p-4 mt-6">
            <p class="text-blue-900">
                <strong>Pro Tip:</strong> Combine invert case with other text tools like <a href="/basic/alternate-case" class="text-blue-600 hover:underline">alternate case</a> for even more creative text effects!
            </p>
        </div>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Frequently Asked Questions</h3>
        
        <div class="space-y-4">
            <div>
                <h4 class="font-semibold text-gray-900">What happens to numbers and symbols?</h4>
                <p class="text-gray-700">Numbers, punctuation, and special characters remain unchanged. Only alphabetic letters are inverted.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900">Can I invert text multiple times?</h4>
                <p class="text-gray-700">Yes! Inverting text twice will return it to its original form since each inversion reverses the previous one.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900">Does it work with special characters?</h4>
                <p class="text-gray-700">The tool works with all standard alphabetic characters. Special Unicode characters are preserved as-is.</p>
            </div>
        </div>
        
        <p class="mt-6 text-sm text-gray-600 italic">
            Last updated: {{ date('F Y') }}. Invert case instantly with our free online tool.
        </p>
    </div>
</article>
@endsection


