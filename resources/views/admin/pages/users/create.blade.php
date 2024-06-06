@extends('admin.layouts.base')
@section('title', 'Create User')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Create User</h1>
<hr class="my-12" />
<!-- DataTales Example -->
<div class="row">
    <div class="col-md-12">
        <form id="input-form">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="username">Username</label>
                    <input type="text" class="form-control" id="username" name="username">
                </div>
                <div class="form-group col-md-6">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email">
                </div>
                <div class="form-group col-md-6">
                    <label for="phoneNumber">Phone number</label>
                    <input type="text" class="form-control" id="phoneNumber" name="phoneNumber">
                </div>
                <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password">
                </div>
                <div class="form-group col-md-6">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city">
                </div>
                <div class="form-group col-md-6">
                    <label for="countryName">Country</label>
                    <input type="text" class="form-control" id="countryName" name="countryName">
                </div>
                <div class="form-group col-md-12">
                    <label for="shippingAddress">Shipping address</label>
                    <input type="text" class="form-control" id="shippingAddress" name="shippingAddress">
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