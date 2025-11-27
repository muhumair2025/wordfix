@extends('admin.layout')

@section('title', 'SEO Settings - WordFix Admin')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">SEO Settings</h1>
    <p class="text-gray-600 mt-2">Manage robots.txt, sitemap.xml, and meta tags for your website</p>
</div>

<!-- Success/Error Messages -->
@if(session('success'))
    <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg" id="success-message">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('success') }}
        </div>
    </div>
@endif

@if(session('error'))
    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg" id="error-message">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ session('error') }}
        </div>
    </div>
@endif

@if($errors->any())
    <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg" id="validation-errors">
        <div class="flex items-start">
            <svg class="w-5 h-5 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <div>
                <p class="font-medium">Please fix the following errors:</p>
                <ul class="mt-1 list-disc list-inside text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

<!-- Storage Info -->
<div class="mb-6 bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg">
    <div class="flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span><strong>File-Based Storage:</strong> All SEO data is stored in files (no database). 
        Robots.txt: <code class="bg-blue-100 px-1 rounded">public/robots.txt</code> | 
        Sitemap: <code class="bg-blue-100 px-1 rounded">public/sitemap.xml</code> | 
        Meta: <code class="bg-blue-100 px-1 rounded">resources/meta/*.json</code></span>
    </div>
</div>

@if($seoStats['total_tools'] < 100)
<!-- Quick Fix Alert -->
<div class="mb-6 bg-yellow-50 border border-yellow-200 text-yellow-800 px-4 py-3 rounded-lg">
    <div class="flex items-center justify-between">
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"/>
            </svg>
            <span><strong>⚠️ Tool Count Issue:</strong> Showing {{ $seoStats['total_tools'] }} tools instead of expected 119. Click to sync all tools.</span>
        </div>
        <a href="{{ route('admin.seo.tool-meta') }}" 
           class="inline-flex items-center px-3 py-1 border border-transparent text-sm font-medium rounded-md text-yellow-800 bg-yellow-100 hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
            Fix Now →
        </a>
    </div>
</div>
@endif

<!-- Quick Actions -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-blue-500 rounded-md flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
            </div>
            <div class="ml-5 w-0 flex-1">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">Robots.txt</dt>
                    <dd class="text-lg font-medium {{ $robotsExists ? 'text-green-600' : 'text-red-600' }}">
                        {{ $robotsExists ? 'Active' : 'Not Found' }}
                    </dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-green-500 rounded-md flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 013 16.382V5.618a1 1 0 011.447-.894L9 7m0 13l6-3m-6 3V7m6 10l4.553 2.276A1 1 0 0021 18.382V7.618a1 1 0 00-.553-.894L15 4m0 13V4m0 0L9 7"/>
                    </svg>
                </div>
            </div>
            <div class="ml-5 w-0 flex-1">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">Sitemap.xml</dt>
                    <dd class="text-lg font-medium {{ $sitemapExists ? 'text-green-600' : 'text-red-600' }}">
                        {{ $sitemapExists ? 'Generated' : 'Not Found' }}
                    </dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-purple-500 rounded-md flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2H5a2 2 0 00-2 2z"/>
                    </svg>
                </div>
            </div>
            <div class="ml-5 w-0 flex-1">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">Home Meta</dt>
                    <dd class="text-lg font-medium text-green-600">Configured</dd>
                </dl>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <div class="w-8 h-8 bg-orange-500 rounded-md flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
            </div>
            <div class="ml-5 w-0 flex-1">
                <dl>
                    <dt class="text-sm font-medium text-gray-500 truncate">Tool Meta</dt>
                    <dd class="text-lg font-medium text-blue-600">
                        <a href="{{ route('admin.seo.tool-meta') }}" class="hover:underline">{{ $seoStats['configured_tools'] }}/{{ $seoStats['total_tools'] }}</a>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>

<!-- SEO Analytics Dashboard -->
<div class="mb-8">
    <h2 class="text-xl font-semibold text-gray-900 mb-4">SEO Analytics</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        <!-- Meta Completion -->
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Meta Completion</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $seoStats['completion_percentage'] }}%</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                    </svg>
                </div>
            </div>
            <div class="mt-2">
                <div class="bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ min(100, $seoStats['completion_percentage']) }}%"></div>
                </div>
            </div>
        </div>

        <!-- Missing Meta -->
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Missing Meta</p>
                    <p class="text-2xl font-bold {{ $seoStats['missing_meta'] > 0 ? 'text-red-600' : 'text-green-600' }}">{{ $seoStats['missing_meta'] }}</p>
                </div>
                <div class="w-12 h-12 {{ $seoStats['missing_meta'] > 0 ? 'bg-red-100' : 'bg-green-100' }} rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 {{ $seoStats['missing_meta'] > 0 ? 'text-red-600' : 'text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16c-.77.833.192 2.5 1.732 2.5z"/>
                    </svg>
                </div>
            </div>
            @if($seoStats['missing_meta'] > 0)
                <p class="text-xs text-red-600 mt-1">Tools need meta tags</p>
            @else
                <p class="text-xs text-green-600 mt-1">All tools configured</p>
            @endif
        </div>

        <!-- SEO Issues -->
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">SEO Issues</p>
                    <p class="text-2xl font-bold {{ $seoStats['seo_issues'] > 0 ? 'text-yellow-600' : 'text-green-600' }}">{{ $seoStats['seo_issues'] }}</p>
                </div>
                <div class="w-12 h-12 {{ $seoStats['seo_issues'] > 0 ? 'bg-yellow-100' : 'bg-green-100' }} rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 {{ $seoStats['seo_issues'] > 0 ? 'text-yellow-600' : 'text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
            </div>
            @if($seoStats['seo_issues'] > 0)
                <p class="text-xs text-yellow-600 mt-1">Need attention</p>
            @else
                <p class="text-xs text-green-600 mt-1">All good!</p>
            @endif
        </div>

        <!-- Total Tools -->
        <div class="bg-white rounded-lg shadow p-4">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-600">Total Tools</p>
                    <p class="text-2xl font-bold text-gray-900">{{ $seoStats['total_tools'] }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
            </div>
            <p class="text-xs text-purple-600 mt-1">
                <a href="{{ route('admin.seo.tool-meta') }}" class="hover:underline">Manage Meta Tags →</a>
            </p>
        </div>
    </div>

    <!-- SEO Issues List -->
    @if($seoStats['seo_issues'] > 0)
        <div class="mt-4 bg-yellow-50 border border-yellow-200 rounded-lg p-4">
            <h3 class="text-sm font-medium text-yellow-800 mb-2">⚠️ SEO Issues Found</h3>
            <ul class="text-sm text-yellow-700 space-y-1">
                @foreach($seoStats['issues_list'] as $issue)
                    <li>• {{ $issue }}</li>
                @endforeach
                @if(count($seoStats['issues_list']) < $seoStats['seo_issues'])
                    <li class="text-yellow-600">• And {{ $seoStats['seo_issues'] - count($seoStats['issues_list']) }} more issues...</li>
                @endif
            </ul>
            <a href="{{ route('admin.seo.tool-meta') }}" class="inline-flex items-center mt-2 text-sm text-yellow-800 hover:text-yellow-900">
                Fix issues →
            </a>
        </div>
    @endif
</div>

<!-- Quick Actions Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
</div>

<!-- Tab Content with Navigation -->
<div x-data="{ 
    activeTab: @if(session('success') && (str_contains(session('success'), 'SEO settings') || str_contains(session('success'), 'Favicon'))) 'seo-settings' @elseif(session('error') && (str_contains(session('error'), 'SEO settings') || str_contains(session('error'), 'Favicon'))) 'seo-settings' @else 'robots' @endif 
}">
    <!-- Tabs Navigation -->
    <div class="mb-6">
        <nav class="flex space-x-8">
            <button @click="activeTab = 'robots'" 
                    :class="activeTab === 'robots' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                Robots.txt
            </button>
            <button @click="activeTab = 'sitemap'" 
                    :class="activeTab === 'sitemap' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                Sitemap.xml
            </button>
            <button @click="activeTab = 'home-meta'" 
                    :class="activeTab === 'home-meta' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                Home Page Meta
            </button>
            <button @click="activeTab = 'seo-settings'" 
                    :class="activeTab === 'seo-settings' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                    class="whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                SEO Settings
            </button>
        </nav>
    </div>
    <!-- Robots.txt Tab -->
    <div x-show="activeTab === 'robots'" class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Robots.txt Management</h3>
            <p class="text-sm text-gray-600 mt-1">Control how search engines crawl your website</p>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.seo.update-robots') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="robots-content" class="block text-sm font-medium text-gray-700 mb-2">
                        Robots.txt Content
                    </label>
                    <textarea id="robots-content" 
                              name="content" 
                              rows="15" 
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 font-mono text-sm"
                              placeholder="User-agent: *&#10;Disallow: /admin&#10;&#10;Sitemap: {{ url('/sitemap.xml') }}">{{ $robotsContent ?: "User-agent: *\nDisallow: /admin\n\nSitemap: " . url('/sitemap.xml') }}</textarea>
                </div>
                <div class="flex items-center justify-between">
                    <div class="text-sm text-gray-500">
                        @if($robotsExists)
                            <span class="text-green-600">✓ File exists at: {{ url('/robots.txt') }}</span>
                        @else
                            <span class="text-red-600">⚠ File not found - will be created</span>
                        @endif
                    </div>
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                        </svg>
                        Update Robots.txt
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Sitemap.xml Tab -->
    <div x-show="activeTab === 'sitemap'" class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Sitemap.xml Management</h3>
            <p class="text-sm text-gray-600 mt-1">Generate and view your website sitemap</p>
        </div>
        <div class="p-6">
            <div class="mb-6">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h4 class="text-sm font-medium text-gray-900">Current Sitemap Status</h4>
                        <p class="text-sm text-gray-600">
                            @if($sitemapExists)
                                <span class="text-green-600">✓ Sitemap exists at: {{ url('/sitemap.xml') }}</span>
                            @else
                                <span class="text-red-600">⚠ Sitemap not found - click generate to create</span>
                            @endif
                        </p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.seo.sitemap-config') }}" 
                           class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            Configure
                        </a>
                        <form action="{{ route('admin.seo.generate-sitemap') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Generate Sitemap
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            @if($sitemapExists)
                <div>
                    <label for="sitemap-content" class="block text-sm font-medium text-gray-700 mb-2">
                        Current Sitemap Content (Read-only)
                    </label>
                    <textarea id="sitemap-content" 
                              rows="20" 
                              readonly
                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm bg-gray-50 font-mono text-sm">{{ $sitemapContent }}</textarea>
                    <div class="mt-2 text-sm text-gray-500">
                        <a href="{{ url('/sitemap.xml') }}" target="_blank" class="text-blue-600 hover:underline">
                            View sitemap in browser →
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Home Meta Tab -->
    <div x-show="activeTab === 'home-meta'" class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Home Page Meta Tags</h3>
            <p class="text-sm text-gray-600 mt-1">Set meta title, description, and keywords for your homepage</p>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.seo.update-home-meta') }}" method="POST">
                @csrf
                <div class="space-y-6">
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            Meta Title <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="title" 
                               name="title" 
                               value="{{ old('title', $homeMeta['title']) }}"
                               maxlength="60"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                               required>
                        <p class="text-sm text-gray-500 mt-1">Recommended: 50-60 characters</p>
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Meta Description <span class="text-red-500">*</span>
                        </label>
                        <textarea id="description" 
                                  name="description" 
                                  rows="3"
                                  maxlength="160"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                  required>{{ old('description', $homeMeta['description']) }}</textarea>
                        <p class="text-sm text-gray-500 mt-1">Recommended: 150-160 characters</p>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="keywords" class="block text-sm font-medium text-gray-700 mb-2">
                            Meta Keywords <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="keywords" 
                               name="keywords" 
                               value="{{ old('keywords', $homeMeta['keywords']) }}"
                               maxlength="255"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                               required>
                        <p class="text-sm text-gray-500 mt-1">Separate keywords with commas</p>
                        @error('keywords')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                            </svg>
                            Update Home Meta Tags
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- SEO Settings Tab -->
    <div x-show="activeTab === 'seo-settings'" class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">SEO Settings</h3>
            <p class="text-sm text-gray-600 mt-1">Manage favicon and search engine verification</p>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.seo.update-seo-settings') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Favicon Section -->
                <div class="mb-8">
                    <h4 class="text-md font-medium text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                        Favicon Management
                    </h4>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label for="favicon" class="block text-sm font-medium text-gray-700 mb-2">
                                Upload Favicon
                            </label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md hover:border-blue-400 transition-colors">
                                <div class="space-y-1 text-center">
                                    @if($seoSettings['favicon_uploaded'] && $seoSettings['favicon_path'])
                                        <div class="mb-4">
                                            <img src="{{ $seoSettings['favicon_path'] }}" alt="Current Favicon" class="mx-auto h-16 w-16 object-contain">
                                            <p class="text-sm text-green-600 mt-2">✓ Favicon uploaded</p>
                                        </div>
                                    @else
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    @endif
                                    <div class="flex text-sm text-gray-600">
                                        <label for="favicon" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Upload a file</span>
                                            <input id="favicon" name="favicon" type="file" class="sr-only" accept=".ico,.png,.jpg,.jpeg,.gif,.svg">
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">ICO, PNG, JPG, SVG up to 2MB</p>
                                </div>
                            </div>
                            @if($seoSettings['favicon_uploaded'])
                                <div class="mt-2">
                                    <button type="button" 
                                            onclick="removeFavicon()"
                                            class="text-sm text-red-600 hover:text-red-800">
                                        Remove current favicon
                                    </button>
                                </div>
                            @endif
                        </div>
                        
                        <div class="bg-blue-50 rounded-lg p-4">
                            <h5 class="text-sm font-medium text-blue-900 mb-2">Favicon Guidelines</h5>
                            <ul class="text-sm text-blue-700 space-y-1">
                                <li>• Recommended size: 32x32 or 16x16 pixels</li>
                                <li>• Best format: ICO for maximum compatibility</li>
                                <li>• PNG/SVG also supported for modern browsers</li>
                                <li>• Will be applied to all pages automatically</li>
                                <li>• Appears in browser tabs and bookmarks</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Search Engine Verification -->
                <div class="mb-8">
                    <h4 class="text-md font-medium text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Search Engine Verification
                    </h4>
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label for="google_site_verification" class="block text-sm font-medium text-gray-700 mb-2">
                                Google Search Console
                            </label>
                            <input type="text" 
                                   id="google_site_verification" 
                                   name="google_site_verification" 
                                   value="{{ old('google_site_verification', $seoSettings['google_site_verification']) }}"
                                   placeholder="Enter verification code"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                            <p class="text-xs text-gray-500 mt-1">Enter only the content value, not the full meta tag</p>
                        </div>

                        <div>
                            <label for="bing_site_verification" class="block text-sm font-medium text-gray-700 mb-2">
                                Bing Webmaster Tools
                            </label>
                            <input type="text" 
                                   id="bing_site_verification" 
                                   name="bing_site_verification" 
                                   value="{{ old('bing_site_verification', $seoSettings['bing_site_verification']) }}"
                                   placeholder="Enter verification code"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="yandex_site_verification" class="block text-sm font-medium text-gray-700 mb-2">
                                Yandex Webmaster
                            </label>
                            <input type="text" 
                                   id="yandex_site_verification" 
                                   name="yandex_site_verification" 
                                   value="{{ old('yandex_site_verification', $seoSettings['yandex_site_verification']) }}"
                                   placeholder="Enter verification code"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <div>
                            <label for="pinterest_site_verification" class="block text-sm font-medium text-gray-700 mb-2">
                                Pinterest
                            </label>
                            <input type="text" 
                                   id="pinterest_site_verification" 
                                   name="pinterest_site_verification" 
                                   value="{{ old('pinterest_site_verification', $seoSettings['pinterest_site_verification']) }}"
                                   placeholder="Enter verification code"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                </div>

                <!-- Custom Head Tags -->
                <div class="mb-8">
                    <h4 class="text-md font-medium text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                        </svg>
                        Custom Head Tags
                    </h4>
                    
                    <div>
                        <label for="custom_head_tags" class="block text-sm font-medium text-gray-700 mb-2">
                            Additional HTML Tags
                        </label>
                        <textarea id="custom_head_tags" 
                                  name="custom_head_tags" 
                                  rows="6"
                                  placeholder="<meta name=&quot;example&quot; content=&quot;value&quot;>&#10;<script>/* Analytics code */</script>"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 font-mono text-sm">{{ old('custom_head_tags', $seoSettings['custom_head_tags']) }}</textarea>
                        <p class="text-sm text-gray-500 mt-1">Add custom meta tags, analytics codes, or other HTML that should appear in the &lt;head&gt; section</p>
                    </div>
                </div>

                <!-- Save Button -->
                <div class="flex justify-end">
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                        </svg>
                        Save SEO Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Quick Actions Section -->
