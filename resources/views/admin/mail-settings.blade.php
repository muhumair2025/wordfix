@extends('admin.layout')

@section('title', 'Mail Settings - Admin Panel')

@section('content')
<div class="mb-8">
    <h1 class="text-3xl font-bold text-gray-900">Mail Settings</h1>
    <p class="text-gray-600 mt-2">Configure SMTP settings for sending emails from WordFix</p>
</div>

<div class="bg-white rounded-lg shadow-sm border border-gray-200">
    <div class="p-6 border-b border-gray-200">
        <h2 class="text-lg font-semibold text-gray-900">Email Configuration</h2>
    </div>

    <form action="{{ route('admin.mail-settings.update') }}" method="POST" class="p-6">
        @csrf
        @method('PUT')

        <!-- Test Email Section -->
        <div class="mb-8 p-4 bg-blue-50 rounded-lg border border-blue-200">
            <div class="mb-4">
                <h3 class="text-sm font-medium text-blue-900">Test Email Configuration</h3>
                <p class="text-sm text-blue-700 mt-1">Send a test email to verify your settings</p>
            </div>
            <div class="flex items-end gap-3">
                <div class="flex-1">
                    <label for="testEmail" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" id="testEmail" name="test_email" 
                           value="{{ Auth::user()->email }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm"
                           placeholder="Enter email address to send test email">
                </div>
                <div class="flex-shrink-0">
                    <button type="button" id="sendTestEmail" class="px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed">
                        Send Test Email
                    </button>
                </div>
            </div>
        </div>

        <!-- SMTP Configuration -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Mail Driver -->
            <div>
                <label for="mail_mailer" class="block text-sm font-medium text-gray-700 mb-2">Mail Driver</label>
                <select name="mail_mailer" id="mail_mailer" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="smtp" {{ old('mail_mailer', $settings['mail_mailer'] ?? 'smtp') === 'smtp' ? 'selected' : '' }}>SMTP</option>
                    <option value="sendmail" {{ old('mail_mailer', $settings['mail_mailer'] ?? '') === 'sendmail' ? 'selected' : '' }}>Sendmail</option>
                    <option value="mailgun" {{ old('mail_mailer', $settings['mail_mailer'] ?? '') === 'mailgun' ? 'selected' : '' }}>Mailgun</option>
                </select>
                @error('mail_mailer')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- SMTP Host -->
            <div>
                <label for="mail_host" class="block text-sm font-medium text-gray-700 mb-2">SMTP Host</label>
                <input type="text" name="mail_host" id="mail_host" value="{{ old('mail_host', $settings['mail_host'] ?? '') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="smtp.gmail.com">
                @error('mail_host')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- SMTP Port -->
            <div>
                <label for="mail_port" class="block text-sm font-medium text-gray-700 mb-2">SMTP Port</label>
                <input type="number" name="mail_port" id="mail_port" value="{{ old('mail_port', $settings['mail_port'] ?? '587') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="587">
                @error('mail_port')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- SMTP Username -->
            <div>
                <label for="mail_username" class="block text-sm font-medium text-gray-700 mb-2">SMTP Username</label>
                <input type="text" name="mail_username" id="mail_username" value="{{ old('mail_username', $settings['mail_username'] ?? '') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="your-email@gmail.com">
                @error('mail_username')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- SMTP Password -->
            <div>
                <label for="mail_password" class="block text-sm font-medium text-gray-700 mb-2">SMTP Password</label>
                <input type="password" name="mail_password" id="mail_password" value="{{ old('mail_password', $settings['mail_password'] ?? '') }}" 
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                       placeholder="Enter password or app password">
                @error('mail_password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- SMTP Encryption -->
            <div>
                <label for="mail_encryption" class="block text-sm font-medium text-gray-700 mb-2">Encryption</label>
                <select name="mail_encryption" id="mail_encryption" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="tls" {{ old('mail_encryption', $settings['mail_encryption'] ?? 'tls') === 'tls' ? 'selected' : '' }}>TLS</option>
                    <option value="ssl" {{ old('mail_encryption', $settings['mail_encryption'] ?? '') === 'ssl' ? 'selected' : '' }}>SSL</option>
                    <option value="" {{ old('mail_encryption', $settings['mail_encryption'] ?? '') === '' ? 'selected' : '' }}>None</option>
                </select>
                @error('mail_encryption')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- From Address Configuration -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <h3 class="text-lg font-medium text-gray-900 mb-4">From Address Configuration</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- From Address -->
                <div>
                    <label for="mail_from_address" class="block text-sm font-medium text-gray-700 mb-2">From Email Address</label>
                    <input type="email" name="mail_from_address" id="mail_from_address" value="{{ old('mail_from_address', $settings['mail_from_address'] ?? '') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="noreply@wordfix.com">
                    @error('mail_from_address')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- From Name -->
                <div>
                    <label for="mail_from_name" class="block text-sm font-medium text-gray-700 mb-2">From Name</label>
                    <input type="text" name="mail_from_name" id="mail_from_name" value="{{ old('mail_from_name', $settings['mail_from_name'] ?? 'WordFix') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                           placeholder="WordFix">
                    @error('mail_from_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Email Notifications Settings -->
        <div class="mt-8 pt-6 border-t border-gray-200">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Email Notifications</h3>
            <div class="space-y-4">
                <div class="flex items-center">
                    <input type="checkbox" name="send_confirmation_emails" id="send_confirmation_emails" value="1" 
                           {{ old('send_confirmation_emails', $settings['send_confirmation_emails'] ?? true) ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="send_confirmation_emails" class="ml-2 block text-sm text-gray-900">
                        Send confirmation emails when users submit feedback or suggestions
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" name="send_status_update_emails" id="send_status_update_emails" value="1" 
                           {{ old('send_status_update_emails', $settings['send_status_update_emails'] ?? true) ? 'checked' : '' }}
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded">
                    <label for="send_status_update_emails" class="ml-2 block text-sm text-gray-900">
                        Send emails when feedback or suggestion status is updated
                    </label>
                </div>
            </div>
        </div>

        <!-- Save Button -->
        <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end">
            <button type="submit" class="px-6 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Save Mail Settings
            </button>
        </div>
    </form>
</div>

<!-- Common SMTP Providers Help -->
<div class="mt-6 bg-gray-50 rounded-lg p-6">
    <h3 class="text-lg font-medium text-gray-900 mb-4">Common SMTP Providers</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <!-- Gmail -->
        <div class="bg-white p-4 rounded-md border border-gray-200">
            <h4 class="font-medium text-gray-900 mb-2">Gmail</h4>
            <div class="text-sm text-gray-600 space-y-1">
                <p><strong>Host:</strong> smtp.gmail.com</p>
                <p><strong>Port:</strong> 587</p>
                <p><strong>Encryption:</strong> TLS</p>
                <p class="text-xs text-blue-600 mt-2">Note: Use App Password for 2FA accounts</p>
            </div>
        </div>

        <!-- Outlook -->
        <div class="bg-white p-4 rounded-md border border-gray-200">
            <h4 class="font-medium text-gray-900 mb-2">Outlook/Hotmail</h4>
            <div class="text-sm text-gray-600 space-y-1">
                <p><strong>Host:</strong> smtp-mail.outlook.com</p>
                <p><strong>Port:</strong> 587</p>
                <p><strong>Encryption:</strong> TLS</p>
            </div>
        </div>

        <!-- Yahoo -->
        <div class="bg-white p-4 rounded-md border border-gray-200">
            <h4 class="font-medium text-gray-900 mb-2">Yahoo Mail</h4>
            <div class="text-sm text-gray-600 space-y-1">
                <p><strong>Host:</strong> smtp.mail.yahoo.com</p>
                <p><strong>Port:</strong> 587</p>
                <p><strong>Encryption:</strong> TLS</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const button = document.getElementById('sendTestEmail');
    
    if (!button) {
        console.error('Send test email button not found!');
        return;
    }
    
    console.log('Test email button found, adding event listener');
    
    button.addEventListener('click', function() {
        console.log('Test email button clicked!');
        const originalText = this.textContent;
        const emailInput = document.getElementById('testEmail');
        const email = emailInput.value.trim();
        
        // Validate email
        if (!email) {
            alert('Please enter an email address');
            return;
        }
        
        if (!email.includes('@')) {
            alert('Please enter a valid email address');
            return;
        }
        
        this.textContent = 'Sending...';
        this.disabled = true;
        
        console.log('Sending test email to:', email);
        
        // Get CSRF token
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (!csrfToken) {
            console.error('CSRF token not found!');
            alert('CSRF token not found. Please refresh the page.');
            this.textContent = originalText;
            this.disabled = false;
            return;
        }
        
        const token = csrfToken.getAttribute('content');
        const url = '{{ route("admin.mail-settings.test") }}';
        
        console.log('Route URL:', url);
        console.log('CSRF Token:', token ? 'Found' : 'Not found');
        
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token,
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                email: email
            })
        })
        .then(response => {
            console.log('Response status:', response.status);
            console.log('Response headers:', response.headers);
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            return response.json();
        })
        .then(data => {
            console.log('Response data:', data);
            if (data.success) {
                alert('Test email sent successfully to ' + email + '!');
            } else {
                alert('Failed to send test email: ' + (data.message || 'Unknown error'));
                console.error('Server error:', data);
            }
        })
        .catch(error => {
            console.error('Fetch error:', error);
            alert('Error sending test email: ' + error.message);
        })
        .finally(() => {
            this.textContent = originalText;
            this.disabled = false;
        });
    });
});
</script>
@endpush
