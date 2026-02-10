<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAgentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'partner_id' => ['nullable', 'exists:partners,id'],
            'name' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string'],
            'logo' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'leader_name' => ['required', 'string', 'max:255'],
            'leader_number' => ['required', 'string', 'max:20'],
            'muthowwif_name' => ['required', 'string', 'max:255'],
            'muthowwif_number' => ['required', 'string', 'max:20'],
        ];
    }
}
