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
                                <a href="{{ route("admin.product.edit") }}"
                                   class="btn btn-outline-primary pull-right">
                                    Thêm mới
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class=" text-primary">
                                        <th>#</th>
                                        <th>Hình ảnh</th>
                                        <th>Mã sản phẩm</th>
                                        <th>Tên sản phẩm</th>
                                        <th>Đơn vị tính</th>
                                        <th>Giá bán</th>
                                        <th>Nước sản xuất</th>
                                        <th class="text-right"></th>
                                        </thead>
                                        <tbody>
                                        <!-- do du lieu ra view -->
                                        @foreach($products as $pro)
                                            <tr>
                                                <td>{{ ($loop->index)+1 }}</td> <!-- lay index cua doi tuong lap -->
                                                <td><img width="100px" class="img-thumbnail" src="{{ $pro->HINHANH }}"></td>
                                                <td>{{ $pro->MASP }}</td>
                                                <td>{{ $pro->TENSP }}</td>
                                                <td>{{ $pro->DVT }}</td>
                                                <td>{{ $pro->GIA }}</td>
                                                <td>{{ $pro->NUOCSX }}</td>
                                                <td>
                                                    <a href="{{ route('admin.product.edit', ["product" => $pro->MASP]) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                    <a onclick="deleteProduct('{{ $pro->MASP }}');" class="btn btn-danger"><i class="fa fa-close"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include("admin.footer")
        </div>
    </div>
@endsection
