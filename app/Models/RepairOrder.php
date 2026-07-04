<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RepairOrder extends Model
{
    protected $fillable = [
        'order_number',
        'tracking_token',
        'type',
        'customer_name',
        'customer_phone',
        'device_name',
        'problem',
        'pc_build',
        'status',
        'delivery_date',
    ];

    protected $casts = [
        'pc_build' => 'array',
    ];

    public function services(): HasMany
    {
        return $this->hasMany(RepairOrderService::class);
    }

    public function extras(): HasMany
    {
        return $this->hasMany(OrderExtra::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(OrderImage::class);
    }

    public function getTotalAttribute(): int
    {
        return (int) $this->services->sum('price')
            + (int) $this->extras->where('status', 'approved')->sum('price');
    }

    public function getTrackingUrlAttribute(): string
    {
        return route('repair.track', $this->tracking_token);
    }

    /**
     * Normalise the customer phone to an international number for wa.me links.
     * Local numbers starting with 0 are prefixed with the configured country code.
     */
    public function getWhatsappNumberAttribute(): string
    {
        $digits = preg_replace('/\D+/', '', (string) $this->customer_phone);

        if (str_starts_with($digits, '0')) {
            $digits = config('maintenance.whatsapp_country_code').substr($digits, 1);
        }

        return $digits;
    }

    /**
     * Build a wa.me deep link that opens WhatsApp to the customer with a
     * pre-filled message. Client-side only — no API is called.
     */
    public function whatsappUrl(string $message): string
    {
        return 'https://wa.me/'.$this->whatsapp_number.'?text='.rawurlencode($message);
    }
}
