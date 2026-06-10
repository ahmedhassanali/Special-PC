<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'en_title',
        'ar_title',
        'en_description',
        'ar_description',
        'category_id'
    ];

    public function product() {
        return $this->hasMany( 'App\Models\Product' , 'sub_category_id');
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

    public function scopeWithTranslatedFields($query)
    {
        return $query->select('id', 'image','category_id',app()->getLocale()."_title as name", app()->getLocale()."_description as description");
    }
}
