<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
    ];

    // Helper method to get a setting value by key
    public static function get(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();

        if (! $setting) {
            return $default;
        }

        return match ($setting->type) {
            'boolean' => (bool) $setting->value,
            'json' => json_decode($setting->value, true),
            default => $setting->value,
        };
    }

    // Helper method to set a setting value
    public static function set(string $key, $value, string $type = 'string', string $group = 'general'): void
    {
        $settingValue = match ($type) {
            'boolean' => (int) $value,
            'json' => json_encode($value),
            default => $value,
        };

        static::updateOrCreate(
            ['key' => $key],
            [
                'value' => $settingValue,
                'type' => $type,
                'group' => $group,
            ]
        );
    }
}
