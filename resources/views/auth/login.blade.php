<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - WordFix</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex">
        <!-- Left Side - Form (Mobile: Full width, Desktop: Half width) -->
        <div class="flex-1 flex flex-col justify-center px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
            <div class="mx-auto w-full max-w-sm lg:w-96">
                <!-- Logo -->
                <div class="text-center mb-8">
                    <a href="/" class="inline-block">
                        <img src="{{ asset('images/logo.png') }}" alt="WordFix" class="h-16 mx-auto">
                    </a>
                    <h2 class="mt-6 text-3xl font-bold text-gray-900">Welcome back</h2>
                    <p class="mt-2 text-sm text-gray-600">Sign in to access your WordFix tools</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <p class="text-sm text-green-600">{{ session('status') }}</p>
                    </div>
                @endif

                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email address</label>
                        <input id="email" 
                               name="email" 
                               type="email" 
                               value="{{ old('email') }}" 
                               required 
                               autofocus 
                               autocomplete="username"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('email') border-red-300 @enderror">
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                        <input id="password" 
                               name="password" 
                               type="password" 
                               required 
                               autocomplete="current-password"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('password') border-red-300 @enderror">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" 
                                   name="remember" 
                                   type="checkbox" 
                                   class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-700">Remember me</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-500">
                                Forgot password?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        Sign in
                    </button>

                    <!-- Register Link -->
                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            Don't have an account? 
                            <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-500 font-medium">Sign up</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Side - Tool Showcase (Hidden on mobile, visible on desktop) -->
        <div class="hidden lg:block relative flex-1 bg-gradient-to-br from-blue-50 to-indigo-100">
            <div class="absolute inset-0 flex items-center justify-center p-12">
                <div class="max-w-md text-center" x-data="{ 
                    currentIndex: 0,
                    isTransitioning: false,
                    tools: [
                        {
                            icon: '🔤',
                            title: 'Text Case Converter',
                            description: 'Transform text between uppercase, lowercase, title case, and more with one click.',
                            example: 'hello world → HELLO WORLD'
                        },
                        {
                            icon: '📊',
                            title: 'Word & Character Counter',
                            description: 'Get instant counts of words, characters, paragraphs, and reading time.',
                            example: 'Analyze any text instantly'
                        },
                        {
                            icon: '🎨',
                            title: 'Text Formatter',
                            description: 'Beautify HTML, CSS, JavaScript, JSON, and SQL code with proper formatting.',
                            example: 'Messy code → Clean & readable'
                        },
                        {
                            icon: '🔍',
                            title: 'Extract & Remove',
                            description: 'Extract emails, URLs, numbers, or remove unwanted characters from text.',
                            example: 'Find patterns in seconds'
                        },
                        {
                            icon: '🎲',
                            title: 'Random Generators',
                            description: 'Generate passwords, Lorem ipsum, colors, dates, and more random data.',
                            example: 'Create test data instantly'
                        },
                        {
                            icon: '✨',
                            title: 'Special Effects',
                            description: 'Apply cool text effects like bold, italic, circled, or upside-down text.',
                            example: 'Make your text stand out'
                        }
                    ],
                    nextSlide() {
                        this.isTransitioning = true;
                        setTimeout(() => {
                            this.currentIndex = (this.currentIndex + 1) % this.tools.length;
                            this.isTransitioning = false;
                        }, 200);
                    }
                }" x-init="setInterval(() => { nextSlide() }, 4000)">
                    
                    <!-- Fixed height container to prevent layout shifts -->
                    <div class="relative h-80 flex items-center justify-center">
                        <template x-for="(tool, index) in tools" :key="index">
                            <div x-show="currentIndex === index" 
                                 x-transition:enter="transition ease-out duration-600"
                                 x-transition:enter-start="opacity-0 transform scale-95"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 x-transition:leave="transition ease-in duration-400"
                                 x-transition:leave-start="opacity-100 transform scale-100"
                                 x-transition:leave-end="opacity-0 transform scale-95"
                                 class="absolute inset-0 flex flex-col justify-center space-y-6">
                                
                                <div class="text-6xl mb-4" x-text="tool.icon"></div>
                                <h3 class="text-2xl font-bold text-gray-900 min-h-[2.5rem] flex items-center justify-center" x-text="tool.title"></h3>
                                <p class="text-gray-600 text-lg leading-relaxed min-h-[6rem] flex items-center justify-center px-4" x-text="tool.description"></p>
                                <div class="bg-white/50 backdrop-blur-sm rounded-lg p-4 border border-white/20">
                                    <p class="text-sm text-gray-500 font-mono" x-text="tool.example"></p>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Dots Indicator -->
                    <div class="flex justify-center space-x-2 mt-8">
                        <template x-for="(tool, index) in tools" :key="index">
                            <button @click="currentIndex = index"
                                    class="w-2 h-2 rounded-full transition-colors"
                                    :class="currentIndex === index ? 'bg-blue-600' : 'bg-gray-300'"></button>
                        </template>
                    </div>

                    <div class="mt-8 text-center">
                        <p class="text-sm text-gray-500">Join thousands of users who trust WordFix</p>
                        <div class="flex justify-center items-center space-x-4 mt-4">
                            <div class="flex -space-x-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-blue-600 rounded-full border-2 border-white"></div>
                                <div class="w-8 h-8 bg-gradient-to-r from-green-400 to-green-600 rounded-full border-2 border-white"></div>
                                <div class="w-8 h-8 bg-gradient-to-r from-purple-400 to-purple-600 rounded-full border-2 border-white"></div>
                                <div class="w-8 h-8 bg-gradient-to-r from-pink-400 to-pink-600 rounded-full border-2 border-white"></div>
                            </div>
                            <span class="text-sm text-gray-600 font-medium">10,000+ happy users</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>