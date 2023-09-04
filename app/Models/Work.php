<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    use HasFactory;
    protected $table = 'work';
    protected $fillable = [
        'employee_id',
        'product_id',
        'quantity',
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
