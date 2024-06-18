<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Language;
use App\Models\Author;
use App\Models\Publisher;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Using with function to Eager Loading
     */
    public function index()
    {
        $books = Book::with('categories', 'languages', 'authors', 'publishers')->paginate(5);

        return view('admin.pages.books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $authors = Author::all();
        $languages = Language::all();
        $publishers = Publisher::all();
        return view('admin.pages.books.create', compact('categories', 'authors', 'languages', 'publishers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookRequest $request)
    {
        try {
            Book::create($request->validated());
            return redirect()->route('books.index')->with('success', 'Book added successfully.');
        } catch (\Exception $e) {
            return redirect()->route('books.index')->with('error', 'Failed to add book.');
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
    public function update(BookRequest $request, string $id)
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
