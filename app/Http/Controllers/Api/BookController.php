<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }
    public function index()
    {
        $books = $this->book->getAllBooks();

        if ($books->isEmpty()) {
            return response()->json(['message' => 'Book not found'], 200);
        }

        return response()->json($books, 200);
    }
}
