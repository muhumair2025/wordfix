<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Verify Email - WordFix</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased bg-gray-50">
    <div class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8">
            <!-- Logo -->
            <div class="text-center">
                <a href="/" class="inline-block">
                    <img src="{{ asset('images/logo.png') }}" alt="WordFix" class="h-16 mx-auto">
                </a>
                <h2 class="mt-6 text-3xl font-bold text-gray-900">Verify Email</h2>
                <p class="mt-2 text-sm text-gray-600">
                    Thanks for signing up! Please verify your email address to continue.
                </p>
            </div>

            <!-- Email Icon -->
            <div class="flex justify-center">
                <div class="bg-yellow-100 rounded-full p-4">
                    <svg class="h-8 w-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                </div>
            </div>

            <!-- Status Message -->
            @if (session('status') == 'verification-link-sent')
                <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-600">
                                A new verification link has been sent to your email address!
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Instructions -->
            <div class="bg-blue-50 rounded-lg p-6 border border-blue-100">
                <h3 class="text-lg font-medium text-blue-900 mb-3">Check your email</h3>
                <p class="text-sm text-blue-700 mb-4">
                    We've sent a verification link to your email address. Click the link in the email to verify your account.
                </p>
                <div class="flex items-center space-x-2 text-sm text-blue-600">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>This usually takes just a few minutes</span>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="space-y-4">
                <!-- Resend Button -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" 
                            class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        Resend Verification Email
                    </button>
                </form>

                <!-- Logout Button -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" 
                            class="w-full bg-gray-100 text-gray-700 py-3 px-4 rounded-lg font-medium hover:bg-gray-200 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                        Log Out
                    </button>
                </form>
            </div>

            <!-- Help Section -->
            <div class="mt-8 text-center">
                <div class="bg-gray-50 rounded-lg p-4 border border-gray-200">
                    <div class="flex items-center justify-center mb-2">
                        <svg class="h-5 w-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <p class="text-sm text-gray-600">
                        <strong>Didn't receive the email?</strong><br>
                        Check your spam folder or click "Resend" to try again.
                    </p>
                </div>
            </div>

            <!-- Stats -->
            <div class="flex justify-center items-center space-x-6 pt-4">
                <div class="text-center">
                    <div class="text-lg font-bold text-gray-900">🔒</div>
                    <div class="text-xs text-gray-500">Secure</div>
                </div>
                <div class="text-center">
                    <div class="text-lg font-bold text-gray-900">⚡</div>
                    <div class="text-xs text-gray-500">Fast</div>
                </div>
                <div class="text-center">
                    <div class="text-lg font-bold text-gray-900">✨</div>
                    <div class="text-xs text-gray-500">Easy</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>