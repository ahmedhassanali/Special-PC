<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class MaintenanceService extends Model
{
    protected $fillable = ['name', 'price', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
        'price' => 'integer',
    ];

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(RepairOrder::class, 'maintenance_order_service')
            ->withPivot(['name', 'price'])
            ->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
