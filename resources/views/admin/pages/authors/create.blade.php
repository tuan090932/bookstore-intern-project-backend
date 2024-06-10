@extends('admin.layouts.base')
@section('title', 'Create Book')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Create Book</h1>
<hr class="my-12" />
<!-- DataTales Example -->
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

        <form action="{{ route('authors.store') }}" method="POST" id="input-form">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-7">
                    <label for="author_name">Họ tên tác giả</label>
                    <input type="text" class="form-control @error('author_name') is-invalid @enderror" id="author_name" name="author_name" value="{{ old('author_name') }}">
                    @error('author_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-5">
                    <label for="age">Tuổi</label>
                    <input type="text" class="form-control @error('age') is-invalid @enderror" id="age" name="age" value="{{ old('age') }}">
                    @error('age')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="birth_date">Năm sinh</label>
                    <input type="date" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date') }}">
                    @error('birth_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="death_date">Năm mất (Nếu có)</label>
                    <input type="date" class="form-control @error('death_date') is-invalid @enderror" id="death_date" name="death_date" value="{{ old('death_date') }}">
                    @error('death_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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
