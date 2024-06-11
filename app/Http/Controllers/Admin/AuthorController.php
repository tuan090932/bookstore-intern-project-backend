<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use Carbon\Carbon;
use App\Rules\ValidBirthDate;
use App\Rules\ValidDeathDate;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Log;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::paginate(15);

        return view('admin.pages.authors.index', compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.authors.create');
    }

    /**
     * Store a newly created author resource in the database.
     *
     * This method is responsible for creating a new author record in the database based on the input data provided in the $request object.
     * It first validates the input data, ensuring that the required fields (author_name, birth_date) are provided and that the death_date field is a valid date if present.
     * It then calculates the author's age based on the birth_date and either the death_date or the current date if the death_date is not provided.
     * Finally, it creates a new Author record in the database and redirects the user back to the create page with a success or error message depending on the outcome of the operation.
     *
     * @param // \Illuminate\Http\Request  $request
     * @return // \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'author_name.required' => 'Họ tên tác giả là bắt buộc.',
            'author_name.string' => 'Họ tên tác giả phải là một chuỗi ký tự.',
            'author_name.max' => 'Họ tên tác giả không được vượt quá 255 ký tự.',
            'author_name.unique' => 'Tên tác giả đã tồn tại. Vui lòng nhập tên khác.',
            'birth_date.required' => 'Ngày sinh là bắt buộc.',
            'birth_date.date_format' => 'Ngày sinh phải có định dạng DD/MM/YYYY.',
            'death_date.date_format' => 'Ngày mất phải có định dạng DD/MM/YYYY.',
        ];

        try
        {
            $request->validate([
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
                    new ValidDeathDate($request->input('birth_date'))
                ],
            ], $messages);

            $authorName = $request->input('author_name');
            $birthDate = Carbon::createFromFormat('d/m/Y', $request->input('birth_date'));
            $deathDate = $request->input('death_date') ? Carbon::createFromFormat('d/m/Y', $request->input('death_date')) : null;

            $age = $deathDate ? $deathDate->year - $birthDate->year : Carbon::now()->year - $birthDate->year;

            Author::create([
                'author_name' => $authorName,
                'birth_date' => $birthDate->format('Y-m-d'),
                'death_date' => $deathDate ? $deathDate->format('Y-m-d') : null,
                'age' => $age,
            ]);

            return redirect()->back()->with('success', 'Tạo tác giả thành công.');
        }
        catch (Exception $e)
        {
            // Logging the exception can be useful for debugging purposes
            Log::error('Error creating author: '.$e->getMessage());

            return redirect()->back()->with('error', 'Đã xảy ra lỗi khi tạo tác giả. Vui lòng thử lại.');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
