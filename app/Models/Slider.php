<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'en_title',
        'ar_title',
        'en_description',
        'ar_description',
        'product_id',
        'status',
    ];

    public function product() {
        return $this->belongsTo( 'App\Models\Product' );
    }

    public function scopeWithTranslatedFields($query)
    {
        return $query->select('id', 'image','status','product_id',app()->getLocale()."_title as title", app()->getLocale()."_description as description");
    }
}
