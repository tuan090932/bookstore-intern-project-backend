<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
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
        return [
            'title' => 'required|string|max:250',
            'language_id' => 'required|integer',
            'num_pages' => 'required|integer',
            'publisher_id' => 'required|integer',
            'category_id' => 'required|integer',
            'image' => 'required|string|max:250',
            'description' => 'required|string|max:250',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'author_id' => 'required|integer',
        ];
    }
}
