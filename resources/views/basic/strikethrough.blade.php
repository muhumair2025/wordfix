@extends('layouts.tool')

@section('title', 'Strikethrough Text - WordFix')

@section('tool-title', 'Strikethrough Text Tool')

@section('tool-description', '')

@section('tool-content')
<!-- Text Converter Component with Div Output -->
<x-text-converter 
    toolId="strikethrough"
    inputPlaceholder="Type or paste your content here"
    outputPlaceholder="S̶t̶r̶i̶k̶e̶t̶h̶r̶o̶u̶g̶h̶ text will appear here"
    downloadFileName="strikethrough-text.txt"
    outputType="div"
    :showStats="true"
/>

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
    setStrikethroughConverter(function(text) {
        return text.split('').map(char => char + '\u0336').join('');
    });
</script>
@endpush

