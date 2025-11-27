<script>
function createSearchComponent() {
    return {
        isOpen: false,
        searchQuery: '',
        selectedIndex: -1,
        isInitialized: false,
        allTools: [
            // Basic Tools
            { name: 'Alternate Case', url: '/basic/alternate-case', category: 'Basic', description: 'Convert text to alternating uppercase and lowercase letters', keywords: ['alternate', 'case', 'mixed', 'toggle'] },
            { name: 'Capitalize Words', url: '/basic/capitalize-words', category: 'Basic', description: 'Capitalize the first letter of each word', keywords: ['capitalize', 'title', 'proper', 'first letter'] },
            { name: 'Invert Case', url: '/basic/invert-case', category: 'Basic', description: 'Invert uppercase to lowercase and vice versa', keywords: ['invert', 'flip', 'reverse', 'case', 'swap'] },
            { name: 'Lower Case', url: '/basic/lower-case', category: 'Basic', description: 'Convert all text to lowercase letters', keywords: ['lowercase', 'small', 'minuscule'] },
            { name: 'Sentence Case', url: '/basic/sentence-case', category: 'Basic', description: 'Capitalize only the first letter of sentences', keywords: ['sentence', 'proper', 'grammar'] },
            { name: 'Strikethrough', url: '/basic/strikethrough', category: 'Basic', description: 'Add strikethrough effect to text', keywords: ['strikethrough', 'cross out', 'line through', 'delete'] },
            { name: 'Title Case', url: '/basic/title-case', category: 'Basic', description: 'Convert text to proper title case formatting', keywords: ['title', 'headline', 'proper case'] },
            { name: 'Underline', url: '/basic/underline', category: 'Basic', description: 'Add underline formatting to text', keywords: ['underline', 'underscore', 'emphasis'] },
            { name: 'Upper Case', url: '/basic/upper-case', category: 'Basic', description: 'Convert all text to uppercase letters', keywords: ['uppercase', 'capital', 'caps', 'shout'] },
            
            // Counter Tools
            { name: 'Character and Word Counter', url: '/counter/character-word-counter', category: 'Counter', description: 'Count characters, words, sentences, and paragraphs', keywords: ['count', 'characters', 'words', 'length', 'statistics'] },
            { name: 'Count Each Line', url: '/counter/count-each-line', category: 'Counter', description: 'Count characters or words in each line separately', keywords: ['count', 'line', 'individual', 'per line'] },
            { name: 'Bracket and Tag Counter', url: '/counter/bracket-tag-counter', category: 'Counter', description: 'Count brackets, tags, and other symbols', keywords: ['brackets', 'tags', 'symbols', 'count', 'html'] },
            
            // Extract Tools
            { name: 'Extract Emails', url: '/extract/emails', category: 'Extract', description: 'Extract email addresses from text', keywords: ['email', 'extract', 'find', 'addresses', '@'] },
            { name: 'Extract Hex Colors', url: '/extract/hex-colors', category: 'Extract', description: 'Extract hexadecimal color codes from text', keywords: ['hex', 'colors', 'extract', '#', 'css'] },
            { name: 'Extract Image URLs', url: '/extract/image-urls', category: 'Extract', description: 'Extract image URLs from text', keywords: ['image', 'urls', 'pictures', 'extract', 'links'] },
            { name: 'Extract IP Address', url: '/extract/ip-address', category: 'Extract', description: 'Extract IP addresses from text', keywords: ['ip', 'address', 'network', 'extract'] },
            { name: 'Extract Phone Numbers', url: '/extract/phone-numbers', category: 'Extract', description: 'Extract phone numbers from text', keywords: ['phone', 'numbers', 'telephone', 'extract'] },
            { name: 'Extract Numbers', url: '/extract/numbers', category: 'Extract', description: 'Extract all numbers from text', keywords: ['numbers', 'digits', 'extract', 'numeric'] },
            { name: 'Extract Text Between', url: '/extract/text-between', category: 'Extract', description: 'Extract text between specific characters or strings', keywords: ['between', 'extract', 'delimiters', 'substring'] },
            { name: 'Extract URLs', url: '/extract/urls', category: 'Extract', description: 'Extract web URLs from text', keywords: ['urls', 'links', 'websites', 'extract', 'http'] },
            { name: 'Extract Random Lines', url: '/extract/random-lines', category: 'Extract', description: 'Extract random lines from text', keywords: ['random', 'lines', 'sample', 'extract'] },
            { name: 'Extract Zip Codes', url: '/extract/zip-codes', category: 'Extract', description: 'Extract postal/zip codes from text', keywords: ['zip', 'postal', 'codes', 'extract'] },
            
            // Formatter Tools
            { name: 'CSS Beautifier', url: '/formatter/css-beautifier', category: 'Formatter', description: 'Format and beautify CSS code', keywords: ['css', 'beautify', 'format', 'pretty', 'style'] },
            { name: 'HTML Beautifier', url: '/formatter/html-beautifier', category: 'Formatter', description: 'Format and beautify HTML code', keywords: ['html', 'beautify', 'format', 'pretty', 'markup'] },
            { name: 'JavaScript Beautifier', url: '/formatter/javascript-beautifier', category: 'Formatter', description: 'Format and beautify JavaScript code', keywords: ['javascript', 'js', 'beautify', 'format', 'pretty'] },
            { name: 'JSON Beautifier', url: '/formatter/json-beautifier', category: 'Formatter', description: 'Format and beautify JSON data', keywords: ['json', 'beautify', 'format', 'pretty', 'data'] },
            { name: 'SQL Beautifier', url: '/formatter/sql-beautifier', category: 'Formatter', description: 'Format and beautify SQL queries', keywords: ['sql', 'beautify', 'format', 'pretty', 'database'] },
            
            // Sorting Tools
            { name: 'Alphabetical Sort', url: '/sorting/alphabetical', category: 'Sorting', description: 'Sort lines alphabetically A-Z or Z-A', keywords: ['sort', 'alphabetical', 'order', 'arrange'] },
            { name: 'Length Sort', url: '/sorting/length', category: 'Sorting', description: 'Sort lines by character length', keywords: ['sort', 'length', 'size', 'characters'] },
            { name: 'Random Sort', url: '/sorting/random', category: 'Sorting', description: 'Randomly shuffle lines of text', keywords: ['random', 'shuffle', 'mix', 'sort'] },
            { name: 'Sort Numbers', url: '/sorting/numbers', category: 'Sorting', description: 'Sort numbers in ascending or descending order', keywords: ['sort', 'numbers', 'numeric', 'order'] },
            
            // Remove Tools
            { name: 'Remove Consonants', url: '/remove/consonants', category: 'Remove', description: 'Remove all consonant letters from text', keywords: ['remove', 'consonants', 'letters', 'vowels only'] },
            { name: 'Remove Duplicate Lines', url: '/remove/duplicate-lines', category: 'Remove', description: 'Remove duplicate lines from text', keywords: ['remove', 'duplicate', 'lines', 'unique'] },
            { name: 'Remove Duplicate Words', url: '/remove/duplicate-words', category: 'Remove', description: 'Remove duplicate words from text', keywords: ['remove', 'duplicate', 'words', 'unique'] },
            { name: 'Remove Empty Lines', url: '/remove/empty-lines', category: 'Remove', description: 'Remove blank or empty lines', keywords: ['remove', 'empty', 'blank', 'lines'] },
            { name: 'Remove Extra Spaces', url: '/remove/extra-spaces', category: 'Remove', description: 'Remove extra spaces between words', keywords: ['remove', 'extra', 'spaces', 'whitespace'] },
            { name: 'Remove First Characters', url: '/remove/first-characters', category: 'Remove', description: 'Remove first N characters from each line', keywords: ['remove', 'first', 'characters', 'beginning'] },
            { name: 'Remove HTML Comments', url: '/remove/html-comments', category: 'Remove', description: 'Remove HTML comments from code', keywords: ['remove', 'html', 'comments', 'clean'] },
            { name: 'Remove HTML Tags', url: '/remove/html-tags', category: 'Remove', description: 'Remove HTML tags and keep only text', keywords: ['remove', 'html', 'tags', 'strip', 'clean'] },
            { name: 'Remove Last Characters', url: '/remove/last-characters', category: 'Remove', description: 'Remove last N characters from each line', keywords: ['remove', 'last', 'characters', 'end'] },
            { name: 'Remove Letters', url: '/remove/letters', category: 'Remove', description: 'Remove all letters and keep only numbers/symbols', keywords: ['remove', 'letters', 'alphabetic', 'text'] },
            { name: 'Remove Line Breaks', url: '/remove/line-breaks', category: 'Remove', description: 'Remove line breaks and join text', keywords: ['remove', 'line breaks', 'newlines', 'join'] },
            { name: 'Remove Lines With Word', url: '/remove/lines-with-word', category: 'Remove', description: 'Remove lines containing specific words', keywords: ['remove', 'lines', 'containing', 'filter'] },
            { name: 'Remove Numbers', url: '/remove/numbers', category: 'Remove', description: 'Remove all numbers from text', keywords: ['remove', 'numbers', 'digits', 'numeric'] },
            { name: 'Remove Numbers From Text', url: '/remove/numbers-from-text', category: 'Remove', description: 'Remove numeric characters from text', keywords: ['remove', 'numbers', 'digits', 'text only'] },
            { name: 'Remove Quotes', url: '/remove/quotes', category: 'Remove', description: 'Remove quotation marks from text', keywords: ['remove', 'quotes', 'quotation', 'marks'] },
            { name: 'Remove Single Quotes', url: '/remove/single-quotes', category: 'Remove', description: 'Remove single quotation marks', keywords: ['remove', 'single', 'quotes', 'apostrophes'] },
            { name: 'Remove Spaces', url: '/remove/spaces', category: 'Remove', description: 'Remove all spaces from text', keywords: ['remove', 'spaces', 'whitespace', 'compact'] },
            { name: 'Remove Special Characters', url: '/remove/special-characters', category: 'Remove', description: 'Remove special characters and symbols', keywords: ['remove', 'special', 'characters', 'symbols', 'clean'] },
            { name: 'Remove Specific Words', url: '/remove/specific-words', category: 'Remove', description: 'Remove specific words from text', keywords: ['remove', 'specific', 'words', 'filter'] },
            { name: 'Remove Tabs', url: '/remove/tabs', category: 'Remove', description: 'Remove tab characters from text', keywords: ['remove', 'tabs', 'whitespace'] },
            { name: 'Remove Text Between', url: '/remove/text-between', category: 'Remove', description: 'Remove text between specific delimiters', keywords: ['remove', 'between', 'delimiters', 'substring'] },
            { name: 'Remove URLs', url: '/remove/urls', category: 'Remove', description: 'Remove web URLs from text', keywords: ['remove', 'urls', 'links', 'websites'] },
            { name: 'Remove Vowels', url: '/remove/vowels', category: 'Remove', description: 'Remove vowel letters from text', keywords: ['remove', 'vowels', 'consonants only'] },
            { name: 'Trim Spaces', url: '/remove/trim-spaces', category: 'Remove', description: 'Remove leading and trailing spaces', keywords: ['trim', 'spaces', 'leading', 'trailing'] },
            
            // Modify Tools
            { name: 'Add Number To Each Line', url: '/modify/add-number-to-each-line', category: 'Modify', description: 'Add line numbers to each line', keywords: ['add', 'numbers', 'line numbers', 'numbering'] },
            { name: 'Add String After Characters', url: '/modify/add-string-after-characters', category: 'Modify', description: 'Add text after specific number of characters', keywords: ['add', 'string', 'after', 'characters', 'insert'] },
            { name: 'Add Text To Each Line', url: '/modify/add-text-to-each-line', category: 'Modify', description: 'Add prefix or suffix to each line', keywords: ['add', 'text', 'prefix', 'suffix', 'lines'] },
            { name: 'Column to Comma', url: '/modify/column-to-comma', category: 'Modify', description: 'Convert column data to comma-separated values', keywords: ['column', 'comma', 'csv', 'convert'] },
            { name: 'Comma to Column', url: '/modify/comma-to-column', category: 'Modify', description: 'Convert comma-separated values to columns', keywords: ['comma', 'column', 'csv', 'convert'] },
            { name: 'Commas Between Numbers', url: '/modify/commas-between-numbers', category: 'Modify', description: 'Add commas as thousand separators in numbers', keywords: ['commas', 'numbers', 'thousands', 'format'] },
            { name: 'Double Space to Single', url: '/modify/double-space-to-single', category: 'Modify', description: 'Convert double spaces to single spaces', keywords: ['double', 'single', 'space', 'convert'] },
            { name: 'Single Space to Double', url: '/modify/single-space-to-double', category: 'Modify', description: 'Convert single spaces to double spaces', keywords: ['single', 'double', 'space', 'convert'] },
            { name: 'Keep First Characters', url: '/modify/keep-first-characters', category: 'Modify', description: 'Keep only first N characters of each line', keywords: ['keep', 'first', 'characters', 'truncate'] },
            { name: 'Keep Last Characters', url: '/modify/keep-last-characters', category: 'Modify', description: 'Keep only last N characters of each line', keywords: ['keep', 'last', 'characters', 'truncate'] },
            { name: 'Keep Lines With Word', url: '/modify/keep-lines-with-word', category: 'Modify', description: 'Keep only lines containing specific word', keywords: ['keep', 'lines', 'containing', 'filter'] },
            { name: 'Keep Lines With Words', url: '/modify/keep-lines-with-words', category: 'Modify', description: 'Keep lines containing any of specified words', keywords: ['keep', 'lines', 'words', 'filter'] },
            { name: 'Merge Text Lists', url: '/modify/merge-text-lists', category: 'Modify', description: 'Merge multiple text lists together', keywords: ['merge', 'combine', 'lists', 'join'] },
            { name: 'Number To Words', url: '/modify/number-to-words', category: 'Modify', description: 'Convert numbers to written words', keywords: ['number', 'words', 'spell out', 'convert'] },
            { name: 'Prefix Suffix', url: '/modify/prefix-suffix', category: 'Modify', description: 'Add prefix and suffix to text', keywords: ['prefix', 'suffix', 'add', 'wrap'] },
            { name: 'Position Text Addition', url: '/modify/position-text-addition', category: 'Modify', description: 'Add text at specific position', keywords: ['position', 'add', 'insert', 'text'] },
            { name: 'Trim Text', url: '/modify/trim-text', category: 'Modify', description: 'Remove whitespace from beginning and end', keywords: ['trim', 'whitespace', 'clean'] },
            
            // Replace Tools
            { name: 'Replace Newline with Commas', url: '/replace/newline-with-commas', category: 'Replace', description: 'Replace line breaks with commas', keywords: ['replace', 'newline', 'commas', 'convert'] },
            { name: 'Replace Spaces', url: '/replace/spaces', category: 'Replace', description: 'Replace spaces with other characters', keywords: ['replace', 'spaces', 'substitute'] },
            { name: 'Replace Text Between', url: '/replace/text-between', category: 'Replace', description: 'Replace text between delimiters', keywords: ['replace', 'between', 'delimiters'] },
            { name: 'Search and Replace', url: '/replace/search-replace', category: 'Replace', description: 'Find and replace text with new text', keywords: ['search', 'replace', 'find', 'substitute'] },
            
            // Conversion Tools
            { name: 'Base64 Decoder', url: '/conversions/base64-decoder', category: 'Conversions', description: 'Decode Base64 encoded text', keywords: ['base64', 'decode', 'convert', 'encoding'] },
            { name: 'Base64 Encoder', url: '/conversions/base64-encoder', category: 'Conversions', description: 'Encode text to Base64 format', keywords: ['base64', 'encode', 'convert', 'encoding'] },
            { name: 'Date Conversion', url: '/conversions/date', category: 'Conversions', description: 'Convert between different date formats', keywords: ['date', 'time', 'format', 'convert'] },
            { name: 'Decimal to String', url: '/conversions/decimal-to-string', category: 'Conversions', description: 'Convert decimal numbers to text', keywords: ['decimal', 'string', 'convert', 'numbers'] },
            { name: 'HTML Entities Converter', url: '/conversions/html-entities', category: 'Conversions', description: 'Convert HTML entities to characters', keywords: ['html', 'entities', 'convert', 'characters'] },
            { name: 'String to Decimal', url: '/conversions/string-to-decimal', category: 'Conversions', description: 'Convert text to decimal numbers', keywords: ['string', 'decimal', 'convert', 'numbers'] },
            { name: 'Text to Binary', url: '/conversions/text-to-binary', category: 'Conversions', description: 'Convert text to binary code', keywords: ['text', 'binary', 'convert', 'code'] },
            { name: 'URL Decode', url: '/conversions/url-decode', category: 'Conversions', description: 'Decode URL-encoded text', keywords: ['url', 'decode', 'percent', 'encoding'] },
            { name: 'URL Encode', url: '/conversions/url-encode', category: 'Conversions', description: 'Encode text for URL usage', keywords: ['url', 'encode', 'percent', 'encoding'] },
            
            // Special Effects Tools
            { name: 'Backward Text', url: '/special-effects/backward', category: 'Special Effects', description: 'Reverse text character by character', keywords: ['backward', 'reverse', 'flip', 'mirror'] },
            { name: 'Binary to Text', url: '/special-effects/binary-to-text', category: 'Special Effects', description: 'Convert binary code to readable text', keywords: ['binary', 'text', 'convert', 'decode'] },
            { name: 'Bold Text', url: '/special-effects/bold', category: 'Special Effects', description: 'Make text bold and emphasized', keywords: ['bold', 'strong', 'emphasis', 'thick'] },
            { name: 'Bold Gothic Text', url: '/special-effects/bold-gothic', category: 'Special Effects', description: 'Convert to bold gothic style text', keywords: ['bold', 'gothic', 'style', 'fancy'] },
            { name: 'Bold Italic Text', url: '/special-effects/bold-italic', category: 'Special Effects', description: 'Make text both bold and italic', keywords: ['bold', 'italic', 'emphasis', 'style'] },
            { name: 'Circled Text', url: '/special-effects/circled', category: 'Special Effects', description: 'Put characters in circles', keywords: ['circled', 'enclosed', 'symbols', 'fancy'] },
            { name: 'Cursive Bold Text', url: '/special-effects/cursive-bold', category: 'Special Effects', description: 'Convert to cursive bold style', keywords: ['cursive', 'bold', 'script', 'handwriting'] },
            { name: 'Flip Text', url: '/special-effects/flip-text', category: 'Special Effects', description: 'Flip text upside down', keywords: ['flip', 'upside down', 'rotate', 'mirror'] },
            { name: 'Flip Words', url: '/special-effects/flip-words', category: 'Special Effects', description: 'Flip the order of words', keywords: ['flip', 'words', 'reverse', 'order'] },
            { name: 'Gothic Text', url: '/special-effects/gothic', category: 'Special Effects', description: 'Convert to gothic style text', keywords: ['gothic', 'style', 'fancy', 'medieval'] },
            { name: 'Italic Text', url: '/special-effects/italic', category: 'Special Effects', description: 'Make text italic and slanted', keywords: ['italic', 'slanted', 'emphasis', 'style'] },
            { name: 'Outline Text', url: '/special-effects/outline', category: 'Special Effects', description: 'Create outlined text effect', keywords: ['outline', 'border', 'hollow', 'stroke'] },
            { name: 'Parentheses Text', url: '/special-effects/parentheses', category: 'Special Effects', description: 'Put parentheses around each character', keywords: ['parentheses', 'brackets', 'enclosed'] },
            { name: 'Pascal Case', url: '/special-effects/pascal-case', category: 'Special Effects', description: 'Convert to PascalCase format', keywords: ['pascal', 'case', 'camel', 'programming'] },
            { name: 'Reverse Words', url: '/special-effects/reverse-words', category: 'Special Effects', description: 'Reverse the order of words', keywords: ['reverse', 'words', 'backward', 'order'] },
            { name: 'Slashed Text', url: '/special-effects/slashed', category: 'Special Effects', description: 'Add slashes through text', keywords: ['slashed', 'strikethrough', 'crossed'] },
            { name: 'Snake Case', url: '/special-effects/snake-case', category: 'Special Effects', description: 'Convert to snake_case format', keywords: ['snake', 'case', 'underscore', 'programming'] },
            { name: 'Upside Down Text', url: '/special-effects/upside-down', category: 'Special Effects', description: 'Flip text upside down', keywords: ['upside down', 'flip', 'rotate', 'mirror'] },
            { name: 'Wide Text', url: '/special-effects/wide-text', category: 'Special Effects', description: 'Make text wider with spacing', keywords: ['wide', 'spaced', 'expanded', 'stretched'] },
            
            // Generator Tools
            { name: 'Lorem Ipsum Generator', url: '/generators/lorem-ipsum', category: 'Generators', description: 'Generate Lorem Ipsum placeholder text', keywords: ['lorem', 'ipsum', 'placeholder', 'dummy', 'text'] },
            { name: 'Random Phone Number Generator', url: '/generators/random-phone-number', category: 'Generators', description: 'Generate random phone numbers', keywords: ['phone', 'number', 'random', 'generate', 'telephone'] },
            { name: 'Random Color Generator', url: '/generators/color', category: 'Generators', description: 'Generate random colors and codes', keywords: ['color', 'random', 'hex', 'rgb', 'generate'] },
            { name: 'Random Date Generator', url: '/generators/date', category: 'Generators', description: 'Generate random dates', keywords: ['date', 'random', 'time', 'generate'] },
            { name: 'Random Email Generator', url: '/generators/email', category: 'Generators', description: 'Generate random email addresses', keywords: ['email', 'random', 'address', 'generate'] },
            { name: 'Random IP Generator', url: '/generators/ip', category: 'Generators', description: 'Generate random IP addresses', keywords: ['ip', 'address', 'random', 'network', 'generate'] },
            { name: 'Random IPv6 Generator', url: '/generators/ipv6', category: 'Generators', description: 'Generate random IPv6 addresses', keywords: ['ipv6', 'address', 'random', 'network', 'generate'] },
            { name: 'Random MAC Generator', url: '/generators/mac', category: 'Generators', description: 'Generate random MAC addresses', keywords: ['mac', 'address', 'random', 'network', 'generate'] },
            { name: 'Random Number Generator', url: '/generators/number', category: 'Generators', description: 'Generate random numbers', keywords: ['number', 'random', 'generate', 'numeric'] },
            { name: 'Random User Agent Generator', url: '/generators/user-agent', category: 'Generators', description: 'Generate random user agent strings', keywords: ['user agent', 'browser', 'random', 'generate'] },
            { name: 'Random Password Generator', url: '/generators/password', category: 'Generators', description: 'Generate secure random passwords', keywords: ['password', 'random', 'secure', 'generate'] },
            { name: 'SEO URL Generator', url: '/generators/seo-url', category: 'Generators', description: 'Generate SEO-friendly URLs', keywords: ['seo', 'url', 'friendly', 'generate', 'slug'] },
            { name: 'Sequential Number Generator', url: '/generators/sequential-number', category: 'Generators', description: 'Generate sequential numbers', keywords: ['sequential', 'number', 'series', 'generate'] },
            { name: 'URL Slug Generator', url: '/generators/url-slug', category: 'Generators', description: 'Generate URL slugs from text', keywords: ['url', 'slug', 'generate', 'friendly'] },
            
            // Studio Tools
            { name: 'TextFlow Pipeline', url: '/studio/text-flow', category: 'Studio', description: 'Advanced text processing pipeline', keywords: ['pipeline', 'workflow', 'advanced', 'processing'] }
        ],
        
        // AI-powered semantic search
        get filteredTools() {
            // Don't show any results until component is properly initialized
            if (!this.isInitialized) {
                return [];
            }
            
            if (!this.searchQuery.trim()) {
                return this.allTools.slice(0, 8); // Show first 8 tools when no search
            }
            
            const query = this.searchQuery.toLowerCase().trim();
            const results = [];
            
            // Exact name matches (highest priority)
            this.allTools.forEach(tool => {
                if (tool.name.toLowerCase().includes(query)) {
                    results.push({ ...tool, score: 100, matchType: 'name' });
                }
            });
            
            // Description matches (high priority)
            this.allTools.forEach(tool => {
                if (!results.find(r => r.url === tool.url) && tool.description.toLowerCase().includes(query)) {
                    results.push({ ...tool, score: 80, matchType: 'description' });
                }
            });
            
            // Keyword matches (medium priority)
            this.allTools.forEach(tool => {
                if (!results.find(r => r.url === tool.url)) {
                    const keywordMatch = tool.keywords.some(keyword => 
                        keyword.toLowerCase().includes(query) || query.includes(keyword.toLowerCase())
                    );
                    if (keywordMatch) {
                        results.push({ ...tool, score: 60, matchType: 'keyword' });
                    }
                }
            });
            
            // Semantic matches (AI-like understanding)
            const semanticMatches = this.getSemanticMatches(query);
            semanticMatches.forEach(tool => {
                if (!results.find(r => r.url === tool.url)) {
                    results.push({ ...tool, score: 40, matchType: 'semantic' });
                }
            });
            
            // Category matches (lowest priority)
            this.allTools.forEach(tool => {
                if (!results.find(r => r.url === tool.url) && tool.category.toLowerCase().includes(query)) {
                    results.push({ ...tool, score: 20, matchType: 'category' });
                }
            });
            
            return results.sort((a, b) => b.score - a.score).slice(0, 10);
        },
        
        // Semantic matching for AI-like search
        getSemanticMatches(query) {
            const semanticMap = {
                'make uppercase': ['Upper Case'],
                'make lowercase': ['Lower Case'],
                'capitalize': ['Capitalize Words', 'Title Case'],
                'count words': ['Character and Word Counter'],
                'count characters': ['Character and Word Counter'],
                'remove duplicates': ['Remove Duplicate Lines', 'Remove Duplicate Words'],
                'find emails': ['Extract Emails'],
                'get emails': ['Extract Emails'],
                'extract email': ['Extract Emails'],
                'find urls': ['Extract URLs'],
                'get links': ['Extract URLs'],
                'format code': ['CSS Beautifier', 'HTML Beautifier', 'JavaScript Beautifier', 'JSON Beautifier'],
                'beautify code': ['CSS Beautifier', 'HTML Beautifier', 'JavaScript Beautifier', 'JSON Beautifier'],
                'sort alphabetically': ['Alphabetical Sort'],
                'arrange alphabetically': ['Alphabetical Sort'],
                'random order': ['Random Sort'],
                'shuffle': ['Random Sort'],
                'encode base64': ['Base64 Encoder'],
                'decode base64': ['Base64 Decoder'],
                'reverse text': ['Backward Text'],
                'flip text': ['Flip Text', 'Upside Down Text'],
                'bold text': ['Bold Text'],
                'italic text': ['Italic Text'],
                'generate password': ['Random Password Generator'],
                'create password': ['Random Password Generator'],
                'lorem ipsum': ['Lorem Ipsum Generator'],
                'placeholder text': ['Lorem Ipsum Generator'],
                'dummy text': ['Lorem Ipsum Generator'],
                'remove html': ['Remove HTML Tags'],
                'strip html': ['Remove HTML Tags'],
                'clean html': ['Remove HTML Tags'],
                'phone number': ['Extract Phone Numbers', 'Random Phone Number Generator'],
                'telephone': ['Extract Phone Numbers', 'Random Phone Number Generator'],
                'ip address': ['Extract IP Address', 'Random IP Generator'],
                'network address': ['Extract IP Address', 'Random IP Generator'],
                'color code': ['Extract Hex Colors', 'Random Color Generator'],
                'hex color': ['Extract Hex Colors', 'Random Color Generator'],
                'find and replace': ['Search and Replace'],
                'search replace': ['Search and Replace'],
                'substitute': ['Search and Replace'],
                'line numbers': ['Add Number To Each Line'],
                'number lines': ['Add Number To Each Line'],
                'csv': ['Column to Comma', 'Comma to Column'],
                'comma separated': ['Column to Comma', 'Comma to Column'],
                'url encode': ['URL Encode'],
                'url decode': ['URL Decode'],
                'percent encoding': ['URL Encode', 'URL Decode'],
                'binary code': ['Text to Binary', 'Binary to Text'],
                'binary conversion': ['Text to Binary', 'Binary to Text'],
                'camel case': ['Pascal Case'],
                'programming case': ['Pascal Case', 'Snake Case'],
                'underscore': ['Snake Case'],
                'snake_case': ['Snake Case'],
                'PascalCase': ['Pascal Case'],
                'remove spaces': ['Remove Spaces', 'Remove Extra Spaces'],
                'delete spaces': ['Remove Spaces', 'Remove Extra Spaces'],
                'trim whitespace': ['Trim Text', 'Trim Spaces'],
                'clean whitespace': ['Trim Text', 'Remove Extra Spaces'],
                'extract numbers': ['Extract Numbers'],
                'find numbers': ['Extract Numbers'],
                'get numbers': ['Extract Numbers'],
                'remove numbers': ['Remove Numbers'],
                'delete numbers': ['Remove Numbers'],
                'special characters': ['Remove Special Characters'],
                'symbols': ['Remove Special Characters'],
                'punctuation': ['Remove Special Characters'],
                'quotes': ['Remove Quotes', 'Remove Single Quotes'],
                'quotation marks': ['Remove Quotes', 'Remove Single Quotes'],
                'line breaks': ['Remove Line Breaks'],
                'newlines': ['Remove Line Breaks', 'Replace Newline with Commas'],
                'empty lines': ['Remove Empty Lines'],
                'blank lines': ['Remove Empty Lines'],
                'vowels': ['Remove Vowels'],
                'consonants': ['Remove Consonants'],
                'first characters': ['Remove First Characters', 'Keep First Characters'],
                'last characters': ['Remove Last Characters', 'Keep Last Characters'],
                'beginning': ['Remove First Characters', 'Keep First Characters'],
                'end': ['Remove Last Characters', 'Keep Last Characters'],
                'prefix': ['Prefix Suffix', 'Add Text To Each Line'],
                'suffix': ['Prefix Suffix', 'Add Text To Each Line'],
                'add text': ['Add Text To Each Line', 'Prefix Suffix'],
                'insert text': ['Position Text Addition'],
                'merge lists': ['Merge Text Lists'],
                'combine lists': ['Merge Text Lists'],
                'join lists': ['Merge Text Lists'],
                'spell out numbers': ['Number To Words'],
                'numbers to words': ['Number To Words'],
                'write out numbers': ['Number To Words'],
                'date format': ['Date Conversion'],
                'convert date': ['Date Conversion'],
                'html entities': ['HTML Entities Converter'],
                'html characters': ['HTML Entities Converter'],
                'escape html': ['HTML Entities Converter'],
                'unescape html': ['HTML Entities Converter']
            };
            
            const matches = [];
            Object.keys(semanticMap).forEach(pattern => {
                if (query.includes(pattern) || pattern.includes(query)) {
                    semanticMap[pattern].forEach(toolName => {
                        const tool = this.allTools.find(t => t.name === toolName);
                        if (tool) matches.push(tool);
                    });
                }
            });
            
            return matches;
        },
        
        highlightMatch(text, query) {
            if (!query.trim()) return text;
            const escapedQuery = query.replace(/[.*+?^${}()|[\]\\]/g, '\\$&');
            const regex = new RegExp('(' + escapedQuery + ')', 'gi');
            return text.replace(regex, '<mark class="bg-yellow-200 px-1 rounded">$1</mark>');
        },
        
        handleKeydown(event) {
            const results = this.filteredTools;
            if (event.key === 'ArrowDown') {
                event.preventDefault();
                this.selectedIndex = Math.min(this.selectedIndex + 1, results.length - 1);
                this.isOpen = true;
            } else if (event.key === 'ArrowUp') {
                event.preventDefault();
                this.selectedIndex = Math.max(this.selectedIndex - 1, -1);
                this.isOpen = true;
            } else if (event.key === 'Enter' && this.selectedIndex >= 0) {
                event.preventDefault();
                window.location.href = results[this.selectedIndex].url;
            } else if (event.key === 'Escape') {
                this.closeDropdown();
            }
        },
        
        init() {
            // Initialize component after a small delay to prevent flickering
            setTimeout(() => {
                this.isInitialized = true;
            }, 100);
            
            // Ensure dropdown stays open when interacting with it
            this.$watch('searchQuery', () => {
                if (this.searchQuery.length > 0 && this.isInitialized) {
                    this.isOpen = true;
                }
            });
        },
        
        openDropdown() {
            // Only open if component is initialized
            if (!this.isInitialized) return;
            
            // Use setTimeout to prevent immediate closing from click.away
            setTimeout(() => {
                this.isOpen = true;
            }, 10);
        },
        
        closeDropdown() {
            this.isOpen = false;
            this.selectedIndex = -1;
        }
    }
}
</script>

