<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;
    protected $table = 'feedback';
    protected $fillable = [
        'rating',
        'feedback',
        'order_id',
        'user_id',
        'product_id'
    ];
public function product(){
    return $this->belongsTo(Product::class,'product_id');
}
public function order(){
    return $this->belongsTo(Cart::class,'order_id');
}
public function user(){
    return $this->belongsTo(User::class,'user_id');
}
}

