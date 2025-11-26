@extends('layouts.tool')

@section('title', 'Image URL Extractor - WordFix')

@section('tool-title', 'Image URL Extractor')

@section('tool-description', 'Extract all image URLs from HTML, text, or web content - with preview thumbnails')

@section('tool-content')
<!-- Text Input -->
<div class="mb-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">Paste Your HTML/Text</label>
    <textarea 
        id="urlInput" 
        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 resize-none font-mono text-sm"
        rows="8"
        placeholder="Paste HTML or text containing image URLs (.jpg, .png, .gif, .webp, .svg)"
        oninput="extractImageURLs()"
    ></textarea>
</div>

<!-- Results Section -->
<div id="resultsSection" class="hidden">
    <div class="mb-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <h3 class="text-lg font-semibold text-gray-900">
            Found <span id="urlCount" class="text-blue-600">0</span> Image(s)
        </h3>
        <div class="flex flex-wrap gap-2">
            <button onclick="copyURLs()" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                Copy All
            </button>
            <button onclick="downloadURLs()" class="px-4 py-2 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors">
                Download
            </button>
            <button onclick="clearAll()" class="px-4 py-2 bg-gray-600 text-white text-sm font-medium rounded-lg hover:bg-gray-700 transition-colors">
                Clear
            </button>
        </div>
    </div>
    
    <!-- Image List with Previews -->
    <div id="imageList" class="space-y-3"></div>
</div>

@include('components.share-section')
@endsection

@section('tool-info')
<article class="prose prose-blue max-w-none">
    <h2 class="text-2xl font-bold text-gray-900 mb-4">About Image URL Extractor</h2>
    
    <div class="text-gray-700 leading-relaxed space-y-4">
        <p>
            The <strong>Image URL Extractor</strong> finds all image URLs from HTML, websites, or any text. Perfect for downloading images, analyzing web pages, or building image galleries.
        </p>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Features</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>Extracts URLs for JPG, PNG, GIF, WEBP, SVG images</li>
            <li>Works with both full URLs and relative paths</li>
            <li>Image preview thumbnails (when accessible)</li>
            <li>Download list as text file</li>
            <li>Copy individual or all URLs</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Common Uses</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li><strong>Web Scraping:</strong> Extract images from web pages</li>
            <li><strong>Development:</strong> Audit image assets in HTML</li>
            <li><strong>SEO:</strong> Analyze image URLs for optimization</li>
            <li><strong>Content:</strong> Build image galleries or catalogs</li>
        </ul>
        
        <h3 class="text-xl font-semibold text-gray-900 mt-6 mb-3">Supported Formats</h3>
        <ul class="list-disc list-inside space-y-1 ml-4">
            <li>.jpg / .jpeg</li>
            <li>.png</li>
            <li>.gif</li>
            <li>.webp</li>
            <li>.svg</li>
        </ul>
    </div>
</article>
@endsection

@push('scripts')
<script>
    let extractedURLs = [];
    
    function extractImageURLs() {
        const text = document.getElementById('urlInput').value;
        const urlRegex = /https?:\/\/[^\s<>"]+?\.(?:jpg|jpeg|png|gif|webp|svg)/gi;
        extractedURLs = text.match(urlRegex) || [];
        
        if (extractedURLs.length > 0) {
            displayResults();
        } else {
            document.getElementById('resultsSection').classList.add('hidden');
        }
    }
    
    function displayResults() {
        const unique = [...new Set(extractedURLs)];
        document.getElementById('urlCount').textContent = unique.length;
        
        const listHTML = unique.map((url, index) => `
            <div class="bg-white border border-gray-200 rounded-lg p-4 hover:shadow-lg transition-shadow">
                <div class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-shrink-0">
                        <img src="${url}" alt="Image ${index + 1}" class="w-32 h-32 object-cover rounded border border-gray-300" onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22100%22 height=%22100%22%3E%3Crect fill=%22%23ddd%22 width=%22100%22 height=%22100%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22 font-family=%22monospace%22 font-size=%2212%22 fill=%22%23999%22%3ENo Preview%3C/text%3E%3C/svg%3E'">
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-mono text-gray-900 break-all mb-2">${url}</p>
                        <div class="flex gap-2">
                            <button onclick="copyURL('${url}')" class="px-3 py-1 bg-blue-50 text-blue-600 text-xs rounded hover:bg-blue-100 transition-colors">
                                Copy
                            </button>
                            <a href="${url}" target="_blank" class="px-3 py-1 bg-green-50 text-green-600 text-xs rounded hover:bg-green-100 transition-colors">
                                Open
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        `).join('');
        
        document.getElementById('imageList').innerHTML = listHTML;
        document.getElementById('resultsSection').classList.remove('hidden');
    }
    
    function copyURL(url) {
        navigator.clipboard.writeText(url);
    }
    
    function copyURLs() {
        const unique = [...new Set(extractedURLs)];
        navigator.clipboard.writeText(unique.join('\n'));
        alert('URLs copied to clipboard!');
    }
    
    function downloadURLs() {
        const unique = [...new Set(extractedURLs)];
        const blob = new Blob([unique.join('\n')], { type: 'text/plain' });
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = 'image-urls.txt';
        a.click();
    }
    
    function clearAll() {
        document.getElementById('urlInput').value = '';
        extractedURLs = [];
        document.getElementById('resultsSection').classList.add('hidden');
    }
</script>
@endpush
