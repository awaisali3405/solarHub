<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;
    protected $table = 'contract';
    protected $fillable = [
        'employee_id',
        'product_id',
        'cost_per_product',
        'date'

    ];
    protected $casts = [
        'date' => 'datetime',
    ];
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');

    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
