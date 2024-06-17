@extends('admin.layouts.base')
@section('title', 'Books')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->

    <div class="d-grid d-flex justify-content-between mb-3">
        <h1 class="h3 mb-2 text-gray-800 d-flex align-items-center">Languages</h1>
        <a href="{{route('languages.create')}}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Create</span>
        </a>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Tên ngôn ngữ</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Tên ngôn ngữ</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($languages as $language)
                            <tr>
                                <td>{{ $language->language_id }}</td>
                                <td>{{ $language->language_name}}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('languages.edit', $language->language_id) }}" type="button" class="btn btn-warning">Edit</a> 
                                        <div class="d-flex justify-conten-center">
                                            <form action="{{ route('languages.destroy', $language->language_id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger m-0">Delete</button>
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
                        {{ $languages->links('vendor.pagination.bootstrap-4') }}
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
