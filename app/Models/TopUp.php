<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Testing\Fluent\Concerns\Has;

class TopUp extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','wallet_id','amount','status','date','method'];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }
}
