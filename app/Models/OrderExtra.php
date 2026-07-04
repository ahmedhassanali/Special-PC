<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderExtra extends Model
{
    protected $fillable = ['name', 'price', 'note', 'status', 'decided_at'];

    protected $casts = [
        'price' => 'integer',
        'decided_at' => 'datetime',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(RepairOrder::class, 'repair_order_id');
    }
}
