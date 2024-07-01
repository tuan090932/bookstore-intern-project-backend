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
            'email.required' => __('auth.email_required'),
            'email.email' => __('auth.email_valid'),
            'password.required' => __('auth.password_required'),
            'password.string' => __('auth.password_string'),
            'password.min' => __('auth.password_min'),
            'password.regex' => __('auth.password_regex'),
        ];
    }
}
