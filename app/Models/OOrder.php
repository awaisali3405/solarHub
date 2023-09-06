<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OOrder extends Model
{
    use HasFactory;
    protected $table = 'o_order';
    protected $fillable = [
        'order_id',
        'customer_id'
    ];
    public function cart()
    {
        return $this->hasMany(Cart::class,'order_id', 'order_id');
    }
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}
