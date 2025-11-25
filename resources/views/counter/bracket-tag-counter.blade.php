@extends('layouts.tool')

@section('title', 'Open and Closing Brackets, Braces, Parentheses, and Tags Counter - WordFix')

@section('tool-title', 'Open and Closing Brackets, Braces, Parentheses, and Tags Counter')

@section('tool-description', 'Count and validate brackets, braces, parentheses, and HTML tags in your code')

@section('tool-content')
<!-- Text Converter Component -->
<x-text-converter 
    toolId="bracketCounter"
    inputPlaceholder="Type or paste your code here"
    outputPlaceholder="Analysis results will appear here"
    downloadFileName="bracket-analysis.txt"
    :showStats="true"
/>

<!-- Results Display -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
    <!-- Left Column - Counts -->
    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
        <h3 class="text-lg font-bold text-blue-900 mb-4">Bracket & Tag Counts</h3>
        <div class="space-y-3 text-sm">
            <div class="flex justify-between items-center">
                <span class="font-medium text-gray-700">Open Braces { :</span>
                <span id="openBraces" class="font-bold text-blue-900">0</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="font-medium text-gray-700">Closing Braces } :</span>
                <span id="closingBraces" class="font-bold text-blue-900">0</span>
            </div>
            <div class="h-px bg-gray-300"></div>
            <div class="flex justify-between items-center">
                <span class="font-medium text-gray-700">Open Parentheses ( :</span>
                <span id="openParentheses" class="font-bold text-blue-900">0</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="font-medium text-gray-700">Closing Parentheses ) :</span>
                <span id="closingParentheses" class="font-bold text-blue-900">0</span>
            </div>
            <div class="h-px bg-gray-300"></div>
            <div class="flex justify-between items-center">
                <span class="font-medium text-gray-700">Open Brackets [ :</span>
                <span id="openBrackets" class="font-bold text-blue-900">0</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="font-medium text-gray-700">Closing Brackets ] :</span>
                <span id="closingBrackets" class="font-bold text-blue-900">0</span>
            </div>
            <div class="h-px bg-gray-300"></div>
            <div class="flex justify-between items-center">
                <span class="font-medium text-gray-700">Open Tags < :</span>
                <span id="openTags" class="font-bold text-blue-900">0</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="font-medium text-gray-700">Closing Tags > :</span>
                <span id="closingTags" class="font-bold text-blue-900">0</span>
            </div>
        </div>
    </div>

    <!-- Right Column - Validation Status -->
    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
        <h3 class="text-lg font-bold text-gray-900 mb-4">Validation Status</h3>
        <div class="space-y-3" id="validationStatus">
            <div class="flex items-start gap-2">
                <svg class="w-5 h-5 text-gray-400 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                </svg>
                <span class="text-sm text-gray-600">Enter code to see validation results</span>
            </div>
        </div>
    </div>
</div>

<div class="text-sm text-blue-600 mb-6">
    This tool counts opening and closing brackets, braces, parentheses, and tags. It also validates if they are properly balanced and reports any mismatches.
</div>

