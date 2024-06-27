<?php

namespace App\Http\Controllers;

use App\Models\OrderStatus;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OrderStatusController extends Controller
{
    /**
     * Display the specified resource.
     */
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $orderStatus = OrderStatus::findOrFail($id);

            return response()->json($orderStatus);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
