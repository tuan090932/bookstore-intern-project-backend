@extends('admin.layouts.base')
@section('title', 'Restore Admins')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-grid d-flex justify-content-between mb-3">
        <h1 class="h3 mb-2 text-gray-800 d-flex align-items-center">Restore Admins</h1>
        <div>
            <button class="btn btn-success btn-icon-split" id="selected-restore-btn">
                <span class="icon text-white-50">
                    <i class="fas fa-trash-restore"></i>
                </span>
                <span class="text">Restore Selected</span>
            </button>
            <button class="btn btn-success btn-icon-split" id="restore-all-btn">
                <span class="icon text-white-50">
                    <i class="fas fa-trash-restore"></i>
                </span>
                <span class="text">Restore All</span>
            </button>
            <a href="{{ route('admins.index') }}" class="btn btn-secondary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">Back</span>
            </a>
        </div>
    </div>

    <!-- Table to display trashed admins -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all"></th>
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
                            <td><input type="checkbox" name="admin_ids[]" value="{{ $admin->admin_id }}"></td>
                            <td>{{ $admin->admin_name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->roles->role_name }}</td>
                            <td>
                                <button type="button" class="btn btn-link p-0 m-0 restore-btn" data-admin-id="{{ $admin->admin_id }}">
                                    <i style="font-size: 28px; color: #18b97e;" class="fas fa-trash-restore"></i>
                                </button>
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
<script src="{{ asset('assets/js/common.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        initializeCheckboxes('select-all', 'select-all-footer', 'admin_ids[]');

        const commonConfig = {
            title: "Confirm Restore",
            method: 'PATCH',
            confirmText: "Restore"
        };

        const restoreSelected = document.getElementById('selected-restore-btn');
        if (restoreSelected) {
            restoreSelected.addEventListener('click', function() {
                const selectedIds = Array.from(document.querySelectorAll('input[name="admin_ids[]"]:checked'))
                    .map(checkbox => checkbox.value);

                const ACTION_URL = "{{ route('admins.restore-selected') }}";
                const body = "Are you sure you want to restore the selected admin users?";

                showModalConfirmation(selectedIds, ACTION_URL, commonConfig.title, body, commonConfig.method, commonConfig.confirmText);
            });
        }

        const restoreAllBtn = document.getElementById('restore-all-btn');
        if (restoreAllBtn) {
            restoreAllBtn.addEventListener('click', function() {
                const ACTION_URL = "{{ route('admins.restore-all') }}";
                const body = "Are you sure you want to restore all admin users?";

                showModalConfirmation([], ACTION_URL, commonConfig.title, body, commonConfig.method, commonConfig.confirmText);
            });
        }

        const restoreButtons = document.querySelectorAll('.restore-btn');
        restoreButtons.forEach(button => {
            button.addEventListener('click', function() {
                const adminId = this.getAttribute('data-admin-id');
                const ACTION_URL = "{{ route('admins.restore', ':id') }}".replace(':id', adminId);
                const body = "Are you sure you want to restore this admin user?";

                showModalConfirmation([adminId], ACTION_URL, commonConfig.title, body, commonConfig.method, commonConfig.confirmText);
            });
        });
    });
</script>

@endsection
