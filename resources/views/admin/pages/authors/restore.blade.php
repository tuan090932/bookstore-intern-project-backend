@php
    dd($authors);
@endphp


@extends('admin.layouts.base')
@section('title', 'Restore Authors')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-grid d-flex justify-content-between mb-3">
        <h1 class="h3 mb-2 text-gray-800 d-flex align-items-center">Restore Authors</h1>
        <a href="{{ route('authors.index') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-arrow-left"></i>
            </span>
            <span class="text">Back</span>
        </a>
    </div>

    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tên tác giả</th>
                            <th>Tuổi</th>
                            <th>Ngày sinh</th>
                            <th>Ngày mất</th>
                            <th>Ngày xóa</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tên tác giả</th>
                            <th>Tuổi</th>
                            <th>Ngày sinh</th>
                            <th>Ngày mất</th>
                            <th>Ngày xóa</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($authors as $author)
                            <tr>
                                <td>{{ $author->author_name }}</td>
                                <td>{{ $author->age }}</td>
                                <td>{{ $author->birth_date }}</td>
                                <td>{{ $author->death_date }}</td>
                                <td>{{ $author->deleted_at }}</td>
                                <td>
                                    <form action="{{ route('authors.restore', $author->author_id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-link p-0 m-0">
                                            <svg width="32" height="32" fill="currentColor">
                                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 3.546 8.639.5.5 0 0 1 .708.706A6 6 0 1 1 8 2v1a.5.5 0 0 1-1 0V1a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1H8z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <div class="d-flex">
                    <nav>
                        {{ $authors->links('vendor.pagination.bootstrap-4') }}
                    </nav>
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