<div class="mt-8">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Quick Actions</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="{{ route('admin.seo.tool-meta') }}" class="block p-6 bg-white rounded-lg shadow hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <svg class="h-8 w-8 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                </svg>
                <div class="ml-4">
                    <h4 class="text-lg font-medium text-gray-900">Manage Tool Meta Tags</h4>
                    <p class="text-sm text-gray-500">Set meta titles and descriptions for individual tools</p>
                </div>
            </div>
        </a>

        <a href="{{ url('/sitemap.xml') }}" target="_blank" class="block p-6 bg-white rounded-lg shadow hover:shadow-md transition-shadow">
            <div class="flex items-center">
                <svg class="h-8 w-8 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                </svg>
                <div class="ml-4">
                    <h4 class="text-lg font-medium text-gray-900">View Live Sitemap</h4>
                    <p class="text-sm text-gray-500">Open sitemap.xml in a new tab</p>
                </div>
            </div>
        </a>
    </div>
</div>

</div> <!-- Close Alpine.js container -->

@push('scripts')
<script>
function removeFavicon() {
    if (confirm('Are you sure you want to remove the current favicon?')) {
        // Create a form to submit DELETE request
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("admin.seo.remove-favicon") }}';
        
        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);
        
        // Add method spoofing for DELETE
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        form.appendChild(methodField);
        
        document.body.appendChild(form);
        form.submit();
    }
}

