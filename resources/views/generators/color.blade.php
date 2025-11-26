@extends('layouts.tool')

@section('title', 'Random Color Generator - WordFix')

@section('tool-title', 'Random Color Generator')

@section('tool-description', 'Generate random colors, palettes, and gradients')

@section('tool-content')
<!-- Compact Configuration -->
<div class="mb-4 bg-purple-50 border border-purple-200 rounded-lg p-3">
    <div class="flex flex-wrap items-center gap-3">
        <button onclick="generateColor()" class="px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
            Generate New Color
        </button>
        
        <div class="flex items-center gap-2">
            <label class="text-xs font-medium text-gray-700">Format:</label>
            <select id="colorFormat" onchange="updateDisplay()" class="px-2 py-1 text-sm border border-purple-300 rounded focus:ring-2 focus:ring-purple-500">
                <option value="hex">Hex</option>
                <option value="rgb">RGB</option>
                <option value="hsl">HSL</option>
            </select>
        </div>
        
        <label class="flex items-center cursor-pointer">
            <input type="checkbox" id="lockAlpha" class="w-4 h-4 text-purple-600 rounded" checked>
            <span class="ml-2 text-xs font-medium text-gray-700">Lock Alpha (1.0)</span>
        </label>
    </div>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Main Color Preview -->
    <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
        <div id="colorPreview" class="w-full h-48 rounded-lg shadow-inner mb-4 transition-colors duration-300 flex items-center justify-center">
            <span id="colorText" class="text-2xl font-bold bg-white/80 px-4 py-2 rounded backdrop-blur-sm shadow-sm select-all cursor-pointer" onclick="copyToClipboard('colorText')">#FFFFFF</span>
        </div>
        
        <div class="grid grid-cols-3 gap-2 text-center text-xs text-gray-600">
            <div class="p-2 bg-gray-50 rounded cursor-pointer hover:bg-gray-100" onclick="copyValue('hexValue')">
                <div class="font-medium mb-1">HEX</div>
                <div id="hexValue" class="select-all">#FFFFFF</div>
            </div>
            <div class="p-2 bg-gray-50 rounded cursor-pointer hover:bg-gray-100" onclick="copyValue('rgbValue')">
                <div class="font-medium mb-1">RGB</div>
                <div id="rgbValue" class="select-all">rgb(255, 255, 255)</div>
            </div>
            <div class="p-2 bg-gray-50 rounded cursor-pointer hover:bg-gray-100" onclick="copyValue('hslValue')">
                <div class="font-medium mb-1">HSL</div>
                <div id="hslValue" class="select-all">hsl(0, 0%, 100%)</div>
            </div>
        </div>
    </div>

    <!-- Palette & Shades -->
    <div class="space-y-4">
        <!-- Monochromatic Palette -->
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
            <h3 class="text-sm font-medium text-gray-700 mb-3">Shades & Tints</h3>
            <div class="flex h-12 rounded-lg overflow-hidden" id="paletteContainer">
                <!-- Generated via JS -->
            </div>
        </div>

        <!-- Complementary -->
        <div class="bg-white p-4 rounded-lg shadow-sm border border-gray-200">
            <h3 class="text-sm font-medium text-gray-700 mb-3">Harmony</h3>
            <div class="flex gap-2">
                <div id="compColor1" class="flex-1 h-12 rounded shadow-sm cursor-pointer" title="Complementary"></div>
                <div id="compColor2" class="flex-1 h-12 rounded shadow-sm cursor-pointer" title="Triadic 1"></div>
                <div id="compColor3" class="flex-1 h-12 rounded shadow-sm cursor-pointer" title="Triadic 2"></div>
            </div>
        </div>
    </div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none mt-8">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Random Color Generator</h2>
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>Generate random colors and explore their variations. Perfect for finding inspiration for your next design project.</p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-4 mb-2">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Generate random colors instantly</li>
            <li>View HEX, RGB, and HSL values</li>
            <li>Auto-generate shades and tints</li>
            <li>View complementary and triadic harmonies</li>
            <li>One-click copy to clipboard</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let currentColor = { h: 0, s: 0, l: 100 };

    function hslToHex(h, s, l) {
        l /= 100;
        const a = s * Math.min(l, 1 - l) / 100;
        const f = n => {
            const k = (n + h / 30) % 12;
            const color = l - a * Math.max(Math.min(k - 3, 9 - k, 1), -1);
            return Math.round(255 * color).toString(16).padStart(2, '0');
        };
        return `#${f(0)}${f(8)}${f(4)}`.toUpperCase();
    }

    function hslToRgb(h, s, l) {
        s /= 100;
        l /= 100;
        const k = n => (n + h / 30) % 12;
        const a = s * Math.min(l, 1 - l);
        const f = n => l - a * Math.max(-1, Math.min(k(n) - 3, Math.min(9 - k(n), 1)));
        return [Math.round(255 * f(0)), Math.round(255 * f(8)), Math.round(255 * f(4))];
    }

    function generateColor() {
        currentColor = {
            h: Math.floor(Math.random() * 360),
            s: Math.floor(Math.random() * 101),
            l: Math.floor(Math.random() * 101)
        };
        updateDisplay();
    }

    function updateDisplay() {
        const { h, s, l } = currentColor;
        const hex = hslToHex(h, s, l);
        const rgb = hslToRgb(h, s, l);
        const rgbStr = `rgb(${rgb[0]}, ${rgb[1]}, ${rgb[2]})`;
        const hslStr = `hsl(${h}, ${s}%, ${l}%)`;

        // Update Main Preview
        const preview = document.getElementById('colorPreview');
        const text = document.getElementById('colorText');
        
        preview.style.backgroundColor = hex;
        
        // Determine text color based on brightness
        const brightness = (rgb[0] * 299 + rgb[1] * 587 + rgb[2] * 114) / 1000;
        text.style.color = brightness > 128 ? '#000000' : '#FFFFFF';
        
        // Update Values
        document.getElementById('hexValue').textContent = hex;
        document.getElementById('rgbValue').textContent = rgbStr;
        document.getElementById('hslValue').textContent = hslStr;
        
        // Update Main Text based on selected format
        const format = document.getElementById('colorFormat').value;
        if (format === 'hex') text.textContent = hex;
        else if (format === 'rgb') text.textContent = rgbStr;
        else text.textContent = hslStr;

        // Generate Palette (Shades/Tints)
        const paletteContainer = document.getElementById('paletteContainer');
        paletteContainer.innerHTML = '';
        for (let i = 10; i <= 90; i += 10) {
            const shadeHex = hslToHex(h, s, i);
            const div = document.createElement('div');
            div.className = 'flex-1 h-full cursor-pointer hover:opacity-90 transition-opacity';
            div.style.backgroundColor = shadeHex;
            div.title = shadeHex;
            div.onclick = () => {
                navigator.clipboard.writeText(shadeHex);
                showToast('Copied: ' + shadeHex);
            };
            paletteContainer.appendChild(div);
        }

        // Harmony
        // Complementary (180deg)
        const compHex = hslToHex((h + 180) % 360, s, l);
        const compDiv = document.getElementById('compColor1');
        compDiv.style.backgroundColor = compHex;
        compDiv.onclick = () => { navigator.clipboard.writeText(compHex); showToast('Copied: ' + compHex); };
        
        // Triadic (120deg)
        const tri1Hex = hslToHex((h + 120) % 360, s, l);
        const tri1Div = document.getElementById('compColor2');
        tri1Div.style.backgroundColor = tri1Hex;
        tri1Div.onclick = () => { navigator.clipboard.writeText(tri1Hex); showToast('Copied: ' + tri1Hex); };
        
        // Triadic (240deg)
        const tri2Hex = hslToHex((h + 240) % 360, s, l);
        const tri2Div = document.getElementById('compColor3');
        tri2Div.style.backgroundColor = tri2Hex;
        tri2Div.onclick = () => { navigator.clipboard.writeText(tri2Hex); showToast('Copied: ' + tri2Hex); };
    }

    function copyValue(id) {
        const text = document.getElementById(id).textContent;
        navigator.clipboard.writeText(text);
        showToast('Copied: ' + text);
    }

    // Initialize
    document.addEventListener('DOMContentLoaded', generateColor);
</script>
@endpush