<!-- Example Section -->
<div class="mb-6">
    <h3 class="text-base font-semibold text-gray-900 mb-3">Example</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Input Code</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700 font-mono">
                function test() {<br>
                &nbsp;&nbsp;let arr = [1, 2, 3];<br>
                &nbsp;&nbsp;return arr.map((x) => x * 2);<br>
                }
            </div>
        </div>
        <div>
            <p class="text-sm font-medium text-gray-700 mb-2">Analysis Result</p>
            <div class="bg-green-50 border border-green-200 rounded p-3 text-sm text-gray-700">
                <span class="text-green-600 font-semibold">✓ All brackets balanced!</span><br>
                Braces: 2 pairs<br>
                Brackets: 1 pair<br>
                Parentheses: 2 pairs
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Bracket and Tag Counter Tool</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Bracket and Tag Counter</strong> is an advanced code analysis tool that counts and validates all types of brackets, braces, parentheses, and HTML/XML tags in your code. It helps developers ensure their code has properly balanced delimiters.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">How to Use the Bracket Counter Tool</h3>
        <ol class="list-decimal list-inside space-y-2 ml-4">
            <li>Type or paste your code into the input box</li>
            <li>The tool automatically counts all brackets, braces, parentheses, and tags</li>
            <li>View the count for each type in the results panel</li>
            <li>Check the validation status to see if all delimiters are properly balanced</li>
            <li>Copy or download the analysis results</li>
        </ol>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">What Gets Counted</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li><strong>Braces:</strong> { } - Used in JavaScript, CSS, JSON, etc.</li>
            <li><strong>Parentheses:</strong> ( ) - Used in function calls, expressions, etc.</li>
            <li><strong>Brackets:</strong> [ ] - Used in arrays, indexing, etc.</li>
            <li><strong>Tags:</strong> &lt; &gt; - Used in HTML, XML, JSX, etc.</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Real-time counting as you type</li>
            <li>Automatic validation of balanced delimiters</li>
            <li>Detects mismatched or unbalanced brackets</li>
            <li>Shows separate counts for opening and closing delimiters</li>
            <li>Color-coded validation status (success/error)</li>
            <li>Comprehensive text statistics</li>
            <li>Import code from files</li>
            <li>Copy or download analysis results</li>
            <li>Works with any programming language</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Use Cases</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>Debugging syntax errors in code</li>
            <li>Validating JSON structure</li>
            <li>Checking HTML/XML tag balance</li>
            <li>Code review and quality assurance</li>
            <li>Finding missing or extra brackets</li>
            <li>Educational purposes for learning programming</li>
            <li>Preparing code for compilers/interpreters</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Tips</h3>
        <ul class="list-disc list-inside space-y-2 ml-4">
            <li>A properly balanced code will show equal counts for opening and closing delimiters</li>
            <li>Mismatched counts indicate a syntax error in your code</li>
            <li>Use this tool before compiling to catch bracket errors early</li>
            <li>Works great for checking minified or compressed code</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    // Set the conversion function for the component
    setBracketCounterConverter(function(text) {
        if (!text) return '';
        
        // Count all delimiters
        const counts = countDelimiters(text);
        
        // Update the count displays
        document.getElementById('openBraces').textContent = counts.openBraces;
        document.getElementById('closingBraces').textContent = counts.closingBraces;
        document.getElementById('openParentheses').textContent = counts.openParentheses;
        document.getElementById('closingParentheses').textContent = counts.closingParentheses;
        document.getElementById('openBrackets').textContent = counts.openBrackets;
        document.getElementById('closingBrackets').textContent = counts.closingBrackets;
        document.getElementById('openTags').textContent = counts.openTags;
        document.getElementById('closingTags').textContent = counts.closingTags;
        
        // Validate and show status
        const validation = validateDelimiters(counts);
        updateValidationStatus(validation);
        
        // Generate output text
        let output = 'BRACKET & TAG ANALYSIS\n';
        output += '='.repeat(50) + '\n\n';
        
        output += 'COUNTS:\n';
        output += `Open Braces {: ${counts.openBraces}, Closing Braces }: ${counts.closingBraces}\n`;
        output += `Open Parentheses (: ${counts.openParentheses}, Closing Parentheses ): ${counts.closingParentheses}\n`;
        output += `Open Brackets [: ${counts.openBrackets}, Closing Brackets ]: ${counts.closingBrackets}\n`;
        output += `Open Tags <: ${counts.openTags}, Closing Tags >: ${counts.closingTags}\n\n`;
        
        output += 'VALIDATION:\n';
        validation.forEach(item => {
            const status = item.balanced ? '✓ BALANCED' : '✗ UNBALANCED';
            output += `${item.type}: ${status}`;
            if (!item.balanced) {
                output += ` (Difference: ${item.difference})`;
            }
            output += '\n';
        });
        
        const allBalanced = validation.every(item => item.balanced);
        output += '\n' + (allBalanced ? '✓ ALL DELIMITERS ARE PROPERLY BALANCED!' : '✗ SOME DELIMITERS ARE UNBALANCED!');
        
        return output;
    });
    
    function countDelimiters(text) {
        return {
            openBraces: (text.match(/\{/g) || []).length,
            closingBraces: (text.match(/\}/g) || []).length,
            openParentheses: (text.match(/\(/g) || []).length,
            closingParentheses: (text.match(/\)/g) || []).length,
            openBrackets: (text.match(/\[/g) || []).length,
            closingBrackets: (text.match(/\]/g) || []).length,
            openTags: (text.match(/</g) || []).length,
            closingTags: (text.match(/>/g) || []).length
        };
    }
    
    function validateDelimiters(counts) {
        return [
            {
                type: 'Braces { }',
                balanced: counts.openBraces === counts.closingBraces,
                difference: Math.abs(counts.openBraces - counts.closingBraces),
                open: counts.openBraces,
                close: counts.closingBraces
            },
            {
                type: 'Parentheses ( )',
                balanced: counts.openParentheses === counts.closingParentheses,
                difference: Math.abs(counts.openParentheses - counts.closingParentheses),
                open: counts.openParentheses,
                close: counts.closingParentheses
            },
            {
                type: 'Brackets [ ]',
                balanced: counts.openBrackets === counts.closingBrackets,
                difference: Math.abs(counts.openBrackets - counts.closingBrackets),
                open: counts.openBrackets,
                close: counts.closingBrackets
            },
            {
                type: 'Tags < >',
                balanced: counts.openTags === counts.closingTags,
                difference: Math.abs(counts.openTags - counts.closingTags),
                open: counts.openTags,
                close: counts.closingTags
            }
        ];
    }
    
    function updateValidationStatus(validation) {
        const statusDiv = document.getElementById('validationStatus');
        const allBalanced = validation.every(item => item.balanced);
        
        let html = '';
        
        if (allBalanced) {
            html = `
                <div class="flex items-start gap-2">
                    <svg class="w-5 h-5 text-green-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-green-700">All Delimiters Balanced!</p>
                        <p class="text-xs text-green-600 mt-1">Your code has properly matched brackets and tags.</p>
                    </div>
                </div>
            `;
        } else {
            html = `
                <div class="flex items-start gap-2 mb-3">
                    <svg class="w-5 h-5 text-red-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <p class="text-sm font-semibold text-red-700">Unbalanced Delimiters Detected!</p>
                        <p class="text-xs text-red-600 mt-1">The following issues were found:</p>
                    </div>
                </div>
            `;
            
            validation.forEach(item => {
                if (!item.balanced) {
                    const moreOrLess = item.open > item.close ? 'more opening' : 'more closing';
                    html += `
                        <div class="ml-7 mb-2">
                            <p class="text-sm text-gray-700">
                                <span class="font-medium">${item.type}:</span> 
                                <span class="text-red-600">${item.difference} ${moreOrLess}</span>
                                <span class="text-gray-500 text-xs">(${item.open} open, ${item.close} close)</span>
                            </p>
                        </div>
                    `;
                }
            });
        }
        
        statusDiv.innerHTML = html;
    }
</script>
@endpush

