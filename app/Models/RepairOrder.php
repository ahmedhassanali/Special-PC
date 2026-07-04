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
}
