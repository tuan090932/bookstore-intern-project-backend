@extends('admin.layouts.base')
@section('title', 'authors')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-grid d-flex justify-content-between mb-3">
        <h1 class="h3 mb-2 text-gray-800 d-flex align-items-center">Authors</h1>
        <div>
            <a href="{{ route('authors.trashed') }}" class="btn btn-secondary btn-icon-split mr-2">
                <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                </span>
                <span class="text">Trashed Authors</span>
            </a>
            <button class="btn btn-danger btn-icon-split" id="authors-selected-delete-btn" data-toggle="modal">
                <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                </span>
                <span class="text">Delete Selected</span>
            </button>
            <button class="btn btn-danger btn-icon-split" id="authors-delete-all-btn" data-toggle="modal">
                <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                </span>
                <span class="text">Delete All</span>
            </button>
            <a href="{{ route('authors.create') }}" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Create</span>
            </a>
        </div>
    </div>

    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all-header"></th>
                            <th>Tên tác giả</th>
                            <th>Tuổi</th>
                            <th>Ngày sinh</th>
                            <th>Ngày mất</th>
                            <th>Quốc tịch</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th><input type="checkbox" id="select-all-footer"></th>
                            <th>Tên tác giả</th>
                            <th>Tuổi</th>
                            <th>Ngày sinh</th>
                            <th>Ngày mất</th>
                            <th>Quốc tch</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($authors as $author)
                            <tr>
                                <td><input type="checkbox" name="author_ids[]" value="{{ $author->author_id }}"></td>
                                <td>{{ $author->author_name }}</td>
                                <td>{{ $author->age }}</td>
                                <td>{{ $author->birth_date }}</td>
                                <td>{{ $author->death_date ? $author->death_date : '------------' }}</td>
                                <td>{{ $author->national }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="" class="mr-2 text-success">
                                            <i style="color: #1CC88A" class="fa-regular fa-pen-to-square fa-2xl"></i>
                                        </a>
                                        <button type="button" class="btn btn-link p-0 m-0" data-author-id="{{ $author->author_id }}" id="delete-btn">
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
                        {{ $authors->links('vendor.pagination.bootstrap-4') }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /.container-fluid -->
<script src="{{ asset('/assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/assets/js/demo/datatables-demo.js') }}"></script>

<script src="{{ asset('assets/js/common.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        initializeCheckboxes('select-all-header', 'select-all-footer', 'author_ids[]');

        const commonConfig = {
            title: "Confirm Delete",
            method: 'DELETE',
            confirmText: "Delete"
        };

        const deleteSelected = document.getElementById('authors-selected-delete-btn');
        if (deleteSelected) {
            deleteSelected.addEventListener('click', function() {
                const selectedIds = Array.from(document.querySelectorAll('input[name="author_ids[]"]:checked'))
                    .map(checkbox => checkbox.value);

                ACTION_URL = "{{ route('authors.delete-selected') }}";
                body = "Are you sure you want to delete the selected authors?";

                showModalConfirmation(selectedIds, ACTION_URL, commonConfig.title, body, commonConfig.method, commonConfig.confirmText);
            });
        }

        const deleteAllBtn = document.getElementById('authors-delete-all-btn');
        if (deleteAllBtn) {
            deleteAllBtn.addEventListener('click', function() {
                ACTION_URL = "{{ route('authors.delete-all') }}";
                body = "Are you sure you want to delete all authors?";

                showModalConfirmation([], ACTION_URL, commonConfig.title, body, commonConfig.method, commonConfig.confirmText);
            });
        }

        const deleteButtons = document.querySelectorAll('#delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const authorId = this.getAttribute('data-author-id');
                ACTION_URL = "{{ route('authors.destroy', ':id') }}".replace(':id', authorId);
                body = "Are you sure you want to delete this author?";

                showModalConfirmation([authorId], ACTION_URL, commonConfig.title, body, commonConfig.method, commonConfig.confirmText);
            });
        });
    });
</script>

@endsection
