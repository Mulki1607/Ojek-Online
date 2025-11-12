<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{   
    use HasFactory;
    protected $fillable = ['name', 'email', 'password', 'phone'];

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
