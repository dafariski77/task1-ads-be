<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReportRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'phone_number' => ['required', 'string'],
            'identity_type' => ['required', 'string'],
            'identity_number' => ['required', 'integer'],
            'pob' => ['required', 'string'],
            'dob' => ['required', 'date'],
            'address' => ['required', 'string'],
            'title' => ['required', 'string'],
            'description' => ['required'],
            'document' => ['required'],
        ];
    }
}
