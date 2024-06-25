@extends('admin.layouts.base')
@section('title', 'Categories')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-grid d-flex justify-content-between mb-3">
        <h1 class="h3 mb-2 text-gray-800 d-flex align-items-center">Categories</h1>
        <a href="{{route('categories.create')}}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Create</span>
        </a>
    </div>
    <!-- Flash Message for Success or Error -->
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @elseif (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="data_table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Categories Name</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Categories Name</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->category_id }}</td>
                            <td >
                                {{ $category->category_name }}
                                @if ($errors->has('category_' . $category->category_id))
                                    <div class="alert alert-danger">
                                        {{ $errors->first('category_' . $category->category_id) }}
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center">
                                    <a href="{{ route('categories.edit', $category->category_id)}}" class="mr-2 text-success">
                                        <i style="color: #1CC88A" class="fa-regular fa-pen-to-square fa-2xl"></i>
                                    </a>
                                    <button type="button" class="btn btn-link p-0 m-0" id="delete_btn" data-toggle="modal" data-target="#confirm_delete_modal_{{ $category->category_id }}">
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
                        {{ $categories->links('vendor.pagination.bootstrap-4') }}
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
