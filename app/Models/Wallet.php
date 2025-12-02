<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Testing\Fluent\Concerns\Has;

class Wallet extends Model
{
    use HasFactory;

    protected $table = 'wallet';
    protected $fillable = ['user_id', 'balance'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }
    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }
}
