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
            <p><strong>Order ID</strong>: {{ $order->order_id }}</p>
            <p><strong>User Name</strong>: {{ $order->user->user_name }}</p>
            <p><strong>Order Date</strong>: {{ $order->order_date }}</p>
            <p><strong>Status</strong>: {{ $order->orderStatus->status_id }}</p>
            <p><strong>Status</strong>:
                <span class="badge badge{{$order->orderStatus->status_id }}">
                    {{ $order->orderStatus->status_name }}
                </span>
            </p>
            <p><strong>Total Price</strong>: {{ number_format($order->total_price, 0, ',', '.') }}đ</p>
            <p><strong>Order Address</strong>: {{ $order->order_address }}</p>
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
                        <td>{{ number_format($detail->price, 0, ',', '.') }}đ</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <form action="{{ route('orders.updateStatus', $order->order_id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="status">Change Status:</label>
            <select name="status_id" id="status" class="form-control">
                @foreach($statuses as $status)
                <option value="{{ $status->status_id }}">
                    {{ $status->status_name }}
                </option>
                @endforeach
            </select>
            @if (session('error'))
            <div class="alert alert-danger mt-2">
                {{ session('error') }}
            </div>
            @endif
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Update Status</button>
    </form>
</div>
<!-- /.container-fluid -->
@endsection
