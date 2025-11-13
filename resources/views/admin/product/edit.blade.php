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
                                <h4 class="card-title pull-left"> Sản phẩm</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('admin.product.edit') }}" enctype="multipart/form-data">
                                    @csrf
                                    @if(isset($product_data->MASP))
                                        <input type="hidden" name="product" value="{{ $product_data->MASP }}">
                                    @endif
                                    @if(isset($product_data->TENSP))
                                        <input type="hidden" name="name" value="{{ $product_data->TENSP }}">
                                    @endif
                                    @if(isset($product_data->HINHANH))
                                        <input type="hidden" name="image" value="{{ $product_data->HINHANH }}">
                                    @endif
                                    <div class="form-row pb-2">
                                        <div class="col-md-3">
                                            <label for="productName">Tên sản phẩm: </label>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" id="productName" name="productName"
                                                   value="@if(isset($product_data->TENSP)){{ $product_data->TENSP }}@endif">
                                            @error("productName")
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row pb-2">
                                        <div class="col-md-3">
                                            <label for="productImage">Hình ảnh: </label>
                                        </div>
                                        <div class="col-md-6">
                                            @if(isset($product_data->HINHANH))
                                                <img class="img-thumbnail" width="100px" src="{{ $product_data->HINHANH }}">
                                            @endif
                                            <input class="form-control" type="file" id="productImage" name="productImage">
                                            @error("productImage")
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row pb-2">
                                        <div class="col-md-3">
                                            <label for="productUnit">Đơn vị tính: </label>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" id="productUnit" name="productUnit"
                                                   value="@if(isset($product_data->DVT)){{ $product_data->DVT }}@endif">
                                            @error("productUnit")
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row pb-2">
                                        <div class="col-md-3">
                                            <label for="productMFNation">Nước sản xuất: </label>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="text" id="productMFNation" name="productMFNation"
                                                   value="@if(isset($product_data->NUOCSX)){{ $product_data->NUOCSX }}@endif">
                                            @error("productMFNation")
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row pb-2">
                                        <div class="col-md-3">
                                            <label for="productPrice">Giá bán: </label>
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" type="number" id="productPrice" name="productPrice"
                                                   value="@if(isset($product_data->GIA)){{ $product_data->GIA }}@endif">
                                            @error("productPrice")
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-row pb-2">
                                        <div class="col-md-3">
                                            <label for="productDescription">Mô tả: </label>
                                        </div>
                                        <div class="col-md-6">
                                            <textarea class="form-control" id="productDescription" name="productDescription">
                                                @if(isset($product_data->MOTA)){{ $product_data->MOTA }}@endif
                                            </textarea>
                                        </div>
                                    </div>
                                    <div class="form-row pb-2">
                                        <div class="col-md-3">
                                            <label for="productCategory">Chọn danh mục: </label>
                                        </div>
                                        <div class="col-md-6">
                                            <select class="form-control" id="productCategory" name="productCategory">
                                                @foreach($category_data as $category)
                                                    <option @if(isset($product_data->LOAI) && ($product_data->LOAI == $category->MALOAI)) selected @endif value="{{ $category->MALOAI }}">{{ $category->TENLOAI }}</option>
                                                @endforeach
                                            </select>
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
