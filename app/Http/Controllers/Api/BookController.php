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
            if ($request->has('minPrice') && $request->has('maxPrice')) {
                $books = $books->whereBetween('price', [$request->input('minPrice'), $request->input('maxPrice')]);
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
}
