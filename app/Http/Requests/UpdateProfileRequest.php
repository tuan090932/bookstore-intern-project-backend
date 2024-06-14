<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Ensure this is set to true if authorization is not needed
    }

    public function rules()
    {
        return [
            'phone' => 'required|string|max:15|regex:/^[0-9]+$/',
            'address' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.string' => 'Số điện thoại phải là một chuỗi.',
            'phone.max' => 'Số điện thoại không được vượt quá 15 ký tự.',
            'phone.regex' => 'Số điện thoại chỉ được chứa các chữ số.',

            'address.required' => 'Địa chỉ là bắt buộc.',
            'address.string' => 'Địa chỉ phải là một chuỗi.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
        ];
    }
}
