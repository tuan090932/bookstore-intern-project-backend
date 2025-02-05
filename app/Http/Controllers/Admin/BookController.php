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
     * This property stores the route for the search functionality.
     * It is initialized in the constructor to ensure it is properly set for use in the views.
     *
     * @var string
     */
    protected $searchRoute;

    /**
     * Controller constructor.
     *
     * Initializes the search route to direct search requests to the appropriate controller action.
     */
    public function __construct()
    {
        $this->searchRoute = route('books.search');
    }

    /**
     * Display a listing of the resource.
     *
     * Using with function to Eager Loading
     */
    public function index()
    {
        $books = Book::with('categories', 'languages', 'authors', 'publishers')->paginate(15);

        return view('admin.pages.books.index', ['books' => $books, 'searchRoute' => $this->searchRoute]);
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
    public function update(BookRequest $request, string $id)
    {
        try {
            $books = Book::findOrFail($id);
            $books->update($request->validated());
            return redirect()->route('books.index')->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            return redirect()->route('books.index')->with('error', 'Failed to add book.');
        }
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
