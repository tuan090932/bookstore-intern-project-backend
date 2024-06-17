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
            <button class="btn btn-danger btn-icon-split" id="selected-delete-btn">
                <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                </span>
                <span class="text">Delete Selected</span>
            </button>
            <button class="btn btn-danger btn-icon-split" id="delete-all-btn">
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
                <form id="selected-delete-form" method="POST" action="{{ route('authors.deleteSelected') }}">
                    @csrf
                    @method('DELETE')
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
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
                                <th>Quốc tịch</th>
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
                                    <td>{{ $author->death_date ? $author->death_date : '-------------' }}</td>
                                <td>{{ $author->national }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('authors.edit', $author->author_id) }}" class="mr-2 text-success">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"></path>
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"></path>
                                                </svg>
                                            </a>
                                            <form id="delete-form-{{ $author->author_id }}" action="{{ route('authors.destroy', $author->author_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="button" class="btn btn-link p-0 m-0" data-toggle="modal" data-target="#confirmDeleteModal-{{ $author->author_id }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                    </svg>
                                                </button>
                                            </form>

                                            <!-- Modal -->
                                            <div style="top: 200px !important;" class="modal fade" id="confirmDeleteModal-{{ $author->author_id }}" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel-{{ $author->author_id }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmDeleteModalLabel-{{ $author->author_id }}">Confirm Deletion</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Bạn có chắc chắn muốn xóa tác giả này không?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <button type="button" class="btn btn-danger" onclick="document.getElementById('delete-form-{{ $author->author_id }}').submit();">Delete</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
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

<script>
    document.getElementById('select-all').addEventListener('click', function(e) {
        const checkboxes = document.querySelectorAll('input[name="author_ids[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
    });

    document.getElementById('select-all-footer').addEventListener('click', function(e) {
        const checkboxes = document.querySelectorAll('input[name="author_ids[]"]');
        checkboxes.forEach(checkbox => checkbox.checked = e.target.checked);
    });

    document.getElementById('selected-delete-btn').addEventListener('click', function() {
        document.getElementById('selected-delete-form').submit();
    });

    document.getElementById('delete-all-btn').addEventListener('click', function() {
        if (confirm('Are you sure you want to delete all authors?')) {
            window.location.href = "{{ route('authors.delete-all') }}";
        }
    });
</script>
@endsection
