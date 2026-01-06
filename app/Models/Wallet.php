<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'owner_type',
        'owner_id',
        'balance',
        'currency',
    ];

    protected $casts = [
        'balance' => 'float',
    ];

    /**
     * Owner wallet (User / Driver)
     */
    public function owner()
    {
        return $this->morphTo();
    }

    /**
     * Wallet transactions
     */
    public function transactions()
    {
        return $this->hasMany(WalletTransaction::class);
    }

    /* ======================
     | STATIC HELPER (WAJIB)
     ====================== */

    public static function getOrCreateFor(Model $owner): self
    {
        return static::firstOrCreate(
            [
                'owner_type' => get_class($owner),
                'owner_id'   => $owner->id,
            ],
            [
                'balance'  => 0,
                'currency' => 'IDR',
            ]
        );
    }

    /* ======================
     | DOMAIN LOGIC (AMAN)
     ====================== */

    public function credit(float $amount, string $type, ?string $description = null): void
    {
        $before = $this->balance;

        $this->update([
            'balance' => $before + $amount,
        ]);

        $this->transactions()->create([
            'type'           => $type,
            'amount'         => $amount,
            'balance_before' => $before,
            'balance_after'  => $this->balance,
            'description'    => $description,
        ]);
    }

    public function debit(float $amount, string $type, ?string $description = null): void
    {
        if ($this->balance < $amount) {
            throw new \Exception('Saldo tidak mencukupi');
        }

        $before = $this->balance;

        $this->update([
            'balance' => $before - $amount,
        ]);

        $this->transactions()->create([
            'type'           => $type,
            'amount'         => $amount,
            'balance_before' => $before,
            'balance_after'  => $this->balance,
            'description'    => $description,
        ]);
    }
}