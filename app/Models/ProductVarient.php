<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductVarient extends Model
{
    protected $casts = [
        "images" => "array"
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function discounted_price()
    {
        return $this->price - ($this->price * $this->product->discount / 100);
    }
}
