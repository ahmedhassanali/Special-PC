<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = [
        'en_name',
        'ar_name',
        'en_description',
        'ar_description',
        'image'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'brand_id', 'id');
    }

    public function scopeWithTranslatedFields($query)
    {
        return $query->select('id', 'image',app()->getLocale()."_name as name", app()->getLocale()."_description as description");
    }
}
