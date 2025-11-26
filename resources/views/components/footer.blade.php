<footer class="bg-white border-t border-gray-200 mt-6 md:mt-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Main Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-8">
            <!-- About WordFix -->
            <div class="lg:col-span-2">
                <a href="/" class="inline-block mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="WordFix" class="h-8">
                </a>
                <p class="text-gray-600 text-sm leading-relaxed mb-4">
                    WordFix is a comprehensive suite of 100+ free online text manipulation tools designed for writers, developers, students, and professionals. Transform, format, analyze, and process text with our clean, fast, and secure web-based tools.
                </p>
                <p class="text-gray-600 text-sm leading-relaxed">
                    From basic case conversions to advanced text processing, code formatting, data extraction, and content generation - WordFix provides everything you need to work with text efficiently. No downloads, no registration required.
                </p>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Quick Links</h3>
                <ul class="space-y-3">
                    <li><a href="/" class="text-gray-600 hover:text-blue-600 transition-colors text-sm">Home</a></li>
                    <li><a href="/basic/upper-case" class="text-gray-600 hover:text-blue-600 transition-colors text-sm">Popular Tools</a></li>
                   
                    @php
                        $footerPages = \App\Models\Page::footerPages();
                    @endphp
                    @foreach($footerPages as $page)
                        <li><a href="{{ $page->url }}" class="text-gray-600 hover:text-blue-600 transition-colors text-sm">{{ $page->title }}</a></li>
                    @endforeach
                </ul>
            </div>
            
            <!-- Help & Feedback -->
            <div>
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Help & Feedback</h3>
                <div class="space-y-3">
                    @auth
                    <button 
                        onclick="openSuggestToolModal()"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center justify-center gap-2"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Suggest a Tool
                    </button>
                    <button 
                        onclick="openFeedbackModal()"
                        class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center justify-center gap-2"
                    >
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        Provide Feedback
                    </button>
                    @else
                    <a href="{{ route('login') }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                        Login to Suggest Tool
                    </a>
                    <a href="{{ route('login') }}" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                        </svg>
                        Login to Give Feedback
                    </a>
                    @endauth
                    <p class="text-xs text-gray-500 mt-3">
                        Have an idea for a new tool or want to report an issue? We'd love to hear from you!
                    </p>
                </div>
            </div>
        </div>
        
        <!-- Tool Categories Overview -->
        <div class="border-t border-gray-200 pt-6 mb-6">
            <h3 class="text-sm font-semibold text-gray-900 mb-3">Tool Categories</h3>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-2">
                <a href="/basic" class="text-xs text-gray-600 hover:text-blue-600 transition-colors py-1">Basic</a>
                <a href="/counter" class="text-xs text-gray-600 hover:text-blue-600 transition-colors py-1">Counter</a>
                <a href="/formatter" class="text-xs text-gray-600 hover:text-blue-600 transition-colors py-1">Formatter</a>
                <a href="/modify" class="text-xs text-gray-600 hover:text-blue-600 transition-colors py-1">Modify</a>
                <a href="/extract" class="text-xs text-gray-600 hover:text-blue-600 transition-colors py-1">Extract</a>
                <a href="/sorting" class="text-xs text-gray-600 hover:text-blue-600 transition-colors py-1">Sorting</a>
                <a href="/remove" class="text-xs text-gray-600 hover:text-blue-600 transition-colors py-1">Remove</a>
                <a href="/replace" class="text-xs text-gray-600 hover:text-blue-600 transition-colors py-1">Replace</a>
                <a href="/conversions" class="text-xs text-gray-600 hover:text-blue-600 transition-colors py-1">Conversions</a>
                <a href="/generators" class="text-xs text-gray-600 hover:text-blue-600 transition-colors py-1">Generators</a>
                <a href="/special-effects" class="text-xs text-gray-600 hover:text-blue-600 transition-colors py-1">Special Effects</a>
                <a href="/studio" class="text-xs text-gray-600 hover:text-blue-600 transition-colors py-1">✨ Studio</a>
            </div>
        </div>
        
        <!-- Bottom Bar -->
        <div class="border-t border-gray-200 pt-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="text-xs text-gray-500">
                © 2024 WordFix. All rights reserved. Free online text tools for everyone.
            </div>
            <div class="flex items-center gap-4 text-xs text-gray-500">
                <span>Made with ❤️ for text processing</span>
                <span>•</span>
                <span>100+ Tools Available</span>
                <span>•</span>
                <span>No Registration Required</span>
            </div>
        </div>
    </div>
