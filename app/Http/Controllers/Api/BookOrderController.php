<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookOrderRequest;
use App\Models\BookOrder;
use App\Models\BookOrderDetail;
use App\Models\Address;
use Exception;
use Illuminate\Http\Request;

class BookOrderController extends Controller
{
    /**
     * Create a new BookOrderController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $user = auth('api')->user();
            $orders = BookOrder::where('user_id', $user->user_id)->with('bookOrderDetails.book')->get();

            return response()->json($orders);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Store a newly created order in storage.
     *
     * @param  \App\Http\Requests\StoreBookOrderRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreBookOrderRequest $request)
    {
        try {
            $user = auth('api')->user();
  
            // Retrieve address details
            $address = Address::findOrFail($request->input('address_id'));
            $order_address = "{$address->shipping_address}, {$address->city}, {$address->country_name}";
 
            // Create the book order
            $order = BookOrder::create([
                'user_id' => $user->user_id,
                'order_date' => $request->input('order_date'),
                'status_id' => 1,
                'address_id' => $request->input('address_id'),
                'order_address' => $order_address,
                'total_price' => array_sum(array_column($request->books, 'price')),
            ]);
 
            foreach ($request->books as $book) {
                BookOrderDetail::create([
                    'order_id' => $order->order_id,
                    'book_id' => $book['book_id'],
                    'quantity' => $book['quantity'],
                    'price' => $book['price'],
                ]);
            }
 
            // Return the created order with loaded details and associated books
            return response()->json($order->load('bookOrderDetails.book'), 201);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified order.
     *
     * @param  int  $order_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($order_id)
    {
        try {
            $user = auth('api')->user();
            $order = BookOrder::where('user_id', $user->user_id)->where('order_id', $order_id)->with('bookOrderDetails.book')->firstOrFail();

            return response()->json($order);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the status_id of the specified order to 4.
     *
     * @param  int  $order_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus($order_id)
    {
        try {
            $user = auth('api')->user();
            $order = BookOrder::where('user_id', $user->user_id)->where('order_id', $order_id)->firstOrFail();

            $order->status_id = 4;
            $order->save();

            return response()->json(['order' => $order]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
