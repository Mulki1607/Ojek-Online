<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['order_id','user_id','driver_id','rating','komentar'];
    public function user()
    {
        return $this-> belongsTo(User::class);
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    public function pesanan()
    {
        return $this->belongsTo(Pesanan::class);
    }
}
