<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayTerm extends Model
{
    use HasFactory;
    protected $table = 'paying_term';
    protected $fillable = [
        'name'


    ];
}
