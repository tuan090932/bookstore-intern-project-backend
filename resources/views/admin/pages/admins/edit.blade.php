@extends('admin.layouts.base')
@section('title', 'Edit Admin')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Edit Admin</h1>
<hr class="my-12" />
<div class="row">
    <div class="col-md-12">
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

        <form action="{{ route('admins.update', $admin->admin_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="admin_name">Name</label>
                <input readonly type="text" class="form-control" id="admin_name" name="admin_name" value="{{ old('admin_name', $admin->admin_name) }}" required>
                @if ($errors->has('admin_name'))
                    <span class="text-danger">{{ $errors->first('admin_name') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input readonly type="email" class="form-control" id="email" name="email" value="{{ old('email', $admin->email) }}" required>
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="role_id">Role</label>
                <select class="form-control" id="role_id" name="role_id">
                    @foreach($roles as $role)
                        <option value="{{ $role->role_id }}" {{ $role->role_id == $admin->role_id ? 'selected' : '' }}>{{ $role->role_name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('role_id'))
                    <span class="text-danger">{{ $errors->first('role_id') }}</span>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
@endsection
