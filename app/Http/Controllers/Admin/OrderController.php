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
use App\Models\BookOrderDetail;
use App\Models\OrderStatus;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class OrderController extends Controller
{
    /**
     * Display a listing of the orders.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $orders = BookOrder::with(['user', 'orderStatus', 'bookOrderDetails'])->paginate(10);
        return view('admin.pages.orders.index', compact('orders'));
    }

    /**
     * Display the specified order.
     *
     * @param string $id
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($id)
    {
        try {
            $order = BookOrder::with(['bookOrderDetails', 'orderStatus', 'user'])->where('order_id', $id)->firstOrFail();
            $statuses = OrderStatus::all();
            return view('admin.pages.orders.show', compact('order', 'statuses'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('orders.index')->with('error', 'Order not found.');
        } catch (Exception $e) {
            return redirect()->route('orders.index')->with('error', 'Failed to fetch order.');
        }
    }

    /**
     * Update the specified order status in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Request $request, $id)
    {
        try {
            $order_status = BookOrder::where('order_id', $id)->firstOrFail();
            $order_status->status_id = $request->input('status_id');
            $order_status->save();
            if ($request->input('status_id') === '4'&& $request->send_email==='1' ) {
                $title = 'Order cancelled';
                $messageContent = 'Your order has been cancelled. Please contact us immediately';
                $order = BookOrder::whereHas('user')->where('order_id', $id)->with(['user', 'bookOrderDetails.book'])->firstOrFail();
                $totalPrice=$order->total_price;
                $bookOrderDetails = $order->bookOrderDetails->map(function($detail) {
                    return [
                            'book_id' => $detail->book_id,
                            'title' => $detail->book->title, 
                            'quantity' => $detail->quantity,
                            'price' => $detail->price,
                        ];
                    })->toArray();
                Mail::to($order->user->email)->send(new MailNotify($messageContent, $title, $bookOrderDetails,$totalPrice));
            }
            return redirect()->route('orders.show', $id)->with('status_success', 'Order status updated successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('orders.show', $id)->with('status_error', 'Order not found.');
        } catch (Exception $e) {
            return redirect()->route('orders.show', $id)->with('status_error', 'Failed to update order status.');
        }
    }

    /**
     * Remove the specified order from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $order = BookOrder::where('order_id', $id)->firstOrFail();
            BookOrderDetail::where('order_id', $id)->delete();
            $order->delete();
            return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('orders.index')->with('error', 'Order not found.');
        } catch (Exception $e) {
            dd($e);
            return redirect()->route('orders.index')->with('error', 'Failed to delete order.');
        }
    }
    
    /**
     * Send email to user
     *
     * @param \Illuminate\Http\Request $request
     * @param string $orderId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendEmail(Request $request, $orderId)
    {
        try {
            $order = BookOrder::whereHas('user')->where('order_id', $orderId)->with(['user', 'bookOrderDetails.book'])->firstOrFail();
            $title = $request->input('title');
            $totalPrice=$order->total_price;
            $messageContent = $request->input('message_content');
            $bookOrderDetails = $order->bookOrderDetails->map(function($detail) {
                return [
                        'book_id' => $detail->book_id,
                        'title' => $detail->book->title, 
                        'quantity' => $detail->quantity,
                        'price' => $detail->price,
                    ];
                })->toArray();
            Mail::to($order->user->email)->send(new MailNotify($messageContent, $title, $bookOrderDetails,$totalPrice));
            return redirect()->route('orders.show', $orderId)->with('email_success', 'Email sent successfully!');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('orders.show', $orderId)->with('email_error', 'Order not found.');
        } catch (Exception $e) {
            return redirect()->route('orders.show', $orderId)->with('email_error', 'Failed to send email: ' . $e->getMessage());
        }
    }
}
