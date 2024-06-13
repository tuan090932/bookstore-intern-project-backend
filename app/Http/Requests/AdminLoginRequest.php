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
            'admin_email' => 'required|email',
            'admin_password' => [
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
            'admin_email.required' => 'Email là bắt buộc.',
            'admin_email.email' => 'Email không đúng định dạng.',
            'admin_password.required' => 'Mật khẩu là bắt buộc.',
            'admin_password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
            'admin_password.min' => 'Mật khẩu phải ít nhất 6 ký tự.',
            'admin_password.regex' => 'Mật khẩu phải chứa ít nhất một chữ thường, một chữ hoa, một chữ số và một ký tự đặc biệt.',
        ];
    }
}
