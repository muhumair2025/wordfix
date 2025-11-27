@extends('layouts.tool')

@section('title', 'Underline Text - WordFix')

@section('tool-title', 'Underline Text Tool')

@section('tool-description', '')

@section('tool-content')
<!-- Text Converter Component with Div Output -->
<x-text-converter 
    toolId="underline"
    inputPlaceholder="Type or paste your content here"
    outputPlaceholder="U̲n̲d̲e̲r̲l̲i̲n̲e̲d̲ text will appear here"
    downloadFileName="underline-text.txt"
    outputType="div"
    :showStats="true"
/>

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
    setUnderlineConverter(function(text) {
        return text.split('').map(char => char + '\u0332').join('');
    });
</script>
@endpush

