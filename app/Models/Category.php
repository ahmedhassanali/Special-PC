<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'en_title',
        'ar_title',
        'en_description',
        'ar_description',
    ];

    public function product() {
        return $this->hasMany( 'App\Models\Product' );
    }

    public function subCategory() {
        return $this->hasMany( 'App\Models\SubCategory' );
    }

    public function scopeWithTranslatedFields($query)
    {
        return $query->select('id', 'image',app()->getLocale()."_title as name", app()->getLocale()."_description as description");
    }
}
