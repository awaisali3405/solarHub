<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $table = 'purchase';
    protected $fillable = [
        'supplier_id',
        'discount',
        'gst_tax',
        'wht_tax',
        'total',
        'paid',
        'status',

    ];
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }
    public function product()
    {
        return $this->hasMany(PurchaseProduct::class, 'purchase_id');
    }


}