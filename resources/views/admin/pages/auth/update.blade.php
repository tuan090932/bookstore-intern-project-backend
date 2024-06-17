@extends('admin.layouts.base')
@section('title', 'Update Admin Profile')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Update Admin Profile</h1>
<hr class="my-12" />
<div class="row">
    <div class="col-md-12">
        <form action="{{ route('admin.profile.update', $admin->admin_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="admin_name">Name</label>
                    <input type="text" readonly class="form-control @error('admin_name') is-invalid @enderror" id="admin_name" name="admin_name" value="{{ $admin->admin_name }}">
                    @error('admin_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="email" readonly class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $admin->email }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="address">Address</label>
                    <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ $admin->address }}">
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $admin->phone }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-success btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-check"></i>
                </span>
                <span class="text">Update</span>
            </button>
        </form>
    </div>
</div>
@endsection
