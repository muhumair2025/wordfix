@extends('layouts.tool')

@section('title', 'Random Password Generator - WordFix')

@section('tool-title', 'Random Password Generator')

@section('tool-description', 'Generate secure, strong passwords')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-6 bg-red-50 border border-red-200 rounded-xl p-4 md:p-5 shadow-sm">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Length Slider -->
        <div class="bg-white p-4 rounded-lg border border-red-100 shadow-sm">
            <label class="block text-sm font-semibold text-gray-700 mb-3 flex justify-between">
                <span>Password Length</span>
                <span class="text-red-600 font-bold" id="lengthDisplay">16</span>
            </label>
            <div class="flex items-center gap-3">
                <input type="range" id="lengthRange" min="4" max="64" value="16" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer accent-red-600" oninput="syncLength(this.value); generatePassword()">
            </div>
            <input type="hidden" id="length" value="16">
        </div>

        <!-- Options -->
        <div class="col-span-1 md:col-span-2 bg-white p-4 rounded-lg border border-red-100 shadow-sm">
            <label class="block text-sm font-semibold text-gray-700 mb-3">Character Sets</label>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                <label class="flex flex-col items-center justify-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-red-50 hover:border-red-200 transition-all">
                    <input type="checkbox" id="uppercase" class="w-5 h-5 text-red-600 rounded focus:ring-red-500 mb-2" checked onchange="generatePassword()">
                    <span class="text-xs font-medium text-gray-700 text-center">ABC</span>
                </label>
                <label class="flex flex-col items-center justify-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-red-50 hover:border-red-200 transition-all">
                    <input type="checkbox" id="lowercase" class="w-5 h-5 text-red-600 rounded focus:ring-red-500 mb-2" checked onchange="generatePassword()">
                    <span class="text-xs font-medium text-gray-700 text-center">abc</span>
                </label>
                <label class="flex flex-col items-center justify-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-red-50 hover:border-red-200 transition-all">
                    <input type="checkbox" id="numbers" class="w-5 h-5 text-red-600 rounded focus:ring-red-500 mb-2" checked onchange="generatePassword()">
                    <span class="text-xs font-medium text-gray-700 text-center">123</span>
                </label>
                <label class="flex flex-col items-center justify-center p-3 border border-gray-200 rounded-lg cursor-pointer hover:bg-red-50 hover:border-red-200 transition-all">
                    <input type="checkbox" id="symbols" class="w-5 h-5 text-red-600 rounded focus:ring-red-500 mb-2" checked onchange="generatePassword()">
                    <span class="text-xs font-medium text-gray-700 text-center">!@#</span>
                </label>
            </div>
            <div class="mt-3 pt-3 border-t border-gray-100">
                <label class="flex items-center cursor-pointer">
                    <input type="checkbox" id="excludeAmbiguous" class="w-4 h-4 text-red-600 rounded focus:ring-red-500" onchange="generatePassword()">
                    <span class="ml-2 text-sm text-gray-600">Exclude Ambiguous Characters (e.g. i, l, 1, L, o, 0, O)</span>
                </label>
            </div>
        </div>
    </div>
</div>

