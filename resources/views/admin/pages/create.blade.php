@extends('admin.layout')

@section('title', 'Create Page - Admin')

@section('content')
<div class="mb-8">
    <div class="flex items-center space-x-4 mb-4">
        <a href="{{ route('admin.pages.index') }}" 
           class="text-gray-600 hover:text-gray-900 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Create New Page</h1>
            <p class="text-gray-600 mt-2">Add a new page to your website</p>
        </div>
    </div>
</div>

<form action="{{ route('admin.pages.store') }}" method="POST" class="space-y-6">
    @csrf
    
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Page Details</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="md:col-span-2">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Page Title *</label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       value="{{ old('title') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                       placeholder="Enter page title"
                       required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">URL Slug</label>
                <input type="text" 
                       id="slug" 
                       name="slug" 
                       value="{{ old('slug') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('slug') border-red-500 @enderror"
                       placeholder="auto-generated-from-title">
                <p class="mt-1 text-xs text-gray-500">Leave empty to auto-generate from title</p>
                @error('slug')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="footer_order" class="block text-sm font-medium text-gray-700 mb-2">Footer Order</label>
                <input type="number" 
                       id="footer_order" 
                       name="footer_order" 
                       value="{{ old('footer_order', 0) }}"
                       min="0"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('footer_order') border-red-500 @enderror"
                       placeholder="0">
                <p class="mt-1 text-xs text-gray-500">Lower numbers appear first in footer</p>
                @error('footer_order')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="mt-6">
            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Page Content *</label>
            <textarea id="content" 
                      name="content" 
                      rows="15"
                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 font-mono text-sm @error('content') border-red-500 @enderror"
                      placeholder="<h1>Your Page Title</h1>
<p>Enter your page content here using HTML tags...</p>

<h2>Section Heading</h2>
<p>You can use any HTML tags including:</p>
<ul>
  <li>Headings: &lt;h1&gt;, &lt;h2&gt;, &lt;h3&gt;</li>
  <li>Paragraphs: &lt;p&gt;</li>
  <li>Lists: &lt;ul&gt;, &lt;ol&gt;, &lt;li&gt;</li>
  <li>Links: &lt;a href=&quot;url&quot;&gt;text&lt;/a&gt;</li>
  <li>Emphasis: &lt;strong&gt;, &lt;em&gt;</li>
</ul>"
                      required>{{ old('content') }}</textarea>
            <div class="mt-2 p-3 bg-blue-50 rounded-lg">
                <p class="text-sm text-blue-800 font-medium mb-1">✨ HTML Content Supported</p>
                <p class="text-xs text-blue-700">You can use full HTML markup including headings, paragraphs, lists, links, and formatting tags. The content will be rendered as HTML on the public page.</p>
            </div>
            @error('content')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">SEO Settings</h2>
        
        <div class="space-y-4">
            <div>
                <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                <textarea id="meta_description" 
                          name="meta_description" 
                          rows="3"
                          maxlength="500"
                          class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('meta_description') border-red-500 @enderror"
                          placeholder="Brief description for search engines (max 500 characters)">{{ old('meta_description') }}</textarea>
                @error('meta_description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="meta_keywords" class="block text-sm font-medium text-gray-700 mb-2">Meta Keywords</label>
                <input type="text" 
                       id="meta_keywords" 
                       name="meta_keywords" 
                       value="{{ old('meta_keywords') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('meta_keywords') border-red-500 @enderror"
                       placeholder="keyword1, keyword2, keyword3">
                <p class="mt-1 text-xs text-gray-500">Separate keywords with commas</p>
                @error('meta_keywords')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-900 mb-4">Publishing Options</h2>
        
        <div class="space-y-4">
            <div class="flex items-center">
                <input type="checkbox" 
                       id="is_published" 
                       name="is_published" 
                       value="1"
                       {{ old('is_published', true) ? 'checked' : '' }}
                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="is_published" class="ml-2 block text-sm text-gray-900">
                    Publish this page immediately
                </label>
            </div>

            <div class="flex items-center">
                <input type="checkbox" 
                       id="show_in_footer" 
                       name="show_in_footer" 
                       value="1"
                       {{ old('show_in_footer') ? 'checked' : '' }}
                       class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                <label for="show_in_footer" class="ml-2 block text-sm text-gray-900">
                    Show link in website footer
                </label>
            </div>
        </div>
    </div>

    <div class="flex justify-end space-x-4">
        <a href="{{ route('admin.pages.index') }}" 
           class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
            Cancel
        </a>
        <button type="submit" 
                class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
            Create Page
        </button>
    </div>
</form>
@endsection

@push('scripts')
<script>
    // Auto-generate slug from title
    document.getElementById('title').addEventListener('input', function() {
        const title = this.value;
        const slugField = document.getElementById('slug');
        
        if (!slugField.value || slugField.dataset.autoGenerated) {
            const slug = title
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
            
            slugField.value = slug;
            slugField.dataset.autoGenerated = 'true';
        }
    });

    // Mark slug as manually edited
    document.getElementById('slug').addEventListener('input', function() {
        this.dataset.autoGenerated = 'false';
    });
</script>
@endpush
