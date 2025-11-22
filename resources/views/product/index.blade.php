@extends("layout.default")
@section("content")


<!-- Page Header -->
<div class="product-page-header">
    <div class="container">
        <h1><i class="fas fa-shoe-prints me-3"></i>Bộ Sưu Tập Giày</h1>
        <p>Khám phá những mẫu giày thể thao và thời trang mới nhất 2025</p>
    </div>
</div>

<!-- Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Sidebar Filter -->
            <div class="col-lg-3 col-md-4">
                <div class="filter-sidebar">
                    <h4 class="filter-title">
                        <i class="fas fa-filter me-2"></i>Danh Mục
                    </h4>
                    <ul class="category-list">
                        <li>
                            <a href="{{ route('cart.index') }}" class="{{ !request('category') ? 'active' : '' }}">
                                <i class="fas fa-th me-2"></i>Tất cả sản phẩm
                            </a>
                        </li>
                        @foreach($category_data as $category)
                        <li>   
                        </li>
                        @endforeach
                    </ul>

                    <!-- Search Box -->
                    <div class="search-box">
                        <form action="{{ url('product') }}" method="GET">
                            <input type="text" name="search" placeholder="Tìm kiếm sản phẩm..."
                                value="{{ request('search') }}">
                            <button type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-lg-9 col-md-8">
                <!-- Results Info -->
                <div class="results-info">
                    <span style="color: #666; font-weight: 500;">
                        <i class="fas fa-box me-2"></i>
                        Hiển thị {{ $product_data->firstItem() ?? 0 }} – {{ $product_data->lastItem() ?? 0 }}
                        của {{ $product_data->total() }} sản phẩm
                    </span>
                </div>

                <!-- Product Grid -->
                <div class="product-grid">
                    @forelse($product_data as $product)
                    <div class="product-card">
                        <div class="product-image">
                            <img src="{{ asset($product->HINHANH) }}" alt="{{ $product->TENSP }}">

                            <span class="product-badge">New</span>
                            <div class="product-actions">
                                <a href="{{ route('product.detail', ['product' => $product->MASP]) }}"
                                    class="action-btn" title="Xem chi tiết">
                                    <i class="fas fa-eye"></i>
                                </a>
                            </div>
                        </div>
                        <div class="product-info">
                            <a href="{{ route('product.detail', ['product' => $product->MASP]) }}"
                                class="product-name">
                                {{ $product->TENSP }}
                            </a>
                            <div class="product-price">
                                {{ number_format($product->GIA, 0, ',', '.') }}đ
                            </div>
                            <form action="{{ route('cart.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->MASP }}">
                                <input type="hidden" name="quantity" value="1">

                                {{-- THÊM DÒNG NÀY: Để báo cho Controller biết cần quay lại trang cũ --}}
                                <input type="hidden" name="redirect_back" value="1">

                                <button type="submit" class="add-to-cart-btn">
                                    <i class="fas fa-shopping-cart me-2"></i>Thêm vào giỏ
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="col-12 text-center py-5">
                        <i class="fas fa-box-open" style="font-size: 80px; color: #ddd;"></i>
                        <h3 class="mt-3" style="color: #999;">Không tìm thấy sản phẩm nào</h3>
                    </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if($product_data->hasPages())
                <div class="d-flex justify-content-center mt-5">
                    {{ $product_data->links('product.pagination') }}
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection