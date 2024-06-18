@extends('admin.layouts.base')
@section('title', 'Trashed Authors')
@section('content')
<div class="container-fluid">

    <div class="d-grid d-flex justify-content-between mb-3">
        <h1 class="h3 mb-2 text-gray-800 d-flex align-items-center">Trashed Authors</h1>
        <div>
            <button class="btn btn-success btn-icon-split" id="bulk-restore-btn">
                <span class="icon text-white-50">
                    <i class="fas fa-undo"></i>
                </span>
                <span class="text">Restore Selected</span>
            </button>
            <!-- Confirm Restore Selected Modal -->
            <div style="top: 200px !important;" class="modal fade" id="confirmRestoreSelectedModal" tabindex="-1" role="dialog" aria-labelledby="confirmRestoreSelectedModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmRestoreSelectedModalLabel">Confirm Restore Selected</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="confirmRestoreSelectedModalBody">
                            Bạn có muốn hoàn lại các tác giả được chọn không?
                        </div>
                        <div class="modal-footer" id="confirmRestoreSelectedModalFooter">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="button" class="btn btn-success" onclick="document.getElementById('bulk-restore-form').submit();">Restore</button>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-success btn-icon-split" id="restore-all-btn">
                <span class="icon text-white-50">
                    <i class="fas fa-undo"></i>
                </span>
                <span class="text">Restore All</span>
            </button>
            <!-- Confirm Restore All Modal -->
            <div style="top: 200px !important;" class="modal fade" id="confirmRestoreAllModal" tabindex="-1" role="dialog" aria-labelledby="confirmRestoreAllModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        @if($authors->count() > 0)
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmRestoreAllModalLabel">Confirm Restore All</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                Bạn có muốn hoàn lại tất cả tác giả không?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-success" onclick="document.getElementById('restore-all-form').submit();">Restore</button>
                            </div>
                        @else
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmRestoreSelectedModalLabel">Không có tác giả nào để hoàn lại</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <a href="{{ route('authors.index') }}" class="btn btn-primary btn-icon-split">
                <span class="icon text-white-50">
                    <i class="fas fa-arrow-left"></i>
                </span>
                <span class="text">Back</span>
            </a>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <form id="bulk-restore-form" method="POST" action="{{ route('authors.restore-selected') }}">
                    @csrf
                    @method('PATCH')
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="select-all"></th>
                                <th>Tên tác giả</th>
                                <th>Tuổi</th>
                                <th>Ngày sinh</th>
                                <th>Ngày mất</th>
                                <th>Quốc tịch</th>
                                <th>Ngày xóa</th>
                                <th>Options</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th><input type="checkbox" id="select-all-footer"></th>
                                <th>Tên tác giả</th>
                                <th>Tuổi</th>
                                <th>Ngày sinh</th>
                                <th>Ngày mất</th>
                                <th>Quốc tịch</th>
                                <th>Ngày xóa</th>
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
                                    <td>{{ $author->deleted_at }}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <form id="restore-form-{{ $author->author_id }}" action="{{ route('authors.restore', $author->author_id) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="button" class="btn btn-link p-0 m-0" data-toggle="modal" data-target="#confirmRestoreModal-{{ $author->author_id }}">
                                                    <i style="font-size: 28px; color: #18b97e;" class="fa-solid fa-trash-can-arrow-up"></i>
                                                </button>
                                            </form>

                                            <!-- Modal -->
                                            <div style="top: 200px !important;" class="modal fade" id="confirmRestoreModal-{{ $author->author_id }}" tabindex="-1" role="dialog" aria-labelledby="confirmRestoreModalLabel-{{ $author->author_id }}" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="confirmRestoreModalLabel-{{ $author->author_id }}">Confirm Restoration</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Bạn có chắc chắn muốn khôi phục tác giả này không?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                                            <button type="button" class="btn btn-success" onclick="document.getElementById('restore-form-{{ $author->author_id }}').submit();">Restore</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
                <div class="d-flex">
                    <nav>
                        {{ $authors->links('vendor.pagination.bootstrap-4') }}
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>

<form id="restore-all-form" action="{{ route('authors.restore-all') }}" method="POST" style="display: none;">
    @csrf
    <input type="hidden" name="_method" value="PATCH">
</form>

<script>
    document.querySelectorAll('#select-all, #select-all-footer').forEach(element => {
        element.addEventListener('click', e => {
            document.querySelectorAll('input[name="author_ids[]"]').forEach(checkbox => {
                checkbox.checked = e.target.checked;
            });
        });
    });

    const bulkRestoreBtn = document.getElementById('bulk-restore-btn');
    bulkRestoreBtn.addEventListener('click', () => {
        const selectedAuthors = document.querySelectorAll('input[name="author_ids[]"]:checked');
        const modalBody = document.getElementById('confirmRestoreSelectedModalBody');
        const modalFooter = document.getElementById('confirmRestoreSelectedModalFooter');

        if (selectedAuthors.length > 0) {
            modalBody.textContent = 'Bạn có muốn hoàn lại các tác giả được chọn không?';
            modalFooter.style.display = 'flex';
        } else {
            modalBody.textContent = 'Không có tác giả nào được chọn để hoàn lại';
            modalFooter.style.display = 'none';
        }

        $('#confirmRestoreSelectedModal').modal('show');
    });

    document.getElementById('restore-all-btn').addEventListener('click', () => {
        $('#confirmRestoreAllModal').modal('show');
    });
</script>
@endsection
