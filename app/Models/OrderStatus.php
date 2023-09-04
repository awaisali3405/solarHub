<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;
    protected $table = 'order_status';
    protected $fillable = [
        'name'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}