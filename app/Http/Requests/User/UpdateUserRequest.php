<?php
namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $userId = $this->route('id');

        return [
            'name' => 'sometimes|string|max:255',
            'user_name' => [
                'sometimes',
                'string',
                'max:255',
                Rule::unique('users', 'user_name')->ignore($userId),
            ],
            'email' => [
                'sometimes',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'phone_number' => 'nullable|string|max:20',
            'password' => 'sometimes|required_with:old_password|string|min:6',
            'old_password' => 'required_with:password|string|min:6',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.string' => 'Tên phải là một chuỗi ký tự.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',
            'user_name.string' => 'user name phải là một chuỗi ký tự.',
            'user_name.max' => 'user name không được vượt quá 255 ký tự.',
            'user_name.unique' => 'user name đã được sử dụng.',
            'email.string' => 'Email phải là một chuỗi ký tự.',
            'email.email' => 'Email không hợp lệ.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',
            'email.unique' => 'Email đã được sử dụng.',
            'phone_number.string' => 'Số điện thoại phải là một chuỗi ký tự.',
            'phone_number.max' => 'Số điện thoại không được vượt quá 20 ký tự.',
            'password.required_with' => 'Mật khẩu mới là bắt buộc khi thay đổi mật khẩu.',
            'password.string' => 'Mật khẩu phải là một chuỗi ký tự.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'old_password.required_with' => 'Mật khẩu cũ là bắt buộc khi thay đổi mật khẩu.',
            'old_password.string' => 'Mật khẩu cũ phải là một chuỗi ký tự.',
            'old_password.min' => 'Mật khẩu cũ phải có ít nhất 6 ký tự.',
        ];
    }
}
