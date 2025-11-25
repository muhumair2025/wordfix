<div x-data="{ 
    isOpen: false,
    searchQuery: '',
    allTools: [
        // Basic Tools
        { name: 'Alternate Case', url: '/basic/alternate-case', category: 'Basic Tools' },
        { name: 'Capitalize Words', url: '/basic/capitalize-words', category: 'Basic Tools' },
        { name: 'Invert Case', url: '/basic/invert-case', category: 'Basic Tools' },
        { name: 'Lower Case', url: '/basic/lower-case', category: 'Basic Tools' },
        { name: 'Sentence Case', url: '/basic/sentence-case', category: 'Basic Tools' },
        { name: 'Strikethrough', url: '/basic/strikethrough', category: 'Basic Tools' },
        { name: 'Title Case', url: '/basic/title-case', category: 'Basic Tools' },
        { name: 'Underline', url: '/basic/underline', category: 'Basic Tools' },
        { name: 'Upper Case', url: '/basic/upper-case', category: 'Basic Tools' },
        
        // Counter Tools
        { name: 'Character and Word Counter', url: '/counter/character-word-counter', category: 'Counter Tools' },
        { name: 'Count Each Line', url: '/counter/count-each-line', category: 'Counter Tools' },
        { name: 'Bracket and Tag Counter', url: '/counter/bracket-tag-counter', category: 'Counter Tools' },
        
        // Extract Tools
        { name: 'Extract Emails', url: '/extract/emails', category: 'Extract Tools' },
        { name: 'Extract Hex Colors', url: '/extract/hex-colors', category: 'Extract Tools' },
        { name: 'Extract Image Urls', url: '/extract/image-urls', category: 'Extract Tools' },
        { name: 'Extract IP Address', url: '/extract/ip-address', category: 'Extract Tools' },
        { name: 'Extract Phone Numbers', url: '/extract/phone-numbers', category: 'Extract Tools' },
        { name: 'Extract Numbers From Text', url: '/extract/numbers', category: 'Extract Tools' },
        { name: 'Extract Text Between', url: '/extract/text-between', category: 'Extract Tools' },
        { name: 'Extract Urls', url: '/extract/urls', category: 'Extract Tools' },
        { name: 'Extract Random Lines', url: '/extract/random-lines', category: 'Extract Tools' },
        { name: 'Extract Zip Codes', url: '/extract/zip-codes', category: 'Extract Tools' },
        
        // Formatter Tools
        { name: 'CSS Beautifier', url: '/formatter/css-beautifier', category: 'Formatter Tools' },
        { name: 'HTML Beautifier', url: '/formatter/html-beautifier', category: 'Formatter Tools' },
        { name: 'JavaScript Beautifier', url: '/formatter/javascript-beautifier', category: 'Formatter Tools' },
        { name: 'JSON Beautifier', url: '/formatter/json-beautifier', category: 'Formatter Tools' },
        { name: 'SQL Beautifier', url: '/formatter/sql-beautifier', category: 'Formatter Tools' },
        
        // Sorting Tools
        { name: 'Alphabetical Sort', url: '/sorting/alphabetical', category: 'Sorting Tools' },
        { name: 'Length Sort', url: '/sorting/length', category: 'Sorting Tools' },
        { name: 'Randomly Sort Lines of Text', url: '/sorting/random', category: 'Sorting Tools' },
        { name: 'Sort Numbers', url: '/sorting/numbers', category: 'Sorting Tools' },
        
        // Remove Tools
        { name: 'Remove Consonants', url: '/remove/consonants', category: 'Remove Tools' },
        { name: 'Remove Duplicate Lines', url: '/remove/duplicate-lines', category: 'Remove Tools' },
        { name: 'Remove Duplicate Words', url: '/remove/duplicate-words', category: 'Remove Tools' },
        { name: 'Remove Empty Lines', url: '/remove/empty-lines', category: 'Remove Tools' },
        { name: 'Remove Extra Spaces', url: '/remove/extra-spaces', category: 'Remove Tools' },
        { name: 'Remove First Characters Of Each Line', url: '/remove/first-characters', category: 'Remove Tools' },
        { name: 'Remove Html Comments', url: '/remove/html-comments', category: 'Remove Tools' },
        { name: 'Remove Html Tags', url: '/remove/html-tags', category: 'Remove Tools' },
        { name: 'Remove Last Characters Of Each Line', url: '/remove/last-characters', category: 'Remove Tools' },
        { name: 'Remove Line Breaks', url: '/remove/line-breaks', category: 'Remove Tools' },
        { name: 'Remove Lines Containing A Certain Word', url: '/remove/lines-with-word', category: 'Remove Tools' },
        { name: 'Remove Numbers', url: '/remove/numbers', category: 'Remove Tools' },
        { name: 'Remove Numbers From Text', url: '/remove/numbers-from-text', category: 'Remove Tools' },
        { name: 'Remove Quotes From Text', url: '/remove/quotes', category: 'Remove Tools' },
        { name: 'Remove Single Quotes From Text', url: '/remove/single-quotes', category: 'Remove Tools' },
        { name: 'Remove Spaces', url: '/remove/spaces', category: 'Remove Tools' },
        { name: 'Remove Special Characters', url: '/remove/special-characters', category: 'Remove Tools' },
        { name: 'Remove Tabs From Text', url: '/remove/tabs', category: 'Remove Tools' },
        { name: 'Remove Text Between', url: '/remove/text-between', category: 'Remove Tools' },
        { name: 'Remove Vowels From Text', url: '/remove/vowels', category: 'Remove Tools' },
        { name: 'Removing Leading And Trailing Spaces', url: '/remove/trim-spaces', category: 'Remove Tools' },
        
        // Modify Tools
        { name: 'Add Number To Each Line', url: '/modify/add-number-to-each-line', category: 'Modify Tools' },
        { name: 'Add String After Number of Characters', url: '/modify/add-string-after-characters', category: 'Modify Tools' },
        { name: 'Add Text To Each Line', url: '/modify/add-text-to-each-line', category: 'Modify Tools' },
        { name: 'Column to Comma', url: '/modify/column-to-comma', category: 'Modify Tools' },
        { name: 'Commas Between Numbers', url: '/modify/commas-between-numbers', category: 'Modify Tools' },
        { name: 'Comma to Column', url: '/modify/comma-to-column', category: 'Modify Tools' },
        { name: 'Convert Double Space To Single Space', url: '/modify/double-space-to-single', category: 'Modify Tools' },
        { name: 'Convert Single Space To Double Space', url: '/modify/single-space-to-double', category: 'Modify Tools' },
        { name: 'Convert Text with Commas To Lines', url: '/modify/commas-to-lines', category: 'Modify Tools' },
        { name: 'Keep First Characters Of Each Line', url: '/modify/keep-first-characters', category: 'Modify Tools' },
        { name: 'Keep Last Characters Of Each Line', url: '/modify/keep-last-characters', category: 'Modify Tools' },
        { name: 'Keep Lines Containing A Certain Word', url: '/modify/keep-lines-with-word', category: 'Modify Tools' },
        { name: 'Keep Lines Containing A Certain Words', url: '/modify/keep-lines-with-words', category: 'Modify Tools' },
        { name: 'Merge Text or Lists', url: '/modify/merge-text-lists', category: 'Modify Tools' },
        { name: 'Number To Words', url: '/modify/number-to-words', category: 'Modify Tools' },
        { name: 'Prefix Suffix', url: '/modify/prefix-suffix', category: 'Modify Tools' },
        { name: 'Specified Position Text Addition', url: '/modify/position-text-addition', category: 'Modify Tools' },
        { name: 'Trim Text', url: '/modify/trim-text', category: 'Modify Tools' },
        
        // Replace Tools
        { name: 'Replace New Line with Commas', url: '/replace/newline-with-commas', category: 'Replace Tools' },
        { name: 'Replace Spaces', url: '/replace/spaces', category: 'Replace Tools' },
        { name: 'Replace Text Between', url: '/replace/text-between', category: 'Replace Tools' },
        { name: 'Search And Replace', url: '/replace/search-replace', category: 'Replace Tools' },
        
        // Conversion Tools
        { name: 'Base64 Decoder', url: '/conversions/base64-decoder', category: 'Conversion Tools' },
        { name: 'Base64 Encoder', url: '/conversions/base64-encoder', category: 'Conversion Tools' },
        { name: 'Date Conversion', url: '/conversions/date', category: 'Conversion Tools' },
        { name: 'Decimal to String', url: '/conversions/decimal-to-string', category: 'Conversion Tools' },
        { name: 'Html Entities Converter', url: '/conversions/html-entities', category: 'Conversion Tools' },
        { name: 'String to Decimal', url: '/conversions/string-to-decimal', category: 'Conversion Tools' },
        { name: 'Text To Binary Code', url: '/conversions/text-to-binary', category: 'Conversion Tools' },
        { name: 'Url Decode', url: '/conversions/url-decode', category: 'Conversion Tools' },
        { name: 'Url Encode', url: '/conversions/url-encode', category: 'Conversion Tools' },
        
        // Special Effects Tools
        { name: 'Backward', url: '/special-effects/backward', category: 'Special Effects Tools' },
        { name: 'Binary Code To Text', url: '/special-effects/binary-to-text', category: 'Special Effects Tools' },
        { name: 'Bold', url: '/special-effects/bold', category: 'Special Effects Tools' },
        { name: 'Bold Gothic Text', url: '/special-effects/bold-gothic', category: 'Special Effects Tools' },
        { name: 'Bold Italic', url: '/special-effects/bold-italic', category: 'Special Effects Tools' },
        { name: 'Circled Text', url: '/special-effects/circled', category: 'Special Effects Tools' },
        { name: 'Cursive Bold', url: '/special-effects/cursive-bold', category: 'Special Effects Tools' },
        { name: 'Flip Text', url: '/special-effects/flip-text', category: 'Special Effects Tools' },
        { name: 'Flip Words', url: '/special-effects/flip-words', category: 'Special Effects Tools' },
        { name: 'Gothic Text', url: '/special-effects/gothic', category: 'Special Effects Tools' },
        { name: 'Italic', url: '/special-effects/italic', category: 'Special Effects Tools' },
        { name: 'Outline Text', url: '/special-effects/outline', category: 'Special Effects Tools' },
        { name: 'Parentheses Around Letters', url: '/special-effects/parentheses', category: 'Special Effects Tools' },
        { name: 'Pascal Case', url: '/special-effects/pascal-case', category: 'Special Effects Tools' },
        { name: 'Reverse Words', url: '/special-effects/reverse-words', category: 'Special Effects Tools' },
        { name: 'Slashed', url: '/special-effects/slashed', category: 'Special Effects Tools' },
        { name: 'Snake Case', url: '/special-effects/snake-case', category: 'Special Effects Tools' },
        { name: 'Upside Down Text', url: '/special-effects/upside-down', category: 'Special Effects Tools' },
        { name: 'Wide Text', url: '/special-effects/wide-text', category: 'Special Effects Tools' },
        
        // Generator Tools
        { name: 'Lorem Ipsum Generator', url: '/generators/lorem-ipsum', category: 'Generator Tools' },
        { name: 'Random Color Generator', url: '/generators/color', category: 'Generator Tools' },
        { name: 'Random Date Generator', url: '/generators/date', category: 'Generator Tools' },
        { name: 'Random Email Generator', url: '/generators/email', category: 'Generator Tools' },
        { name: 'Random IP address Generator', url: '/generators/ip', category: 'Generator Tools' },
        { name: 'Random ipv6 Address Generator', url: '/generators/ipv6', category: 'Generator Tools' },
        { name: 'Random MAC address Generator', url: '/generators/mac', category: 'Generator Tools' },
        { name: 'Random Number Generator', url: '/generators/number', category: 'Generator Tools' },
        { name: 'Random User-agent Generator', url: '/generators/user-agent', category: 'Generator Tools' },
        { name: 'Random Password Generator', url: '/generators/password', category: 'Generator Tools' },
        { name: 'SEO Friendly URL Generator', url: '/generators/seo-url', category: 'Generator Tools' },
        { name: 'Sequential Number Generator', url: '/generators/sequential-number', category: 'Generator Tools' },
        { name: 'URL Slug Generator', url: '/generators/url-slug', category: 'Generator Tools' },
    ],
    get filteredTools() {
        if (!this.searchQuery) {
            return this.allTools;
        }
        const query = this.searchQuery.toLowerCase();
        return this.allTools.filter(tool => 
            tool.name.toLowerCase().includes(query) || 
            tool.category.toLowerCase().includes(query)
        );
    }
}" class="bg-white border border-gray-300 rounded-lg shadow-sm mb-6">
    <!-- Header Button -->
    <button @click="isOpen = !isOpen" 
            class="w-full px-4 py-3 flex items-center justify-center text-gray-700 hover:bg-gray-50 transition-colors rounded-lg">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <span class="font-medium">Search Tools</span>
        <svg class="w-4 h-4 ml-2 transform transition-transform duration-200"
             :class="{ 'rotate-180': isOpen }"
             fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
        </svg>
    </button>
    
    <!-- Collapsible Content -->
    <div x-show="isOpen" 
         x-cloak
         x-collapse
         class="border-t border-gray-200">
        <div class="p-4">
            <!-- Search Input -->
            <input type="text" 
                   x-model="searchQuery"
                   placeholder="Search Here"
                   class="w-full px-4 py-2 text-sm border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent mb-3">
            
            <!-- Tools List -->
            <div class="max-h-96 overflow-y-auto">
                <!-- Home Link -->
                <a href="/" 
                   class="block px-3 py-2 text-sm text-blue-600 hover:bg-blue-50 rounded-md transition-colors">
                    Home
                </a>
                
                <!-- Filtered Tools -->
                <template x-for="tool in filteredTools" :key="tool.url">
                    <a :href="tool.url" 
                       x-text="tool.name"
                       class="block px-3 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-md transition-colors"></a>
                </template>
                
                <!-- No Results -->
                <div x-show="filteredTools.length === 0" class="px-3 py-4 text-sm text-gray-500 text-center">
                    No tools found matching "<span x-text="searchQuery"></span>"
                </div>
            </div>
        </div>
    </div>
</div>

