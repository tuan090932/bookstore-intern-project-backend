<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\User;
use App\Models\BookOrder;

class DashboardController extends Controller
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
        $this->searchRoute = route('authors.search');
    }

    /**
     * Display the dashboard with various statistics.
     *
     * @return \Illuminate\View\View The view for the admin dashboard with the required data.
     */
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
