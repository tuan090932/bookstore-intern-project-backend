<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use Exception;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authors = Author::all();

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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'author_name' => 'required|string|max:255',
            'age' => 'required|integer|max:150|min:10',
            'birth_date' => 'required|date',
            'death_date' => 'nullable|date',
        ]);

        try
        {
            Author::create([
                'author_name' => $request->input('author_name'),
                'birth_date' => $request->input('birth_date'),
                'death_date' => $request->input('death_date'),
            ]);

            return redirect()->route('authors.create')->with('success', 'Tác giả đã được thêm thành công!');
        }
        catch (Exception $e)
        {
            return redirect()->route('authors.create')->with('error', 'Có lỗi xảy ra khi thêm tác giả. Vui lòng thử lại.');
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
