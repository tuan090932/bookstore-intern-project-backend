<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if ($this->method() == 'PUT') {
            $id = $this->route('user');
            return [
                'user_name' => 'required|string|max:250|unique:users,user_name,' . $id . ',user_id',
                'email' => 'required|email|unique:users,email,' . $id . ',user_id',
                'phone_number' => 'required|string|max:250|unique:users,phone_number,' . $id . ',user_id',
            ];
        } else {
            return [
                'user_name' => 'required|string|max:250|unique:users,user_name',
                'email' => 'required|email|unique:users,email',
                'phone_number' => 'required|string|max:250|unique:users,phone_number',
                'password' => 'required|min:6',
                'city' => 'required|string|max:250',
                'country_name' => 'required|string|max:250',
                'shipping_address' => 'required',
            ];
        }
    }
}
