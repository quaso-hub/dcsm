<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';

    protected $fillable = [
        'category_food_id',
        'name',
        'description',
        'base_price',
        'image_path',
        'nutrition_info',
        'is_active',
    ];

    public function categoriesItem()
    {
        return $this->belongsToMany(CategoryItem::class, 'foods_categories_list');
    }

    public function items()
    {
        return $this->hasMany(FoodItem::class);
    }

    public function defaultItems()
    {
        return $this->hasMany(DefaultFoodsItem::class, 'food_id');
    }



    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function categoryFood()
    {
        return $this->belongsTo(CategoryFood::class);
    }
}
