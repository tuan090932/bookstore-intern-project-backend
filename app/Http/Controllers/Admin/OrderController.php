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
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use App\Enums\BookOrderStatus; // Import enum

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
            return redirect()->route('orders.index')->with('error', __('messages.order.not_found'));
        } catch (Exception $e) {
            return redirect()->route('orders.index')->with('error', __('messages.order.fetch_failed'));
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
            if ((int)$request->input('status_id') === BookOrderStatus::CANCELLED && $request->send_email==='1') {
                $title = __('messages.order.order_cancelled_title');
                $messageContent = __('messages.order.order_cancelled_message');
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
            return redirect()->route('orders.show', $id)->with('status_success', __('messages.order.status_updated'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('orders.show', $id)->with('status_error', __('messages.order.not_found'));
        } catch (Exception $e) {
            return redirect()->route('orders.show', $id)->with('status_error', __('messages.order.status_update_failed'));
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
            return redirect()->route('orders.index')->with('success', __('messages.order.deleted_success'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('orders.index')->with('error', __('messages.order.not_found'));
        } catch (Exception $e) {
            dd($e);
            return redirect()->route('orders.index')->with('error', __('messages.order.deleted_failed'));
        }
    }
    
    /**
     * Send order notification email to user
     *
     * @param \Illuminate\Http\Request $request
     * @param string $orderId
     * @return \Illuminate\Http\RedirectResponse
    */
    public function sendOrderNotificationEmail(Request $request, $orderId)
    {
        try {
            $order = BookOrder::whereHas('user')->where('order_id', $orderId)->with(['user', 'bookOrderDetails.book'])->firstOrFail();
            $title = $request->input('title');
            $totalPrice = $order->total_price;
            $messageContent = $request->input('message_content');
            $bookOrderDetails = $order->bookOrderDetails->map(function($detail) {
                return [
                    'book_id' => $detail->book_id,
                    'title' => $detail->book->title,
                    'quantity' => $detail->quantity,
                    'price' => $detail->price,
                ];
            })->toArray();
    
            // Queue the email
            Mail::to($order->user->email)->queue(new MailNotify($messageContent, $title, $bookOrderDetails, $totalPrice));
    
            return redirect()->route('orders.show', $orderId)->with('email_success', __('messages.order.email_sent'));
        } catch (ModelNotFoundException $e) {
            return redirect()->route('orders.show', $orderId)->with('email_error', __('messages.order.not_found'));
        } catch (Exception $e) {
            return redirect()->route('orders.show', $orderId)->with('email_error', __('messages.order.email_failed', ['message' => $e->getMessage()]));
        }
    }
}
