@extends('admin.layouts.base')

@section('title', 'Order Details')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800 d-flex align-items-center">Order Details</h1>

    <!-- Order Information -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <h5>Order Information</h5>
            <p>Order ID: {{ $order->order_id }}</p>
            <p>User Name: {{ $order->user->user_name }}</p>
            <p>Order Date: {{ $order->order_date }}</p>
            <p>Status: {{ $order->orderStatus->status_id }}</p>

            <p>Status:
                <span class="badge badge{{$order->orderStatus->status_id }}">
                    {{ $order->orderStatus->status_name }}
                </span>
            </p>


            <p>Total Price: {{ $order->total_price }}</p>
            <p>Order Address: {{ $order->order_address }}</p>
        </div>
    </div>

    <!-- Order Details -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <h5>Order Details</h5>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Book Title</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->bookOrderDetails as $detail)
                    <tr>
                        <td>{{ $detail->book->title }}</td>
                        <td>{{ $detail->quantity }}</td>
                        <td>{{ $detail->price }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection