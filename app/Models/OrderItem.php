<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','product_id','quantity'];

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }

    public function product(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Product::class,'product_id');
    }

    public function itemPrice()
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
