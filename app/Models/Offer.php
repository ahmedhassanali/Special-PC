<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    const PERSENTAGE = 2 , VALUE=1;
    use HasFactory;
    protected $fillable = [
        'en_name',
        'ar_name',
        'type',
        'amount',
        'start_date',
        'end_date',
        'ar_description',
        'en_description'
    ];

    public function scopeWithTranslatedFields($query)
    {
        return $query->select('id', 'type',app()->getLocale()."_name as name", app()->getLocale()."_description as description" , 'amount' ,'start_date','end_date');
    }
}
