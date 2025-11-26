@extends('layouts.tool')

@section('title', 'Hex Color Extractor - WordFix')

@section('tool-title', 'Hex Color Extractor')

@section('tool-description', 'Extract all hex color codes from text, CSS, or HTML - with visual preview')

@section('tool-content')
<!-- Text Input -->
<div class="mb-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">Paste Your Text/Code</label>
    <textarea 
        id="colorInput" 
        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none font-mono text-sm"
        rows="8"
        placeholder="Paste CSS, HTML, or any text containing hex colors like #FF5733 or #abc"
        oninput="extractColors()"
    ></textarea>
</div>

<!-- Results Section -->
<div id="resultsSection" class="hidden">
    <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <h3 class="text-lg font-semibold text-gray-900">
            Found <span id="colorCount" class="text-blue-600">0</span> Color(s)
        </h3>
        <div class="flex flex-wrap gap-2">
            <button onclick="copyColors()" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                Copy All
            </button>
            <button onclick="downloadColors()" class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                Download
            </button>
            <button onclick="clearAll()" class="px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
                Clear
            </button>
        </div>
    </div>
    
    <!-- Color Grid -->
    <div id="colorGrid" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-4"></div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Hex Color Extractor</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Hex Color Extractor</strong> finds all hexadecimal color codes in your text, CSS, or HTML. Visualize colors instantly with preview swatches.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Extracts both 6-digit (#FF5733) and 3-digit (#abc) hex codes</li>
            <li>Visual color preview with swatches</li>
            <li>Automatic duplicate removal</li>
            <li>Copy individual colors or all at once</li>
            <li>Download as text file</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Uses</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Design:</strong> Extract color palettes from websites</li>
            <li><strong>Development:</strong> Find colors in CSS/HTML code</li>
            <li><strong>Branding:</strong> Analyze competitor color schemes</li>
            <li><strong>Documentation:</strong> List all colors used in a project</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Supported Formats</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>6-digit hex: <code>#FF5733</code></li>
            <li>3-digit hex: <code>#abc</code> (expanded to <code>#aabbcc</code>)</li>
            <li>Uppercase or lowercase</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let extractedColors = [];
    
    function extractColors() {
        const text = document.getElementById('colorInput').value;
        const hexRegex = /#([0-9A-Fa-f]{6}|[0-9A-Fa-f]{3})\b/g;
        const matches = text.match(hexRegex) || [];
        
        // Expand 3-digit hex to 6-digit
        extractedColors = matches.map(color => {
            if (color.length === 4) {
                return '#' + color[1] + color[1] + color[2] + color[2] + color[3] + color[3];
            }
            return color.toUpperCase();
        });
        
        if (extractedColors.length > 0) {
            displayResults();
        } else {
            document.getElementById('resultsSection').classList.add('hidden');
        }
    }
    
    function displayResults() {
        const unique = [...new Set(extractedColors)];
        document.getElementById('colorCount').textContent = unique.length;
        
        const gridHTML = unique.map(color => `
            <div class="bg-white border border-gray-200 rounded-lg p-3 hover:shadow-lg transition-shadow">
                <div class="w-full h-24 rounded-lg mb-3 border-2 border-gray-300" style="background-color: ${color}"></div>
                <div class="text-center">
                    <code class="text-sm font-mono text-gray-900">${color}</code>
                    <button onclick="copyColor('${color}')" class="block w-full mt-2 px-2 py-1 bg-blue-50 text-blue-600 text-xs rounded hover:bg-blue-100 transition-colors">
                        Copy
                    </button>
                </div>
            </div>
        `).join('');
        
        document.getElementById('colorGrid').innerHTML = gridHTML;
        document.getElementById('resultsSection').classList.remove('hidden');
    }
    
    function copyColor(color) {
        navigator.clipboard.writeText(color);
    }
    
    function copyColors() {
        const unique = [...new Set(extractedColors)];
        navigator.clipboard.writeText(unique.join('\n'));
        alert('Colors copied to clipboard!');
    }
    
    function downloadColors() {
        const unique = [...new Set(extractedColors)];
        const blob = new Blob([unique.join('\n')], { type: 'text/plain' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'extracted-colors.txt';
        a.click();
    }
    
    function clearAll() {
        document.getElementById('colorInput').value = '';
        extractedColors = [];
        document.getElementById('resultsSection').classList.add('hidden');
    }
</script>
@endpush
