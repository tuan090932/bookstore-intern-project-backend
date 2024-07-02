@extends('admin.layouts.base')
@section('title', 'Users')
@section('head')
<!-- Custom styles for this page -->
<link href="{{ asset('/assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-grid d-flex justify-content-between mb-3">
        <h1 class="h3 mb-2 text-gray-800 d-flex align-items-center">Users</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Create</span>
        </a>
    </div>

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>City</th>
                            <th>Shipping address</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>City</th>
                            <th>Shipping address</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->user_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>{{ optional($user->addresses)->city }}</td>
                            <td>{{ optional($user->addresses)->shipping_address }}</td>
                            <td>
                                <div class="d-flex  justify-content-center">
                                    <a href="{{ route('users.edit', $user->user_id) }}" class="mr-2 text-success">
                                        <i style="color: #1CC88A" class="fa-regular fa-pen-to-square fa-2xl"></i>
                                    </a>
                                    <button type="button" class="btn btn-link p-0 m-0" data-user-id="{{ $user->user_id }}" id="delete-btn">
                                        <i style="color: red" class="fa-regular fa-trash-can fa-2xl"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <!-- Pagination Links -->
                <div class="d-flex">
                    <nav>
                        {{ $users->links() }}
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
<script src="{{ asset('assets/js/common.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const commonConfig = {
            title: "Confirm Delete",
            method: 'DELETE',
            confirmText: "Delete"
        };
        const deleteButtons = document.querySelectorAll('#delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const userId = this.getAttribute('data-user-id');
                ACTION_URL = "{{ route('users.destroy', ':id') }}".replace(':id', userId);
                body = "Are you sure you want to delete this user?";

                showModalConfirmation([userId], ACTION_URL, commonConfig.title, body, commonConfig.method, commonConfig.confirmText);
            });
        });
    });
</script>
@endsection