<!-- Main Password Display -->
<div class="mb-8">
    <div class="relative group">
        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-orange-600 rounded-xl opacity-20 group-hover:opacity-40 transition duration-200 blur"></div>
        <div class="relative bg-white p-6 md:p-8 rounded-xl shadow-lg border border-gray-100 text-center">
            
            <!-- Password Text -->
            <div class="mb-6 relative">
                <div id="passwordDisplay" class="text-3xl md:text-5xl font-mono font-bold text-gray-800 break-all tracking-wider selection:bg-red-100 selection:text-red-900" style="min-height: 1.5em;">
                    Generating...
                </div>
                <!-- Hidden input for reliable copying -->
                <textarea id="hiddenPassword" class="absolute opacity-0 pointer-events-none w-1 h-1" readonly></textarea>
            </div>

            <!-- Strength Meter -->
            <div class="max-w-md mx-auto mb-8">
                <div class="flex justify-between text-xs font-bold text-gray-500 mb-1 uppercase tracking-wide">
                    <span>Strength</span>
                    <span id="strengthText" class="text-red-500">Weak</span>
                </div>
                <div class="h-2 w-full bg-gray-100 rounded-full overflow-hidden">
                    <div id="strengthBar" class="h-full w-0 bg-red-500 transition-all duration-500 ease-out"></div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 max-w-lg mx-auto">
                <button onclick="copyPassword()" id="copyBtn" class="w-full py-4 px-6 bg-gray-900 text-white font-bold rounded-xl hover:bg-black hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2 group">
                    <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m0 0h2a2 2 0 012 2v3m2 4H10m0 0l3-3m-3 3l3 3" />
                    </svg>
                    <span id="copyBtnText">Copy Password</span>
                </button>
                <button onclick="generatePassword()" class="w-full py-4 px-6 bg-white border-2 border-gray-200 text-gray-700 font-bold rounded-xl hover:border-red-500 hover:text-red-600 hover:bg-red-50 transition-all duration-200 flex items-center justify-center gap-2 group">
                    <svg class="w-5 h-5 group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Generate New
                </button>
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none mt-12">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Random Password Generator</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Create strong, secure passwords to protect your online accounts. Customize length and character types to meet specific requirements.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Customizable password length (4-64 characters)</li>
            <li>Toggle Uppercase, Lowercase, Numbers, and Symbols</li>
            <li>Option to exclude ambiguous characters (like I, l, 1, O, 0)</li>
            <li>Real-time strength estimation</li>
            <li>One-click copy to clipboard</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    const CHARS = {
        upper: 'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        lower: 'abcdefghijklmnopqrstuvwxyz',
        numbers: '0123456789',
        symbols: '!@#$%^&*()_+~`|}{[]:;?><,./-='
    };
    
    const AMBIGUOUS = 'Il1O0o';

    function syncLength(val) {
        document.getElementById('length').value = val;
        document.getElementById('lengthDisplay').textContent = val;
    }

    function generatePassword() {
        const length = parseInt(document.getElementById('length').value) || 16;
        const useUpper = document.getElementById('uppercase').checked;
        const useLower = document.getElementById('lowercase').checked;
        const useNumbers = document.getElementById('numbers').checked;
        const useSymbols = document.getElementById('symbols').checked;
        const excludeAmbiguous = document.getElementById('excludeAmbiguous').checked;

        let charset = '';
        if (useUpper) charset += CHARS.upper;
        if (useLower) charset += CHARS.lower;
        if (useNumbers) charset += CHARS.numbers;
        if (useSymbols) charset += CHARS.symbols;

        if (excludeAmbiguous) {
            for (let i = 0; i < AMBIGUOUS.length; i++) {
                charset = charset.replace(new RegExp(AMBIGUOUS[i], 'g'), '');
            }
        }

        if (charset === '') {
            document.getElementById('passwordDisplay').textContent = 'Select options';
            document.getElementById('hiddenPassword').value = '';
            return;
        }

        let password = '';
        const array = new Uint32Array(length);
        window.crypto.getRandomValues(array);
        
        for (let i = 0; i < length; i++) {
            password += charset[array[i] % charset.length];
        }

        document.getElementById('passwordDisplay').textContent = password;
        document.getElementById('hiddenPassword').value = password;
        calculateStrength(password);
        
        // Reset copy button
        resetCopyButton();
    }

    function calculateStrength(password) {
        let score = 0;
        if (password.length > 8) score += 1;
        if (password.length > 12) score += 1;
        if (/[A-Z]/.test(password)) score += 1;
        if (/[a-z]/.test(password)) score += 1;
        if (/[0-9]/.test(password)) score += 1;
        if (/[^A-Za-z0-9]/.test(password)) score += 1;

        const bar = document.getElementById('strengthBar');
        const text = document.getElementById('strengthText');
        
        let percentage = Math.min(100, (score / 6) * 100);
        let color = 'bg-red-500';
        let label = 'Weak';
        let textColor = 'text-red-500';

        if (score >= 5) {
            color = 'bg-green-500';
            label = 'Very Strong';
            textColor = 'text-green-600';
        } else if (score >= 4) {
            color = 'bg-green-400';
            label = 'Strong';
            textColor = 'text-green-500';
        } else if (score >= 3) {
            color = 'bg-yellow-400';
            label = 'Medium';
            textColor = 'text-yellow-600';
        }

        bar.className = `h-full transition-all duration-500 ease-out ${color}`;
        bar.style.width = `${percentage}%`;
        text.textContent = label;
        text.className = `font-bold uppercase tracking-wide ${textColor}`;
    }

    function copyPassword() {
        const password = document.getElementById('hiddenPassword').value;
        if (!password) return;

        // Try using the modern Clipboard API first
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(password).then(() => {
                showCopySuccess();
            }).catch(() => {
                fallbackCopy();
            });
        } else {
            fallbackCopy();
        }
    }

    function fallbackCopy() {
        const textArea = document.getElementById('hiddenPassword');
        textArea.select();
        try {
            document.execCommand('copy');
            showCopySuccess();
        } catch (err) {
            console.error('Fallback copy failed', err);
            // Fallback to manual selection if everything fails
            const display = document.getElementById('passwordDisplay');
            const range = document.createRange();
            range.selectNodeContents(display);
            const selection = window.getSelection();
            selection.removeAllRanges();
            selection.addRange(range);
            alert('Please press Ctrl+C to copy');
        }
    }

    function showCopySuccess() {
        const btnText = document.getElementById('copyBtnText');
        const originalText = btnText.textContent;
        
        btnText.textContent = 'Copied!';
        const btn = document.getElementById('copyBtn');
        btn.classList.remove('bg-gray-900', 'hover:bg-black');
        btn.classList.add('bg-green-600', 'hover:bg-green-700');
        
        if (typeof showToast === 'function') {
            showToast('Password copied to clipboard!', 'success');
        }

        setTimeout(() => {
            resetCopyButton();
        }, 2000);
    }

    function resetCopyButton() {
        const btnText = document.getElementById('copyBtnText');
        const btn = document.getElementById('copyBtn');
        
        if (btnText.textContent === 'Copied!') {
            btnText.textContent = 'Copy Password';
            btn.classList.add('bg-gray-900', 'hover:bg-black');
            btn.classList.remove('bg-green-600', 'hover:bg-green-700');
        }
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', generatePassword);
</script>
@endpush
