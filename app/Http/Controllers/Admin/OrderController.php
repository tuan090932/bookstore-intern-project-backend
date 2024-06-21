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
            return redirect()->route('orders.show', $id)->with('success', 'Order status updated successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('orders.show', $id)->with('error', 'Order not found.');
        } catch (Exception $e) {
            return redirect()->route('orders.show', $id)->with('error', 'Failed to update order status.');
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
            $bookOrderDetails = BookOrderDetail::where('order_id', $id)->get();
            foreach ($bookOrderDetails as $bookOrderDetail) {
                $bookOrderDetail->delete();
            }
            $order->delete();
            return redirect()->route('orders.index')->with('success', 'Order deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return redirect()->route('orders.index')->with('error', 'Order not found.');
        } catch (Exception $e) {
            dd($e);
            return redirect()->route('orders.index')->with('error', 'Failed to delete order.');
        }
    }
}
