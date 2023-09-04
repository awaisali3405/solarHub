<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';
    protected $fillable = [
        'product_id',
        'quantity',
        'description',
        'status_id'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'status_id');
    }
}