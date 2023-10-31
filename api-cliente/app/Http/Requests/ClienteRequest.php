<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
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
            'name' => 'required|min:3|max:100',
            'email' => 'required|email|unique:clientes',
            'phone_number' => 'required|min:10|max:15',
            'surnames' => 'nullable|min:3|max:100',
            'birthdate' => 'nullable|date_format:d/m/Y',
            'address' => 'nullable|string',
            'country' => 'nullable|string',
            'province' => 'nullable|string',
            'city' => 'nullable|string',
            'postal_code' => 'nullable|string',
        ];
    }
}
