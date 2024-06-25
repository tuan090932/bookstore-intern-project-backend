<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
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
        $rules = [
            'admin_name' => 'required|string|max:255',
            'role_id' => 'required|exists:roles,role_id',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:15',
        ];

        if ($this->isMethod('POST')) {
            $rules['password'] = 'required|string|min:6|confirmed';
            $rules['email'] = 'required|string|email|max:255|unique:admin,email';
        }

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $rules['email'] = [
                'sometimes',
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('admin')->ignore($this->route('admin'), 'admin_id'),
            ];
        }

        return $rules;
    }
}
