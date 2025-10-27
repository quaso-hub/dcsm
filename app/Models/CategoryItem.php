<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryItem extends Model
{
    use HasFactory;

    protected $table = 'categories_item';

    protected $fillable = [
        'name',
        'description',
        'selection_type',
        'builder_tags',
    ];

    protected $casts = [
        'builder_tags' => 'array',
    ];
    public function foods()
    {
        return $this->belongsToMany(Food::class, 'foods_categories_list');
    }

    public function foodItems()
    {
        return $this->hasMany(FoodItem::class, 'category_item_id');
    }
}
