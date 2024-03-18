<?php

namespace App\Http\Requests;

use App\Enums\UserGender;
use Illuminate\Foundation\Http\FormRequest;

class EditProfileRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'phone' => 'nullable|string',
            'gender' => 'required|in:' . implode(',', UserGender::all()),
            'date_of_birth' => 'nullable|date',
            'avatar' => 'nullable|file|mimetypes:image/jpeg,image/png',
        ];
    }
}