// Debug form submission
document.addEventListener('DOMContentLoaded', function() {
    const seoForm = document.querySelector('form[action*="update-seo-settings"]');
    if (seoForm) {
        seoForm.addEventListener('submit', function(e) {
            console.log('SEO Form submitting...', {
                action: this.action,
                method: this.method,
                hasFile: this.querySelector('input[type="file"]').files.length > 0
            });
        });
    }
    
    // Check for session messages and scroll to them
    @if(session('success'))
        console.log('Success message present:', '{{ session('success') }}');
        const successMsg = document.getElementById('success-message');
        if (successMsg) {
            successMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
            // Add a subtle animation
            successMsg.style.animation = 'pulse 2s ease-in-out';
        }
    @endif
    
    @if(session('error'))
        console.log('Error message present:', '{{ session('error') }}');
        const errorMsg = document.getElementById('error-message');
        if (errorMsg) {
            errorMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
            errorMsg.style.animation = 'pulse 2s ease-in-out';
        }
    @endif
    
    @if($errors->any())
        const validationMsg = document.getElementById('validation-errors');
        if (validationMsg) {
            validationMsg.scrollIntoView({ behavior: 'smooth', block: 'center' });
            validationMsg.style.animation = 'pulse 2s ease-in-out';
        }
    @endif
});
</script>
@endpush
@endsection
