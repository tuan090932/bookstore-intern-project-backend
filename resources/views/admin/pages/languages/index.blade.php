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
                            <th>Tên ngôn ngữ</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tên ngôn ngữ</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($languages as $language)
                            <tr>
                                <td>{{ $language->language_name}}</td>
                                <td>
                                <div class="d-flex  justify-content-left">
                                        <a href="{{ route('languages.edit', $language->language_id)}}" class="mr-2 text-success">
                                            <i style="color: #1CC88A" class="fa-regular fa-pen-to-square fa-2xl"></i>
                                        </a>
                                        <button type="button" class="btn btn-link p-0 m-0" data-language-id="{{ $language->language_id }}" id="delete-btn">
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
                const languageId = this.getAttribute('data-language-id');
                ACTION_URL = "{{ route('languages.destroy', ':id') }}".replace(':id', languageId);
                body = "Are you sure you want to delete this language?";

                showModalConfirmation([languageId], ACTION_URL, commonConfig.title, body, commonConfig.method, commonConfig.confirmText);
            });
        });
    });
</script>
@endsection
