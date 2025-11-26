<footer class="bg-white border-t border-gray-200 mt-6 md:mt-8">
    <div class="w-full px-4 sm:px-6 lg:px-8 py-6">
        <!-- Logo and Description -->
        <div class="mb-6">
            <a href="/" class="inline-block mb-2">
                <img src="{{ asset('images/logo.png') }}" alt="WordFix" class="h-7 md:h-8">
            </a>
            <p class="text-gray-600 text-xs max-w-md leading-relaxed">
                Welcome to WordFix! We built this website in 2024 because we noticed there was a need for a clean, simple, and safe way to modify text online for free.
            </p>
        </div>
        
        <!-- Footer Menus Grid - Balanced Columns -->
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 md:gap-4 mb-6">
            <!-- Column 1: Basic + Counter + Generator Tools -->
            <div class="footer-section">
                <button class="footer-toggle md:cursor-default w-full text-left flex justify-between items-center md:pointer-events-none" onclick="toggleFooterSection(this)">
                    <h3 class="text-xs font-semibold text-gray-900">Basic Tools</h3>
                    <svg class="w-4 h-4 md:hidden transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <ul class="footer-content space-y-1 mt-2 hidden md:block">
                    <li><a href="/basic/alternate-case" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Alternate Case</a></li>
                    <li><a href="/basic/capitalize-words" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Capitalize Words</a></li>
                    <li><a href="/basic/invert-case" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Invert Case</a></li>
                    <li><a href="/basic/lower-case" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Lower Case</a></li>
                    <li><a href="/basic/sentence-case" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Sentence Case</a></li>
                    <li><a href="/basic/strikethrough" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Strikethrough</a></li>
                    <li><a href="/basic/title-case" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Title Case</a></li>
                    <li><a href="/basic/underline" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Underline</a></li>
                    <li><a href="/basic/upper-case" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Upper Case</a></li>
                </ul>
                
                <button class="footer-toggle md:cursor-default w-full text-left flex justify-between items-center md:pointer-events-none mt-3" onclick="toggleFooterSection(this)">
                    <h3 class="text-xs font-semibold text-gray-900">Counter Tools</h3>
                    <svg class="w-4 h-4 md:hidden transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <ul class="footer-content space-y-1 mt-2 hidden md:block">
                    <li><a href="/counter/character-word-counter" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Character Counter</a></li>
                    <li><a href="/counter/count-each-line" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Count Each Line</a></li>
                    <li><a href="/counter/bracket-tag-counter" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Bracket Counter</a></li>
                </ul>
                
                <button class="footer-toggle md:cursor-default w-full text-left flex justify-between items-center md:pointer-events-none mt-3" onclick="toggleFooterSection(this)">
                    <h3 class="text-xs font-semibold text-gray-900">Generator Tools</h3>
                    <svg class="w-4 h-4 md:hidden transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <ul class="footer-content space-y-1 mt-2 hidden md:block">
                    <li><a href="/generators/lorem-ipsum" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Lorem Ipsum</a></li>
                    <li><a href="/generators/color" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Random Color</a></li>
                    <li><a href="/generators/date" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Random Date</a></li>
                    <li><a href="/generators/email" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Random Email</a></li>
                    <li><a href="/generators/ip" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Random IP</a></li>
                    <li><a href="/generators/ipv6" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Random IPv6</a></li>
                    <li><a href="/generators/mac" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Random MAC</a></li>
                    <li><a href="/generators/number" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Random Number</a></li>
                    <li><a href="/generators/user-agent" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Random User Agent</a></li>
                    <li><a href="/generators/password" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Random Password</a></li>
                    <li><a href="/generators/seo-url" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">SEO URL</a></li>
                    <li><a href="/generators/sequential-number" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Sequential Number</a></li>
                    <li><a href="/generators/url-slug" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">URL Slug</a></li>
                </ul>
            </div>
            
            <!-- Column 2: Extract + Formatter Tools -->
            <div class="footer-section">
                <button class="footer-toggle md:cursor-default w-full text-left flex justify-between items-center md:pointer-events-none" onclick="toggleFooterSection(this)">
                    <h3 class="text-xs font-semibold text-gray-900">Extract Tools</h3>
                    <svg class="w-4 h-4 md:hidden transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <ul class="footer-content space-y-1 mt-2 hidden md:block">
                    <li><a href="/extract/emails" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Extract Emails</a></li>
                    <li><a href="/extract/hex-colors" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Extract Hex Colors</a></li>
                    <li><a href="/extract/image-urls" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Extract Image Urls</a></li>
                    <li><a href="/extract/ip-address" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Extract IP Address</a></li>
                    <li><a href="/extract/phone-numbers" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Extract Phone Numbers</a></li>
                    <li><a href="/extract/numbers" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Extract Numbers</a></li>
                    <li><a href="/extract/text-between" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Extract Text Between</a></li>
                    <li><a href="/extract/urls" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Extract Urls</a></li>
                    <li><a href="/extract/random-lines" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Extract Random Lines</a></li>
                    <li><a href="/extract/zip-codes" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Extract Zip Codes</a></li>
                </ul>
                
                <button class="footer-toggle md:cursor-default w-full text-left flex justify-between items-center md:pointer-events-none mt-3" onclick="toggleFooterSection(this)">
                    <h3 class="text-xs font-semibold text-gray-900">Formatter Tools</h3>
                    <svg class="w-4 h-4 md:hidden transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <ul class="footer-content space-y-1 mt-2 hidden md:block">
                    <li><a href="/formatter/css-beautifier" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">CSS Beautifier</a></li>
                    <li><a href="/formatter/html-beautifier" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">HTML Beautifier</a></li>
                    <li><a href="/formatter/javascript-beautifier" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">JavaScript Beautifier</a></li>
                    <li><a href="/formatter/json-beautifier" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">JSON Beautifier</a></li>
                    <li><a href="/formatter/sql-beautifier" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">SQL Beautifier</a></li>
                </ul>
            </div>
            
            <!-- Column 3: Sorting + Conversion + Replace Tools -->
            <div class="footer-section">
                <button class="footer-toggle md:cursor-default w-full text-left flex justify-between items-center md:pointer-events-none" onclick="toggleFooterSection(this)">
                    <h3 class="text-xs font-semibold text-gray-900">Sorting Tools</h3>
                    <svg class="w-4 h-4 md:hidden transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <ul class="footer-content space-y-1 mt-2 hidden md:block">
                    <li><a href="/sorting/alphabetical" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Alphabetical Sort</a></li>
                    <li><a href="/sorting/length" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Length Sort</a></li>
                    <li><a href="/sorting/random" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Random Sort</a></li>
                    <li><a href="/sorting/numbers" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Sort Numbers</a></li>
                </ul>
                
                <button class="footer-toggle md:cursor-default w-full text-left flex justify-between items-center md:pointer-events-none mt-3" onclick="toggleFooterSection(this)">
                    <h3 class="text-xs font-semibold text-gray-900">Conversion Tools</h3>
                    <svg class="w-4 h-4 md:hidden transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <ul class="footer-content space-y-1 mt-2 hidden md:block">
                    <li><a href="/conversions/base64-decoder" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Base64 Decoder</a></li>
                    <li><a href="/conversions/base64-encoder" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Base64 Encoder</a></li>
                    <li><a href="/conversions/date" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Date Conversion</a></li>
                    <li><a href="/conversions/decimal-to-string" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Decimal to String</a></li>
                    <li><a href="/conversions/html-entities" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Html Entities</a></li>
                    <li><a href="/conversions/string-to-decimal" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">String to Decimal</a></li>
                    <li><a href="/conversions/text-to-binary" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Text To Binary</a></li>
                    <li><a href="/conversions/url-decode" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Url Decode</a></li>
                    <li><a href="/conversions/url-encode" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Url Encode</a></li>
                </ul>
                
                <button class="footer-toggle md:cursor-default w-full text-left flex justify-between items-center md:pointer-events-none mt-3" onclick="toggleFooterSection(this)">
                    <h3 class="text-xs font-semibold text-gray-900">Replace Tools</h3>
                    <svg class="w-4 h-4 md:hidden transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <ul class="footer-content space-y-1 mt-2 hidden md:block">
                    <li><a href="/replace/newline-with-commas" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Newline with Commas</a></li>
                    <li><a href="/replace/spaces" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Replace Spaces</a></li>
                    <li><a href="/replace/text-between" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Replace Text Between</a></li>
                    <li><a href="/replace/search-replace" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Search And Replace</a></li>
                </ul>
            </div>
            
            <!-- Column 4: Remove Tools -->
            <div class="footer-section">
                <button class="footer-toggle md:cursor-default w-full text-left flex justify-between items-center md:pointer-events-none" onclick="toggleFooterSection(this)">
                    <h3 class="text-xs font-semibold text-gray-900">Remove Tools</h3>
                    <svg class="w-4 h-4 md:hidden transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <ul class="footer-content space-y-1 mt-2 hidden md:block">
                    <li><a href="/remove/consonants" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Remove Consonants</a></li>
                    <li><a href="/remove/duplicate-lines" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Remove Duplicates</a></li>
                    <li><a href="/remove/duplicate-words" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Remove Dup. Words</a></li>
                    <li><a href="/remove/empty-lines" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Remove Empty Lines</a></li>
                    <li><a href="/remove/extra-spaces" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Remove Extra Spaces</a></li>
                    <li><a href="/remove/first-characters" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Remove First Chars</a></li>
                    <li><a href="/remove/html-comments" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Remove Html Comments</a></li>
                    <li><a href="/remove/html-tags" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Remove Html Tags</a></li>
                    <li><a href="/remove/last-characters" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Remove Last Chars</a></li>
                    <li><a href="/remove/line-breaks" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Remove Line Breaks</a></li>
                    <li><a href="/remove/lines-with-word" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Remove Lines w/ Word</a></li>
                    <li><a href="/remove/numbers" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Remove Numbers</a></li>
                    <li><a href="/remove/numbers-from-text" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Remove Num. From Text</a></li>
                    <li><a href="/remove/quotes" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Remove Quotes</a></li>
                    <li><a href="/remove/single-quotes" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Remove Single Quotes</a></li>
                    <li><a href="/remove/spaces" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Remove Spaces</a></li>
                    <li><a href="/remove/special-characters" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Remove Special Chars</a></li>
                    <li><a href="/remove/tabs" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Remove Tabs</a></li>
                    <li><a href="/remove/text-between" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Remove Text Between</a></li>
                    <li><a href="/remove/vowels" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Remove Vowels</a></li>
                    <li><a href="/remove/trim-spaces" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Trim Spaces</a></li>
                </ul>
            </div>
            
            <!-- Column 5: Modify Tools -->
            <div class="footer-section">
                <button class="footer-toggle md:cursor-default w-full text-left flex justify-between items-center md:pointer-events-none" onclick="toggleFooterSection(this)">
                    <h3 class="text-xs font-semibold text-gray-900">Modify Tools</h3>
                    <svg class="w-4 h-4 md:hidden transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <ul class="footer-content space-y-1 mt-2 hidden md:block">
                    <li><a href="/modify/add-number-to-each-line" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Add Number To Line</a></li>
                    <li><a href="/modify/add-string-after-characters" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Add String After Chars</a></li>
                    <li><a href="/modify/add-text-to-each-line" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Add Text To Line</a></li>
                    <li><a href="/modify/column-to-comma" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Column to Comma</a></li>
                    <li><a href="/modify/commas-between-numbers" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Commas in Numbers</a></li>
                    <li><a href="/modify/comma-to-column" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Comma to Column</a></li>
                    <li><a href="/modify/double-space-to-single" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Double to Single Space</a></li>
                    <li><a href="/modify/single-space-to-double" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Single to Double Space</a></li>
                    <li><a href="/modify/keep-first-characters" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Keep First Chars</a></li>
                    <li><a href="/modify/keep-last-characters" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Keep Last Chars</a></li>
                    <li><a href="/modify/keep-lines-with-word" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Keep Lines w/ Word</a></li>
                    <li><a href="/modify/keep-lines-with-words" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Keep Lines w/ Words</a></li>
                    <li><a href="/modify/merge-text-lists" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Merge Text or Lists</a></li>
                    <li><a href="/modify/number-to-words" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Number To Words</a></li>
                    <li><a href="/modify/prefix-suffix" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Prefix Suffix</a></li>
                    <li><a href="/modify/position-text-addition" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Position Text Add</a></li>
                    <li><a href="/modify/trim-text" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Trim Text</a></li>
                </ul>
            </div>
            
            <!-- Column 6: Special Effects Tools -->
            <div class="footer-section">
                <button class="footer-toggle md:cursor-default w-full text-left flex justify-between items-center md:pointer-events-none" onclick="toggleFooterSection(this)">
                    <h3 class="text-xs font-semibold text-gray-900">Special Effects</h3>
                    <svg class="w-4 h-4 md:hidden transform transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                    </svg>
                </button>
                <ul class="footer-content space-y-1 mt-2 hidden md:block">
                    <li><a href="/special-effects/backward" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Backward</a></li>
                    <li><a href="/special-effects/binary-to-text" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Binary To Text</a></li>
                    <li><a href="/special-effects/bold" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Bold</a></li>
                    <li><a href="/special-effects/bold-gothic" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Bold Gothic</a></li>
                    <li><a href="/special-effects/bold-italic" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Bold Italic</a></li>
                    <li><a href="/special-effects/circled" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Circled</a></li>
                    <li><a href="/special-effects/cursive-bold" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Cursive Bold</a></li>
                    <li><a href="/special-effects/flip-text" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Flip Text</a></li>
                    <li><a href="/special-effects/flip-words" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Flip Words</a></li>
                    <li><a href="/special-effects/gothic" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Gothic</a></li>
                    <li><a href="/special-effects/italic" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Italic</a></li>
                    <li><a href="/special-effects/outline" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Outline</a></li>
                    <li><a href="/special-effects/parentheses" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Parentheses</a></li>
                    <li><a href="/special-effects/pascal-case" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Pascal Case</a></li>
                    <li><a href="/special-effects/reverse-words" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Reverse Words</a></li>
                    <li><a href="/special-effects/slashed" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Slashed</a></li>
                    <li><a href="/special-effects/snake-case" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Snake Case</a></li>
                    <li><a href="/special-effects/upside-down" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Upside Down</a></li>
                    <li><a href="/special-effects/wide-text" class="text-xs text-gray-600 hover:text-blue-600 transition-colors">Wide Text</a></li>
                </ul>
            </div>
        </div>
        
        <!-- Suggest Tool Button -->
        <div class="mb-6 text-center">
            <a href="/contact" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-xs font-medium rounded hover:bg-blue-700 transition-colors">
                <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Suggest Us a Tool
            </a>
        </div>
        
        <!-- Bottom Section -->
        <div class="pt-4 border-t border-gray-200">
            <div class="flex flex-col md:flex-row justify-between items-center space-y-2 md:space-y-0">
                <p class="text-xs text-gray-500">
                    &copy; {{ date('Y') }} WordFix. All rights reserved.
                </p>
                <div class="flex flex-wrap justify-center gap-3 md:gap-4">
                    <a href="/contact" class="text-xs text-gray-500 hover:text-blue-600 transition-colors">Contact</a>
                    <a href="/privacy-policy" class="text-xs text-gray-500 hover:text-blue-600 transition-colors">Privacy Policy</a>
                    <a href="/terms" class="text-xs text-gray-500 hover:text-blue-600 transition-colors">Terms</a>
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
function toggleFooterSection(button) {
    // Only work on mobile
    if (window.innerWidth >= 768) return;
    
    const content = button.nextElementSibling;
    const icon = button.querySelector('svg');
    
    // Toggle content
    content.classList.toggle('hidden');
    
    // Rotate icon
    if (content.classList.contains('hidden')) {
        icon.style.transform = 'rotate(0deg)';
    } else {
        icon.style.transform = 'rotate(180deg)';
    }
}
</script>
