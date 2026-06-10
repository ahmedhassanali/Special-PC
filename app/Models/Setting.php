<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model {
    use HasFactory;

    protected $fillable = [
        'image',
        'ar_title',
        'en_title',
        'x',
        'instagram',
        'facebook',
        'tiktok',
        'whatsapp',
        'website',
        'email',
        'phone',
        'ar_about_us',
        'en_about_us',
        'tax',
        'snapchat',
        'ar_terms_conditions',
        'en_terms_conditions',
        'service_fee',
        'server_key',
        'app_store_link',
        'google_play_link',
        'coupon_id',
        'offer_id',
    ];


    public function scopeWithTranslatedFields($query)
    {
        return $query->select('image',app()->getLocale()."_title as title", app()->getLocale()."_about_us as about_us", app()->getLocale()."_terms_conditions as terms_conditions"
        ,"x","instagram","facebook","tiktok","whatsapp","website","email","phone","snapchat","app_store_link","google_play_link");
    }

    public function offer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }

    public function coupon(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Coupon::class, 'coupon_id');
    }

}
