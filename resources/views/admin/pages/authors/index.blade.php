@extends('admin.layouts.base')
@section('title', 'authors')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('/assets/css/index.css') }}">
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.js"></script>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-grid d-flex justify-content-between mb-3">
        <h1 class="h3 mb-2 text-gray-800 d-flex align-items-center">Authors</h1>
        <div>
            <a href="{{ route('authors.trashed') }}" class="btn btn-secondary btn-icon-split mr-2">
                <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                </span>
                <span class="text">Trashed Authors</span>
            </a>
            <button class="btn btn-danger btn-icon-split" id="authors-selected-delete-btn" data-toggle="modal">
                <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                </span>
                <span class="text">Delete Selected</span>
            </button>
            <button class="btn btn-danger btn-icon-split" id="authors-delete-all-btn" data-toggle="modal">
                <span class="icon text-white-50">
                    <i class="fas fa-trash"></i>
                </span>
                <span class="text">Delete All</span>
            </button>
            <a href="{{ route('authors.create') }}" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-plus"></i>
                </span>
                <span class="text">Create</span>
            </a>
        </div>
    </div>

    <!-- Filter Form -->
    <div class="mb-4">
        <form action="{{ route('authors.index') }}" method="GET" class="filter-form">
            <!-- Age Range -->
            <div class="form-group mb-3">
                <label for="age_range" class="age_range_text">Age: </label>
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 mr-2 ml-3">
                        <div class="age_range" id="age_range"></div>
                        <input type="hidden" name="min_age" id="min_age" value="{{ request()->get('min_age', 0) }}">
                        <input type="hidden" name="max_age" id="max_age" value="{{ request()->get('max_age', 100) }}">
                    </div>
                    <div class="age_range_values ml-5">
                        <span id="age_range_values"></span>
                    </div>
                </div>
            </div>

            <div class="d-flex">
                <!-- Death Status Filter -->
                <div class="form-group mr-2">
                    <label for="death_status" class="mr-2">Death Status: </label>
                    <select name="death_status" id="death_status" class="form-control">
                        <option value="">All</option>
                        <option value="alive" {{ request()->get('death_status') == 'alive' ? 'selected' : '' }}>Alive Authors</option>
                        <option value="deceased" {{ request()->get('death_status') == 'deceased' ? 'selected' : '' }}>Deceased Authors</option>
                    </select>
                </div>

                <!-- Sorting Options -->
                <div class="form-group mr-2">
                    <label for="sort_by" class="mr-2">Sort By: </label>
                    <select name="sort_by" id="sort_by" class="form-control">
                        <option value="">Default</option>
                        <option value="name_asc" {{ request()->get('sort_by') == 'name_asc' ? 'selected' : '' }}>Name A -- Z</option>
                        <option value="age_asc" {{ request()->get('sort_by') == 'age_asc' ? 'selected' : '' }}>Age Ascending</option>
                        <option value="age_desc" {{ request()->get('sort_by') == 'age_desc' ? 'selected' : '' }}>Age Descending</option>
                        <option value="birth_date_asc" {{ request()->get('sort_by') == 'birth_date_asc' ? 'selected' : '' }}>Birth Date Ascending</option>
                        <option value="birth_date_desc" {{ request()->get('sort_by') == 'birth_date_desc' ? 'selected' : '' }}>Birth Date Descending</option>
                        <option value="death_date_asc" {{ request()->get('sort_by') == 'death_date_asc' ? 'selected' : '' }}>Death Date Ascending</option>
                        <option value="death_date_desc" {{ request()->get('sort_by') == 'death_date_desc' ? 'selected' : '' }}>Death Date Descending</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary filter align-self-end">Filter</button>
        </form>
    </div>

    <!-- Data Table -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th><input type="checkbox" id="select-all-header"></th>
                            <th>Author Name</th>
                            <th>Age</th>
                            <th>Birth Date</th>
                            <th>Death Date</th>
                            <th>National</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th><input type="checkbox" id="select-all-footer"></th>
                            <th>Author Name</th>
                            <th>Age</th>
                            <th>Birth Date</th>
                            <th>Death Date</th>
                            <th>National</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($authors as $author)
                            <tr>
                                <td><input type="checkbox" name="author_ids[]" value="{{ $author->author_id }}"></td>
                                <td>{{ $author->author_name }}</td>
                                <td>{{ $author->age }}</td>
                                <td>{{ $author->birth_date }}</td>
                                <td>{{ $author->death_date ? $author->death_date : '------------' }}</td>
                                <td>{{ $author->national }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
                                        <a href="{{ route('authors.edit', $author->author_id) }}" class="mr-2 text-success">
                                            <i style="color: #1CC88A" class="fa-regular fa-pen-to-square fa-2xl"></i>
                                        </a>
                                        <button type="button" class="btn btn-link p-0 m-0" data-author-id="{{ $author->author_id }}" id="delete-btn">
                                            <i style="color: red" class="fa-regular fa-trash-can fa-2xl"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex">
                    <nav>
                        {{ $authors->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- /.container-fluid -->
<script src="{{ asset('/assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/assets/js/demo/datatables-demo.js') }}"></script>

<!-- noUiSlider initialization -->
<script src="{{ asset('/assets/js/index.js') }}"></script>
<script src="{{ asset('assets/js/common.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        initializeCheckboxes('select-all-header', 'select-all-footer', 'author_ids[]');

        const commonConfig = {
            title: "Confirm Delete",
            method: 'DELETE',
            confirmText: "Delete"
        };

        const deleteSelected = document.getElementById('authors-selected-delete-btn');
        if (deleteSelected) {
            deleteSelected.addEventListener('click', function() {
                const selectedIds = Array.from(document.querySelectorAll('input[name="author_ids[]"]:checked'))
                    .map(checkbox => checkbox.value);

                ACTION_URL = "{{ route('authors.delete-selected') }}";
                body = "Are you sure you want to delete the selected authors?";

                showModalConfirmation(selectedIds, ACTION_URL, commonConfig.title, body, commonConfig.method, commonConfig.confirmText);
            });
        }

        const deleteAllBtn = document.getElementById('authors-delete-all-btn');
        if (deleteAllBtn) {
            deleteAllBtn.addEventListener('click', function() {
                ACTION_URL = "{{ route('authors.delete-all') }}";
                body = "Are you sure you want to delete all authors?";

                showModalConfirmation([], ACTION_URL, commonConfig.title, body, commonConfig.method, commonConfig.confirmText);
            });
        }

        const deleteButtons = document.querySelectorAll('#delete-btn');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const authorId = this.getAttribute('data-author-id');
                ACTION_URL = "{{ route('authors.destroy', ':id') }}".replace(':id', authorId);
                body = "Are you sure you want to delete this author?";

                showModalConfirmation([authorId], ACTION_URL, commonConfig.title, body, commonConfig.method, commonConfig.confirmText);
            });
        });
    });
</script>
@endsection