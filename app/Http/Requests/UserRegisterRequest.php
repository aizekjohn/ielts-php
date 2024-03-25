<?php

namespace App\Http\Requests;

use App\Enums\UserGender;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property mixed $phone
 */
class UserRegisterRequest extends FormRequest
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
            'email' => 'required|email',
            'token' => 'required|string',
            'phone' => 'nullable|string',
            'gender' => 'required|in:' . implode(',', UserGender::all()),
            'date_of_birth' => 'nullable|date',
            'avatar' => 'nullable|file|mimetypes:image/jpeg,image/png',
            'referrer' => 'nullable|string|size:5',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'phone' => $this->formatPhoneNumber($this->phone),
        ]);
    }

    protected function formatPhoneNumber($phone): string
    {
        $phone = str_replace(' ', '', $phone);

        if (!empty($phone) && !str_starts_with($phone, '+')) {
            $phone = '+' . $phone;
        }

        return $phone;
    }
}