</footer>

<!-- Suggest Tool Modal -->
<div id="suggestToolModal" class="fixed inset-0 z-50 hidden" style="background-color: rgba(0, 0, 0, 0.5);">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full transform transition-all duration-300 scale-95 opacity-0" id="suggestToolModalContent">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-700 rounded-t-2xl p-6">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="bg-white bg-opacity-20 rounded-full p-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Suggest a New Tool</h3>
                            <p class="text-blue-100 text-sm">Help us improve WordFix</p>
                        </div>
                    </div>
                    <button onclick="closeSuggestToolModal()" class="text-white hover:bg-white hover:bg-opacity-20 rounded-full p-2 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Modal Body -->
            <div class="p-6">
                <form id="suggestToolForm" class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                Tool Name
                            </span>
                        </label>
                        <input type="text" id="toolName" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-gray-800 placeholder-gray-400" placeholder="e.g., Password Strength Checker">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Description
                            </span>
                        </label>
                        <textarea id="toolDescription" rows="3" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-gray-800 placeholder-gray-400 resize-none" placeholder="Describe what this tool should do and how it would help users..."></textarea>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                                </svg>
                                Category
                            </span>
                        </label>
                        <select id="toolCategory" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-gray-800 bg-white">
                            <option value="">Select a category</option>
                            <option value="basic">Basic Tools</option>
                            <option value="counter">Counter Tools</option>
                            <option value="formatter">Code Formatters</option>
                            <option value="modify">Text Modifiers</option>
                            <option value="extract">Data Extractors</option>
                            <option value="sorting">Sorting Tools</option>
                            <option value="remove">Remove Tools</option>
                            <option value="replace">Replace Tools</option>
                            <option value="conversions">Converters</option>
                            <option value="generators">Generators</option>
                            <option value="special-effects">Special Effects</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    
                    <!-- Use Case -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/>
                                </svg>
                                Use Case (Optional)
                            </span>
                        </label>
                        <textarea id="useCase" rows="2" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 text-gray-800 placeholder-gray-400 resize-none" placeholder="When would this tool be useful? What problem does it solve?"></textarea>
                    </div>
                    
                    <div class="flex gap-3 pt-4">
                        <button type="button" onclick="closeSuggestToolModal()" class="flex-1 px-6 py-3 border-2 border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 font-medium">
                            Cancel
                        </button>
                        <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-xl hover:from-blue-700 hover:to-blue-800 transition-all duration-200 font-medium shadow-lg hover:shadow-xl">
                            Submit Suggestion
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Feedback Modal -->
<div id="feedbackModal" class="fixed inset-0 z-50 hidden" style="background-color: rgba(0, 0, 0, 0.5);">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full transform transition-all duration-300 scale-95 opacity-0" id="feedbackModalContent">
            <!-- Modal Header -->
            <div class="bg-gradient-to-r from-green-600 to-green-700 rounded-t-2xl p-6">
                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="bg-white bg-opacity-20 rounded-full p-2">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white">Provide Feedback</h3>
                            <p class="text-green-100 text-sm">Help us make WordFix better</p>
                        </div>
                    </div>
                    <button onclick="closeFeedbackModal()" class="text-white hover:bg-white hover:bg-opacity-20 rounded-full p-2 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
            
            <!-- Modal Body -->
            <div class="p-6">
                <form id="feedbackForm" class="space-y-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                                </svg>
                                Feedback Type
                            </span>
                        </label>
                        <select id="feedbackType" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 text-gray-800 bg-white">
                            <option value="bug_report">🐛 Bug Report</option>
                            <option value="feature_request">✨ Feature Request</option>
                            <option value="improvement">🚀 Improvement Suggestion</option>
                            <option value="compliment">👏 Compliment</option>
                            <option value="other">💬 Other Feedback</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                                </svg>
                                Subject
                            </span>
                        </label>
                        <input type="text" id="feedbackSubject" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 text-gray-800 placeholder-gray-400" placeholder="Brief description of your feedback">
                    </div>
                    
                    <!-- Rating -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
                                </svg>
                                Rating (Optional)
                            </span>
                        </label>
                        <select id="rating" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 text-gray-800 bg-white">
                            <option value="">Select a rating</option>
                            <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                            <option value="4">⭐⭐⭐⭐ Good</option>
                            <option value="3">⭐⭐⭐ Average</option>
                            <option value="2">⭐⭐ Poor</option>
                            <option value="1">⭐ Very Poor</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            <span class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Details
                            </span>
                        </label>
                        <textarea id="feedbackDetails" rows="4" class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-all duration-200 text-gray-800 placeholder-gray-400 resize-none" placeholder="Please provide detailed feedback. The more specific, the better we can help!"></textarea>
                    </div>
                    
                    <div class="flex gap-3 pt-4">
                        <button type="button" onclick="closeFeedbackModal()" class="flex-1 px-6 py-3 border-2 border-gray-200 text-gray-600 rounded-xl hover:bg-gray-50 hover:border-gray-300 transition-all duration-200 font-medium">
                            Cancel
                        </button>
                        <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-xl hover:from-green-700 hover:to-green-800 transition-all duration-200 font-medium shadow-lg hover:shadow-xl">
                            Send Feedback
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// Suggest Tool Modal Functions
function openSuggestToolModal() {
    const modal = document.getElementById('suggestToolModal');
    const modalContent = document.getElementById('suggestToolModalContent');
    
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    // Animate modal entrance
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeSuggestToolModal() {
    const modal = document.getElementById('suggestToolModal');
    const modalContent = document.getElementById('suggestToolModalContent');
    
    // Animate modal exit
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        document.getElementById('suggestToolForm').reset();
    }, 300);
}

