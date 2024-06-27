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
    <!-- Update Status Form -->
    <form action="{{ route('orders.updateStatus', $order->order_id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="status">Change Status:</label>
        <select name="status_id" id="status" class="form-control" onchange="toggleCheckbox()">
            @foreach($statuses as $status)
                <option value="{{ $status->status_id }}">
                    {{ $status->status_name }}
                </option>
            @endforeach
        </select>
        @if (session('status_error'))
            <div class="alert alert-danger mt-2">
                {{ session('status_error') }}
            </div>
        @endif
        @if (session('status_success'))
            <div class="alert alert-success">
                {{ session('status_success') }}
            </div>
        @endif
    </div>
    <div class="form-group" id="send_email_group" style="display: none;">
        <input type="checkbox" name="send_email" id="send_email" value="1">
        <label for="send_email">Send cancellation email to user</label>
    </div>
       <button type="submit" class="btn btn-primary">Update Status</button>
  </form>
    <!-- Send Email Form -->
    <form action="{{ route('orders.sendEmail', $order->order_id) }}" method="POST">
        @csrf
        <div class="form-group mt-4">
            <label for="title">Email Title:</label>
            <input type="text" name="title" id="title" class="form-control" >
        </div>
        <div class="form-group">
            <label for="message_content">Email Content:</label>
            <textarea name="message_content" id="message_content" class="form-control" rows="5" ></textarea>
        </div>
        @if (session('email_error'))
        <div class="alert alert-danger mt-2">
            {{ session('email_error') }}
        </div>
        @endif
        @if (session('email_success'))
        <div class="alert alert-success">
            {{ session('email_success') }}
        </div>
        @endif
        <button type="submit" class="btn btn-primary">Send Email</button>
    </form>
</div>
<!-- /.container-fluid -->
@endsection
<script>
    function toggleCheckbox() {
        var statusSelect = document.getElementById("status");
        var sendEmailGroup = document.getElementById("send_email_group");
        if (statusSelect.value == "4") {
            sendEmailGroup.style.display = "block";
        } else {
            sendEmailGroup.style.display = "none";
        }
    }
</script>