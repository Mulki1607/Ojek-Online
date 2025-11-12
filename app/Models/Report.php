<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = ['user_id', 'driver_id', 'admin_id', 'isi_laporan', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
