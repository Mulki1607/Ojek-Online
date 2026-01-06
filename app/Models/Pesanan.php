<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    /**
     * ==============================
     * MASS ASSIGNMENT
     * ==============================
     */
    protected $fillable = [
        'user_id',
        'driver_id',
        'pickup_location',
        'pickup_lat',
        'pickup_lng',
        'destination',
        'pickup_note',
        'price',
        'status',
        'user_notified',
    ];

    /**
     * ==============================
     * CASTING
     * ==============================
     */
    protected $casts = [
        'pickup_lat' => 'float',
        'pickup_lng' => 'float',
        'price'      => 'float',
        'user_notified' => 'boolean',
    ];

    /**
     * ==============================
     * STATUS CONSTANT (BEST PRACTICE)
     * ==============================
     */
    public const STATUS_PENDING   = 'pending';
    public const STATUS_ACCEPTED  = 'accepted';
    public const STATUS_COMPLETED = 'completed';
    public const STATUS_EXPIRED   = 'expired';

    /**
     * ==============================
     * RELATIONSHIPS
     * ==============================
     */

    // USER PEMESAN
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // DRIVER
    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    // RATING (1 PESANAN = 1 RATING)
    public function rating()
    {
        return $this->hasOne(Rating::class, 'pesanan_id');
    }

    /**
     * ==============================
     * HELPER METHODS (OPTIONAL)
     * ==============================
     */

    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isAccepted(): bool
    {
        return $this->status === self::STATUS_ACCEPTED;
    }

    public function isCompleted(): bool
    {
        return $this->status === self::STATUS_COMPLETED;
    }
}