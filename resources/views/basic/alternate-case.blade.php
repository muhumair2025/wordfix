@extends('layouts.tool')

@section('title', 'Alternate Case - WordFix')

@section('tool-title', 'Alternate Case Text Tool')

@section('tool-description', '')

@section('tool-content')
<!-- Text Converter Component -->
<x-text-converter 
    toolId="alternateCase"
    inputPlaceholder="Type or paste your content here"
    outputPlaceholder="aLtErNaTiNg CaSe will appear here"
    downloadFileName="alternate-case-text.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    This tool creates aLtErNaTiNg CaSe by alternating between uppercase and lowercase letters.
</div>

<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">aLtErNaTiNg CaSe Example</h3>
    <div class="mb-3">
        <p class="text-sm font-medium text-gray-700 mb-2">Before</p>
        <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">the alternate case tool creates fun text</div>
    </div>
    <div>
        <p class="text-sm font-medium text-gray-700 mb-2">After</p>
        <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">tHe AlTeRnAtE cAsE tOoL cReAtEs FuN tExT</div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Alternate Case Converter Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>alternate case converter</strong> creates unique text by alternating between uppercase and lowercase letters. This playful text style is also known as "aLtErNaTiNg CaSe," "mocking text," or "spongebob case."
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">What is Alternating Case?</h3>
        <p>
            Alternating case is a text formatting style where letters alternate between uppercase and lowercase throughout the text. This creates a distinctive, eye-catching appearance often used for humorous or satirical purposes.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use the Alternate Case Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Type or paste your text into the input box</li>
            <li>The tool automatically converts it to alternating case</li>
            <li>Copy the formatted text for use anywhere</li>
            <li>Download or share your converted text</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Popular Uses for Alternating Case</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Social Media:</strong> Create engaging posts and comments</li>
            <li><strong>Memes:</strong> Popular for mocking text memes</li>
            <li><strong>Gaming:</strong> Unique usernames and chat messages</li>
            <li><strong>Creative Writing:</strong> Add emphasis or sarcasm</li>
            <li><strong>Discord & Slack:</strong> Stand out in group chats</li>
            <li><strong>Twitter/X:</strong> Eye-catching tweets and replies</li>
            <li><strong>Instagram Bios:</strong> Unique profile descriptions</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Why Use Alternating Case?</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Express Sarcasm:</strong> Convey mocking or ironic tone</li>
            <li><strong>Stand Out:</strong> Make text more noticeable</li>
            <li><strong>Be Creative:</strong> Add personality to messages</li>
            <li><strong>Humor:</strong> Create funny, memorable content</li>
            <li><strong>Emphasis:</strong> Highlight specific messages</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">The Mocking SpongeBob Meme</h3>
        <p>
            Alternating case gained massive popularity through the "Mocking SpongeBob" meme, where text is written in this style to represent a mocking or sarcastic tone. This internet phenomenon made alternating case a widely recognized form of online communication.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Best Practices</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Use sparingly for maximum impact</li>
            <li>Perfect for short, punchy messages</li>
            <li>Great for informal communication</li>
            <li>Avoid in professional or formal contexts</li>
            <li>Test readability before posting</li>
        </ul>
        
        <div class="bg-blue-50 border-l-4 border-blue-600 p-4 mt-6">
            <p class="text-blue-900">
                <strong>Fun Fact:</strong> Alternating case is one of the most popular text styles for social media engagement and creative expression!
            </p>
        </div>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Frequently Asked Questions</h3>
        
        <div class="space-y-4">
            <div>
                <h4 class="font-semibold text-gray-900">Why is it called "Mocking SpongeBob case"?</h4>
                <p class="text-gray-700">It originated from a meme using a picture of SpongeBob SquarePants, where the text is written in alternating case to represent a mocking tone.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900">Where can I use alternating case text?</h4>
                <p class="text-gray-700">It works on most social media platforms, messaging apps, forums, and anywhere that accepts Unicode text.</p>
            </div>
            
            <div>
                <h4 class="font-semibold text-gray-900">Is alternating case professional?</h4>
                <p class="text-gray-700">No, it's best used for casual, humorous, or creative contexts. Avoid using it in professional communications.</p>
            </div>
        </div>
        
        <p class="mt-6 text-sm text-gray-600 italic">
            Last updated: {{ date('F Y') }}. Create fun and engaging text with our alternating case converter.
        </p>
    </div>
</article>
@endsection

@push('scripts')
<script>
    // Set the conversion function for the component
    setAlternateCaseConverter(function(text) {
        let result = '';
        let isUpper = false;
        for (let char of text) {
            if (char.match(/[a-zA-Z]/)) {
                result += isUpper ? char.toUpperCase() : char.toLowerCase();
                isUpper = !isUpper;
            } else {
                result += char;
            }
        }
        return result;
    });
</script>
@endpush

