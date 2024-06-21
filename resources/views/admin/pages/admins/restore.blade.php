@extends('admin.layouts.base')
@section('title', 'Restore Admins')
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-grid d-flex justify-content-between mb-3">
        <h1 class="h3 mb-2 text-gray-800 d-flex align-items-center">Restore Admins</h1>
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
                'body' => 'Are you sure you want to restore the selected admin users?',
                'formId' => 'bulk-restore-form',
                'formAction' => route('admins.restore-selected'),
                'method' => 'PATCH',
                'inputId' => 'admin_ids',
                'confirmText' => 'Restore'
            ])
            @endcomponent

            <button class="btn btn-success btn-icon-split" id="restore-all-btn" data-toggle="modal" data-target="#confirm-restore-all-modal">
                <span class="icon text-white-50">
                    <i class="fas fa-trash-restore"></i>
                </span>
                <span class="text">Restore All</span>
            </button>
            <!-- Confirm Restore All Modal -->
            @component('components.confirm-modal', [
                'id' => 'confirm-restore-all-modal',
                'labelId' => 'confirm-restore-all-modal-label',
                'title' => 'Confirm Restore All',
                'body' => 'Are you sure you want to restore all admin users?',
                'formId' => 'restore-all-form',
                'formAction' => route('admins.restore-all'),
                'method' => 'PATCH',
                'inputId' => 'admin_ids',
                'confirmText' => 'Restore'
            ])
            @endcomponent
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
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($admins as $admin)
                        <tr>
                            <td><input type="checkbox" name="admin_ids[]" value="{{ $admin->id }}"></td>
                            <td>{{ $admin->id }}</td>
                            <td>{{ $admin->admin_name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->role->role_name }}</td>
                            <td>
                                <button type="button" class="btn btn-link p-0 m-0" data-toggle="modal" data-target="#confirm-restore-modal-{{ $admin->id }}">
                                    <i style="font-size: 28px; color: #18b97e;" class="fas fa-trash-restore"></i>
                                </button>
                                <!-- Confirm Restore Modal -->
                                @component('components.confirm-modal', [
                                    'id' => 'confirm-restore-modal-'.$admin->id,
                                    'labelId' => 'confirm-restore-modal-label-'.$admin->id,
                                    'title' => 'Confirm Restore',
                                    'body' => 'Are you sure you want to restore this admin user?',
                                    'formId' => 'restore-form-'.$admin->id,
                                    'formAction' => route('admins.restore', ['id' => $admin->id]),
                                    'method' => 'PATCH',
                                    'inputId' => $admin->id,
                                    'confirmText' => 'Restore'
                                ])
                                @endcomponent
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

@endsection
