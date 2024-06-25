<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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

    /**
     * Display the specified book by its ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $book = Book::find($id);

        return response()->json($book);
    }

    /**
     * Display the specified book by its category.
     *
     * @param  int  $category_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBookByCategory($category_id){
        try{
            $books = Book::where('category_id', $category_id)->get();
            return response()->json($books);
        }catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified book by its author.
     *
     * @param  int  $author_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBookByAuthor($author_id){
        try{
            $books = Book::where('author_id', $author_id)->get();
            return response()->json($books);
        }catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified book by its publisher.
     *
     * @param  int  $publisher_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBookByPublisher($publisher_id){
        try{
            $books = Book::where('publisher_id', $publisher_id)->get();
            return response()->json($books);
        }catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified book by its language.
     *
     * @param  int  $language_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBookByLanguage($language_id){
        try{
            $books = Book::where('language_id', $language_id)->get();
            return response()->json($books);
        }catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the books within a specified price range.
     *
     * @param  float  $minPrice
     * @param  float  $maxPrice
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBooksByPriceRange($minPrice, $maxPrice)
    {
        try {
            $books = Book::whereBetween('price', [$minPrice, $maxPrice])->get();
            return response()->json($books);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
