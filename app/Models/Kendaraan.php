<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $table = 'kendaraan';
    protected $primaryKey = 'Plat_Nomor';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'Plat_Nomor',
        'Tipe',
        'Merk',
        'Warna',
        'driver_id',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}