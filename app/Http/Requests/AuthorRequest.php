<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\ValidBirthDate;
use App\Rules\ValidDeathDate;

class AuthorRequest extends FormRequest
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
        $authorId = $this->route('author');

        return [
            'author_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('authors', 'author_name')->ignore($authorId, 'author_id'),
            ],
            'birth_date' => [
                'required',
                'date_format:d/m/Y',
                new ValidBirthDate
            ],
            'death_date' => [
                'nullable',
                'date_format:d/m/Y',
                new ValidDeathDate($this->birth_date)
            ],
            'national' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'author_name.required' => 'Author name is required.',
            'author_name.string' => 'Author name must be a string.',
            'author_name.max' => 'Author name must not exceed 255 characters.',
            'author_name.unique' => 'Author name already exists. Please choose a different name.',

            'birth_date.required' => 'Birth date is required.',
            'birth_date.date_format' => 'Birth date must be in the format DD/MM/YYYY.',
            'death_date.date_format' => 'Death date must be in the format DD/MM/YYYY.',

            'national.required' => 'Nationality is required.',
            'national.string' => 'Nationality must be a string.',
            'national.max' => 'Nationality must not exceed 255 characters.',
        ];
    }
}
