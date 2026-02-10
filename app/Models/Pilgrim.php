<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pilgrim extends Model
{
    use HasFactory, HasUuids;

    /**
     * Kolom yang boleh diisi secara massal.
     * photo_path WAJIB ada di sini agar tersimpan ke DB.
     */
    protected $fillable = [
        'agent_id',
        'name',
        'passport_number',
        'umrah_id',
        'hotel_madinah_name',
        'hotel_madinah_check_in',
        'hotel_madinah_check_out',
        'hotel_makkah_name',
        'hotel_makkah_check_in',
        'hotel_makkah_check_out',
        'photo_path'
    ];

    /**
     * Agar kolom public ID yang digunakan adalah 'uuid'
     */
    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    /**
     * Route Model Binding Customization.
     */
    public function getRouteKeyName(): string
    {
        return 'uuid';
    }

    /**
     * Type Casting.
     */
    protected function casts(): array
    {
        return [
            'hotel_madinah_check_in' => 'date',
            'hotel_madinah_check_out' => 'date',
            'hotel_makkah_check_in' => 'date',
            'hotel_makkah_check_out' => 'date',
        ];
    }

    public function agent(): BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }
}
