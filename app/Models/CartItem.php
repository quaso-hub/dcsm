<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'user_id',
        'food_id',
        'quantity',
        'base_price',
        'addons_total_price',
        'customizations',
    ];
    protected $casts = [
        'customizations' => 'array',
    ];
    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
