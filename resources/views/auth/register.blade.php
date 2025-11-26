<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register - WordFix</title>
    
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
                    <h2 class="mt-6 text-3xl font-bold text-gray-900">Create account</h2>
                    <p class="mt-2 text-sm text-gray-600">Join WordFix and unlock powerful text tools</p>
                </div>

                <!-- Register Form -->
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full name</label>
                        <input id="name" 
                               name="name" 
                               type="text" 
                               value="{{ old('name') }}" 
                               required 
                               autofocus 
                               autocomplete="name"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('name') border-red-300 @enderror">
                        @error('name')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email address</label>
                        <input id="email" 
                               name="email" 
                               type="email" 
                               value="{{ old('email') }}" 
                               required 
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
                               autocomplete="new-password"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('password') border-red-300 @enderror">
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm password</label>
                        <input id="password_confirmation" 
                               name="password_confirmation" 
                               type="password" 
                               required 
                               autocomplete="new-password"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('password_confirmation') border-red-300 @enderror">
                        @error('password_confirmation')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        Create account
                    </button>

                    <!-- Login Link -->
                    <div class="text-center">
                        <p class="text-sm text-gray-600">
                            Already have an account? 
                            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-500 font-medium">Sign in</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right Side - Benefits Showcase (Hidden on mobile, visible on desktop) -->
        <div class="hidden lg:block relative flex-1 bg-gradient-to-br from-green-50 to-emerald-100">
            <div class="absolute inset-0 flex items-center justify-center p-12">
                <div class="max-w-md text-center" x-data="{ 
                    currentIndex: 0,
                    isTransitioning: false,
                    benefits: [
                        {
                            icon: '🚀',
                            title: 'Boost Productivity',
                            description: 'Save hours of manual work with our automated text processing tools.',
                            stats: '10x faster text processing'
                        },
                        {
                            icon: '🔒',
                            title: 'Privacy First',
                            description: 'Your data is processed locally and never stored on our servers.',
                            stats: '100% privacy guaranteed'
                        },
                        {
                            icon: '🎯',
                            title: 'Professional Results',
                            description: 'Get consistent, professional-quality text formatting every time.',
                            stats: 'Used by 10,000+ professionals'
                        },
                        {
                            icon: '💡',
                            title: 'Smart Automation',
                            description: 'Intelligent algorithms handle complex text transformations automatically.',
                            stats: '50+ powerful tools'
                        },
                        {
                            icon: '🌐',
                            title: 'Always Available',
                            description: 'Access your tools from anywhere, anytime. No downloads required.',
                            stats: '24/7 availability'
                        },
                        {
                            icon: '⚡',
                            title: 'Lightning Fast',
                            description: 'Process large amounts of text in milliseconds with our optimized engine.',
                            stats: 'Process 1M+ characters/sec'
                        }
                    ],
                    nextSlide() {
                        this.isTransitioning = true;
                        setTimeout(() => {
                            this.currentIndex = (this.currentIndex + 1) % this.benefits.length;
                            this.isTransitioning = false;
                        }, 200);
                    }
                }" x-init="setInterval(() => { nextSlide() }, 4500)">
                    
                    <!-- Fixed height container to prevent layout shifts -->
                    <div class="relative h-80 flex items-center justify-center">
                        <template x-for="(benefit, index) in benefits" :key="index">
                            <div x-show="currentIndex === index" 
                                 x-transition:enter="transition ease-out duration-600"
                                 x-transition:enter-start="opacity-0 transform scale-95"
                                 x-transition:enter-end="opacity-100 transform scale-100"
                                 x-transition:leave="transition ease-in duration-400"
                                 x-transition:leave-start="opacity-100 transform scale-100"
                                 x-transition:leave-end="opacity-0 transform scale-95"
                                 class="absolute inset-0 flex flex-col justify-center space-y-6">
                                
                                <div class="text-6xl mb-4" x-text="benefit.icon"></div>
                                <h3 class="text-2xl font-bold text-gray-900 min-h-[2.5rem] flex items-center justify-center" x-text="benefit.title"></h3>
                                <p class="text-gray-600 text-lg leading-relaxed min-h-[6rem] flex items-center justify-center px-4" x-text="benefit.description"></p>
                                <div class="bg-white/50 backdrop-blur-sm rounded-lg p-4 border border-white/20">
                                    <p class="text-sm text-green-600 font-semibold" x-text="benefit.stats"></p>
                                </div>
                            </div>
                        </template>
                    </div>

                    <!-- Dots Indicator -->
                    <div class="flex justify-center space-x-2 mt-8">
                        <template x-for="(benefit, index) in benefits" :key="index">
                            <button @click="currentIndex = index"
                                    class="w-2 h-2 rounded-full transition-colors"
                                    :class="currentIndex === index ? 'bg-green-600' : 'bg-gray-300'"></button>
                        </template>
                    </div>

                    <div class="mt-8 text-center">
                        <p class="text-sm text-gray-500 mb-4">What our users say</p>
                        <div class="bg-white/60 backdrop-blur-sm rounded-lg p-4 border border-white/30">
                            <p class="text-sm text-gray-700 italic">"WordFix has completely transformed how I handle text processing. It's incredibly fast and reliable!"</p>
                            <p class="text-xs text-gray-500 mt-2">- Sarah, Content Manager</p>
                        </div>
                    </div>

                    <div class="mt-6 flex justify-center items-center space-x-6">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">50+</div>
                            <div class="text-xs text-gray-500">Tools</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">10K+</div>
                            <div class="text-xs text-gray-500">Users</div>
                        </div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-gray-900">99.9%</div>
                            <div class="text-xs text-gray-500">Uptime</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>