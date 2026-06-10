<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    const ACTIVE = 1;

    protected $fillable = [
        'ar_name', 'en_name', 'sub_category_id', 'category_id', 'ar_description', 'unit_id', 'en_description',
        'offer_id', 'tax', 'brand_id', 'color_id', 'rate', 'featured', 'status',
        'cost', 'stock', 'price', 'image', 'free_shipping', 'special_offer', 'weight'
    ];


    public function category(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function offer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }

    public function subCategory(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }

    public function brand(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    public function color(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function unit(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }

    public function feedbacks()
    {
        return $this->hasMany(Feedback::class, 'product_id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id');
    }

    public function getAverageRating()
    {
        return $this->feedbacks->avg('rating');
    }

    public function scopeWithTranslatedFields($query)
    {
        return $query->select(
            'id',
            'image',
            app()->getLocale() . "_name as name",
            app()->getLocale() . "_description as description",
            "tax",
            "rate",
            "status",
            "cost",
            "stock",
            "price",
            "sub_category_id",
            "category_id",
            "unit_id",
            "brand_id",
            "offer_id",
            "special_offer",
            "free_shipping",
        );
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class ,'product_id');
    }
}
