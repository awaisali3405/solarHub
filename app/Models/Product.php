<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $fillable = [
        'name',
        'category_id',
        'sub_category_id',
        'unit_id',
        'purchase_price',
        'sale_price',
        'img',
        'stock',
        'status',
        'description','watt','created_by'
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
    public function recipe()
    {
        return $this->hasMany(Recipe::class, 'recipe_product_id');
    }
    public function createdBy(){
        return $this->belongsTo(Admin::class,'created_by');

    }
    public function feedback(){
        return $this->hasMany(Feedback::class,'product_id');
    }
    public function avgRating(){
        return $this->feedback->avg('rating');
    }
}
