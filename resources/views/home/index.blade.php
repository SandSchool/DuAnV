@extends('layout.default')

@section('title', 'Trang Chủ - ShoesVN')

@section('content')
<section class="hero-section">
    <div class="container">
        <h1 class="hero-title">Khám Phá Bộ Sưu Tập Giày Mới</h1>
        <p class="lead">Chính hãng - Chất lượng cao - Giá tốt nhất</p>

        <div class="search-container mx-auto mt-4">
            <form action="{{ route('product.index') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control search-input" placeholder="Tìm kiếm sản phẩm..." value="{{ request('keyword') }}">
                <button class="btn btn-danger search-btn" type="submit">
                    <i class="fas fa-search"></i> Tìm kiếm
                </button>
            </form>
        </div>
    </div>
</section>

<section class="category-section">
    <div class="container">
        <h2 class="section-title">Danh Mục Sản Phẩm</h2>
        <div class="row">
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="category-card">
                    <div class="category-icon"><i class="fas fa-running"></i></div>
                    <h5>Giày Thể Thao</h5>
                    <p class="text-muted">Năng động & Thoải mái</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="category-card">
                    <div class="category-icon"><i class="fas fa-user-tie"></i></div>
                    <h5>Giày Công Sở</h5>
                    <p class="text-muted">Lịch sự & Sang trọng</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="category-card">
                    <div class="category-icon"><i class="fas fa-mountain"></i></div>
                    <h5>Giày Outdoor</h5>
                    <p class="text-muted">Bền bỉ & Chống nước</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="category-card">
                    <div class="category-icon"><i class="fas fa-star"></i></div>
                    <h5>Giày Thời Trang</h5>
                    <p class="text-muted">Phong cách & Hiện đại</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="py-5">
    <div class="container">
        <h2 class="section-title">Sản Phẩm Nổi Bật</h2>
        <div class="row">

            {{--
              - Lặp qua biến $products.
            --}}
            @forelse($products ?? [] as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card product-card">

                    {{-- Bạn có thể làm cho badge này động, ví dụ:
                    @if($product->is_new)
                        <span class="product-badge">NEW</span>
                    @elseif($product->is_hot)
                        <span class="product-badge">HOT</span>
                    @elseif($product->sale_percent)
                         <span class="product-badge">-{{ $product->sale_percent }}%</span>
                    @endif
                    --}}
                    <span class="product-badge">HOT</span>

                    {{-- ĐÃ SỬA: Sử dụng tên cột 'HINHANH' (hoặc tên cột hình ảnh của bạn) --}}
                    <img src="{{ $product->HINHANH ?? 'https://placehold.co/300x250/EAEAEA/BDBDBD?text=No+Image' }}" class="product-img" alt="{{ $product->TENSP ?? 'Sản phẩm' }}">
                    <div class="card-body">
                        {{-- ĐÃ SỬA: Sử dụng tên cột 'TENSP' --}}
                        <h5 class="product-title">{{ $product->TENSP ?? 'Tên sản phẩm' }}</h5>

                        {{-- Phần đánh giá này cũng nên được lấy động từ database --}}
                        <p class="text-muted mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            (128)
                        </p>

                        <div class="mb-3">
                            {{-- ĐÃ SỬA: Sử dụng tên cột 'GIA' --}}
                            <span class="product-price">{{ number_format($product->GIA ?? 0) }}đ</span>

                            {{-- ĐÃ SỬA: Giả sử giá cũ là 'GIACU'. Nếu tên khác, bạn hãy đổi lại --}}
                            @if(isset($product->GIACU) && $product->GIACU > $product->GIA)
                            <span class="old-price">{{ number_format($product->GIACU) }}đ</span>
                            @endif
                        </div>

                        {{-- ĐÃ SỬA: Lấy id (hoặc MASP) làm data attribute --}}
                        {{-- SỬA LẠI $product->id (nếu cột ID của bạn là 'id') --}}
                        <button class="btn btn-add-cart w-100" data-product-id="{{ $product->id ?? $product->MASP ?? '' }}">
                            <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                        </button>
                    </div>
                </div>
            </div>

            @empty

            {{-- Đây là nội dung sẽ hiển thị nếu không có sản phẩm nào --}}
            <div class="col-12">
                <p class="text-center text-muted fs-5 mt-4">Không có sản phẩm nào để hiển thị.</p>
            </div>

            @endforelse

        </div>

        <div class="text-center mt-5">
            {{-- Bạn nên thay thế phần phân trang tĩnh này bằng trình phân trang của Laravel --}}
            {{-- Ví dụ: {{ $products->links() }} --}}
            <nav>
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#"><i class="fas fa-chevron-left"></i></a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</section>
@endsection

{{-- ================================================= --}}
{{-- PHẦN SCRIPT AJAX ĐƯỢC THÊM VÀO ĐÂY --}}
{{-- ================================================= --}}
@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Lấy CSRF token từ thẻ meta
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // Tìm tất cả các nút "Thêm vào giỏ"
        document.querySelectorAll('.btn-add-cart').forEach(button => {
            button.addEventListener('click', async function(e) {
                e.preventDefault(); // Ngăn hành vi mặc định (nếu có)

                const productId = this.dataset.productId;
                const button = this; // Lưu lại tham chiếu tới nút bấm

                // Kiểm tra xem productId có rỗng không
                if (!productId) {
                    console.error('Lỗi: Không tìm thấy product-id trên nút bấm.');
                    button.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Lỗi ID';
                    button.style.backgroundColor = '#e74c3c';
                    setTimeout(() => {
                        button.innerHTML = '<i class="fas fa-cart-plus"></i> Thêm vào giỏ';
                        button.style.backgroundColor = '';
                    }, 2000);
                    return; // Dừng thực thi
                }

                // Vô hiệu hóa nút để tránh click nhiều lần
                button.disabled = true;
                button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Đang xử lý...';

                try {
                    // Gửi yêu cầu fetch (AJAX) đến route 'cart.add'
                    const response = await fetch('{{ route("cart.add") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken, // Gửi token
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            quantity: 1 // Mặc định thêm 1 sản phẩm
                        })
                    });

                    // Chuyển response thành JSON
                    const data = await response.json();

                    if (response.ok) {
                        // 1. Cập nhật badge giỏ hàng
                        const badge = document.querySelector('.cart-badge'); // Thay '.cart-badge' bằng class thực tế của bạn
                        if (badge) {
                            badge.textContent = data.total_quantity;
                            // Thêm hiệu ứng rung/nháy cho badge
                            badge.style.transform = 'scale(1.3)';
                            badge.style.transition = 'transform 0.2s';
                            setTimeout(() => badge.style.transform = 'scale(1)', 200);
                        }

                        // 2. Cập nhật nút bấm
                        button.innerHTML = '<i class="fas fa-check"></i> Đã thêm';
                        button.style.backgroundColor = '#27ae60';

                    } else {
                        // Nếu có lỗi (ví dụ: sản phẩm không tồn tại, validate fail)
                        throw new Error(data.message || 'Có lỗi xảy ra');
                    }

                } catch (error) {
                    console.error('Lỗi khi thêm vào giỏ:', error);
                    button.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Lỗi';
                    button.style.backgroundColor = '#e74c3c'; // Màu đỏ lỗi
                }

                // Dù thành công hay thất bại, khôi phục lại nút sau 2 giây
                setTimeout(() => {
                    button.innerHTML = '<i class="fas fa-cart-plus"></i> Thêm vào giỏ';
                    button.style.backgroundColor = ''; // Trả về màu gốc
                    button.disabled = false;
                }, 2000);
            });
        });

        // (Giữ lại code animation cho category card và search form của bạn)
        // Category card click animation
        document.querySelectorAll('.category-card').forEach(card => {
            card.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 200);

                // Bạn có thể chuyển hướng người dùng đến trang danh mục
                // Ví dụ: window.location.href = '/category/giay-the-thao';
            });
        });

        // Search form enhancement
        const searchForm = document.querySelector('.search-container form');
        const searchInput = document.querySelector('.search-input');

        searchInput.addEventListener('focus', function() {
            this.style.boxShadow = '0 0 10px rgba(52, 152, 219, 0.5)';
        });

        searchInput.addEventListener('blur', function() {
            this.style.boxShadow = '';
        });
    });
</script>
@endpush