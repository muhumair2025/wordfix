@extends('admin.layout')

@section('title', 'Sitemap Configuration - WordFix Admin')

@section('content')
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Sitemap Configuration</h1>
            <p class="text-gray-600 mt-2">Configure how your sitemap.xml is generated</p>
        </div>
        <a href="{{ route('admin.seo.index') }}" 
           class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Back to SEO Settings
        </a>
    </div>
</div>

<!-- Success/Error Messages -->
@if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg">
        {{ session('error') }}
    </div>
@endif

<!-- Configuration Form -->
<div class="bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Sitemap Settings</h3>
        <p class="text-sm text-gray-600 mt-1">Configure how your sitemap.xml file is generated</p>
    </div>
    
    <form action="{{ route('admin.seo.update-sitemap-config') }}" method="POST" class="p-6">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- Basic Settings -->
            <div class="space-y-6">
                <h4 class="text-md font-medium text-gray-900 border-b border-gray-200 pb-2">Basic Settings</h4>
                
                <div>
                    <label for="base_url" class="block text-sm font-medium text-gray-700 mb-2">
                        Base URL <span class="text-red-500">*</span>
                    </label>
                    <input type="url" 
                           id="base_url" 
                           name="base_url" 
                           value="{{ old('base_url', $config['base_url']) }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           required>
                    <p class="text-sm text-gray-500 mt-1">The base URL of your website (e.g., https://wordfix.com)</p>
                    @error('base_url')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="default_changefreq" class="block text-sm font-medium text-gray-700 mb-2">
                        Default Change Frequency <span class="text-red-500">*</span>
                    </label>
                    <select id="default_changefreq" 
                            name="default_changefreq" 
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                            required>
                        <option value="always" {{ old('default_changefreq', $config['default_changefreq']) === 'always' ? 'selected' : '' }}>Always</option>
                        <option value="hourly" {{ old('default_changefreq', $config['default_changefreq']) === 'hourly' ? 'selected' : '' }}>Hourly</option>
                        <option value="daily" {{ old('default_changefreq', $config['default_changefreq']) === 'daily' ? 'selected' : '' }}>Daily</option>
                        <option value="weekly" {{ old('default_changefreq', $config['default_changefreq']) === 'weekly' ? 'selected' : '' }}>Weekly</option>
                        <option value="monthly" {{ old('default_changefreq', $config['default_changefreq']) === 'monthly' ? 'selected' : '' }}>Monthly</option>
                        <option value="yearly" {{ old('default_changefreq', $config['default_changefreq']) === 'yearly' ? 'selected' : '' }}>Yearly</option>
                        <option value="never" {{ old('default_changefreq', $config['default_changefreq']) === 'never' ? 'selected' : '' }}>Never</option>
                    </select>
                    <p class="text-sm text-gray-500 mt-1">How frequently pages are likely to change</p>
                </div>

                <div class="flex items-center space-x-6">
                    <div class="flex items-center">
                        <input type="checkbox" 
                               id="include_lastmod" 
                               name="include_lastmod" 
                               value="1"
                               {{ old('include_lastmod', $config['include_lastmod']) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="include_lastmod" class="ml-2 block text-sm text-gray-900">
                            Include Last Modified Date
                        </label>
                    </div>
                    
                    <div class="flex items-center">
                        <input type="checkbox" 
                               id="auto_generate" 
                               name="auto_generate" 
                               value="1"
                               {{ old('auto_generate', $config['auto_generate']) ? 'checked' : '' }}
                               class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                        <label for="auto_generate" class="ml-2 block text-sm text-gray-900">
                            Auto-generate on changes
                        </label>
                    </div>
                </div>
            </div>

            <!-- Priority Settings -->
            <div class="space-y-6">
                <h4 class="text-md font-medium text-gray-900 border-b border-gray-200 pb-2">Priority Settings</h4>
                
                <div>
                    <label for="homepage_priority" class="block text-sm font-medium text-gray-700 mb-2">
                        Homepage Priority <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           id="homepage_priority" 
                           name="homepage_priority" 
                           value="{{ old('homepage_priority', $config['homepage_priority']) }}"
                           min="0" 
                           max="1" 
                           step="0.1"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           required>
                    <p class="text-sm text-gray-500 mt-1">Priority of homepage (0.0 to 1.0)</p>
                </div>

                <div>
                    <label for="category_priority" class="block text-sm font-medium text-gray-700 mb-2">
                        Category Pages Priority <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           id="category_priority" 
                           name="category_priority" 
                           value="{{ old('category_priority', $config['category_priority']) }}"
                           min="0" 
                           max="1" 
                           step="0.1"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           required>
                    <p class="text-sm text-gray-500 mt-1">Priority of category pages (0.0 to 1.0)</p>
                </div>

                <div>
                    <label for="tool_priority" class="block text-sm font-medium text-gray-700 mb-2">
                        Tool Pages Priority <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           id="tool_priority" 
                           name="tool_priority" 
                           value="{{ old('tool_priority', $config['tool_priority']) }}"
                           min="0" 
                           max="1" 
                           step="0.1"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                           required>
                    <p class="text-sm text-gray-500 mt-1">Priority of individual tool pages (0.0 to 1.0)</p>
                </div>
            </div>
        </div>

        <!-- Exclude Pages -->
        <div class="mt-6">
            <label for="exclude_pages" class="block text-sm font-medium text-gray-700 mb-2">
                Exclude Pages
            </label>
            <textarea id="exclude_pages" 
                      name="exclude_pages" 
                      rows="4"
                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                      placeholder="/admin&#10;/login&#10;/register">{{ old('exclude_pages', implode("\n", $config['exclude_pages'] ?? [])) }}</textarea>
            <p class="text-sm text-gray-500 mt-1">Enter one URL path per line to exclude from sitemap (e.g., /admin, /login)</p>
        </div>

        <!-- Action Buttons -->
        <div class="mt-8 flex items-center justify-between">
            <div class="text-sm text-gray-500">
                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Configuration is saved to: <code class="bg-gray-100 px-2 py-1 rounded">resources/meta/sitemap-config.json</code>
            </div>
            
            <div class="flex space-x-3">
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                    </svg>
                    Save Configuration
                </button>
                
                <a href="{{ route('admin.seo.generate-sitemap') }}" 
                   onclick="event.preventDefault(); document.getElementById('generate-sitemap-form').submit();"
                   class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Generate Sitemap Now
                </a>
            </div>
        </div>
    </form>
</div>

<!-- Hidden form for sitemap generation -->
<form id="generate-sitemap-form" action="{{ route('admin.seo.generate-sitemap') }}" method="POST" style="display: none;">
    @csrf
</form>

<!-- Preview Section -->
<div class="mt-8 bg-white rounded-lg shadow">
    <div class="px-6 py-4 border-b border-gray-200">
        <h3 class="text-lg font-medium text-gray-900">Configuration Preview</h3>
        <p class="text-sm text-gray-600 mt-1">Preview of current sitemap configuration</p>
    </div>
    <div class="p-6">
        <div class="bg-gray-50 rounded-lg p-4 font-mono text-sm">
            <div class="text-gray-600 mb-2">// Current Configuration</div>
            <div><span class="text-blue-600">Base URL:</span> {{ $config['base_url'] }}</div>
            <div><span class="text-blue-600">Change Frequency:</span> {{ $config['default_changefreq'] }}</div>
            <div><span class="text-blue-600">Homepage Priority:</span> {{ $config['homepage_priority'] }}</div>
            <div><span class="text-blue-600">Category Priority:</span> {{ $config['category_priority'] }}</div>
            <div><span class="text-blue-600">Tool Priority:</span> {{ $config['tool_priority'] }}</div>
            <div><span class="text-blue-600">Include Last Modified:</span> {{ $config['include_lastmod'] ? 'Yes' : 'No' }}</div>
            <div><span class="text-blue-600">Auto Generate:</span> {{ $config['auto_generate'] ? 'Yes' : 'No' }}</div>
            @if(!empty($config['exclude_pages']))
                <div><span class="text-blue-600">Excluded Pages:</span> {{ implode(', ', $config['exclude_pages']) }}</div>
            @endif
        </div>
    </div>
</div>
@endsection
