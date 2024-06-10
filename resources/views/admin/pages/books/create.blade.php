@extends('admin.layouts.base')
@section('title', 'Create Book')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Create Book</h1>
<hr class="my-12" />
<!-- DataTales Example -->
<div class="row">
    <div class="col-md-12">
        <form id="input-form">
            @csrf
            <div class="form-row">
                <div class="form-group col-md-7">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group col-md-5">
                    <label for="language">Language</label>
                    <input type="text" class="form-control" id="language" name="language">
                </div>
                <div class="form-group col-md-6">
                    <label for="numPages">Num pages</label>
                    <input type="number" class="form-control" id="numPages" name="numPages">
                </div>
                <div class="form-group col-md-6">
                    <label for="publisher">Publisher</label>
                    <input type="text" class="form-control" id="publisher" name="publisher">
                </div>
                <div class="form-group col-md-6">
                    <label for="category">Category</label>
                    <input type="text" class="form-control" id="category" name="category">
                </div>
                <div class="form-group col-md-6">
                    <label for="price">Price</label>
                    <input type="number" min="0" class="form-control" id="price" name="price">
                </div>
                <div class="form-group col-md-6">
                    <label for="stock">Stock</label>
                    <input type="number" min="0" class="form-control" id="stock" name="stock">
                </div>
                <div class="form-group col-md-6">
                    <label for="author">Author</label>
                    <input type="text" class="form-control" id="author" name="author">
                </div>
                <div class="form-group col-md-12">
                    <label for="image">Image</label>
                    <input type="text" class="form-control" id="image" name="image">
                </div>

                <div class="form-group col-md-12">
                    <label for="description">Description</label>
                    <textarea type="text" class="form-control" rows="6" id="description" name="description"></textarea>
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
