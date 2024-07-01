<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookFilterRequest extends FormRequest
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
    public function rules()
    {
        return [
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|integer|exists:categories,category_id',
            'author_id' => 'nullable|integer|exists:authors,author_id',
            'publisher_id' => 'nullable|integer|exists:publishers,publisher_id',
            'language_id' => 'nullable|integer|exists:languages,language_id',
        ];
    }
    
    /**
     * Get the validation messages that apply to the request.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'min_price.numeric' => 'The minimum price must be a number.',
            'max_price.numeric' => 'The maximum price must be a number.',
            'category_id.integer' => 'The category ID must be an integer.',
            'category_id.exists' => 'The selected category ID is invalid.',
            'author_id.integer' => 'The author ID must be an integer.',
            'author_id.exists' => 'The selected author ID is invalid.',
            'publisher_id.integer' => 'The publisher ID must be an integer.',
            'publisher_id.exists' => 'The selected publisher ID is invalid.',
            'language_id.integer' => 'The language ID must be an integer.',
            'language_id.exists' => 'The selected language ID is invalid.',
        ]; 
    }
}
