<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function product_varients()
    {
        return $this->hasMany(ProductVarient::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function order_items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
