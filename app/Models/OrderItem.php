<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getSubtotalAttribute()
    {
        return $this->quantity * $this->price;
    }

    public function getPriceFormattedAttribute()
    {
        return number_format($this->price, 2, ',', ' ') . ' F CFA';
    }

    public function getSubtotalFormattedAttribute()
    {
        return number_format($this->subtotal, 2, ',', ' ') . ' F CFA';
    }
}
