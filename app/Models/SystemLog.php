<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SystemLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'action',
        'entity_type',
        'entity_id',
        'action',
        'description',
        'ip_address',
        'user_agent',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
