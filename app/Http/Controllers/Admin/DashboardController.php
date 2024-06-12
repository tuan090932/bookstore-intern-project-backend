<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

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

    public function indexPage()
    {
        return view('admin.pages.dashboard.index', ['searchRoute' => $this->searchRoute]);
    }
}
