<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        $books = Book::with(['authors', 'categories', 'languages', 'publishers'])->get();
        // $books = Book::all();

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
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:250',
            'language_id' => 'required|integer',
            'num_pages' => 'required|integer',
            'publisher_id' => 'required|integer',
            'category_id' => 'required|integer',
            'image' => 'required|string|max:250|unique:books,image',
            'description' => 'required|string|max:250',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'author_id' => 'required|integer',
        ], [
            'title.required' => 'Title is required.',
            'language_id.required' => 'Language is required.',
            'num_pages.required' => 'Number of pages is required.',
            'publisher_id.required' => 'Publisher is required.',
            'category_id.required' => 'Category is required.',
            'image.required' => 'Image is required.',
            'description.required' => 'Description is required.',
            'price.required' => 'Price is required.',
            'stock.required' => 'Stock is required.',
            'author_id.required' => 'Author is required.',
        ]);

        Book::create($request->all());

        return redirect()->route('books.index')->with('success', 'Book added successfully.');
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
        $books = Book::findOrFail($id);
        $categories = Category::all();
        $authors = Author::all();
        $languages = Language::all();
        $publishers = Publisher::all();
        return view('admin.pages.books.edit', compact('books', 'categories', 'authors', 'languages', 'publishers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:250',
                'language_id' => 'required|integer',
                'num_pages' => 'required|integer',
                'publisher_id' => 'required|integer',
                'category_id' => 'required|integer',
                'image' => 'required|string|max:250|unique:books,image,' . $id,
                'description' => 'required|string|max:250',
                'price' => 'required|numeric',
                'stock' => 'required|integer',
                'author_id' => 'required|integer',
            ], [
                'title.required' => 'Title is required.',
                'language_id.required' => 'Language is required.',
                'num_pages.required' => 'Number of pages is required.',
                'publisher_id.required' => 'Publisher is required.',
                'category_id.required' => 'Category is required.',
                'image.required' => 'Image is required.',
                'description.required' => 'Description is required.',
                'price.required' => 'Price is required.',
                'stock.required' => 'Stock is required.',
                'author_id.required' => 'Author is required.',
            ]);

            $book = Book::findOrFail($id);
            $book->update($request->all());
            return redirect()->route('books.index')->with('success', 'Book updated successfully.');
        } catch (\Exception $e) {
            return redirect()->route('books.index')->with('error', 'Book updated fail.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $books = Book::findOrFail($id);
        $books->delete();
        return redirect()->route('books.index')->with('success', 'Delete Product Successfully');
    }

    /**
     * Search for books by title.
     */
    public function search(Request $request)
    {
        $search = $request->input('search');
        $books = Book::where('title', 'like', '%' . $search . '%')->with(['authors', 'categories', 'languages', 'publishers'])->get();
        return view('admin.pages.books.index', compact('books'));
    }
}
