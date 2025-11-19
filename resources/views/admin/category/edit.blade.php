@extends("layout.admin")
@section("main")
    <div class="wrapper ">
        @include("admin.sidebar")
        <div class="main-panel">
            <!-- Navbar -->
        @include("admin.navbar")
        <!-- End Navbar -->
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title pull-left"> Danh mục sản phẩm</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.category.edit') }}" enctype="multipart/form-data">
                                    @csrf
                                    @if(isset($category_data->MALOAI))
                                        <input type="hidden" name="category" value="{{ $category_data->MALOAI }}">
                                    @endif
                                    @if(isset($category_data->TENLOAI))
                                        <input type="hidden" name="name" value="{{ $category_data->TENLOAI }}">
                                    @endif
                                    @if(isset($category_data->HINHANH))
                                        <input type="hidden" name="image" value="{{ $category_data->HINHANH }}">
                                    @endif
                                    <div class="form-row pb-2">
                                        <div class="col-md-3">
                                            <label for="categoryName">Tên danh mục: </label>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" id="categoryName" name="categoryName"
                                                   value="@if(isset($category_data->TENLOAI)){{ $category_data->TENLOAI }}@endif">
                                            @error("categoryName")
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row pb-2">
                                        <div class="col-md-3">
                                            <label for="categoryImage">Hình ảnh: </label>
                                        </div>
                                        <div class="col-md-6">
                                            @if(isset($category_data->HINHANH))
                                                <img class="img-thumbnail" width="100px" src="{{ $category_data->HINHANH }}">
                                            @endif
                                            <input class="form-control" type="file" id="categoryImage" name="categoryImage">
                                            @error("categoryImage")
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row pb-2">
                                        <div class="col-md-3">
                                            <label for="categoryDescription">Mô tả: </label>
                                        </div>
                                        <div class="col-md-6">
                                            <textarea class="form-control" id="categoryDescription" name="categoryDescription">
                                                @if(isset($category_data->MOTA)){{ $category_data->MOTA }}@endif
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        @if(session("success"))
                                            <p class="text-success w-100 text-center">{{ session("success") }}</p>
                                        @endif
                                        @if(session("error"))
                                            <p class="text-danger w-100 text-center">{{ session("error") }}</p>
                                        @endif
                                        <button class="btn btn-success mx-auto" type="submit">Lưu</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include("admin.footer")
        </div>
    </div>
@stop
