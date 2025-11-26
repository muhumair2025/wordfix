<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MailSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class MailSettingController extends Controller
{
    /**
     * Display the mail settings form.
     */
    public function index()
    {
        $settings = MailSetting::pluck('value', 'key')->toArray();
        return view('admin.mail-settings', compact('settings'));
    }

    /**
     * Update the mail settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'mail_mailer' => 'required|string|in:smtp,sendmail,mailgun',
            'mail_host' => 'required_if:mail_mailer,smtp|string|max:255',
            'mail_port' => 'required_if:mail_mailer,smtp|integer|min:1|max:65535',
            'mail_username' => 'required_if:mail_mailer,smtp|string|max:255',
            'mail_password' => 'required_if:mail_mailer,smtp|string|max:255',
            'mail_encryption' => 'nullable|string|in:tls,ssl',
            'mail_from_address' => 'required|email|max:255',
            'mail_from_name' => 'required|string|max:255',
            'send_confirmation_emails' => 'boolean',
            'send_status_update_emails' => 'boolean',
        ]);

        $settings = [
            'mail_mailer' => $request->mail_mailer,
            'mail_host' => $request->mail_host,
            'mail_port' => $request->mail_port,
            'mail_username' => $request->mail_username,
            'mail_password' => $request->mail_password,
            'mail_encryption' => $request->mail_encryption,
            'mail_from_address' => $request->mail_from_address,
            'mail_from_name' => $request->mail_from_name,
            'send_confirmation_emails' => $request->boolean('send_confirmation_emails'),
            'send_status_update_emails' => $request->boolean('send_status_update_emails'),
        ];

        // Save to database
        foreach ($settings as $key => $value) {
            MailSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        // Update .env file for consistency
        $this->updateEnvFile($settings);

        // Update runtime mail configuration
        $this->updateMailConfig();

        return redirect()->route('admin.mail-settings')
            ->with('success', 'Mail settings updated successfully in both database and .env file!');
    }

    /**
     * Send a test email.
     */
    public function sendTestEmail(Request $request)
    {
        try {
            // Log the request for debugging
            \Log::info('Test email request received', [
                'email' => $request->input('email'),
                'user_id' => Auth::id()
            ]);

            // Validate email
            $request->validate([
                'email' => 'required|email'
            ]);
            
            // Update mail config before sending test
            $this->updateMailConfig();
            
            $email = $request->input('email');
            
            // Log current mail configuration for debugging
            \Log::info('Current mail config', [
                'mailer' => config('mail.default'),
                'host' => config('mail.mailers.smtp.host'),
                'port' => config('mail.mailers.smtp.port'),
                'username' => config('mail.mailers.smtp.username'),
                'encryption' => config('mail.mailers.smtp.encryption'),
                'from_address' => config('mail.from.address'),
                'from_name' => config('mail.from.name')
            ]);
            
            Mail::raw('This is a test email from WordFix. If you received this, your mail configuration is working correctly!', function ($message) use ($email) {
                $message->to($email)
                        ->subject('WordFix - Test Email Configuration');
            });

            \Log::info('Test email sent successfully', ['email' => $email]);

            return response()->json([
                'success' => true, 
                'message' => 'Test email sent successfully to ' . $email
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation error in test email', [
                'errors' => $e->errors(),
                'email' => $request->input('email')
            ]);
            
            return response()->json([
                'success' => false, 
                'message' => 'Validation error: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
        } catch (\Exception $e) {
            \Log::error('Failed to send test email', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'email' => $request->input('email')
            ]);
            
            return response()->json([
                'success' => false, 
                'message' => 'Failed to send test email: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update Laravel's mail configuration from database settings.
     */
    private function updateMailConfig()
    {
        $settings = MailSetting::pluck('value', 'key')->toArray();

        if (!empty($settings)) {
            Config::set('mail.default', $settings['mail_mailer'] ?? 'smtp');
            Config::set('mail.mailers.smtp.host', $settings['mail_host'] ?? '');
            Config::set('mail.mailers.smtp.port', $settings['mail_port'] ?? 587);
            Config::set('mail.mailers.smtp.username', $settings['mail_username'] ?? '');
            Config::set('mail.mailers.smtp.password', $settings['mail_password'] ?? '');
            Config::set('mail.mailers.smtp.encryption', $settings['mail_encryption'] ?? 'tls');
            Config::set('mail.from.address', $settings['mail_from_address'] ?? 'noreply@wordfix.com');
            Config::set('mail.from.name', $settings['mail_from_name'] ?? 'WordFix');
        }
    }

    /**
     * Update .env file with mail settings for consistency.
     */
    private function updateEnvFile($settings)
    {
        $envPath = base_path('.env');
        
        if (!file_exists($envPath)) {
            \Log::warning('.env file not found, skipping .env update');
            return;
        }

        try {
            $envContent = file_get_contents($envPath);
            
            // Map database keys to .env keys
            $envMappings = [
                'mail_mailer' => 'MAIL_MAILER',
                'mail_host' => 'MAIL_HOST',
                'mail_port' => 'MAIL_PORT',
                'mail_username' => 'MAIL_USERNAME',
                'mail_password' => 'MAIL_PASSWORD',
                'mail_encryption' => 'MAIL_ENCRYPTION',
                'mail_from_address' => 'MAIL_FROM_ADDRESS',
                'mail_from_name' => 'MAIL_FROM_NAME',
            ];

            foreach ($envMappings as $dbKey => $envKey) {
                if (isset($settings[$dbKey])) {
                    $value = $settings[$dbKey];
                    
                    // Escape special characters and wrap in quotes if needed
                    if (is_string($value) && (strpos($value, ' ') !== false || strpos($value, '@') !== false)) {
                        $value = '"' . addslashes($value) . '"';
                    }
                    
                    // Check if the key already exists in .env
                    if (preg_match("/^{$envKey}=.*$/m", $envContent)) {
                        // Update existing key
                        $envContent = preg_replace("/^{$envKey}=.*$/m", "{$envKey}={$value}", $envContent);
                    } else {
                        // Add new key at the end
                        $envContent .= "\n{$envKey}={$value}";
                    }
                }
            }

            // Write back to .env file
            file_put_contents($envPath, $envContent);
            
            \Log::info('Successfully updated .env file with mail settings');
            
        } catch (\Exception $e) {
            \Log::error('Failed to update .env file: ' . $e->getMessage());
        }
    }
}