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
        $books = Book::with(['authors', 'categories', 'languages', 'publishers'])->paginate(15);
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
        return view('admin.pages.books.create', compact('categories','authors', 'languages','publishers'));
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
        try {
            $book = Book::findOrFail($id);
            $book->delete();
            return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('books.index')->with('error', 'Failed to delete the book.');
        }
    }

}
