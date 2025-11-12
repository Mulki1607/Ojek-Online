<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $fillable = ['pesanan_id', 'admin_id', 'metode', 'jumlah', 'status'];

    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
