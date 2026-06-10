<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $fillable = [
        'en_name',
        'ar_name',
        'delivery_fees',
        'city_id',
    ];

    public function scopeWithTranslatedFields($query)
    {
        return $query->select('id','delivery_fees','city_id',app()->getLocale()."_name as name");
    }
}
