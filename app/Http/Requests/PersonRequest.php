<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PersonRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required'],
            'birthdate' => ['required', 'date'],
            'email' => ['required', Rule::unique('people')->ignore($this->person), 'email'],
            'phone' => ['required'],
            'job_title' => ['required'],
            'address' => ['required'],
            'country' => ['required'],
            'company' => ['required'],
            'age' => ['required']
        ];
    }
}
