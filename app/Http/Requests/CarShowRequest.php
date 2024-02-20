<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarShowRequest extends ApiRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'mark' => 'required|string|min:1|max:255|exists:cars',
            'model' => 'string|min:1|max:255|exists:cars,title'
        ];
    }
}
