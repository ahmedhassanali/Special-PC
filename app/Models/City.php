<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'en_name',
        'ar_name',
    ];


    public function area() {
        return $this->hasMany( 'App\Models\Area' );
    }

    public function scopeWithTranslatedFields($query)
    {
        return $query->select('id',app()->getLocale()."_name as name");
    }
}
