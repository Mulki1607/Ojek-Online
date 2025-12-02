<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = ['nama','email', 'password','phone','status','online','lat','lng','kendaraan_id'];
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
        return $this->hasMany(Kendaraan::class);
    }
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
