<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Driver extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'status',
        'online',
        'work_status',
        'lat',
        'lng',
        'vehicle_type',
        'vehicle_brand',
        'vehicle_plate',
        'rating',
        'rating_count',
        'ktp',
        'sim',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    // ✅ DRIVER → PESANAN (UNTUK STATISTIK & ADMIN)
    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'driver_id');
    }

    // ✅ DRIVER → RATING
    public function ratings()
    {
        return $this->hasMany(Rating::class, 'driver_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SCOPES (OPTIONAL, SIAP DIPAKAI NANTI)
    |--------------------------------------------------------------------------
    */

    public function scopeOnline($query)
    {
        return $query->where('online', 1);
    }
    public function wallet()
    {
        return $this->morphOne(Wallet::class, 'owner');
    }
    public function kendaraan()
    {
        return $this->hasOne(Kendaraan::class, 'driver_id', 'id');
    }
}