<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['to', 'from', 'text'];

    public function fromContact()
    {
        return $this->hasOne(User::class, 'id', 'from');
    }
    public function toContact()
    {
        return $this->hasOne(User::class, 'from', 'to');
    }
    public function userFrom()
    {
        return $this->belongsTo(User::class, 'id', 'from');
    }
    public function userTo()
    {
        return $this->belongsTo(User::class, 'id', 'to');
    }
}
