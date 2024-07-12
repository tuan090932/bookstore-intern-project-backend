<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookOrderRequest;
use App\Models\BookOrder;
use App\Models\BookOrderDetail;
use App\Models\Address;
use App\Enums\BookOrderStatus; // Import enum
use Exception;
use Illuminate\Http\Request;
use App\Events\OrderCreated;
use Illuminate\Support\Facades\Event;

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
    public function index(Request $request)
    {
        try {
            $user = auth('api')->user();
            $query = BookOrder::where('user_id', $user->user_id)
                              ->with('bookOrderDetails.book')
                              ->join('order_status', 'book_order.status_id', '=', 'order_status.status_id');
    
            if ($request->has('status_id')) {
                $query->where('book_order.status_id', $request->input('status_id'));
            }
    
            $orders = $query->get();
    
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
            $orderAddress = "{$address->shipping_address}, {$address->city}, {$address->country_name}";
 
            // Create the book order
            $order = BookOrder::create([
                'user_id' => $user->user_id,
                'order_date' => $request->input('order_date'),
                'status_id' => BookOrderStatus::PENDING,
                'address_id' => $request->input('address_id'),
                'order_address' => $orderAddress,
                'total_price' => array_sum(array_column($request->books, 'price')),
            ]);
 
            $bookOrderDetails = [];
            foreach ($request->books as $book) {
               $bookOrderDetails[] = [
                    'order_id' => $order->order_id,
                    'book_id' => $book['book_id'],
                    'quantity' => $book['quantity'],
                    'price' => $book['price'],
                ];
            }
            BookOrderDetail::insert($bookOrderDetails);
            //Event::fire(new App\Events\OrderCreated($order));
            event(new OrderCreated($order));



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
            $order = BookOrder::where('user_id', $user->user_id)
                                ->where('order_id', $order_id)
                                ->with('bookOrderDetails.book')
                                ->join('order_status', 'book_order.status_id', '=', 'order_status.status_id')
                                ->firstOrFail();

            return response()->json($order);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Update the status_id of the specified order to Cancelled.
     *
     * @param  int  $order_id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus($order_id)
    {
        try {
            $user = auth('api')->user();
            $order = BookOrder::where('user_id', $user->user_id)->where('order_id', $order_id)->firstOrFail();

            $order->status_id = BookOrderStatus::CANCELLED;
            $order->save();

            return response()->json(['order' => $order]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
