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
                    <label for="TenSP">Tên sản phẩm</label>
                    <input type="text" class="form-control" id="TenSP">
                </div>
                <div class="form-group col-md-5">
                    <label for="NSX">Nhà sản xuất</label>
                    <input type="text" class="form-control" id="NSX">
                </div>
                <div class="form-group col-md-6">
                    <label for="THieu">Thương hiệu</label>
                    <input type="text" class="form-control" id="THieu">
                </div>
                <div class="form-group col-md-6">
                    <label for="DMSP">Danh mục SP</label>
                    <select name="DanhMucSp" id="DanhMucSp" class="form-control"></select>
                </div>
                <div class="form-group col-md-6">
                    <label for="Gia">Giá</label>
                    <input type="number" min="0" class="form-control" id="Gia">
                </div>
                <div class="form-group col-md-6">
                    <label for="TongSL">Tổng SL</label>
                    <input type="number" min="0" class="form-control" id="TongSL">
                </div>

                <div class="form-group col-md-12">
                    <label for="HinhAnh">Url hình ảnh</label>
                    <input type="text" class="form-control" id="HinhAnh">
                </div>

                <div class="form-group col-md-12">
                    <label for="ChiTiet">Chi tiết</label>
                    <textarea type="text" class="form-control" rows="6" id="ChiTiet"></textarea>
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
                    <span class="text">Quay lại</span>
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