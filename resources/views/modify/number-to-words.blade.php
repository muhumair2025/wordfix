@extends('layouts.tool')

@section('title', 'Number to Words Converter - WordFix')

@section('tool-title', 'Number to Words Converter')

@section('tool-description', 'Convert numbers into written words (123 becomes one hundred twenty-three)')

@section('tool-content')
<!-- Conversion Options -->
<div class="mb-6 p-4 bg-gray-50 border border-gray-200 rounded-lg">
    <h3 class="text-sm font-semibold text-gray-900 mb-4">Conversion Options</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
        <div>
            <label for="outputCase" class="block text-sm font-medium text-gray-700 mb-2">Output Case:</label>
            <select id="outputCase" onchange="updateConversion()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="lowercase">lowercase (one hundred)</option>
                <option value="uppercase">UPPERCASE (ONE HUNDRED)</option>
                <option value="capitalize">Capitalize Each Word (One Hundred)</option>
                <option value="sentence">Sentence case (One hundred)</option>
            </select>
        </div>
        
        <div>
            <label for="andBetween" class="block text-sm font-medium text-gray-700 mb-2">Between Tens/Ones:</label>
            <select id="andBetween" onchange="updateConversion()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="with-and">With "and" (twenty-one)</option>
                <option value="without-and">Without "and" (twenty one)</option>
                <option value="hyphen">Hyphenated (twenty-one)</option>
            </select>
        </div>
        
        <div>
            <label for="currency" class="block text-sm font-medium text-gray-700 mb-2">Currency Mode:</label>
            <select id="currency" onchange="updateConversion()" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                <option value="none">None (regular numbers)</option>
                <option value="usd">US Dollars ($)</option>
                <option value="eur">Euros (€)</option>
                <option value="gbp">British Pounds (£)</option>
                <option value="inr">Indian Rupees (₹)</option>
            </select>
        </div>
    </div>
    
    <div class="flex flex-wrap gap-4">
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="processEachLine" checked onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Process each line separately</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="showOriginal" onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Show original number with result</span>
        </label>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="handleDecimals" checked onchange="updateConversion()" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
            <span class="ml-2 text-sm text-gray-700">Handle decimal numbers</span>
        </label>
    </div>
</div>

<!-- Text Converter Component -->
<x-text-converter 
    toolId="numberWords"
    inputPlaceholder="Enter numbers to convert (one per line or in text)"
    outputPlaceholder="Words will appear here"
    downloadFileName="numbers-to-words.txt"
    :showStats="true"
/>

