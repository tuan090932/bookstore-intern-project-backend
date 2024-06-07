@extends('admin.layouts.base')
@section('title', 'Create User')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Create User</h1>
<hr class="my-12" />
<!-- DataTales Example -->
<div class="row">
    <div class="col-md-12">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('users.store') }}" method="POST" id="input-form">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="user_name">Username</label>
                    <input type="text" class="form-control" id="user_name" name="user_name" value="{{ old('user_name') }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email') }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="phone_number">Phone number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number') }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}">
                </div>
                <div class="form-group col-md-6">
                    <label for="country_name">Country</label>
                    <input type="text" class="form-control" id="country_name" name="country_name" value="{{ old('country_name') }}">
                </div>
                <div class="form-group col-md-12">
                    <label for="shipping_address">Shipping address</label>
                    <input type="text" class="form-control" id="shipping_address" name="shipping_address" value="{{ old('shipping_address') }}">
                </div>
            </div>

            <hr class="my-12" />

            <!--------------------Button--------------------------->
            <div class="d-grid d-flex justify-content-between">
                <!------ Button Quay Lại ------>
                <a href="javascript:history.back()" asp-action="Index" class="form-group btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Back</span>
                </a>

                <!------ Button Tạo ------>
                <a class="form-group btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <input type="submit" value="Create" class="btn btn-success" />
                </a>
            </div>
        </form>
    </div>
</div>

@endsection