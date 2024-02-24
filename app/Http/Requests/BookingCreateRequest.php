<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookingCreateRequest extends ApiRequest
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
            'start_date' => 'required|date_format:Y-m-d|after_or_equal:now',
            'end_date' => 'required|date_format:Y-m-d|after:start_date',
            'client.first_name' => 'required|string|min:1|max:255',
            'client.last_name' => 'required|string|min:1|max:255',
            'client.patronymic' => 'string|min:1|max:255',
            'client.passport_number' => 'required|string|min:1|max:255',
            'client.passport_series' => 'required|string|min:1|max:255',
            'client.phone' => 'required|string|min:1|max:255',
            'client.birth_date' => 'required|date_format:Y-m-d',
            'cars.*' => 'required|integer|exists:cars,id',
        ];
    }
}
