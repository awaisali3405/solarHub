<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyExpense extends Model
{
    use HasFactory;
    protected $table = 'daily_expense';
    protected $fillable = [
        'amount',
        'type',
        'description',
        'date'
    ];
    protected $casts = [
        'date' => 'datetime'
    ];

}
