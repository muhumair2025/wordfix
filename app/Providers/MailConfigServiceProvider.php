<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use App\Models\MailSetting;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Load mail configuration from database on every request
        try {
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
        } catch (\Exception $e) {
            // If database is not available or table doesn't exist, use default config
            \Log::warning('Could not load mail settings from database: ' . $e->getMessage());
        }
    }
}
