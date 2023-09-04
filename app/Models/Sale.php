<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $table = 'sale';
    protected $fillable = [
        'customer_id',
        'discount',
        'gst_tax',
        'wht_tax',
        'paid',
        'status',
        'total'

    ];
    public function product()
    {
        return $this->hasMany(SaleProduct::class, 'sale_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}