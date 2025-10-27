<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryFood extends Model
{
    use HasFactory;

    protected $table = 'categories_food';

    protected $fillable = [
        'name',
        'description',
    ];

    public function foods()
    {
        return $this->hasMany(Food::class, 'category_food_id');
    }
}
