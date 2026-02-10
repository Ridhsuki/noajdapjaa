<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Partner extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'makkah_address',
        'makkah_phone',
        'madinah_address',
        'madinah_phone',
    ];

    public function agents(): HasMany
    {
        return $this->hasMany(Agent::class);
    }
}
