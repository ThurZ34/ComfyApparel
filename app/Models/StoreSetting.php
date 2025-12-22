<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class StoreSetting extends Model
{
    protected $fillable = [
        'store_name',
        'logo',
        'whatsapp',
        'address',
    ];

    /**
     * Get the full URL for the logo.
     */
    public function getLogoUrl(): ?string
    {
        if ($this->logo) {
            return Storage::url($this->logo);
        }

        return null;
    }

    /**
     * Get the store settings (cached for performance).
     */
    public static function getSetting(): self
    {
        return Cache::remember('store_settings', 3600, function () {
            return self::first() ?? new self([
                'store_name' => 'ComfyApparel',
            ]);
        });
    }

    /**
     * Clear the cache when settings are updated.
     */
    public static function clearCache(): void
    {
        Cache::forget('store_settings');
    }
}
