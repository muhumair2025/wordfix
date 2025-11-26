<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailSetting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'description',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get a setting value by key.
     */
    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        
        if (!$setting) {
            return $default;
        }

        return static::castValue($setting->value, $setting->type);
    }

    /**
     * Set a setting value by key.
     */
    public static function set($key, $value, $type = 'string')
    {
        return static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $value,
                'type' => $type,
            ]
        );
    }

    /**
     * Get all settings as key-value pairs.
     */
    public static function getAllAsKeyValue()
    {
        return static::query()->get()->mapWithKeys(function ($setting) {
            return [$setting->key => static::castValue($setting->value, $setting->type)];
        });
    }

    /**
     * Cast value to appropriate type.
     */
    protected static function castValue($value, $type)
    {
        switch ($type) {
            case 'boolean':
                return filter_var($value, FILTER_VALIDATE_BOOLEAN);
            case 'integer':
                return (int) $value;
            case 'float':
                return (float) $value;
            default:
                return $value;
        }
    }

    /**
     * Apply mail settings to Laravel config.
     */
    public static function applyToConfig()
    {
        $settings = static::getAllAsKeyValue();

        if ($settings->isNotEmpty()) {
            config([
                'mail.default' => $settings['mail_mailer'] ?? 'smtp',
                'mail.mailers.smtp.host' => $settings['mail_host'] ?? 'localhost',
                'mail.mailers.smtp.port' => $settings['mail_port'] ?? 587,
                'mail.mailers.smtp.username' => $settings['mail_username'] ?? '',
                'mail.mailers.smtp.password' => $settings['mail_password'] ?? '',
                'mail.mailers.smtp.encryption' => $settings['mail_encryption'] ?? 'tls',
                'mail.from.address' => $settings['mail_from_address'] ?? 'noreply@wordfix.com',
                'mail.from.name' => $settings['mail_from_name'] ?? 'WordFix',
            ]);
        }
    }
}