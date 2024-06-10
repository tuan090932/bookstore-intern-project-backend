<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

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
