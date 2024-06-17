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
        $userId = $this->route('id');
        logger($userId);
        return [
            'phone' => 'sometimes|string|max:15|regex:/^[0-9]+$/',
            'user_name' => 'sometimes|string|max:255|unique:users,user_name,' . $userId . ',user_id',
            'email' => 'sometimes|email|max:255|unique:users,email,' . $userId . ',user_id',
            'name' => 'sometimes|string|max:255',
            'password' => 'sometimes|string|min:6|confirmed',
            'old_password' => 'required_with:password|string|min:6'
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
            'user_name.unique' => 'Tên người dùng đã tồn tại.',
            'email.unique' => 'Email đã tồn tại.',
            'old_password.required_with' => 'Cần nhập mật khẩu cũ khi thay đổi mật khẩu.',
        ];
    }
}
