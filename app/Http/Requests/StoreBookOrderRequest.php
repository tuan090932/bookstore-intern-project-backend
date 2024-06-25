<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookOrderRequest extends FormRequest
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
            'order_date' => 'required|date',
            'address_id' => 'required|exists:addresses,address_id',
            'books' => 'required|array',
            'books.*.book_id' => 'required|exists:books,book_id',
            'books.*.quantity' => 'required|integer|min:1',
            'books.*.price' => 'required|numeric|min:0',
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
            'order_date.required' => __('validation.required', ['attribute' => 'order date']),
            'order_date.date' => __('validation.date', ['attribute' => 'order date']),
            'address_id.required' => __('validation.required', ['attribute' => 'address']),
            'address_id.exists' => __('validation.exists', ['attribute' => 'address']),
            'books.required' => __('validation.required', ['attribute' => 'books']),
            'books.array' => __('validation.array', ['attribute' => 'books']),
            'books.*.book_id.required' => __('validation.required', ['attribute' => 'book id']),
            'books.*.book_id.exists' => __('validation.exists', ['attribute' => 'book id']),
            'books.*.quantity.required' => __('validation.required', ['attribute' => 'quantity']),
            'books.*.quantity.integer' => __('validation.integer', ['attribute' => 'quantity']),
            'books.*.quantity.min' => __('validation.min', ['attribute' => 'quantity']),
            'books.*.price.required' => __('validation.required', ['attribute' => 'price']),
            'books.*.price.numeric' => __('validation.numeric', ['attribute' => 'price']),
            'books.*.price.min' => __('validation.min', ['attribute' => 'price']),
        ];
    }
}
