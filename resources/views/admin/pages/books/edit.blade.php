@extends('admin.layouts.base')
@section('title', 'Edit Book')
@section('content')
<h1 class="h3 mb-2 text-gray-800">Edit Book</h1>
<hr class="my-12" />
<!-- DataTales Example -->
<div class="row">
    <div class="col-md-12">
        <form action="{{ route('books.update', $books->book_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-7">
                    <label for="title">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $books->title }}">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-5">
                    <label for="language">Language</label>
                    <select name="language_id" id="language" class="form-control @error('language_id') is-invalid @enderror">
                        <option value="">Select a language</option>
                        @foreach($languages as $language)
                            <option value="{{ $language->language_id }}" {{ $books->language_id == $language->language_id ? 'selected' : '' }}>{{ $language->language_name }}</option>
                        @endforeach
                        @error('language_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="numPages">Num pages</label>
                    <input type="number" class="form-control @error('num_pages') is-invalid @enderror" id="numPages" name="num_pages" value="{{ $books->num_pages }}">
                    @error('num_pages')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="publisher">Publisher</label>
                    <select name="publisher_id" id="publisher" class="form-control @error('publisher_id') is-invalid @enderror">
                        <option value="">Select a publisher</option>
                        @foreach($publishers as $publisher)
                            <option value="{{ $publisher->publisher_id }}" {{ $books->publisher_id == $publisher->publisher_id ? 'selected' : '' }}>{{ $publisher->publisher_name }}</option>
                        @endforeach
                        @error('publisher_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="category">Category</label>
                    <select name="category_id" id="category" class="form-control @error('category_id') is-invalid @enderror">
                        <option value="">Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->category_id }}" {{ $books->category_id == $category->category_id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                        @endforeach
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="price">Price</label>
                    <input type="number" min="0" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ $books->price }}">
                    @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="stock">Stock</label>
                    <input type="number" min="0" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ $books->stock }}">
                    @error('stock')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="author">Author</label>
                    <select name="author_id" id="author" class="form-control @error('author_id') is-invalid @enderror">
                        <option value="">Select an author</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->author_id }}" {{ $books->author_id == $author->author_id ? 'selected' : '' }}>{{ $author->author_name }}</option>
                        @endforeach
                        @error('author_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="image">Image URL</label>
                    <input type="text" class="form-control @error('image') is-invalid @enderror" id="image" name="image" value="{{ $books->image }}">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label for="description">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" rows="6" id="description" name="description">{{ $books->description }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
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

                <!-- Create Button -->
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
