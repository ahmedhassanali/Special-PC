<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model {
    use HasFactory;

    const
    ACTIVE = 1 ,
    NON_ACTIVE = 0 ,
    ALL_USERS = 1,
    FIRST_TIME_USERS = '0',
    UNLIMITED_USERS=0,
    INACTIVE = 0,
    PERSENTAGE = 2,
    VALUE=1;


    protected $fillable = [
        'code',
        'uses',
        'type',
        'end_at',
        'amount',
        'max',
        'status',
        'notes',
        'for'
    ];

}
