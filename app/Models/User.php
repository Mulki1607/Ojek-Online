<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'phone'
    ];

    protected $hidden = [
        'password'
    ];
    protected $casts = [
        'password' => 'hashed',
    ];

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
    public function wallet()
    {
        return $this->morphOne(Wallet::class, 'owner');
    }
}
