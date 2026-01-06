<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class WalletTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'wallet_id',
        'type',
        'amount',
        'balance_before',
        'balance_after',
        'description',
    ];

    protected $casts = [
        'amount'         => 'float',
        'balance_before' => 'float',
        'balance_after'  => 'float',
    ];

    public function wallet()
    {
        return $this->belongsTo(Wallet::class);
    }

    /* OPTIONAL – supaya konsisten */
    public const TYPE_TOPUP         = 'topup';
    public const TYPE_ORDER_PAYMENT = 'order_payment';
    public const TYPE_ORDER_INCOME  = 'order_income';
    public const TYPE_WITHDRAW      = 'withdraw';
}