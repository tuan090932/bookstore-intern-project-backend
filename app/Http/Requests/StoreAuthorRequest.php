<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\ValidBirthDate;
use App\Rules\ValidDeathDate;
use Illuminate\Validation\Rule;

class StoreAuthorRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Ensure to return true to allow form request to proceed
    }

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
                new ValidDeathDate($this->birth_date)
            ],
            'national' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }

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

            'national.required' => 'Quốc tịch là bắt buộc.',
            'national.string' => 'Quốc tịch phải là một chuỗi ký tự.',
            'national.max' => 'Quốc tịch không được vượt quá 255 ký tự.',
        ];
    }
}
