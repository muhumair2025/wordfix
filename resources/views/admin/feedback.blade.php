@extends('admin.layout')

@section('title', 'User Feedback - Admin Panel')

@section('content')
<div class="mb-8 flex justify-between items-center">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">User Feedback</h1>
        <p class="text-gray-600 mt-2">Review and respond to user feedback</p>
    </div>
    <div class="flex items-center space-x-4">
        <span class="bg-blue-100 text-blue-800 text-sm font-medium px-3 py-1 rounded-full">
            {{ $feedback->total() }} Total Feedback
        </span>
    </div>
</div>

@if(session('success'))
    <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg mb-6">
        {{ session('success') }}
    </div>
@endif

@if($feedback->count() > 0)
    <!-- Filter Tabs -->
    <div class="mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8">
                <a href="?status=all" class="py-2 px-1 border-b-2 font-medium text-sm {{ request('status', 'all') === 'all' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    All ({{ $feedback->total() }})
                </a>
                <a href="?status=new" class="py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'new' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    New
                </a>
                <a href="?status=in_progress" class="py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'in_progress' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    In Progress
                </a>
                <a href="?status=resolved" class="py-2 px-1 border-b-2 font-medium text-sm {{ request('status') === 'resolved' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Resolved
                </a>
            </nav>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Feedback</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Rating</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($feedback as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0">
                                    @if($item->feedback_type === 'bug_report')
                                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 16.5c-.77.833.192 2.5 1.732 2.5z"/>
                                            </svg>
                                        </div>
                                    @elseif($item->feedback_type === 'feature_request')
                                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                            </svg>
                                        </div>
                                    @elseif($item->feedback_type === 'compliment')
                                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                            </svg>
                                        </div>
                                    @else
                                        <div class="w-8 h-8 bg-gray-100 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center space-x-2">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if($item->feedback_type === 'bug_report') bg-red-100 text-red-800
                                            @elseif($item->feedback_type === 'feature_request') bg-blue-100 text-blue-800
                                            @elseif($item->feedback_type === 'improvement') bg-yellow-100 text-yellow-800
                                            @elseif($item->feedback_type === 'compliment') bg-green-100 text-green-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst(str_replace('_', ' ', $item->feedback_type)) }}
                                        </span>
                                        @if($item->tool_name)
                                            <span class="text-xs text-gray-500">• {{ $item->tool_name }}</span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-900 mt-1 line-clamp-2">{{ Str::limit($item->message, 120) }}</p>
                                    @if($item->browser || $item->device)
                                        <p class="text-xs text-gray-500 mt-1">{{ $item->browser }} • {{ $item->device }}</p>
                                    @endif
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-8 w-8">
                                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center">
                                        <span class="text-sm font-medium text-gray-600">{{ substr($item->user->name, 0, 1) }}</span>
                                    </div>
                                </div>
                                <div class="ml-3">
                                    <div class="text-sm font-medium text-gray-900">{{ $item->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $item->user->email }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($item->rating)
                                <div class="flex items-center">
                                    @for($i = 1; $i <= 5; $i++)
                                        @if($i <= $item->rating)
                                            <svg class="h-4 w-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @else
                                            <svg class="h-4 w-4 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                            </svg>
                                        @endif
                                    @endfor
                                    <span class="ml-1 text-sm text-gray-500">({{ $item->rating }})</span>
                                </div>
                            @else
                                <span class="text-sm text-gray-400">No rating</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                @if($item->status === 'new') bg-blue-100 text-blue-800
                                @elseif($item->status === 'in_progress') bg-yellow-100 text-yellow-800
                                @elseif($item->status === 'resolved') bg-green-100 text-green-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst(str_replace('_', ' ', $item->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $item->created_at->format('M j, Y') }}
                            <div class="text-xs text-gray-400">{{ $item->created_at->diffForHumans() }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <div class="flex items-center justify-end space-x-2">
                                <button onclick="viewFeedback({{ $item->id }})" 
                                        class="text-blue-600 hover:text-blue-900 transition-colors" title="View Details">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                    </svg>
                                </button>
                                
                                @if($item->status !== 'resolved')
                                <form action="{{ route('admin.feedback.update-status', $item) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="resolved">
                                    <button type="submit" 
                                            class="text-green-600 hover:text-green-900 transition-colors" 
                                            title="Mark as Resolved"
                                            onclick="return confirm('Mark this feedback as resolved?')">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                        </svg>
                                    </button>
                                </form>
                                @endif
                                
                                <button onclick="replyToFeedback({{ $item->id }})" 
                                        class="text-purple-600 hover:text-purple-900 transition-colors" title="Reply">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
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
        @if($feedback->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $feedback->links() }}
            </div>
        @endif
    </div>
@else
    <div class="bg-white rounded-lg shadow p-8 text-center">
        <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
        </svg>
        <h3 class="mt-4 text-lg font-medium text-gray-900">No Feedback Yet</h3>
        <p class="mt-2 text-sm text-gray-500">
            User feedback will appear here once they start submitting it through the footer form.
        </p>
        <div class="mt-6">
            <span class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-green-700 bg-green-100">
                Ready to Receive Feedback
            </span>
        </div>
    </div>
@endif

<!-- View Feedback Modal -->
<div id="viewFeedbackModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-screen overflow-y-auto">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900">Feedback Details</h3>
                <button onclick="closeFeedbackModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div id="feedbackDetails" class="px-6 py-4">
                <!-- Content will be populated by JavaScript -->
            </div>
        </div>
    </div>
</div>

<script>
async function viewFeedback(feedbackId) {
    try {
        const response = await fetch(`/admin/feedback/${feedbackId}`);
        const feedback = await response.json();
        
        const modal = document.getElementById('viewFeedbackModal');
        const details = document.getElementById('feedbackDetails');
        
        const ratingStars = feedback.rating ? 
            Array.from({length: 5}, (_, i) => i < feedback.rating ? '★' : '☆').join('') : 
            'No rating provided';
        
        details.innerHTML = `
            <div class="space-y-6">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Feedback Type</label>
                        <p class="mt-1 text-sm text-gray-900">${feedback.feedback_type.replace('_', ' ')}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tool Name</label>
                        <p class="mt-1 text-sm text-gray-900">${feedback.tool_name || 'General feedback'}</p>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Rating</label>
                    <p class="mt-1 text-sm text-gray-900">${ratingStars} ${feedback.rating ? '(' + feedback.rating + '/5)' : ''}</p>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Message</label>
                    <div class="mt-1 p-3 bg-gray-50 rounded-lg">
                        <p class="text-sm text-gray-900 whitespace-pre-wrap">${feedback.message}</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Submitted By</label>
                        <p class="mt-1 text-sm text-gray-900">${feedback.user.name}</p>
                        <p class="text-sm text-gray-500">${feedback.user.email}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Status</label>
                        <p class="mt-1 text-sm text-gray-900">${feedback.status.replace('_', ' ')}</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Browser</label>
                        <p class="mt-1 text-sm text-gray-900">${feedback.browser || 'Unknown'}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Device</label>
                        <p class="mt-1 text-sm text-gray-900">${feedback.device || 'Unknown'}</p>
                    </div>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700">Submitted On</label>
                    <p class="mt-1 text-sm text-gray-900">${new Date(feedback.created_at).toLocaleDateString()}</p>
                </div>
            </div>
        `;
        
        modal.classList.remove('hidden');
    } catch (error) {
        console.error('Error fetching feedback details:', error);
        alert('Error loading feedback details');
    }
}

function closeFeedbackModal() {
    document.getElementById('viewFeedbackModal').classList.add('hidden');
}

function replyToFeedback(feedbackId) {
    // TODO: Implement reply functionality
    alert('Reply functionality will be implemented');
}

// Close modal when clicking outside
document.getElementById('viewFeedbackModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeFeedbackModal();
    }
});
</script>
@endsection