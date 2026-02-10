<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePilgrimRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'agent_id' => ['required', 'exists:agents,id'],
            'name' => ['required', 'string', 'max:255'],
            'passport_number' => ['required', 'string', 'max:20', 'unique:pilgrims,passport_number'],
            'umrah_id' => ['required', 'string', 'max:50', 'unique:pilgrims,umrah_id'],
            'hotel_madinah_name' => ['nullable', 'string'],
            'hotel_madinah_check_in' => ['nullable', 'date'],
            'hotel_madinah_check_out' => ['nullable', 'date', 'after_or_equal:hotel_madinah_check_in'],
            'hotel_makkah_name' => ['nullable', 'string'],
            'hotel_makkah_check_in' => ['nullable', 'date'],
            'hotel_makkah_check_out' => ['nullable', 'date', 'after_or_equal:hotel_makkah_check_in'],
            'photo' => [
                'nullable',
                'image',
                'mimetypes:image/jpeg,image/png,image/jpg,image/webp,image/avif,image/heic',
                'max:2048'
            ],
        ];
    }
}
