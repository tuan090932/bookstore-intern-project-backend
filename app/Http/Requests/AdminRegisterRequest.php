<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'admin_name' => 'required|string|max:250',
            'password' => [
                'required',
                'string',
                'min:6',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
                'confirmed'
            ],
            'email' => 'required|string|email|max:250|unique:admin,email',
        ];
    }

    /**
     * Get the custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'admin_name.required' => '*Tên là bắt buộc.',
            'admin_name.string' => '*Tên phải là một chuỗi ký tự.',
            'admin_name.max' => '*Tên không được dài quá 250 ký tự.',

            'password.required' => '*Mật khẩu là bắt buộc.',
            'password.string' => '*Mật khẩu phải là một chuỗi ký tự.',
            'password.min' => '*Mật khẩu phải ít nhất 6 ký tự.',
            'password.regex' => '*Mật khẩu phải chứa ít nhất một chữ thường, một chữ hoa, một chữ số và một ký tự đặc biệt.',
            'password.confirmed' => '*Xác nhận mật khẩu không khớp.',

            'email.required' => '*Email là bắt buộc.',
            'email.string' => '*Email phải là một chuỗi ký tự.',
            'email.email' => '*Email phải là một địa chỉ email hợp lệ.',
            'email.max' => '*Email không được dài quá 250 ký tự.',
            'email.unique' => '*Email này đã được sử dụng.',
        ];
    }
}
