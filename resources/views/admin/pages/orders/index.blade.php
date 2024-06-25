@extends('admin.layouts.base')
@section('title', 'Orders')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <!-- Page Heading -->
    <div class="d-grid d-flex justify-content-between mb-3">
        <h1 class="h3 mb-2 text-gray-800 d-flex align-items-center">Orders</h1>
    </div>
    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="data_table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>User Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Order Date</th>
                            <th>Total Price</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Order ID</th>
                            <th>User Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Order Date</th>
                            <th>Total Price</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->order_id }}</td>
                            <td>{{ $order->user->user_name }}</td>
                            <td>{{ $order->user->phone_number }}</td>
                            <td>{{ $order->user->email }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ number_format($order->total_price, 0, ',', '.') }}đ</td>
                            <td>{{ $order->order_address }}</td>
                            <td>
                                <span class="badge badge{{$order->orderStatus->status_id }}">
                                    {{ $order->orderStatus->status_name }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('orders.show', $order->order_id) }}" class="mr-2 text-primary">
                                        <i class="fa-regular fa-eye fa-2xl" style="color: #96baf8;"></i>
                                    </a>
                                    <button type="button" class="btn btn-link p-0 m-0" id="delete_btn" data-toggle="modal" data-target="#confirm_delete_modal_{{ $order->order_id }}">
                                        <i style="color: red" class="fa-regular fa-trash-can fa-2xl"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex">
                    <nav>
                        {{ $orders->links('vendor.pagination.bootstrap-4') }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<!-- Page level plugins -->
<script src="{{ asset('/assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<!-- Page level custom scripts -->
<script src="{{ asset('/assets/js/demo/datatables-demo.js') }}"></script>
@endsection
