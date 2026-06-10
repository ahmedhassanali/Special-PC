<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'ar_name',
        'en_name',
        'ar_short_name',
        'en_short_name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'color_id', 'id');
    }

    public function scopeWithTranslatedFields($query)
    {
        return $query->select('id',app()->getLocale()."_name as name", app()->getLocale()."_short_name as short_name");
    }
}