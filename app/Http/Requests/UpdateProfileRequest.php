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
            'phone_number' => 'sometimes|string|max:15|regex:/^[0-9]+$/',
            'user_name' => 'sometimes|string|max:255|unique:users,user_name,' . $userId . ',user_id',
            'email' => 'sometimes|email|max:255|unique:users,email,' . $userId . ',user_id',
            'name' => 'sometimes|string|max:255',
            'password' => 'sometimes|string|min:6',
            'old_password' => 'required_with:password|string|min:6'
        ];
    }

    public function messages()
    {
        return [
            'phone_number.string' => __('validation.phone_number.string'),
            'phone_number.max' => __('validation.phone_number.max'),
            'phone_number.regex' => __('validation.phone_number.regex'),
            'user_name.unique' => __('validation.user_name.unique'),
            'user_name.string' => __('validation.user_name.string'),
            'email.email' => __('validation.email.email'),
            'email.max' => __('validation.email.max'),
            'email.unique' => __('validation.email.unique'),
            'old_password.required_with' => __('validation.old_password.required_with'),
        ];
    }
}
