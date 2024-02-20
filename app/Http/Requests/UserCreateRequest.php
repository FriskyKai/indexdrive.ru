<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends ApiRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|min:1|max:255',
            'last_name' => 'required|string|min:1|max:255',
            'patronymic' => 'string|min:1|max:255',
            'phone' => 'required|string|min:1|max:255|unique:users',
            'birth_date' => 'required|date',
            'passport_series' => 'required|string|min:1|max:255',
            'passport_number' => 'required|string|min:1|max:255',
            'password' => 'required|string|min:1|max:255'
        ];
    }
}
