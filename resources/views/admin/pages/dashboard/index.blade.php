@extends('admin.layouts.base')
@section('title', 'Dashboard')
@section('head')
<link rel="stylesheet" href="{{ asset('/assets/css/admin-index.css') }}">
<link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
@endsection

@section('content')
<style>
    .cardBox
    {
        position: relative;
        width: 100%;
        padding: 20px;
        display: grid;
        grid-template-columns: repeat(3,1fr) !important;
        grid-gap: 30px;
    }
</style>
    <div class="container-fluid">
        <div class="d-grid d-flex justify-content-between">
            <h1 class="h3 mb-2 text-gray-800 d-flex align-items-center">Dashboard</h1>
            @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
            @endif
        </div>
        <!-- cards -->
        <div class="cardBox">
            <div class="card">
                <div>
                    <div class="number">{{ $totalBooksInStock }}</div>
                    <div class="cardName">In Stock</div>
                </div>
                <div class="iconBox">
                    <i class="fa-solid fa-cart-shopping fa-2xs"></i>
                </div>
            </div>
            <div class="card">
                <div>
                    <div class="number">{{ $totalDistinctTitles }}</div>
                    <div class="cardName">Books</div>
                </div>
                <div class="iconBox">
                    <i class="fa-solid fa-book fa-2xs"></i>
                </div>
            </div>
            <div class="card">
                <div>
                    <div class="number">{{ number_format($getTotalRevenue, 0, ',', '.') }}đ</div>
                    <div class="cardName">Income</div>
                </div>
                <div class="iconBox">
                    <i class="fa-regular fa-money-bill-1 fa-2xs"></i>
                </div>
            </div>
        </div>
        <!-- order detail list -->
        <div class="detail">
            <div class="recentOders">
                <div class="cardHeader">
                    <h2>Recent Orders</h2>
                    <a href="{{ route('orders.index') }}" class="btn">View All</a>
                </div>
                <table>
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Phone Number</td>
                            <td>Email</td>
                            <td>Order Date</td>
                            <td>Price</td>
                            <td>Status</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentOrders as $order)
                        <tr>
                            <td>{{ $order->user->name }}</td>
                            <td>{{ $order->user->phone_number }}</td>
                            <td>{{ $order->user->email }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ number_format($order->total_price, 0, ',', '.') }}đ</td>
                            <td>
                                <td>
                                    <span class="badge badge{{$order->orderStatus->status_id }}">
                                        {{ $order->orderStatus->status_name }}
                                    </span>
                                </td>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- order detail list -->
            <div class="recentCustomers">
                <div class="cardHeader">
                    <h2>Recent Customers</h2>
                </div>
                <table>
                    @foreach ($recentCustomers as $customer)
                        <tr>
                            <td>
                                <h4>{{ $customer->name }}</h4>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
<!-- <script src="/admin page/assets/js/admin-script.js"></script> -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
@endsection