<div x-data="createSearchComponent()" class="relative mb-6">
    <!-- Modern Search Input -->
    <div class="relative">
        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </div>
        <input type="text" 
               x-model="searchQuery"
               @keydown="handleKeydown"
               @focus="openDropdown()"
               @input="selectedIndex = -1; openDropdown()"
               @click="openDropdown()"
               placeholder="Search tools... (e.g., 'make uppercase', 'count words', 'remove duplicates')"
               class="w-full pl-10 pr-4 py-3 text-sm bg-white border border-gray-200 rounded-xl shadow-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 placeholder-gray-400">
        
        <!-- Clear button -->
        <button x-show="searchQuery" 
                @click="searchQuery = ''; closeDropdown()"
                class="absolute inset-y-0 right-0 pr-3 flex items-center">
            <svg class="w-4 h-4 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>
    
    <!-- Search Results Dropdown -->
    <div x-show="isOpen" 
         x-cloak
         @click.away="closeDropdown()"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-1 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-1 scale-95"
         class="absolute top-full left-0 right-0 mt-2 bg-white rounded-xl shadow-xl border border-gray-100 z-50 max-h-96 overflow-hidden">
        
        <!-- Search Results -->
        <div class="overflow-y-auto max-h-96" @click.stop>
            <!-- AI Search Hint -->
            <div x-show="searchQuery && filteredTools.length > 0" class="px-4 py-2 bg-gradient-to-r from-blue-50 to-indigo-50 border-b border-gray-100">
                <div class="flex items-center text-xs text-blue-600">
                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <span>AI-powered search results</span>
                </div>
            </div>
            
            <!-- Home Link -->
            <a href="/" 
               class="flex items-center px-4 py-3 text-sm text-blue-600 hover:bg-blue-50 transition-colors border-b border-gray-50">
                <svg class="w-4 h-4 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="font-medium">Home</span>
            </a>
            
            <!-- Filtered Tools -->
            <template x-for="(tool, index) in filteredTools" :key="tool.url">
                <a :href="tool.url" 
                   :class="{ 'bg-blue-50 border-l-4 border-blue-400': selectedIndex === index }"
                   @mouseenter="selectedIndex = index"
                   class="block px-4 py-3 hover:bg-blue-50 transition-all duration-150 border-b border-gray-50 last:border-b-0">
                    <div class="flex items-start justify-between">
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center">
                                <h4 class="text-sm font-medium text-gray-900 truncate" x-html="highlightMatch(tool.name, searchQuery)"></h4>
                                <span class="ml-2 px-2 py-0.5 text-xs bg-gray-100 text-gray-600 rounded-full" x-text="tool.category"></span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1 line-clamp-2" x-html="highlightMatch(tool.description, searchQuery)"></p>
                        </div>
                        <div class="ml-3 flex-shrink-0">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </div>
                    </div>
                </a>
            </template>
            
            <!-- No Results -->
            <div x-show="searchQuery && filteredTools.length === 0 && isInitialized" class="px-4 py-8 text-center">
                <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.467.881-6.077 2.33l-.853-.853A9.967 9.967 0 0112 13c3.536 0 6.635 1.84 8.4 4.6l-.853.853A8.013 8.013 0 0012 15z"/>
                </svg>
                <p class="text-sm text-gray-500 mb-2">No tools found matching "<span class="font-medium" x-text="searchQuery"></span>"</p>
                <p class="text-xs text-gray-400">Try searching for: "uppercase", "count words", "remove spaces", "format code"</p>
            </div>
            
            <!-- Quick Tips -->
            <div x-show="!searchQuery && isInitialized" class="px-4 py-3 bg-gray-50 border-t border-gray-100">
                <p class="text-xs text-gray-600 mb-2 font-medium">Quick Tips:</p>
                <div class="grid grid-cols-2 gap-2 text-xs text-gray-500">
                    <div>• "make uppercase" → Upper Case</div>
                    <div>• "count words" → Word Counter</div>
                    <div>• "remove duplicates" → Remove Duplicates</div>
                    <div>• "format code" → Code Beautifiers</div>
                </div>
            </div>
        </div>
    </div>
</div>