// Feedback Modal Functions
function openFeedbackModal() {
    const modal = document.getElementById('feedbackModal');
    const modalContent = document.getElementById('feedbackModalContent');
    
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    
    // Animate modal entrance
    setTimeout(() => {
        modalContent.classList.remove('scale-95', 'opacity-0');
        modalContent.classList.add('scale-100', 'opacity-100');
    }, 10);
}

function closeFeedbackModal() {
    const modal = document.getElementById('feedbackModal');
    const modalContent = document.getElementById('feedbackModalContent');
    
    // Animate modal exit
    modalContent.classList.remove('scale-100', 'opacity-100');
    modalContent.classList.add('scale-95', 'opacity-0');
    
    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        document.getElementById('feedbackForm').reset();
    }, 300);
}

// Form Submissions
document.getElementById('suggestToolForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const toolName = document.getElementById('toolName').value;
    const toolDescription = document.getElementById('toolDescription').value;
    const toolCategory = document.getElementById('toolCategory').value;
    const useCase = document.getElementById('useCase').value;
    
    if (!toolName || !toolDescription) {
        alert('Please fill in all required fields.');
        return;
    }
    
    const formData = new FormData();
    formData.append('tool_name', toolName);
    formData.append('description', toolDescription);
    formData.append('category', toolCategory);
    formData.append('use_case', useCase);
    
    try {
        const response = await fetch('{{ route("suggestions.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert(data.message);
            document.getElementById('suggestToolForm').reset();
            closeSuggestToolModal();
        } else {
            alert('Error: ' + (data.message || 'Something went wrong'));
        }
    } catch (error) {
        alert('Error: Unable to submit suggestion. Please try again.');
        console.error('Error:', error);
    }
});

document.getElementById('feedbackForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const feedbackType = document.getElementById('feedbackType').value;
    const toolName = document.getElementById('feedbackSubject').value; // Using subject as tool name
    const rating = document.getElementById('rating').value;
    const message = document.getElementById('feedbackDetails').value;
    
    if (!feedbackType || !message) {
        alert('Please fill in all required fields.');
        return;
    }
    
    const formData = new FormData();
    formData.append('feedback_type', feedbackType);
    formData.append('tool_name', toolName);
    formData.append('rating', rating);
    formData.append('message', message);
    
    try {
        const response = await fetch('{{ route("feedback.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
            },
            body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
            alert(data.message);
            document.getElementById('feedbackForm').reset();
            closeFeedbackModal();
        } else {
            alert('Error: ' + (data.message || 'Something went wrong'));
        }
    } catch (error) {
        alert('Error: Unable to submit feedback. Please try again.');
        console.error('Error:', error);
    }
});

// Close modals when clicking outside
document.getElementById('suggestToolModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeSuggestToolModal();
    }
});

document.getElementById('feedbackModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeFeedbackModal();
    }
});

// Close modals with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeSuggestToolModal();
        closeFeedbackModal();
    }
});
</script>