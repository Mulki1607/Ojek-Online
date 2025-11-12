<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'plat_nomor',
        'jenis',
        'merk',
        'warna',
    ];
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
