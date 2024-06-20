@extends('admin.layouts.base')
@section('title', 'Create Category')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Create Category</h1>
<hr class="my-12" />
<!-- Display Success or Error Messages -->
@if (session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
<div class="row">
    <div class="col-md-12">
        <form id="input_form" method="POST" action="{{ route('categories.store') }}">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="category_name">Category Name</label>
                    <input type="text" class="form-control @error('category_name') is-invalid @enderror" id="category_name" name="category_name" value="{{ old('category_name') }}">
                    @error('category_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <hr class="my-12" />
            <div class="d-grid d-flex justify-content-between">
                <a href="javascript:history.back()" class="form-group btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Back</span>
                </a>
                <button type="submit" class="form-group btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Create</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection