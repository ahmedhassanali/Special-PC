<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentCard  extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'name',
        'card_number',
        'expire_date',
        'cvv',
        'default',
        'status'
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
