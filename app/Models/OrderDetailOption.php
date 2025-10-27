<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetailOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_detail_id',
        'food_item_id',
    ];

    public function orderDetail()
    {
        return $this->belongsTo(OrderDetail::class);
    }

    public function foodItem()
    {
        return $this->belongsTo(FoodItem::class);
    }
}
