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
        grid-template-columns: repeat(2,1fr) !important;
        grid-gap: 30px;
    }
</style>
<h1 class="h3 mb-2 text-gray-800 d-flex align-items-center">Dashboard</h1>

    <!-- cards -->
    <div class="cardBox">
        <div class="card">
            <div>
                <div class="number">100</div>
                <div class="cardName">Đang bán</div>
            </div>
            <div class="iconBox">
                <ion-icon name="cart-outline"></ion-icon>
            </div>
        </div>
        <div class="card">
            <div>
                <div class="number">90.000.000</div>
                <div class="cardName">Thu nhập</div>
            </div>
            <div class="iconBox">
                <ion-icon name="cash-outline"></ion-icon>
            </div>
        </div>
    </div>

    <!-- order detail list -->
    <div class="detail">
        <div class="recentOders">
            <div class="cardHeader">
                <h2>Recent Oders</h2>
                <a href="#" class="btn">View All</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <td>Tên sản phẩm</td>
                        <td>Giá</td>
                        <td>Tình trạng thanh toán</td>
                        <td>Giao hàng</td>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>LOGITECH G502</td>
                        <td>2.150.000đ</td>
                        <td>Quá hạn thanh toán</td>
                        <td><span class="status inProgress">Đang xử lý</span></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td>Kit V65</td>
                        <td>2.150.000đ</td>
                        <td>Đã thanh toán</td>
                        <td><span class="status delivered">Đã giao hàng</span></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td>LOGITECH G502</td>
                        <td>2.150.000đ</td>
                        <td>Quá hạn thanh toán</td>
                        <td><span class="status pending">Đang chờ thanh toán</span></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td>Kit V65</td>
                        <td>2.150.000đ</td>
                        <td>Đã thanh toán</td>
                        <td><span class="status return">Hoàn trả</span></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td>LOGITECH G502</td>
                        <td>2.150.000đ</td>
                        <td>Quá hạn thanh toán</td>
                        <td><span class="status inProgress">Đang xử lý</span></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td>Kit V65</td>
                        <td>2.150.000đ</td>
                        <td>Đã thanh toán</td>
                        <td><span class="status delivered">Đã giao hàng</span></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td>LOGITECH G502</td>
                        <td>2.150.000đ</td>
                        <td>Quá hạn thanh toán</td>
                        <td><span class="status pending">Đang chờ thanh toán</span></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td>Kit V65</td>
                        <td>2.150.000đ</td>
                        <td>Đã thanh toán</td>
                        <td><span class="status return">Hoàn trả</span></td>
                    </tr>
                </tbody>
                <tbody>
                    <tr>
                        <td>LOGITECH G502</td>
                        <td>2.150.000đ</td>
                        <td>Quá hạn thanh toán</td>
                        <td><span class="status inProgress">Đang xử lý</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- order detail list -->
        <div class="recentCustomers">
            <div class="cardHeader">
                <h2>Recent Customers</h2>
            </div>
            <table>
                <tr>
                    <td>
                        <h4>Huy<br><span>TP.Hồ Chí Minh</span></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>Huy<br><span>TP.Hồ Chí Minh</span></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>Huy<br><span>TP.Hồ Chí Minh</span></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>Huy<br><span>TP.Hồ Chí Minh</span></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>Huy<br><span>Hà Nội</span></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>Huy<br><span>Hà Nội</span></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>Huy<br><span>Hà Nội</span></h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>Huy<br><span>Hà Nội</span></h4>
                    </td>
                </tr>
            </table>
        </div>
    </div>

<!-- <script src="/admin page/assets/js/admin-script.js"></script> -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
@endsection