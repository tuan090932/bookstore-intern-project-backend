<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooksInStock = Book::totalBooksInStock();
        $totalDistinctTitles = Book::totalDistinctTitles();
        $recentCustomers = User::orderBy('created_at', 'desc')->take(10)->get();
        return view('admin.pages.dashboard.index', compact('totalBooksInStock', 'totalDistinctTitles', 'recentCustomers'));
    }
}
