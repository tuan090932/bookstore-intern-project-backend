<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Category;
use App\Models\Language;
use App\Models\Author;
use App\Models\Publisher;
use Illuminate\Http\Request;
use App\Models\BookOrder;

class OrderController extends Controller
{
    public function index()
    {
        $orders = BookOrder::join('users', 'book_order.user_id', '=', 'users.user_id')
            ->join('order_status', 'book_order.status_id', '=', 'order_status.status_id')
            ->join('book_order_details', 'book_order.order_id', '=', 'book_order_details.order_id')
            ->select(
                'book_order.order_id',
                'users.user_name',
                'users.email',
                'order_status.status_name',
                'book_order.order_date',
                'book_order.total_price',
                'book_order_details.book_id',
                'book_order_details.quantity',
                'book_order_details.price'
            )
            ->get();

        return view('admin.pages.orders.index', compact('orders'));
    }


    public function show($id)
    {
        $order = BookOrder::with('details')->where('order_id', $id)->first();

        if (!$order) {
            return redirect()->route('orders.index')->with('error', 'Order not found.');
        }

        return view('admin.pages.orders.index', compact('order'));
    }
}
