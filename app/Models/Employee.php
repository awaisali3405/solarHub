<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $table = 'employee';
    protected $fillable = [
        'name',
        'cnic',
        'phone',
        'address',
        'contract',
        'salary',
        'joining_date',
        'paying_term',
        'img'

    ];
    protected $casts = [
        'joining_date' => 'datetime',
    ];
    public function pay_term()
    {
        return $this->belongsTo(PayTerm::class, 'paying_term');
    }

    public function contract()
    {
        return $this->hasMany(Contract::class);
    }
    public function work()
    {
        return $this->hasMany(Work::class);
    }
}
