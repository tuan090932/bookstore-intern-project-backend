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
        return [
            'author_name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('authors', 'author_name'),
            ],
            'birth_date' => [
                'required',
                'date_format:d/m/Y',
                new ValidBirthDate
            ],
            'death_date' => [
                'nullable',
                'date_format:d/m/Y',
                new ValidDeathDate($this->input('birth_date'))
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
            'author_name.required' => 'Họ tên tác giả là bắt buộc.',
            'author_name.string' => 'Họ tên tác giả phải là một chuỗi ký tự.',
            'author_name.max' => 'Họ tên tác giả không được vượt quá 255 ký tự.',
            'author_name.unique' => 'Tên tác giả đã tồn tại. Vui lòng nhập tên khác.',
            'birth_date.required' => 'Ngày sinh là bắt buộc.',
            'birth_date.date_format' => 'Ngày sinh phải có định dạng DD/MM/YYYY.',
            'death_date.date_format' => 'Ngày mất phải có định dạng DD/MM/YYYY.',
        ];
    }
}
