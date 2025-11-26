@extends('admin.layout')

@section('title', 'Tool Suggestions - Admin Panel')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Tool Suggestions</h1>
        <p class="text-gray-600 mt-2">Review and manage user tool suggestions</p>
    </div>
    <div class="flex items-center space-x-4">
        <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
            {{ $suggestions->total() }} Total Suggestions
        </span>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
        {{ session('success') }}
    </div>
@endif

@if($suggestions->count() > 0)
    <!-- Filter Tabs -->
    <div class="mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8">
                <a href="?status=all" class="py-2 px-1 border-b-2 font-medium text-sm {{ request('status', 'all') === 'all' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    All ({{ $suggestions->total() }})
                </a>
                <a href="?status=pending" class="py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'pending' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Pending
                </a>
                <a href="?status=under_review" class="py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'under_review' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Under Review
                </a>
                <a href="?status=approved" class="py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'approved' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Approved
                </a>
                <a href="?status=rejected" class="py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'rejected' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Rejected
                </a>
            </nav>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tool Suggestion</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($suggestions as $suggestion)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="text-sm font-medium text-gray-900 mb-1">{{ $suggestion->tool_name }}</div>
                                    <p class="text-sm text-gray-600 line-clamp-2">{{ Str::limit($suggestion->description, 120) }}</p>
                                    @if($suggestion->use_case)
                                        <div class="mt-2 p-2 bg-blue-50 rounded text-xs text-blue-700">
                                            <strong>Use case:</strong> {{ Str::limit($suggestion->use_case, 80) }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8">
                                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                        <span class="text-sm font-medium text-gray-600">{{ substr($suggestion->user->name, 0, 1) }}</span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $suggestion->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $suggestion->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                {{ $suggestion->category ?: 'Uncategorized' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                @if($suggestion->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($suggestion->status === 'under_review') bg-blue-100 text-blue-800
                                @elseif($suggestion->status === 'approved') bg-green-100 text-green-800
                                @elseif($suggestion->status === 'rejected') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst(str_replace('_', ' ', $suggestion->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $suggestion->created_at->format('M j, Y') }}
                            <div class="text-xs text-gray-400">{{ $suggestion->created_at->diffForHumans() }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <button onclick="viewSuggestion({{ $suggestion->id }})" 
                                        class="text-blue-600 hover:text-blue-900 transition-colors" title="View Details">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                                
                                @if($suggestion->status === 'pending')
                                <form action="{{ route('admin.suggestions.update-status', $suggestion) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" 
                                            class="text-green-600 hover:text-green-900 transition-colors" 
                                            title="Approve Suggestion"
                                            onclick="return confirm('Approve this tool suggestion?')">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                </form>
                                
                                <form action="{{ route('admin.suggestions.update-status', $suggestion) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" 
                                            class="text-red-600 hover:text-red-900 transition-colors" 
                                            title="Reject Suggestion"
                                            onclick="return confirm('Reject this tool suggestion?')">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </form>
                                @elseif($suggestion->status === 'under_review')
                                <form action="{{ route('admin.suggestions.update-status', $suggestion) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" 
                                            class="text-green-600 hover:text-green-900 transition-colors" 
                                            title="Approve Suggestion"
                                            onclick="return confirm('Approve this tool suggestion?')">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                </form>
                                @endif
                                
                                <button onclick="updateSuggestionStatus({{ $suggestion->id }}, '{{ $suggestion->status }}')" 
                                        class="text-purple-600 hover:text-purple-900 transition-colors" title="Update Status">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Pagination -->
        @if($suggestions->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $suggestions->links() }}
            </div>
        @endif
    </div>
@else
    <div class="bg-white rounded-lg shadow p-8 text-center">
        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
        </svg>
        <h3 class="mt-4 text-lg font-medium text-gray-900">No Tool Suggestions Yet</h3>
        <p class="mt-2 text-sm text-gray-500">
            Tool suggestions from users will appear here once they start submitting them through the footer form.
        </p>
        <div class="mt-6">
            <span class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-700 bg-blue-100">
                Ready to Receive Suggestions
            </span>
        </div>
    </div>
@endif

<!-- View Suggestion Modal -->
<div id="viewSuggestionModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-screen overflow-y-auto">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">Tool Suggestion Details</h3>
                <button onclick="closeSuggestionModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div id="suggestionDetails" class="px-6 py-4">
                <!-- Content will be populated by JavaScript -->
            </div>
        </div>
    </div>
</div>

<!-- Update Status Modal -->
<div id="updateStatusModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
            <form id="statusUpdateForm" method="POST">
                @csrf
                @method('PATCH')
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900">Update Suggestion Status</h3>
                </div>
                <div class="px-6 py-4 space-y-4">
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                        <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="pending">Pending</option>
                            <option value="under_review">Under Review</option>
                            <option value="approved">Approved</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    <div>
                        <label for="admin_notes" class="block text-sm font-medium text-gray-700">Admin Notes</label>
                        <textarea id="admin_notes" name="admin_notes" rows="3" 
                                  class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                  placeholder="Optional notes for the user..."></textarea>
                    </div>
                </div>
                <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                    <button type="button" onclick="closeStatusModal()" 
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-md hover:bg-blue-700">
                        Update Status
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
async function viewSuggestion(suggestionId) {
    try {
        const response = await fetch(`/admin/suggestions/${suggestionId}`);
        const suggestion = await response.json();
        
        const modal = document.getElementById('viewSuggestionModal');
        const details = document.getElementById('suggestionDetails');
        
        details.innerHTML = `
            <div class="space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tool Name</label>
                        <p class="mt-1 text-sm text-gray-900">${suggestion.tool_name}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Category</label>
                        <p class="mt-1 text-sm text-gray-900">${suggestion.category || 'Not specified'}</p>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Description</label>
                    <div class="mt-1 p-3 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-900">${suggestion.description}</p>
                    </div>
                </div>
                
                ${suggestion.use_case ? `
                <div>
                    <label class="block text-sm font-medium text-gray-700">Use Case</label>
                    <div class="mt-1 p-3 bg-blue-50 rounded-lg">
                        <p class="text-sm text-blue-900">${suggestion.use_case}</p>
                    </div>
                </div>
                ` : ''}
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Submitted By</label>
                        <p class="mt-1 text-sm text-gray-900">${suggestion.user.name}</p>
                        <p class="text-sm text-gray-500">${suggestion.user.email}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <p class="mt-1 text-sm text-gray-900">${suggestion.status.replace('_', ' ')}</p>
                    </div>
                </div>
                
                ${suggestion.admin_notes ? `
                <div>
                    <label class="block text-sm font-medium text-gray-700">Admin Notes</label>
                    <div class="mt-1 p-3 bg-yellow-50 rounded-lg">
                        <p class="text-sm text-yellow-900">${suggestion.admin_notes}</p>
                    </div>
                </div>
                ` : ''}
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Submitted On</label>
                    <p class="mt-1 text-sm text-gray-900">${new Date(suggestion.created_at).toLocaleDateString()}</p>
                </div>
            </div>
        `;
        
        modal.classList.remove('hidden');
    } catch (error) {
        console.error('Error fetching suggestion details:', error);
        alert('Error loading suggestion details');
    }
}

function closeSuggestionModal() {
    document.getElementById('viewSuggestionModal').classList.add('hidden');
}

function updateSuggestionStatus(suggestionId, currentStatus) {
    const modal = document.getElementById('updateStatusModal');
    const form = document.getElementById('statusUpdateForm');
    const statusSelect = document.getElementById('status');
    
    form.action = `/admin/suggestions/${suggestionId}/status`;
    statusSelect.value = currentStatus;
    
    modal.classList.remove('hidden');
}

function closeStatusModal() {
    document.getElementById('updateStatusModal').classList.add('hidden');
}

// Close modals when clicking outside
document.getElementById('viewSuggestionModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeSuggestionModal();
    }
});

document.getElementById('updateStatusModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeStatusModal();
    }
});
</script>
@endsection