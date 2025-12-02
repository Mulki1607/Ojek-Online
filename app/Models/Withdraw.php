<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Withdraw extends Model
{
    use HasFactory;
    protected $fillable = ['wallet_id','amount','status','methode','reference_number'];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
