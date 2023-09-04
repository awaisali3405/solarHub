<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;
    protected $table = 'recipe_detail';
    protected $fillable = [
        'recipe_product_id',
        'raw_id',
        'quantity',

    ];
    public function raw()
    {
        return $this->belongsTo(Product::class, 'raw_id');
    }
    public function recipeProduct()
    {
        return $this->belongsTo(Product::class, 'recipe_product_id');
    }

}
