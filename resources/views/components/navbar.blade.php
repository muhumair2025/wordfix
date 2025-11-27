<nav x-data="{ 
    mobileMenuOpen: false,
    activeDropdown: null,
    isNavInitialized: false,
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
    },
    init() {
        // Initialize navbar after small delay to prevent flickering
        setTimeout(() => {
            this.isNavInitialized = true;
        }, 50);
    }
}" x-init="init()" class="bg-white shadow-sm border-b border-gray-200 sticky top-0 z-50" :class="{'bg-gray-900 border-gray-700': document.documentElement.classList.contains('dark') || document.body.getAttribute('data-theme') === 'dark'}">
    <div class="w-full px-4 sm:px-6 lg:px-8">
        <!-- Two-row layout for laptop and desktop screens (lg to 2xl) -->
        <div class="hidden lg:flex 2xl:hidden flex-col">
            <!-- First row: Logo and Auth -->
            <div class="flex items-center justify-between h-12 border-b border-gray-100">
                <div class="flex-shrink-0">
                    <a href="/" class="flex items-center">
                        <img src="{{ asset('images/logo.png') }}" alt="WordFix" class="h-10">
                    </a>
                </div>
                <div class="flex items-center space-x-2">
                    @auth
                        @if(Auth::user()->role === 'admin')
                            <a href="/admin" class="px-2 py-1 text-xs font-medium text-purple-600 hover:text-purple-700 hover:bg-purple-50 rounded-md transition-all duration-200 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                Admin
                            </a>
                        @endif
                        <span class="text-xs text-gray-600">{{ Str::limit(Auth::user()->name, 12) }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-2 py-1 text-xs font-medium text-red-600 hover:text-red-700 hover:bg-red-50 rounded-md transition-all duration-200">
                                Logout
                            </button>
                        </form>
                    @else
                        <!-- Dark Mode Toggle -->
                        <button onclick="toggleTheme()" class="theme-toggle mr-2" title="Toggle Dark Mode">
                            <svg class="moon-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                            </svg>
                            <svg class="sun-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                            </svg>
                        </button>
                        
                        <a href="{{ route('login') }}" class="px-2 py-1 text-xs font-medium text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-md transition-all duration-200">Login</a>
                        <a href="{{ route('register') }}" class="px-2 py-1 text-xs font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md transition-all duration-200">Register</a>
                    @endauth
                </div>
            </div>
            <!-- Second row: Navigation -->
            <div class="flex items-center justify-center h-12">
                <div class="flex items-center space-x-0.5">
                    <template x-for="(menu, key) in menus" :key="key">
                        <div class="relative" @click.away="activeDropdown = null">
                            <button @click.stop="activeDropdown = (activeDropdown === key ? null : key)"
                                    class="px-2 py-1 text-xs font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-all duration-200 flex items-center gap-0.5"
                                    :class="{ 'text-blue-600 bg-blue-50': activeDropdown === key }">
                                <span x-text="menu.title" class="whitespace-nowrap"></span>
                                <svg class="w-2.5 h-2.5 transition-transform duration-200" 
                                     :class="activeDropdown === key ? 'rotate-90' : 'rotate-0'"
                                     fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </button>
                            <!-- Dropdown Menu -->
                            <div x-show="activeDropdown === key"
                                 x-cloak
                                 @click.stop
                                 x-transition:enter="transition ease-out duration-200"
                                 x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave="transition ease-in duration-150"
                                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                 x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                                 class="absolute left-0 mt-1 w-64 bg-white rounded-lg shadow-lg border border-gray-100 py-1 max-h-72 overflow-y-auto z-50">
                                <template x-for="item in menu.items" :key="item.url">
                                    <a :href="item.url" 
                                       x-text="item.name"
                                       @click="activeDropdown = null"
                                       class="block px-2 py-1.5 text-xs text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-150 mx-1 rounded-md"></a>
                                </template>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
        
        <!-- Single row layout for very large screens and mobile -->
        <div class="flex items-center h-16 lg:hidden 2xl:flex">
            <!-- Logo -->
            <div class="flex-shrink-0 mr-8">
                <a href="/" class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="WordFix" class="h-12 md:h-14">
                </a>
            </div>
            
            <!-- Desktop Navigation for Very Large Screens (2xl and above) -->
            <div class="hidden 2xl:flex items-center space-x-0.5 flex-1">
                <template x-for="(menu, key) in menus" :key="key">
                    <div class="relative" 
                         @click.away="activeDropdown = null">
                        <button @click.stop="activeDropdown = (activeDropdown === key ? null : key)"
                                class="px-2.5 py-1.5 text-xs font-medium text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-all duration-200 flex items-center gap-1"
                                :class="{ 'text-blue-600 bg-blue-50': activeDropdown === key }">
                            <span x-text="menu.title" class="whitespace-nowrap"></span>
                            <!-- Right arrow by default, down arrow on click/active -->
                            <svg class="w-3 h-3 transition-transform duration-200" 
                                 :class="activeDropdown === key ? 'rotate-90' : 'rotate-0'"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </button>
                        
                        <!-- Dropdown Menu -->
                        <div x-show="activeDropdown === key"
                             x-cloak
                             @click.stop
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 translate-y-1 scale-95"
                             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                             x-transition:leave-end="opacity-0 translate-y-1 scale-95"
                             class="absolute left-0 mt-1 w-72 bg-white rounded-lg shadow-lg border border-gray-100 py-1 max-h-72 overflow-y-auto z-50">
                            <template x-for="item in menu.items" :key="item.url">
                                <a :href="item.url" 
                                   x-text="item.name"
                                   @click="activeDropdown = null"
                                   class="block px-2.5 py-1.5 text-xs text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-colors duration-150 mx-1 rounded-md"></a>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
            
            <!-- Desktop Auth Buttons for Very Large Screens -->
            <div class="hidden 2xl:flex items-center space-x-3 ml-4">
                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="/admin" class="px-3 py-1.5 text-xs font-medium text-purple-600 hover:text-purple-700 hover:bg-purple-50 rounded-md transition-all duration-200 flex items-center gap-1">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            Admin
                        </a>
                    @endif
                    <div class="flex items-center space-x-1 xl:space-x-2">
                        <span class="text-xs text-gray-600">Hi, {{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="px-3 py-1.5 text-xs font-medium text-red-600 hover:text-red-700 hover:bg-red-50 rounded-md transition-all duration-200 flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                @else
                    <!-- Dark Mode Toggle for Desktop -->
                    <button onclick="toggleTheme()" class="theme-toggle mr-2" title="Toggle Dark Mode">
                        <svg class="moon-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <svg class="sun-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </button>
                    
                    <a href="{{ route('login') }}" class="px-3 py-1.5 text-xs font-medium text-blue-600 hover:text-blue-700 hover:bg-blue-50 rounded-md transition-all duration-200 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="px-3 py-1.5 text-xs font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md transition-all duration-200 flex items-center gap-1">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                        </svg>
                        Register
                    </a>
                @endauth
            </div>
            
            <!-- Mobile/Tablet menu button - Show on screens smaller than lg (1024px) -->
            <div class="lg:hidden ml-auto">
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-colors duration-200">
                    <svg class="w-5 h-5 transition-transform duration-200" 
                         :class="mobileMenuOpen ? 'rotate-90' : 'rotate-0'"
                         fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 -translate-y-2"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 -translate-y-2"
         class="lg:hidden border-t border-gray-100 bg-gradient-to-b from-white to-gray-50"
         :class="{'border-gray-700 bg-gradient-to-b from-gray-900 to-gray-800': document.body.getAttribute('data-theme') === 'dark'}">
        <div class="px-3 pt-3 pb-4 space-y-2 max-h-[calc(100vh-4rem)] overflow-y-auto"
             :class="{'bg-gray-900': document.body.getAttribute('data-theme') === 'dark'}">
            <template x-for="(menu, key) in menus" :key="key">
                <div class="bg-white rounded-xl border border-gray-100 shadow-sm overflow-hidden"
                     :class="{'bg-gray-800 border-gray-600': document.body.getAttribute('data-theme') === 'dark'}">
                    <button @click="activeDropdown = (activeDropdown === key ? null : key)"
                            class="w-full flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-200"
                            :class="{ 
                                'bg-blue-50 text-blue-600': activeDropdown === key && document.body.getAttribute('data-theme') !== 'dark',
                                'bg-blue-900 text-blue-300': activeDropdown === key && document.body.getAttribute('data-theme') === 'dark',
                                'text-white hover:bg-gray-700 hover:text-blue-300': document.body.getAttribute('data-theme') === 'dark'
                            }">
                        <span x-text="menu.title"></span>
                        <svg class="w-4 h-4 transform transition-transform duration-200"
                             :class="activeDropdown === key ? 'rotate-90' : 'rotate-0'"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </button>
                    <div x-show="activeDropdown === key" 
                         x-cloak
                         x-collapse
                         class="border-t border-gray-100 bg-gray-50"
                         :class="{'border-gray-600 bg-gray-700': document.body.getAttribute('data-theme') === 'dark'}">
                        <div class="py-2 space-y-1">
                            <template x-for="item in menu.items" :key="item.url">
                                <a :href="item.url" 
                                   x-text="item.name"
                                   @click="mobileMenuOpen = false"
                                   class="block px-4 py-2.5 text-sm text-gray-600 hover:bg-white hover:text-blue-600 hover:border-l-4 hover:border-blue-400 transition-all duration-200 border-l-4 border-transparent"
                                   :class="{
                                       'text-gray-300 hover:bg-gray-600 hover:text-blue-300': document.body.getAttribute('data-theme') === 'dark'
                                   }"></a>
                            </template>
                        </div>
                    </div>
                </div>
            </template>
            
            <!-- Mobile Auth Section -->
            <div class="mt-4 pt-4 border-t border-gray-200"
                 :class="{'border-gray-600': document.body.getAttribute('data-theme') === 'dark'}">
                @auth
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4">
                        <div class="flex items-center justify-between mb-3">
                            <div>
                                <div class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                            @if(Auth::user()->role === 'admin')
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                    Admin
                                </span>
                            @endif
                        </div>
                        <div class="space-y-2">
                            @if(Auth::user()->role === 'admin')
                                <a href="/admin" class="w-full flex items-center justify-center px-3 py-2 text-sm font-medium text-purple-600 bg-purple-50 rounded-lg hover:bg-purple-100 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                    Admin Panel
                                </a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="w-full">
                                @csrf
                                <button type="submit" class="w-full flex items-center justify-center px-3 py-2 text-sm font-medium text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-xl border border-gray-100 shadow-sm p-4"
                         :class="{'bg-gray-800 border-gray-600': document.body.getAttribute('data-theme') === 'dark'}">
                        <div class="space-y-2">
                            <!-- Dark Mode Toggle for Mobile -->
                            <button onclick="toggleTheme()" class="w-full flex items-center justify-center px-3 py-2 text-sm font-medium text-gray-700 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-200 theme-toggle-mobile"
                                    :class="{'text-white bg-gray-700 hover:bg-gray-600': document.body.getAttribute('data-theme') === 'dark'}">
                                <svg class="w-4 h-4 mr-2 moon-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                                </svg>
                                <svg class="w-4 h-4 mr-2 sun-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                                </svg>
                                <span class="theme-text"></span>
                            </button>
                            
                            <div x-show="isNavInitialized" x-transition>
                                <a href="{{ route('login') }}" class="w-full flex items-center justify-center px-3 py-2 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-200"
                                   :class="{'text-blue-300 bg-blue-900 hover:bg-blue-800': document.body.getAttribute('data-theme') === 'dark'}">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                                    </svg>
                                    Login
                                </a>
                                <a href="{{ route('register') }}" class="w-full flex items-center justify-center px-3 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-colors duration-200"
                                   :class="{'bg-blue-700 hover:bg-blue-600': document.body.getAttribute('data-theme') === 'dark'}">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                                    </svg>
                                    Register
                                </a>
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

