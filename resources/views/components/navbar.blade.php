<nav x-data="{ 
    mobileMenuOpen: false,
    activeDropdown: null,
    menus: {
        'basic': {
            title: 'Basic',
            items: [
                { name: 'Alternate Case', url: '/basic/alternate-case' },
                { name: 'Capitalize Words', url: '/basic/capitalize-words' },
                { name: 'Invert Case', url: '/basic/invert-case' },
                { name: 'Lower Case', url: '/basic/lower-case' },
                { name: 'Sentence Case', url: '/basic/sentence-case' },
                { name: 'Strikethrough', url: '/basic/strikethrough' },
                { name: 'Title Case', url: '/basic/title-case' },
                { name: 'Underline', url: '/basic/underline' },
                { name: 'Upper Case', url: '/basic/upper-case' }
            ]
        },
        'counter': {
            title: 'Counter',
            items: [
                { name: 'Character and Word Counter', url: '/counter/character-word-counter' },
                { name: 'Count Each Line', url: '/counter/count-each-line' },
                { name: 'Bracket and Tag Counter', url: '/counter/bracket-tag-counter' }
            ]
        },
        'formatter': {
            title: 'Formatter',
            items: [
                { name: 'CSS Beautifier', url: '/formatter/css-beautifier' },
                { name: 'HTML Beautifier', url: '/formatter/html-beautifier' },
                { name: 'JavaScript Beautifier', url: '/formatter/javascript-beautifier' },
                { name: 'JSON Beautifier', url: '/formatter/json-beautifier' },
                { name: 'SQL Beautifier', url: '/formatter/sql-beautifier' }
            ]
        },
        'modify': {
            title: 'Modify',
            items: [
                { name: 'Add Number To Each Line', url: '/modify/add-number-to-each-line' },
                { name: 'Add String After Number of Characters', url: '/modify/add-string-after-characters' },
                { name: 'Add Text To Each Line', url: '/modify/add-text-to-each-line' },
                { name: 'Column to Comma', url: '/modify/column-to-comma' },
                { name: 'Commas Between Numbers', url: '/modify/commas-between-numbers' },
                { name: 'Comma to Column', url: '/modify/comma-to-column' },
                { name: 'Convert Double Space To Single Space', url: '/modify/double-space-to-single' },
                { name: 'Convert Single Space To Double Space', url: '/modify/single-space-to-double' },
                { name: 'Keep First Characters Of Each Line', url: '/modify/keep-first-characters' },
                { name: 'Keep Last Characters Of Each Line', url: '/modify/keep-last-characters' },
                { name: 'Keep Lines Containing A Certain Word', url: '/modify/keep-lines-with-word' },
                { name: 'Keep Lines Containing A Certain Words', url: '/modify/keep-lines-with-words' },
                { name: 'Merge Text or Lists', url: '/modify/merge-text-lists' },
                { name: 'Number To Words', url: '/modify/number-to-words' },
                { name: 'Prefix Suffix', url: '/modify/prefix-suffix' },
                { name: 'Specified Position Text Addition', url: '/modify/position-text-addition' },
                { name: 'Trim Text', url: '/modify/trim-text' }
            ]
        },
        'special-effects': {
            title: 'Special Effects',
            items: [
                { name: 'Backward', url: '/special-effects/backward' },
                { name: 'Binary Code To Text', url: '/special-effects/binary-to-text' },
                { name: 'Bold', url: '/special-effects/bold' },
                { name: 'Bold Gothic Text', url: '/special-effects/bold-gothic' },
                { name: 'Bold Italic', url: '/special-effects/bold-italic' },
                { name: 'Circled Text', url: '/special-effects/circled' },
                { name: 'Cursive Bold', url: '/special-effects/cursive-bold' },
                { name: 'Flip Text', url: '/special-effects/flip-text' },
                { name: 'Flip Words', url: '/special-effects/flip-words' },
                { name: 'Gothic Text', url: '/special-effects/gothic' },
                { name: 'Italic', url: '/special-effects/italic' },
                { name: 'Outline Text', url: '/special-effects/outline' },
                { name: 'Parentheses Around Letters', url: '/special-effects/parentheses' },
                { name: 'Pascal Case', url: '/special-effects/pascal-case' },
                { name: 'Reverse Words', url: '/special-effects/reverse-words' },
                { name: 'Slashed', url: '/special-effects/slashed' },
                { name: 'Snake Case', url: '/special-effects/snake-case' },
                { name: 'Upside Down Text', url: '/special-effects/upside-down' },
                { name: 'Wide Text', url: '/special-effects/wide-text' }
            ]
        },
        'extract': {
            title: 'Extract',
            items: [
                { name: 'Extract Emails', url: '/extract/emails' },
                { name: 'Extract Hex Colors', url: '/extract/hex-colors' },
                { name: 'Extract Image Urls', url: '/extract/image-urls' },
                { name: 'Extract IP Address', url: '/extract/ip-address' },
                { name: 'Extract Phone Numbers', url: '/extract/phone-numbers' },
                { name: 'Extract Numbers From Text', url: '/extract/numbers' },
                { name: 'Extract Text Between', url: '/extract/text-between' },
                { name: 'Extract Urls', url: '/extract/urls' },
                { name: 'Extract Random Lines', url: '/extract/random-lines' },
                { name: 'Extract Zip Codes', url: '/extract/zip-codes' }
            ]
        },
        'sorting': {
            title: 'Sorting',
            items: [
                { name: 'Alphabetical Sort', url: '/sorting/alphabetical' },
                { name: 'Length Sort', url: '/sorting/length' },
                { name: 'Randomly Sort Lines of Text', url: '/sorting/random' },
                { name: 'Sort Numbers', url: '/sorting/numbers' }
            ]
        },
        'remove': {
            title: 'Remove',
            items: [
                { name: 'Remove Consonants', url: '/remove/consonants' },
                { name: 'Remove Duplicate Lines', url: '/remove/duplicate-lines' },
                { name: 'Remove Duplicate Words', url: '/remove/duplicate-words' },
                { name: 'Remove Empty Lines', url: '/remove/empty-lines' },
                { name: 'Remove Extra Spaces', url: '/remove/extra-spaces' },
                { name: 'Remove First Characters', url: '/remove/first-characters' },
                { name: 'Remove HTML Comments', url: '/remove/html-comments' },
                { name: 'Remove HTML Tags', url: '/remove/html-tags' },
                { name: 'Remove Last Characters', url: '/remove/last-characters' },
                { name: 'Remove Letters', url: '/remove/letters' },
                { name: 'Remove Line Breaks', url: '/remove/line-breaks' },
                { name: 'Remove Lines With Word', url: '/remove/lines-with-word' },
                { name: 'Remove Numbers', url: '/remove/numbers' },
                { name: 'Remove Numbers From Text', url: '/remove/numbers-from-text' },
                { name: 'Remove Quotes', url: '/remove/quotes' },
                { name: 'Remove Single Quotes', url: '/remove/single-quotes' },
                { name: 'Remove Spaces', url: '/remove/spaces' },
                { name: 'Remove Special Characters', url: '/remove/special-characters' },
                { name: 'Remove Specific Words', url: '/remove/specific-words' },
                { name: 'Remove Tabs', url: '/remove/tabs' },
                { name: 'Remove Text Between', url: '/remove/text-between' },
                { name: 'Remove URLs', url: '/remove/urls' },
                { name: 'Remove Vowels', url: '/remove/vowels' },
                { name: 'Trim Spaces', url: '/remove/trim-spaces' }
            ]
        },
        'replace': {
            title: 'Replace',
            items: [
                { name: 'Replace New Line with Commas', url: '/replace/newline-with-commas' },
                { name: 'Replace Spaces', url: '/replace/spaces' },
                { name: 'Replace Text Between', url: '/replace/text-between' },
                { name: 'Search And Replace', url: '/replace/search-replace' }
            ]
        },
        'conversions': {
            title: 'Conversions',
            items: [
                { name: 'Base64 Decoder', url: '/conversions/base64-decoder' },
                { name: 'Base64 Encoder', url: '/conversions/base64-encoder' },
                { name: 'Date Conversion', url: '/conversions/date' },
                { name: 'Decimal to String', url: '/conversions/decimal-to-string' },
                { name: 'Html Entities Converter', url: '/conversions/html-entities' },
                { name: 'String to Decimal', url: '/conversions/string-to-decimal' },
                { name: 'Text To Binary Code', url: '/conversions/text-to-binary' },
                { name: 'Url Decode', url: '/conversions/url-decode' },
                { name: 'Url Encode', url: '/conversions/url-encode' }
            ]
        },
        'generators': {
            title: 'Generators',
            items: [
                { name: 'Lorem Ipsum Generator', url: '/generators/lorem-ipsum' },
                { name: 'Random Phone Number Generator', url: '/generators/random-phone-number' },
                { name: 'Random Color Generator', url: '/generators/color' },
                { name: 'Random Date Generator', url: '/generators/date' },
                { name: 'Random Email Generator', url: '/generators/email' },
                { name: 'Random IP address Generator', url: '/generators/ip' },
                { name: 'Random ipv6 Address Generator', url: '/generators/ipv6' },
                { name: 'Random MAC address Generator', url: '/generators/mac' },
                { name: 'Random Number Generator', url: '/generators/number' },
                { name: 'Random User-agent Generator', url: '/generators/user-agent' },
                { name: 'Random Password Generator', url: '/generators/password' },
                { name: 'SEO Friendly URL Generator', url: '/generators/seo-url' },
                { name: 'Sequential Number Generator', url: '/generators/sequential-number' },
                { name: 'URL Slug Generator', url: '/generators/url-slug' }
            ]
        },
        'studio': {
            title: '✨ Studio',
            items: [
                { name: 'TextFlow Pipeline', url: '/studio/text-flow' }
            ]
        }
    }
}" class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <div class="flex items-center h-20">
            <!-- Logo -->
            <div class="flex-shrink-0 mr-8">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="WordFix" class="h-12 md:h-14">
                </a>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-1 flex-1">
                <template x-for="(menu, key) in menus" :key="key">
                    <div class="relative" 
                         @mouseenter="activeDropdown = key" 
                         @mouseleave="activeDropdown = null">
                        <button class="px-3 py-2 text-sm font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors duration-150"
                                :class="{ 'text-blue-600 bg-blue-50': activeDropdown === key }">
                            <span x-text="menu.title"></span>
                            <svg class="inline-block w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="activeDropdown === key"
                             x-cloak
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-1"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 translate-y-1"
                             class="absolute left-0 mt-2 w-72 bg-white rounded-lg shadow-lg border border-gray-200 py-2 max-h-96 overflow-y-auto">
                            <template x-for="item in menu.items" :key="item.url">
                                <a :href="item.url" 
                                   x-text="item.name"
                                   class="block px-4 py-2 text-xs text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-150 whitespace-nowrap"></a>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
            
            <!-- Mobile menu button -->
            <div class="lg:hidden ml-auto">
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Navigation -->
    <div x-show="mobileMenuOpen" 
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-1"
         class="lg:hidden border-t border-gray-200 bg-white">
        <div class="px-2 pt-2 pb-3 space-y-1 max-h-[calc(100vh-4rem)] overflow-y-auto">
            <template x-for="(menu, key) in menus" :key="key">
                <div class="border-b border-gray-100 pb-2">
                    <button @click="activeDropdown = (activeDropdown === key ? null : key)"
                            class="w-full flex items-center justify-between px-3 py-2 text-base font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600 rounded-md">
                        <span x-text="menu.title"></span>
                        <svg class="w-5 h-5 transform transition-transform duration-200"
                             :class="{ 'rotate-180': activeDropdown === key }"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                    <div x-show="activeDropdown === key" 
                         x-cloak
                         x-collapse
                         class="mt-1 space-y-1 pl-4">
                        <template x-for="item in menu.items" :key="item.url">
                            <a :href="item.url" 
                               x-text="item.name"
                               class="block px-3 py-2 text-sm text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-md"></a>
                        </template>
                    </div>
                </div>
            </template>
        </div>
    </div>
</nav>

