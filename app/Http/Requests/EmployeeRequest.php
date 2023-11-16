<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'company_id' => 'required|integer|exists:companies,id',
            'email' => 'required|email|unique:employees,email,'.$this->employee?->id.'|max:255',
            'food_preference_id' => 'required|integer|exists:food_preferences,id',
            'phones' => 'array',
            'phones.*' => 'string|regex:/^([0-9\s\-\+\(\)]*)$/|min:9',
        ];
    }

    public function messages(): array
    {
        return [
            'phones.*' => 'Invalid phone number',
        ];
    }
}
