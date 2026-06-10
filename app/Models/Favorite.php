<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable = [
        'status',
        'product_id',
        'customer_id',
    ];

    public function product() {
        return $this->belongsTo( 'App\Models\Product' );
    }

    public function customer() {
        return $this->belongsTo( 'App\Models\Customer' );
    }
}
