@extends('admin.layouts.base')
@section('title', 'Edit User')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Edit User</h1>
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
        <form action="{{ route('users.update', $user->user_id) }}" method="POST" id="input-form">
            @csrf
            @method('PUT')
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
                    <input type="submit" value="Update" class="btn btn-success" />
                </a>
            </div>
            <div class="form-row">
                <div class="form-group col-md-5">
                    <label for="user_name">Username</label>
                    <input type="text" class="form-control" id="user_name" name="user_name" value="{{ old('user_name', $user->user_name) }}">
                </div>
                <div class="form-group col-md-4">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="phone_number">Phone number</label>
                    <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                </div>
                <!-- <div class="form-group col-md-6">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                </div> -->
            </div>
        </form>
        <form action="{{ route('addresses.store') }}" method="POST">
            @csrf
            <div class="form-row">
                <input type="hidden" id="user_id" name="user_id" value="{{ $user->user_id }}">

                <div class="form-group col-md-4">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="{{ old('city') }}">
                </div>
                <div class="form-group col-md-3">
                    <label for="country_name">Country</label>
                    <input type="text" class="form-control" id="country_name" name="country_name" value="{{ old('country_name') }}">
                </div>
                <div class="form-group col-md-5">
                    <label for="shipping_address">Shipping address</label>
                    <input type="text" class="form-control" id="shipping_address" name="shipping_address" value="{{ old('shipping_address') }}">
                </div>
                <button type="submit" class="btn btn-primary btn-icon-split mb-3">
                    <span class="icon text-white-50">
                        <i class="fas fa-plus"></i>
                    </span>
                    <span class="text">Add address</span>
                </button>
            </div>
        </form>
        <table class="table table-bordered" width="100%" cellspacing="0" id="addressTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>City</th>
                    <th>Country</th>
                    <th>Shipping address</th>
                    <th>Options</th>
                </tr>
            <tbody>
                @foreach ($addresses as $address)
                <tr>
                    <td>{{ $loop->index + 1 }}</td>
                    <td>{{ $address->city }}</td>
                    <td>{{ $address->country_name }}</td>
                    <td>{{ $address->shipping_address }}</td>
                    <td>
                        <div class="d-flex  justify-content-center">
                            <a href="#" class="mr-2 text-success">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </a>
                            <a href="#" class="text-danger">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                    <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z" />
                                </svg>
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            </thead>
        </table>
    </div>
</div>
@endsection