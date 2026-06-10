<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'cart_id',
        'product_id',
        'quantity',
        'referrer_id',
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function cartItemPrice()
    {

        $price = $this->product->offer
            ? ($this->product->offer->type == Offer::VALUE
                ? ($this->product->price - $this->product->offer->amount) *
                    $this->quantity
                : ($this->product->price -
                        ($this->product->offer->amount * $this->product->price) / 100) *
                    $this->quantity)
            : $this->product->price * $this->quantity;

        return $price;
    }
}
