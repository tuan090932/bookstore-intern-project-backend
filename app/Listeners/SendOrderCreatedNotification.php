<?php

// app/Listeners/SendOrderCreatedNotification.php
namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendOrderCreatedNotification implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct()
    {
        //
    }

    public function handle(OrderCreated $event)
    {
        // Log the order creation or perform any other desired actions
        \Log::info('Order created:', [
            'order_id' => $event->order->order_id,
            'user_id' => $event->order->user_id,
            'total_price' => $event->order->total_price,
            'order_date' => $event->order->order_date,
        ]);

        // Perform any other actions, such as sending notifications
    }
}

