<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Http\Requests\BookFilterRequest;
class BookController extends Controller
{
    
    /**
     * Display a listing of all books based on the provided filters.
     * @param \App\Http\Requests\BookFilterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(BookFilterRequest $request)
    {
        try{
            $books = Book::with(['authors', 'languages', 'publishers', 'categories']);
            if ($request->has('min_price') && $request->has('max_price')) {
                $books = $books->whereBetween('price', [$request->input('min_price'), $request->input('max_price')]);
            }
            if ($request->has('category_id')) {
                $books = $books->where('category_id', $request->input('category_id'));
            }
            if ($request->has('author_id')) {
                $books = $books->where('author_id', $request->input('author_id'));
            }
            if ($request->has('publisher_id')) {
                $books = $books->where('publisher_id', $request->input('publisher_id'));
            }
            if ($request->has('language_id')) {
                $books = $books->where('language_id', $request->input('language_id'));
            }
            $books = $books->get();
            return response()->json($books);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified book by its ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $book = Book::with(['authors', 'languages', 'publishers', 'categories'])->find($id);

        return response()->json($book);
    }

    /**
    * Search for books by title or author name.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\JsonResponse
    */
    public function search(Request $request)
    {
        try {
            $query = $request->input('query');
    
            $books = Book::join('authors', 'books.author_id', '=', 'authors.author_id')
                        ->where('books.title', 'like', '%' . $query . '%')
                        ->orWhere('authors.author_name', 'like', '%' . $query . '%')
                        ->select('books.*', 'authors.author_name as author_name')
                        ->get();
    
            return response()->json($books);
        } catch (Exception $e) {
            return response()->json(['error' => 'Error searching books: ' . $e->getMessage()], 500);
        }
    }
}
