<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'shipping_address' => 'required|string',
            'city' => 'required|string',
            'country_name' => 'required|string',
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
            'shipping_address.required' => __('validation.required', ['attribute' => __('attributes.shipping_address')]),
            'shipping_address.string' => __('validation.string', ['attribute' => __('attributes.shipping_address')]),
            'city.required' => __('validation.required', ['attribute' => __('attributes.city')]),
            'city.string' => __('validation.string', ['attribute' => __('attributes.city')]),
            'country_name.required' => __('validation.required', ['attribute' => __('attributes.country_name')]),
            'country_name.string' => __('validation.string', ['attribute' => __('attributes.country_name')]),
        ];
    }
}
