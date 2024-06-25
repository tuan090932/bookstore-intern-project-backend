@extends('admin.layouts.base')
@section('title', 'Managers')
@section('content')
     <!-- Begin Page Content -->
     <div class="container-fluid">
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
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
                <button class="btn btn-danger btn-icon-split" id="admins-selected-delete-btn" data-toggle="modal">
                    <span class="icon text-white-50">
                        <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">Delete Selected</span>
                </button>
                <button class="btn btn-danger btn-icon-split" id="admins-delete-all-btn" data-toggle="modal">
                    <span class="icon text-white-50">
                        <i class="fas fa-trash"></i>
                    </span>
                    <span class="text">Delete All</span>
                </button>
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
                                <th><input type="checkbox" id="select-all-header"></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th><input type="checkbox" id="select-all-footer"></th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Options</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($admins as $admin)
                                <tr>
                                    <td>
                                        @if($admin->admin_id !== $currentAdmin->admin_id)
                                            <input type="checkbox" name="admin_ids[]" value="{{ $admin->admin_id }}">
                                        @endif
                                    </td>
                                    <td>{{ $admin->admin_name }}</td>
                                    <td>{{ $admin->email }}</td>
                                    <td>{{ $admin->roles->role_name }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            @if($admin->admin_id !== $currentAdmin->admin_id)
                                                <a href="{{ route('admins.edit', $admin->admin_id) }}" class="mr-2 text-success">
                                                    <i style="color: #1CC88A" class="fa-regular fa-pen-to-square fa-2xl"></i>
                                                </a>
                                                <button type="button" class="btn btn-link p-0 m-0" data-admin-id="{{ $admin->admin_id }}" id="delete-btn">
                                                    <i style="color: red" class="fa-regular fa-trash-can fa-2xl"></i>
                                                </button>
                                            @endif
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
    <script src="{{ asset('/assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/assets/js/demo/datatables-demo.js') }}"></script>

    <script src="{{ asset('assets/js/common.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeCheckboxes('select-all-header', 'select-all-footer', 'admin_ids[]');

            const commonConfig = {
                title: "Confirm Delete",
                method: 'DELETE',
                confirmText: "Delete"
            };

            const deleteSelected = document.getElementById('admins-selected-delete-btn');
            if (deleteSelected) {
                deleteSelected.addEventListener('click', function() {
                    const selectedIds = Array.from(document.querySelectorAll('input[name="admin_ids[]"]:checked'))
                        .map(checkbox => checkbox.value);

                    const ACTION_URL = "{{ route('admins.delete-selected') }}";
                    const body = "Are you sure you want to delete the selected admins?";

                    showModalConfirmation(selectedIds, ACTION_URL, commonConfig.title, body, commonConfig.method, commonConfig.confirmText);
                });
            }

            const deleteAllBtn = document.getElementById('admins-delete-all-btn');
            if (deleteAllBtn) {
                deleteAllBtn.addEventListener('click', function() {
                    const ACTION_URL = "{{ route('admins.delete-all') }}";
                    const body = "Are you sure you want to delete all admins?";

                    showModalConfirmation([], ACTION_URL, commonConfig.title, body, commonConfig.method, commonConfig.confirmText);
                });
            }

            const deleteButtons = document.querySelectorAll('#delete-btn');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const adminId = this.getAttribute('data-admin-id');
                    const ACTION_URL = "{{ route('admins.destroy', ':id') }}".replace(':id', adminId);
                    const body = "Are you sure you want to delete this admin?";

                    showModalConfirmation([adminId], ACTION_URL, commonConfig.title, body, commonConfig.method, commonConfig.confirmText);
                });
            });
        });
    </script>

@endsection
