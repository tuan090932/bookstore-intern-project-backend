<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
<<<<<<< HEAD
use App\Models\Book;
=======
>>>>>>> develop
use Illuminate\Http\Request;

class BookController extends Controller
{
<<<<<<< HEAD
    private $book;

    public function __construct(Book $book)
    {
        $this->book = $book;
    }
    public function index()
    {
        $books = Book::all();;

        if ($books->isEmpty()) {
            return response()->json(['message' => 'Book not found'], 200);
        }

        return response()->json($books, 200);
    }
=======
    //
>>>>>>> develop
}
