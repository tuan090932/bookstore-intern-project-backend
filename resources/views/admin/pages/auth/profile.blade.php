@extends('admin.layouts.base')
@section('title', 'Admin Profile')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Admin Profile</h1>
<hr class="my-12" />
<div class="row">
    <div class="col-md-12">
        <div class="form-row">
            <div class="form-group col-md-6">
                <label>Name</label>
                <input type="text" readonly class="form-control" value="{{ $admin->admin_name }}">
            </div>
            <div class="form-group col-md-6">
                <label>Email</label>
                <input type="email" readonly class="form-control" value="{{ $admin->email }}">
            </div>
            <div class="form-group col-md-6">
                <label>Address</label>
                <input type="text" readonly class="form-control" value="{{ $admin->address }}">
            </div>
            <div class="form-group col-md-6">
                <label>Phone</label>
                <input type="text" readonly class="form-control" value="{{ $admin->phone }}">
            </div>
            <div class="form-group col-md-6">
                <label>Role</label>
                <input type="text" readonly class="form-control" value="{{ $role->role_name }}">
            </div>
        </div>
        <a href="{{ route('admin.profile.edit') }}" class="btn btn-primary">Edit Profile</a>
    </div>
</div>
@endsection
