@extends('admin.layouts.base')
@section('title', 'Restore Authors')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-grid d-flex justify-content-between mb-3">
        <h1 class="h3 mb-2 text-gray-800 d-flex align-items-center">Restore Authors</h1>
        <div>
            <button class="btn btn-success btn-icon-split" id="selected-restore-btn" data-toggle="modal" data-target="#confirm-restore-modal">
                <span class="icon text-white-50">
                    <i class="fas fa-trash-restore"></i>
                </span>
                <span class="text">Restore Selected</span>
            </button>
            <!-- Confirm Restore Selected Modal -->
            @component('components.confirm-modal', [
                'id' => 'confirm-restore-modal',
                'labelId' => 'confirm-restore-modal-label',
                'title' => 'Confirm Restore',
                'body' => 'Bạn có chắc chắn muốn khôi phục những tác giả được chọn này không?',
                'formId' => 'bulk-restore-form',
                'formAction' => route('authors.restore-selected'),
                'method' => 'PATCH',
                'inputId' => 'author_ids',
                'confirmText' => 'Restore'
            ])
            @endcomponent

            <button class="btn btn-success btn-icon-split" id="restore-all-btn" data-toggle="modal" data-target="#confirm-restore-all-modal">
                <span class="icon text-white-50">
                    <i class="fas fa-trash-restore"></i>
                </span>
                <span class="text">Delete All</span>
            </button>
            <!-- Confirm Restore All Modal -->
            @component('components.confirm-modal', [
                'id' => 'confirm-restore-all-modal',
                'labelId' => 'confirm-restore-all-modal-label',
                'title' => 'Confirm Restore',
                'body' => 'Bạn có chắc chắn muốn xóa tất cả các tác giả không?',
                'formId' => 'restore-all-form',
                'formAction' => route('authors.restore-all'),
                'method' => 'PATCH',
                'inputId' => 'author_ids',
                'confirmText' => 'Restore'
            ])
            @endcomponent

            <a href="{{ route('authors.index') }}" class="btn btn-secondary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">Back</span>
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
                                <td>{{ $author->death_date ? $author->death_date : '------------' }}</td>
                                <td>{{ $author->national }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <button type="button" class="btn btn-link p-0 m-0" id="restore-btn" data-toggle="modal" data-target="#confirm-restore-modal-{{ $author->author_id }}">
                                            <i style="font-size: 28px; color: #18b97e;" class="fa-solid fa-trash-can-arrow-up"></i>
                                        </button>
                                        <!-- Confirm Restore Modal -->
                                        @component('components.confirm-modal', [
                                            'id' => 'confirm-restore-modal-'.$author->author_id,
                                            'labelId' => 'confirm-restore-modal-label-'.$author->author_id,
                                            'title' => 'Confirm Restore',
                                            'body' => 'Bạn có chắc chắn muốn khôi phục tác giả này không?',
                                            'formId' => 'restore-form-'.$author->author_id,
                                            'formAction' => route('authors.restore', ['id' => $author->author_id]),
                                            'method' => 'PATCH',
                                            'inputId' => $author->author_id,
                                            'confirmText' => 'Restore'
                                        ])
                                        @endcomponent
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
<script src="{{ asset('/assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/assets/js/demo/datatables-demo.js') }}"></script>
<script src="{{ asset('/assets/js/checkbox-handler.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        initializeCheckboxes('select-all', 'select-all-footer', 'author_ids[]', 'selected-restore-btn', 'author_ids');
    });
</script>

@endsection

