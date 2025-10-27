<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DefaultFoodsItem extends Model
{
    protected $table = 'default_foods_item';

    protected $fillable = [
        'food_id',
        'category_item_id',
        'food_item_id',
    ];

    public function item()
    {
        return $this->belongsTo(FoodItem::class, 'food_item_id');
    }

    public function category()
    {
        return $this->hasOneThrough(
            CategoryItem::class,
            FoodItem::class,
            'id', 
            'id',
            'food_item_id',
            'categories_item_id'
        );
    }
}
