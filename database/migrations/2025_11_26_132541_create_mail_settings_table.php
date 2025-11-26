<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mail_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('string'); // string, boolean, integer
            $table->text('description')->nullable();
            $table->timestamps();
        });

        // Insert default mail settings
        DB::table('mail_settings')->insert([
            [
                'key' => 'mail_mailer',
                'value' => 'smtp',
                'type' => 'string',
                'description' => 'Mail driver (smtp, sendmail, mailgun, etc.)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'mail_host',
                'value' => 'smtp.gmail.com',
                'type' => 'string',
                'description' => 'SMTP server hostname',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'mail_port',
                'value' => '587',
                'type' => 'integer',
                'description' => 'SMTP server port',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'mail_username',
                'value' => '',
                'type' => 'string',
                'description' => 'SMTP username/email',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'mail_password',
                'value' => '',
                'type' => 'string',
                'description' => 'SMTP password/app password',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'mail_encryption',
                'value' => 'tls',
                'type' => 'string',
                'description' => 'Encryption method (tls, ssl, null)',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'mail_from_address',
                'value' => 'noreply@wordfix.com',
                'type' => 'string',
                'description' => 'Default from email address',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'mail_from_name',
                'value' => 'WordFix',
                'type' => 'string',
                'description' => 'Default from name',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'notifications_enabled',
                'value' => 'true',
                'type' => 'boolean',
                'description' => 'Enable email notifications',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mail_settings');
    }
};