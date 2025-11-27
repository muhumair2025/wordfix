@extends('admin.layout')

@section('title', 'Tool Meta Tags - WordFix Admin')

@section('content')
<div class="mb-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Tool Meta Tags</h1>
            <p class="text-gray-600 mt-2">Manage meta titles, descriptions, and keywords for individual tools</p>
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

<!-- Storage Info -->
<div class="mb-6 bg-blue-50 border border-blue-200 text-blue-700 px-4 py-3 rounded-lg">
    <div class="flex items-center">
        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span><strong>Storage Location:</strong> Tool meta data is saved in <code class="bg-blue-100 px-2 py-1 rounded">resources/meta/tools.json</code> (file-based, no database required)</span>
    </div>
</div>

<!-- Search and Filter -->
<div class="mb-6 bg-white rounded-lg shadow p-4">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
        <div class="flex-1 max-w-lg">
            <input type="text" 
                   id="search-tools" 
                   placeholder="Search tools..."
                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
        </div>
        <div class="flex items-center space-x-3">
            <select id="category-filter" class="px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                <option value="">All Categories</option>
                <option value="basic">Basic Tools</option>
                <option value="counter">Counter Tools</option>
                <option value="formatter">Formatter Tools</option>
                <option value="modify">Modify Tools</option>
                <option value="extract">Extract Tools</option>
                <option value="sorting">Sorting Tools</option>
                <option value="remove">Remove Tools</option>
                <option value="replace">Replace Tools</option>
                <option value="conversions">Conversion Tools</option>
                <option value="generators">Generator Tools</option>
                <option value="special-effects">Special Effects Tools</option>
            </select>
        </div>
    </div>
</div>

<!-- Auto-Sync and Bulk Update Section -->
<div class="mb-6 space-y-4">
    <!-- Auto-Sync New Tools -->
    <div class="bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-lg p-4">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-medium text-green-900">🔄 Auto-Sync New Tools</h3>
                <p class="text-sm text-green-700 mt-1">Automatically detect and add new tools from navbar to SEO management</p>
            </div>
            <form action="{{ route('admin.seo.sync-tools') }}" method="POST" class="inline">
                @csrf
                <button type="submit" 
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"/>
                    </svg>
                    Sync New Tools
                </button>
            </form>
        </div>
    </div>

    <!-- Bulk Update Section -->
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-4">
        <div class="flex items-center justify-between">
            <div>
                <h3 class="text-lg font-medium text-blue-900">📝 Bulk Update All Tools</h3>
                <p class="text-sm text-blue-700 mt-1">Update meta tags for all visible tools at once</p>
            </div>
            <button type="button" 
                    id="update-all-btn"
                    class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
                <span id="update-all-text">Update All Visible Tools</span>
            </button>
        </div>
        <div id="bulk-progress" class="hidden mt-3">
            <div class="bg-blue-200 rounded-full h-2">
                <div id="progress-bar" class="bg-blue-600 h-2 rounded-full transition-all duration-300" style="width: 0%"></div>
            </div>
            <p id="progress-text" class="text-sm text-blue-700 mt-1">Processing...</p>
        </div>
    </div>
</div>