<div class="text-sm text-blue-600 mb-6">
    This tool converts numbers into their written word equivalents. Perfect for writing checks, creating formal documents, spelling out amounts, or educational purposes. Supports whole numbers, decimals, and currency formats.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Number to Words Examples</h3>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 1: Basic Numbers</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> 123</div>
                <div><strong>Output:</strong> one hundred twenty-three</div>
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 2: Large Numbers</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> 1000000</div>
                <div><strong>Output:</strong> one million</div>
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 3: Decimal Numbers</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> 45.50</div>
                <div><strong>Output:</strong> forty-five point five zero</div>
            </div>
        </div>
        
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Example 4: Currency (USD)</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm">
                <div class="mb-2"><strong>Input:</strong> 250.75</div>
                <div><strong>Output:</strong> two hundred fifty dollars and seventy-five cents</div>
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Number to Words Converter Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Number to Words Converter</strong> transforms numeric digits into their written word equivalents. Essential for check writing, legal documents, formal correspondence, or any situation requiring spelled-out numbers.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use This Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Choose your output case (lowercase, UPPERCASE, Capitalize, Sentence case)</li>
            <li>Select formatting preference (with/without "and", hyphenation)</li>
            <li>Optionally select currency mode if converting money amounts</li>
            <li>Enter your numbers in the input box (one per line or in text)</li>
            <li>Get instant word equivalents in the output</li>
            <li>Copy or download the results</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Multiple Number Format Support</strong> - Whole numbers, decimals, negative numbers</li>
            <li><strong>Large Number Support</strong> - Handles millions, billions, trillions</li>
            <li><strong>Currency Conversion</strong> - Special formatting for USD, EUR, GBP, INR</li>
            <li><strong>Case Options</strong> - 4 different case styles for output</li>
            <li><strong>Formatting Control</strong> - With/without "and", hyphenation options</li>
            <li><strong>Decimal Handling</strong> - Converts decimal numbers to words</li>
            <li><strong>Batch Processing</strong> - Convert multiple numbers at once</li>
            <li><strong>Show Original</strong> - Display number alongside words</li>
            <li>Real-time conversion as you type</li>
            <li>Import/export functionality</li>
            <li>Mobile responsive</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Supported Number Ranges</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>0 to 999:</strong> Basic numbers (zero to nine hundred ninety-nine)</li>
            <li><strong>Thousands:</strong> 1,000 to 999,999 (one thousand to nine hundred ninety-nine thousand)</li>
            <li><strong>Millions:</strong> 1,000,000 to 999,999,999</li>
            <li><strong>Billions:</strong> 1,000,000,000 to 999,999,999,999</li>
            <li><strong>Trillions:</strong> And beyond</li>
            <li><strong>Decimals:</strong> Any decimal number (e.g., 45.67)</li>
            <li><strong>Negative:</strong> Negative numbers (e.g., -25)</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Check Writing</strong> - Spell out payment amounts</li>
            <li><strong>Legal Documents</strong> - Formal contracts requiring spelled numbers</li>
            <li><strong>Wedding Invitations</strong> - Spell out dates and numbers</li>
            <li><strong>Formal Letters</strong> - Professional correspondence</li>
            <li><strong>Educational Content</strong> - Teaching number words</li>
            <li><strong>Invoices</strong> - Professional amount spelling</li>
            <li><strong>Age/Date Spelling</strong> - Spell out ages or years</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Currency Mode Examples</h3>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">US Dollars</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> 1250.50</li>
            <li><strong>Output:</strong> one thousand two hundred fifty dollars and fifty cents</li>
        </ul>
        
        <h4 class="text-lg font-semibold text-gray-900 mt-4 mb-2">Indian Rupees</h4>
        <ul class="list-none ml-4 space-y-1">
            <li><strong>Input:</strong> 5000</li>
            <li><strong>Output:</strong> five thousand rupees</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Output Case Examples</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>lowercase:</strong> one hundred twenty-three</li>
            <li><strong>UPPERCASE:</strong> ONE HUNDRED TWENTY-THREE</li>
            <li><strong>Capitalize Each Word:</strong> One Hundred Twenty-Three</li>
            <li><strong>Sentence case:</strong> One hundred twenty-three</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Use currency mode when converting money amounts for checks or invoices</li>
            <li>Sentence case is best for formal documents and letters</li>
            <li>Enable "Show original number" to keep reference alongside words</li>
            <li>Process multiple numbers by putting one per line</li>
            <li>The tool handles very large numbers (billions and trillions)</li>
            <li>Decimal handling converts each digit individually (123.45 → "point four five")</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let conversionOptions = {
        outputCase: 'lowercase',
        andBetween: 'with-and',
        currency: 'none',
        processEachLine: true,
        showOriginal: false,
        handleDecimals: true
    };
    
    const ones = ['', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];
    const tens = ['', '', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];
    const teens = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];
    
    // Update conversion options
    window.updateConversion = function() {
        conversionOptions.outputCase = document.getElementById('outputCase').value;
        conversionOptions.andBetween = document.getElementById('andBetween').value;
        conversionOptions.currency = document.getElementById('currency').value;
        conversionOptions.processEachLine = document.getElementById('processEachLine').checked;
        conversionOptions.showOriginal = document.getElementById('showOriginal').checked;
        conversionOptions.handleDecimals = document.getElementById('handleDecimals').checked;
        
        // Trigger re-conversion
        const inputElement = document.getElementById('numberWords-input');
        if (inputElement) {
            inputElement.dispatchEvent(new Event('input'));
        }
    };
    
    // Set the conversion function
    setNumberWordsConverter(function(text) {
        if (!text || !text.trim()) return '';
        
        if (conversionOptions.processEachLine) {
            const lines = text.split('\n');
            return lines.map(line => {
                if (!line.trim()) return line;
                return convertLineToWords(line);
            }).join('\n');
        } else {
            return convertLineToWords(text);
        }
    });
    
    function convertLineToWords(text) {
        // Find all numbers in the text
        const numberRegex = /-?\d+(\.\d+)?/g;
        
        return text.replace(numberRegex, (match) => {
            const words = numberToWords(parseFloat(match));
            const formatted = applyCase(words);
            
            if (conversionOptions.showOriginal) {
                return `${match} (${formatted})`;
            }
            return formatted;
        });
    }
    
    function numberToWords(num) {
        if (num === 0) return 'zero';
        
        let words = '';
        let isNegative = num < 0;
        num = Math.abs(num);
        
        // Handle currency
        if (conversionOptions.currency !== 'none' && conversionOptions.handleDecimals) {
            const parts = num.toFixed(2).split('.');
            const dollars = parseInt(parts[0]);
            const cents = parseInt(parts[1]);
            
            let currencyName = '';
            let subunitName = '';
            
            switch (conversionOptions.currency) {
                case 'usd':
                    currencyName = dollars === 1 ? 'dollar' : 'dollars';
                    subunitName = cents === 1 ? 'cent' : 'cents';
                    break;
                case 'eur':
                    currencyName = dollars === 1 ? 'euro' : 'euros';
                    subunitName = cents === 1 ? 'cent' : 'cents';
                    break;
                case 'gbp':
                    currencyName = dollars === 1 ? 'pound' : 'pounds';
                    subunitName = cents === 1 ? 'penny' : 'pence';
                    break;
                case 'inr':
                    currencyName = dollars === 1 ? 'rupee' : 'rupees';
                    subunitName = cents === 1 ? 'paisa' : 'paise';
                    break;
            }
            
            words = convertNumberToWords(dollars) + ' ' + currencyName;
            if (cents > 0) {
                words += ' and ' + convertNumberToWords(cents) + ' ' + subunitName;
            }
        } else {
            // Handle decimals
            if (num % 1 !== 0 && conversionOptions.handleDecimals) {
                const parts = num.toString().split('.');
                words = convertNumberToWords(parseInt(parts[0])) + ' point';
                for (let digit of parts[1]) {
                    words += ' ' + ones[parseInt(digit)];
                }
            } else {
                words = convertNumberToWords(Math.floor(num));
            }
        }
        
        if (isNegative) {
            words = 'negative ' + words;
        }
        
        return words.trim();
    }
    
    function convertNumberToWords(num) {
        if (num === 0) return 'zero';
        
        const billion = Math.floor(num / 1000000000);
        const million = Math.floor((num % 1000000000) / 1000000);
        const thousand = Math.floor((num % 1000000) / 1000);
        const remainder = num % 1000;
        
        let words = '';
        
        if (billion > 0) {
            words += convertHundreds(billion) + ' billion ';
        }
        
        if (million > 0) {
            words += convertHundreds(million) + ' million ';
        }
        
        if (thousand > 0) {
            words += convertHundreds(thousand) + ' thousand ';
        }
        
        if (remainder > 0) {
            words += convertHundreds(remainder);
        }
        
        return words.trim();
    }
    
    function convertHundreds(num) {
        const hundred = Math.floor(num / 100);
        const remainder = num % 100;
        
        let words = '';
        
        if (hundred > 0) {
            words += ones[hundred] + ' hundred';
            if (remainder > 0) {
                words += ' ';
            }
        }
        
        if (remainder > 0) {
            if (remainder < 10) {
                words += ones[remainder];
            } else if (remainder < 20) {
                words += teens[remainder - 10];
            } else {
                const ten = Math.floor(remainder / 10);
                const one = remainder % 10;
                
                if (conversionOptions.andBetween === 'hyphen' && one > 0) {
                    words += tens[ten] + '-' + ones[one];
                } else {
                    words += tens[ten];
                    if (one > 0) {
                        words += ' ' + ones[one];
                    }
                }
            }
        }
        
        return words;
    }
    
    function applyCase(text) {
        switch (conversionOptions.outputCase) {
            case 'uppercase':
                return text.toUpperCase();
            case 'lowercase':
                return text.toLowerCase();
            case 'capitalize':
                return text.split(' ').map(word => 
                    word.charAt(0).toUpperCase() + word.slice(1).toLowerCase()
                ).join(' ');
            case 'sentence':
                return text.charAt(0).toUpperCase() + text.slice(1).toLowerCase();
            default:
                return text;
        }
    }
    
    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        updateConversion();
    });
</script>
@endpush

