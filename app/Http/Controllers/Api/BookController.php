<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Display a listing of all books.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $books = Book::all();
        return response()->json($books);
    }
}
