<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RepairOrderService extends Model
{
    protected $table = 'maintenance_order_service';

    protected $fillable = ['maintenance_service_id', 'name', 'price'];

    protected $casts = ['price' => 'integer'];

    public function order(): BelongsTo
    {
        return $this->belongsTo(RepairOrder::class, 'repair_order_id');
    }

    public function service(): BelongsTo
    {
        return $this->belongsTo(MaintenanceService::class, 'maintenance_service_id');
    }
}
