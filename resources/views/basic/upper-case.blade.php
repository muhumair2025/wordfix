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

<!-- Share Section -->
<div class="border-t border-gray-200 pt-6">
    <div class="flex flex-wrap items-center gap-2 mb-4">
        <span class="font-semibold text-gray-900 text-sm">Share this tool:</span>
        <button onclick="shareOnFacebook()" class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
            </svg>
            Facebook
        </button>
        <button onclick="shareOnTwitter()" class="inline-flex items-center px-3 py-1.5 bg-black text-white text-xs font-medium rounded hover:bg-gray-900 transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
            </svg>
            X
        </button>
        <button onclick="shareViaEmail()" class="inline-flex items-center px-3 py-1.5 bg-gray-600 text-white text-xs font-medium rounded hover:bg-gray-700 transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
            </svg>
            E-Mail
        </button>
        <button onclick="shareOnPinterest()" class="inline-flex items-center px-3 py-1.5 bg-red-600 text-white text-xs font-medium rounded hover:bg-red-700 transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.041-3.439.219-.937 1.406-5.957 1.406-5.957s-.359-.72-.359-1.781c0-1.663.967-2.911 2.168-2.911 1.024 0 1.518.769 1.518 1.688 0 1.029-.653 2.567-.992 3.992-.285 1.193.6 2.165 1.775 2.165 2.128 0 3.768-2.245 3.768-5.487 0-2.861-2.063-4.869-5.008-4.869-3.41 0-5.409 2.562-5.409 5.199 0 1.033.394 2.143.889 2.741.099.12.112.225.085.345-.09.375-.293 1.199-.334 1.363-.053.225-.172.271-.401.165-1.495-.69-2.433-2.878-2.433-4.646 0-3.776 2.748-7.252 7.92-7.252 4.158 0 7.392 2.967 7.392 6.923 0 4.135-2.607 7.462-6.233 7.462-1.214 0-2.354-.629-2.758-1.379l-.749 2.848c-.269 1.045-1.004 2.352-1.498 3.146 1.123.345 2.306.535 3.55.535 6.607 0 11.985-5.365 11.985-11.987C23.97 5.39 18.592.026 11.985.026L12.017 0z"/>
            </svg>
            Pinterest
        </button>
        <button onclick="shareOnLinkedIn()" class="inline-flex items-center px-3 py-1.5 bg-blue-700 text-white text-xs font-medium rounded hover:bg-blue-800 transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
            </svg>
            LinkedIn
        </button>
        <button onclick="shareOnWhatsApp()" class="inline-flex items-center px-3 py-1.5 bg-green-600 text-white text-xs font-medium rounded hover:bg-green-700 transition-colors">
            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
            </svg>
            WhatsApp
        </button>
    </div>
    
    <div class="space-y-3">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Page Link:</label>
            <div class="flex gap-2">
                <input type="text" readonly value="{{ url()->current() }}" class="flex-1 px-3 py-2 text-sm border border-gray-300 rounded bg-gray-50">
                <button onclick="copyPageLink()" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </button>
            </div>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">HTML Link Code:</label>
            <div class="flex gap-2">
                <input type="text" readonly value='<a href="{{ url()->current() }}" title="Upper Case">Upper Case</a>' class="flex-1 px-3 py-2 text-sm border border-gray-300 rounded bg-gray-50">
                <button onclick="copyHtmlCode()" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                </button>
            </div>
        </div>
    </div>
</div>
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
    
    // Social Share Functions
    function copyPageLink() {
        const link = '{{ url()->current() }}';
        navigator.clipboard.writeText(link).then(() => {
            alert('Page link copied to clipboard!');
        });
    }
    
    function copyHtmlCode() {
        const code = '<a href="{{ url()->current() }}" title="Upper Case">Upper Case</a>';
        navigator.clipboard.writeText(code).then(() => {
            alert('HTML code copied to clipboard!');
        });
    }
    
    function shareOnFacebook() {
        const url = encodeURIComponent('{{ url()->current() }}');
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank', 'width=600,height=400');
    }
    
    function shareOnTwitter() {
        const url = encodeURIComponent('{{ url()->current() }}');
        const text = encodeURIComponent('Check out this Upper Case Text Tool!');
        window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank', 'width=600,height=400');
    }
    
    function shareViaEmail() {
        const subject = encodeURIComponent('Upper Case Text Tool');
        const body = encodeURIComponent('Check out this useful tool: {{ url()->current() }}');
        window.location.href = `mailto:?subject=${subject}&body=${body}`;
    }
    
    function shareOnPinterest() {
        const url = encodeURIComponent('{{ url()->current() }}');
        const description = encodeURIComponent('Upper Case Text Tool - Convert text to uppercase');
        window.open(`https://pinterest.com/pin/create/button/?url=${url}&description=${description}`, '_blank', 'width=600,height=400');
    }
    
    function shareOnLinkedIn() {
        const url = encodeURIComponent('{{ url()->current() }}');
        window.open(`https://www.linkedin.com/sharing/share-offsite/?url=${url}`, '_blank', 'width=600,height=400');
    }
    
    function shareOnWhatsApp() {
        const url = encodeURIComponent('{{ url()->current() }}');
        const text = encodeURIComponent('Check out this Upper Case Text Tool: ');
        window.open(`https://wa.me/?text=${text}${url}`, '_blank');
    }
</script>
@endpush

