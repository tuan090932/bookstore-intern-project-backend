@extends('admin.layouts.base')
@section('title', 'Books')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-grid d-flex justify-content-between mb-3">
        <h1 class="h3 mb-2 text-gray-800 d-flex align-items-center">Books</h1>
        <a href="{{ route('books.create') }}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Create</span>
        </a>
    </div>

    <!-- Display success/error messages -->
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
                            <th>Tên sách</th>
                            <th>Danh mục</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Số lượng trang</th>
                            <th>Tác giả</th>
                            <th>Đơn vị phát hành</th>
                            <th>Ngôn ngữ</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tên sách</th>
                            <th>Danh mục</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Số lượng trang</th>
                            <th>Tác giả</th>
                            <th>Đơn vị phát hành</th>
                            <th>Ngôn ngữ</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->categories ? $book->categories->category_name : 'N/A' }}</td>
                                <td>{{ number_format($book->price, 0, ',', '.') }}đ</td>
                                <td>{{ $book->stock }}</td>
                                <td>{{ $book->num_pages }}</td>
                                <td>{{ $book->authors ? $book->authors->author_name : 'N/A' }}</td>
                                <td>{{ $book->publishers ? $book->publishers->publisher_name : 'N/A' }}</td>
                                <td>{{ $book->languages ? $book->languages->language_name : 'N/A' }}</td>
                                <td>
                                    <div class="d-flex  justify-content-center">
                                        <a href="{{ route('books.edit', $book->book_id)}}" class="mr-2 text-success">
                                            <i style="color: #1CC88A" class="fa-regular fa-pen-to-square fa-2xl"></i>
                                        </a>
                                        <div class="d-flex justify-content-center">
                                            <form action="{{ route('books.destroy', $book->book_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-link p-0 m-0" id="delete-btn">
                                                    <i style="color: red" class="fa-regular fa-trash-can fa-2xl"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex">
                    <nav>
                        {{ $books->links('vendor.pagination.bootstrap-4') }}
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
