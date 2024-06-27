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
}
