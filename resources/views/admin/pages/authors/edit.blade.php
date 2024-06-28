@extends('admin.layouts.base')
@section('title', 'Edit Author')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Edit Author</h1>
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

        <form action="{{ route('authors.update', $author->author_id) }}" method="POST" id="input-form">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-7">
                    <label for="author_name">Author name</label>
                    <input type="text" class="form-control @error('author_name') is-invalid @enderror" id="author_name" name="author_name" value="{{ old('author_name', $author->author_name) }}" autocomplete="off">
                    @error('author_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="birth_date">Birth date</label>
                    <input type="text" class="form-control @error('birth_date') is-invalid @enderror" id="birth_date" name="birth_date" value="{{ old('birth_date', $author->birth_date) }}" placeholder="DD/MM/YYYY" autocomplete="off">
                    @error('birth_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="death_date">Death date (Optional)</label>
                    <input type="text" class="form-control @error('death_date') is-invalid @enderror" id="death_date" name="death_date" value="{{ old('death_date', $author->death_date) }}" placeholder="DD/MM/YYYY" autocomplete="off">
                    @error('death_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="national">National</label>
                    <input type="text" class="form-control @error('national') is-invalid @enderror" id="national" name="national" value="{{ old('national', $author->national) }}" autocomplete="off">
                    @error('national')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <hr class="my-12" />

            <!--------------------Button--------------------------->
            <div class="d-grid d-flex justify-content-between">
                <!------ Button Quay Lại ------>
                <a href="{{ route('authors.index') }}" class="form-group btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Back</span>
                </a>

                <!------ Update Button ------>
                <a class="form-group btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <input type="submit" value="Update" class="btn btn-success" />
                </a>
            </div>
        </form>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="{{ asset('assets/js/author-input-handler.js') }}"></script>
@endsection
