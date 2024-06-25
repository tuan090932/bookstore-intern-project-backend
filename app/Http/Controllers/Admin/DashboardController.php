<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Models\BookOrder;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBooksInStock = Book::totalBooksInStock();
        $totalDistinctTitles = Book::totalDistinctTitles();
        $recentCustomers = User::latest('created_at')->limit(10)->get();
        $recentOrders = BookOrder::with(['user', 'orderStatus', 'bookOrderDetails'])->latest('order_date')->limit(10)->get();
        $getTotalRevenue = BookOrder::getTotalRevenue();
        return view('admin.pages.dashboard.index', compact('totalBooksInStock', 'totalDistinctTitles', 'recentCustomers', 'recentOrders', 'getTotalRevenue'));
    }
}
