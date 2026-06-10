<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model {
    use HasFactory;

    protected $fillable = [
        'order_id',
        'customer_id',
        'payment_card_id',
        'amount',
        'payment_method',
        'status',
        'payment_status',
        'comment',
        'invoice',
    ];

    protected $with = [
        'order','customer'
    ];

    public function order() {
        return $this->belongsTo( Order::class );
    }

    public function customer() {
        return $this->belongsTo( Customer::class );
    }

    public function paymentCard() {
        return $this->belongsTo( PaymentCard::class );
    }
}
