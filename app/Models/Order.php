<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const PREORDERED = 0;
    const ORDERED    = 1;
    const PROCESSING = 2;
    const SHIPPING   = 3;
    const DELIVERED  = 4;
    const FINISHED   = 5;
    const CANCELLED  = 6;
    const RETURNED   = 7;
    const RUNNING    = 8; // Captain -> !CANCELLED && !DELIVERED  or  Customer -> !CANCELLED && !FINISHED
    const COMPLETED  = 9; // CANCELLED && DELIVERED

    protected $fillable = ['user_id','customer_id','customer_address_id','shipping_fees','total' ,'status','captain_delivery_time','customer_receiving_time','captain_id', 'paid','marketer_id'];

    public function items(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function customer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function address(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(CustomerAddress::class, 'customer_address_id');
    }

    public function payment(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Payment::class);
    }
    
    public function marketer()
    {
        return $this->belongsTo(Marketer::class);
    }
}
