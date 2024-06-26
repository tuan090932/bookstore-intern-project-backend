<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email',
            'password' => [
                'required',
                'string',
                'min:6',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => '*Email is required.',
            'email.email' => '*Email must be a valid email address.',
            'password.required' => '*Password is required.',
            'password.string' => '*Password must be a string.',
            'password.min' => '*Password must be at least 6 characters.',
            'password.regex' => '*Password must include 1 uppercase, 1 number, 1 special character, and be 6+ characters long.',
        ];
    }
}
