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
                                <a href="{{ route("admin.category.edit") }}"
                                   class="btn btn-outline-primary pull-right">
                                    Thêm mới
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead class=" text-primary">
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            Hình ảnh
                                        </th>
                                        <th>
                                            Mã danh mục
                                        </th>
                                        <th>
                                            Tên danh mục
                                        </th>
                                        <th class="text-right">

                                        </th>
                                        </thead>
                                        <tbody>
                                            <!-- do du lieu ra view -->
                                            @foreach($categories as $cat)
                                                <tr>
                                                    <td>{{ ($loop->index)+1 }}</td> <!-- lay index cua doi tuong lap -->
                                                    <td><img width="100px" class="img-thumbnail" src="{{ $cat->HINHANH }}"></td>
                                                    <td>{{ $cat->MALOAI }}</td>
                                                    <td>{{ $cat->TENLOAI }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.category.edit', ["category" => $cat->MALOAI]) }}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                                        <a onclick="deleteCategory('{{ $cat->MALOAI }}');" class="btn btn-danger"><i class="fa fa-close"></i></a>
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
@stop
