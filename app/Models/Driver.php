<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = ['email', 'password', 'status'];
    use HasFactory;
    public function pesanans()
    {
        return $this->hasMany(Pesanan::class);
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
    public function kendaraan()
    {
        return $this->hasOne(Kendaraan::class);
    }
}
