<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Testing\Fluent\Concerns\Has;

class WalletTransaction extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','tipe','jumlah','saldo_awal','saldo_akhir'];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
