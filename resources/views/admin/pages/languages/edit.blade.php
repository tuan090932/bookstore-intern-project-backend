@extends('admin.layouts.base')
@section('language_name', 'Edit Language')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Edit Language</h1>
<hr class="my-12" />
<!-- DataTales Example -->
<div class="row">
    <div class="col-md-12">
        <form action="{{ route('languages.update', $languages->language_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-7">
                    <label for="language_name">Language Name</label>
                    <input type="text" class="form-control" id="language_name" name="language_name" value="{{ $languages->language_name }}">
                </div>
            </div>
            <hr class="my-12" />

            <!-- Buttons -->
            <div class="d-grid d-flex justify-content-between">
                <!-- Back Button -->
                <a href="{{ route('books.index') }}" class="form-group btn btn-secondary btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-arrow-left"></i>
                    </span>
                    <span class="text">Back</span>
                </a>

                <!-- Submit Button -->
                <button type="submit" class="form-group btn btn-success btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-check"></i>
                    </span>
                    <span class="text">Submit</span>
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
