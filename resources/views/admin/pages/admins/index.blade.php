@extends('admin.layouts.base')
@section('title', 'Managers')
@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-grid d-flex justify-content-between mb-3">
            <h1 class="h3 mb-2 text-gray-800 d-flex align-items-center">Admin Accounts</h1>
            <div>
                <a href="{{ route('admins.trashed') }}" class="btn btn-secondary btn-icon-split mr-2">
                    <span class="icon text-white-50">
                        <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">Trashed Admins</span>
                </a>
                <button class="btn btn-danger btn-icon-split" id="admins-selected-delete-btn" data-toggle="modal" data-target="#confirm-delete-modal">
                    <span class="icon text-white-50">
                        <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">Delete Selected</span>
                </button>
                <!-- Confirm Delete Selected Modal -->
                @component('components.confirm-modal', [
                    'id' => 'confirm-delete-modal',
                    'labelId' => 'confirm-delete-modal-label',
                    'title' => 'Confirm Delete',
                    'body' => 'Bạn có chắc chắn muốn xóa những admin được chọn này không?',
                    'formId' => 'bulk-delete-form',
                    'formAction' => route('admins.delete-selected'),
                    'method' => 'DELETE',
                    'inputId' => 'admin_ids',
                    'confirmText' => 'Delete'
                ])
                @endcomponent

                <button class="btn btn-danger btn-icon-split" id="delete-all-btn" data-toggle="modal" data-target="#confirm-delete-all-modal">
                    <span class="icon text-white-50">
                        <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">Delete All</span>
                </button>
                <!-- Confirm Delete All Modal -->
                @component('components.confirm-modal', [
                    'id' => 'confirm-delete-all-modal',
                    'labelId' => 'confirm-delete-all-modal-label',
                    'title' => 'Confirm Delete',
                    'body' => 'Bạn có chắc chắn muốn xóa tất cả các admin không?',
                    'formId' => 'delete-all-form',
                    'formAction' => route('admins.delete-all'),
                    'method' => 'DELETE',
                    'inputId' => 'admin_ids',
                    'confirmText' => 'Delete'
                ])
                @endcomponent

                <a href="{{ route('admins.create') }}" class="btn btn-primary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Create</span>
                </a>
            </div>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>ID</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Quyền</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th><input type="checkbox" id="select-all-footer"></th>
                                <th>ID</th>
                                <th>Họ tên</th>
                                <th>Email</th>
                                <th>Quyền</th>
                                <th>Options</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td><input type="checkbox" name="admin_ids[]" value="{{ $admin->admin_id }}"></td>
                                    <td>{{ $admin->admin_id }}</td>
                                    <td>{{ $admin->admin_name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->roles->role_name }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('admins.edit', $admin->admin_id) }}" class="mr-2 text-success">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                                </svg>
                                            </a>
                                            <button type="button" class="btn btn-link p-0 m-0" id="delete-btn" data-toggle="modal" data-target="#confirm-delete-modal-{{ $admin->admin_id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                                </svg>
                                            </button>
                                            <!-- Modal for Delete Confirmation -->
                                            @component('components.confirm-modal', [
                                                'id' => 'confirm-delete-modal-'.$admin->admin_id,
                                                'labelId' => 'confirm-delete-modal-label-'.$admin->admin_id,
                                                'title' => 'Confirm Delete',
                                                'body' => 'Are you sure you want to delete this admin?',
                                                'formId' => 'delete-form-'.$admin->admin_id,
                                                'formAction' => route('admins.destroy', ['admin' => $admin->admin_id]),
                                                'method' => 'DELETE',
                                                'inputId' => $admin->admin_id,
                                                'confirmText' => 'Delete'
                                            ])
                                            @endcomponent
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex">
                        <nav>
                            {{ $admins->links('vendor.pagination.bootstrap-4') }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.container-fluid -->
    <script src="{{ asset('/assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/vendor/bootstrap/scss/_tables.scss') }}"></script>
    <script src="{{ asset('/assets/js/demo/datatables-demo.js') }}"></script>
    <script src="{{ asset('/assets/js/checkbox-handler.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            initializeCheckboxes('select-all', 'select-all-footer', 'admin_ids[]', 'admins-selected-delete-btn', 'admin_ids');
        });
    </script>

@endsection
