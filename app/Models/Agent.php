<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'partner_id',
        'name',
        'address',
        'logo',
        'leader_name',
        'leader_number',
        'muthowwif_name',
        'muthowwif_number',
    ];

    public function pilgrims(): HasMany
    {
        return $this->hasMany(Pilgrim::class);
    }
    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class);
    }
}
