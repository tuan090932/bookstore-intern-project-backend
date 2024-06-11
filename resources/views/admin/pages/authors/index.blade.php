@extends('admin.layouts.base')
@section('title', 'authors')
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.css" rel="stylesheet">
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.4/nouislider.min.js"></script>

<!-- Custom CSS for noUiSlider -->
<style>
    .noUi-target, .noUi-lower, .noUi-upper {
        background: #f8f9fc;
    }
    .noUi-handle {
        width: 10px;
        height: 10px;
        background: #4e73df;
        border: 1px solid #fff;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    }
    .noUi-tooltip {
        display: none;
    }
    .age_range {
        width: 100%;
    }
    .filter-form {
        max-width: 30%;
        margin-left: 20px;
    }
    .age_range_text {
        margin-right: 30px;
    }
</style>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-grid d-flex justify-content-between mb-3">
        <h1 class="h3 mb-2 text-gray-800 d-flex align-items-center">authors</h1>
        <a href="{{route('authors.create')}}" class="btn btn-primary btn-icon-split">
            <span class="icon text-white-50">
                <i class="fas fa-plus"></i>
            </span>
            <span class="text">Create</span>
        </a>
    </div>

    <!-- Filter by Age Range -->
    <div class="mb-4">
        <form action="{{ route('authors.index') }}" method="GET" class="form-inline w-100 filter-form">
            <label for="age_range" class="age_range_text">Tuổi: </label>
            <div class="form-group mr-2 flex-grow-1">
                <div class="age_range" id="age_range"></div>
                <input type="hidden" name="min_age" id="min_age" value="{{ request()->get('min_age', 0) }}">
                <input type="hidden" name="max_age" id="max_age" value="{{ request()->get('max_age', 100) }}">
            </div>
            <div class="form-group mr-2 age_range_values">
                <span id="age_range_values" class="ml-3"></span>
            </div>
            <button type="submit" class="btn btn-primary ml-2 filter">Filter</button>
        </form>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Tên tác giả</th>
                            <th>Tuổi</th>
                            <th>Ngày sinh</th>
                            <th>Ngày mất</th>
                            <th>Options</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tên tác giả</th>
                            <th>Tuổi</th>
                            <th>Ngày sinh</th>
                            <th>Ngày mất</th>
                            <th>Options</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($authors as $author)
                            <tr>
                                <td>{{ $author->author_name }}</td>
                                <td>{{ $author->age }}</td>
                                <td>{{ $author->birth_date }}</td>
                                <td>{{ $author->death_date }}</td>
                                <td>
                                    <div class="d-flex justify-content-center">
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
                </table>
                <div class="d-flex">
                    <nav>
                        {{ $authors->links('vendor.pagination.bootstrap-4') }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

<!-- Page level plugins -->
<script src="{{ asset('/assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('/assets/js/demo/datatables-demo.js') }}"></script>

<!-- noUiSlider initialization -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var ageRangeSlider = document.getElementById('age_range');
        var minAgeInput = document.getElementById('min_age');
        var maxAgeInput = document.getElementById('max_age');
        var ageRangeValues = document.getElementById('age_range_values');

        noUiSlider.create(ageRangeSlider, {
            start: [minAgeInput.value || 0, maxAgeInput.value || 100],
            connect: true,
            range: {
                'min': 0,
                'max': 100
            },
            tooltips: [true, true],
            format: {
                to: function (value) {
                    return Math.round(value);
                },
                from: function (value) {
                    return Number(value);
                }
            }
        });

        ageRangeSlider.noUiSlider.on('update', function (values, handle) {
            minAgeInput.value = values[0];
            maxAgeInput.value = values[1];
            ageRangeValues.innerHTML = values.join(' - ');
        });

        ageRangeSlider.noUiSlider.on('set', function (values, handle) {
            minAgeInput.value = values[0];
            maxAgeInput.value = values[1];
        });
    });
</script>

@endsection