<!-- Tools Grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6" id="tools-grid">
    @foreach($tools as $category => $categoryTools)
        @foreach($categoryTools as $tool)
            @php
                $toolKey = $category . '.' . $tool['slug'];
                $meta = $toolMeta[$toolKey] ?? [
                    'title' => $tool['name'] . ' - WordFix',
                    'description' => 'Use our free ' . strtolower($tool['name']) . ' tool to transform your text quickly and easily.',
                    'keywords' => strtolower($tool['name']) . ', text tools, online tools, free tools'
                ];
            @endphp
            <div class="tool-card bg-white rounded-lg shadow" data-category="{{ $category }}" data-tool="{{ strtolower($tool['name']) }}">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">{{ $tool['name'] }}</h3>
                            <p class="text-sm text-gray-500">{{ ucfirst($category) }} • /{{ $category }}/{{ $tool['slug'] }}</p>
                        </div>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                            {{ ucfirst($category) }}
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.seo.update-tool-meta') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="tool_key" value="{{ $toolKey }}">
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Meta Title <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="title" 
                                   value="{{ old('title', $meta['title']) }}"
                                   maxlength="60"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm"
                                   required>
                            <p class="text-xs text-gray-500 mt-1">{{ strlen($meta['title']) }}/60 characters</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Meta Description <span class="text-red-500">*</span>
                            </label>
                            <textarea name="description" 
                                      rows="2"
                                      maxlength="160"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm"
                                      required>{{ old('description', $meta['description']) }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">{{ strlen($meta['description']) }}/160 characters</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                Meta Keywords <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   name="keywords" 
                                   value="{{ old('keywords', $meta['keywords']) }}"
                                   maxlength="255"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm"
                                   required>
                            <p class="text-xs text-gray-500 mt-1">Separate with commas</p>
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" 
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/>
                                </svg>
                                Update Meta
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        @endforeach
    @endforeach
</div>

<!-- Empty State -->
<div id="no-results" class="hidden text-center py-12">
    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
    </svg>
    <h3 class="mt-2 text-sm font-medium text-gray-900">No tools found</h3>
    <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter criteria.</p>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('search-tools');
    const categoryFilter = document.getElementById('category-filter');
    const toolCards = document.querySelectorAll('.tool-card');
    const noResults = document.getElementById('no-results');

    function filterTools() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCategory = categoryFilter.value;
        let visibleCount = 0;

        toolCards.forEach(card => {
            const toolName = card.dataset.tool;
            const category = card.dataset.category;
            
            const matchesSearch = toolName.includes(searchTerm);
            const matchesCategory = !selectedCategory || category === selectedCategory;
            
            if (matchesSearch && matchesCategory) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Show/hide no results message
        if (visibleCount === 0) {
            noResults.classList.remove('hidden');
        } else {
            noResults.classList.add('hidden');
        }
    }

    searchInput.addEventListener('input', filterTools);
    categoryFilter.addEventListener('change', filterTools);

    // Character counters for all forms
    document.querySelectorAll('input[name="title"]').forEach(input => {
        const counter = input.parentElement.querySelector('p');
        input.addEventListener('input', function() {
            const length = this.value.length;
            counter.textContent = `${length}/60 characters`;
            counter.className = length > 60 ? 'text-xs text-red-500 mt-1' : 'text-xs text-gray-500 mt-1';
        });
    });

    document.querySelectorAll('textarea[name="description"]').forEach(textarea => {
        const counter = textarea.parentElement.querySelector('p');
        textarea.addEventListener('input', function() {
            const length = this.value.length;
            counter.textContent = `${length}/160 characters`;
            counter.className = length > 160 ? 'text-xs text-red-500 mt-1' : 'text-xs text-gray-500 mt-1';
        });
    });

    // Bulk Update Functionality
    const updateAllBtn = document.getElementById('update-all-btn');
    const updateAllText = document.getElementById('update-all-text');
    const bulkProgress = document.getElementById('bulk-progress');
    const progressBar = document.getElementById('progress-bar');
    const progressText = document.getElementById('progress-text');

    updateAllBtn.addEventListener('click', async function() {
        const visibleForms = Array.from(document.querySelectorAll('.tool-card')).filter(card => 
            card.style.display !== 'none'
        );

        if (visibleForms.length === 0) {
            alert('No tools visible to update!');
            return;
        }

        if (!confirm(`Are you sure you want to update meta tags for ${visibleForms.length} tools?`)) {
            return;
        }

        // Show progress
        updateAllBtn.disabled = true;
        updateAllText.textContent = 'Updating...';
        bulkProgress.classList.remove('hidden');
        
        let completed = 0;
        let errors = 0;

        for (let i = 0; i < visibleForms.length; i++) {
            const form = visibleForms[i].querySelector('form');
            const formData = new FormData(form);
            
            // Update progress
            const progress = ((i + 1) / visibleForms.length) * 100;
            progressBar.style.width = progress + '%';
            progressText.textContent = `Processing ${i + 1} of ${visibleForms.length} tools...`;

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                });

                if (response.ok) {
                    completed++;
                    // Add success indicator to the card
                    const card = visibleForms[i];
                    const indicator = document.createElement('div');
                    indicator.className = 'absolute top-2 right-2 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center';
                    indicator.innerHTML = '<svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
                    card.style.position = 'relative';
                    card.appendChild(indicator);
                    
                    // Remove indicator after 3 seconds
                    setTimeout(() => indicator.remove(), 3000);
                } else {
                    errors++;
                }
            } catch (error) {
                errors++;
                console.error('Error updating tool:', error);
            }

            // Small delay to prevent overwhelming the server
            await new Promise(resolve => setTimeout(resolve, 100));
        }

        // Show completion message
        progressText.textContent = `Completed! ${completed} updated, ${errors} errors`;
        updateAllText.textContent = `Update All Visible Tools`;
        updateAllBtn.disabled = false;

        // Hide progress after 3 seconds
        setTimeout(() => {
            bulkProgress.classList.add('hidden');
            progressBar.style.width = '0%';
        }, 3000);

        // Show summary alert
        if (errors === 0) {
            alert(`✅ Successfully updated ${completed} tools!`);
        } else {
            alert(`⚠️ Updated ${completed} tools with ${errors} errors. Check console for details.`);
        }
    });
});
</script>
@endpush
@endsection
