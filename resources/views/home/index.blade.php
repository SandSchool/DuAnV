@extends('layout.default')

@section('title', 'Trang Chủ - ShoesVN')

@section('content')
<section class="hero-section">
    <div class="container">
        <h1 class="hero-title">Khám Phá Bộ Sưu Tập Giày Mới</h1>
        <p class="lead">Chính hãng - Chất lượng cao - Giá tốt nhất</p>

        <div class="search-container mx-auto mt-4">
            <form action="/products/search" method="GET" class="d-flex">
                <input type="text" name="keyword" class="form-control search-input" placeholder="Tìm kiếm sản phẩm...">
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
            @foreach($products ?? [] as $product)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card product-card">
                    <span class="product-badge">HOT</span>
                    <img src="{{ $product->image ?? 'https://via.placeholder.com/300x250' }}" class="product-img" alt="{{ $product->name ?? 'Sản phẩm' }}">
                    <div class="card-body">
                        <h5 class="product-title">{{ $product->name ?? 'Nike Air Max 270' }}</h5>
                        <p class="text-muted mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            (128)
                        </p>
                        <div class="mb-3">
                            <span class="product-price">{{ number_format($product->price ?? 1500000) }}đ</span>
                            <span class="old-price">{{ number_format($product->old_price ?? 2000000) }}đ</span>
                        </div>
                        <button class="btn btn-add-cart w-100">
                            <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                        </button>
                    </div>
                </div>
            </div>
            @endforeach

            @if(!isset($products) || count($products) == 0)
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card product-card">
                    <span class="product-badge">NEW</span>
                    <img src="https://via.placeholder.com/300x250/3498db/ffffff?text=Nike+Air+Max" class="product-img" alt="Nike Air Max">
                    <div class="card-body">
                        <h5 class="product-title">Nike Air Max 270</h5>
                        <p class="text-muted mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            (128)
                        </p>
                        <div class="mb-3">
                            <span class="product-price">1.500.000đ</span>
                            <span class="old-price">2.000.000đ</span>
                        </div>
                        <button class="btn btn-add-cart w-100">
                            <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card product-card">
                    <span class="product-badge">-30%</span>
                    <img src="https://via.placeholder.com/300x250/e74c3c/ffffff?text=Adidas+Ultraboost" class="product-img" alt="Adidas Ultraboost">
                    <div class="card-body">
                        <h5 class="product-title">Adidas Ultraboost 22</h5>
                        <p class="text-muted mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            (95)
                        </p>
                        <div class="mb-3">
                            <span class="product-price">2.100.000đ</span>
                            <span class="old-price">3.000.000đ</span>
                        </div>
                        <button class="btn btn-add-cart w-100">
                            <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card product-card">
                    <span class="product-badge">HOT</span>
                    <img src="https://via.placeholder.com/300x250/2ecc71/ffffff?text=Puma+RS-X" class="product-img" alt="Puma RS-X">
                    <div class="card-body">
                        <h5 class="product-title">Puma RS-X³ Puzzle</h5>
                        <p class="text-muted mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            (76)
                        </p>
                        <div class="mb-3">
                            <span class="product-price">1.800.000đ</span>
                            <span class="old-price">2.500.000đ</span>
                        </div>
                        <button class="btn btn-add-cart w-100">
                            <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card product-card">
                    <span class="product-badge">SALE</span>
                    <img src="https://via.placeholder.com/300x250/9b59b6/ffffff?text=Converse+Chuck" class="product-img" alt="Converse">
                    <div class="card-body">
                        <h5 class="product-title">Converse Chuck 70</h5>
                        <p class="text-muted mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            (203)
                        </p>
                        <div class="mb-3">
                            <span class="product-price">1.200.000đ</span>
                            <span class="old-price">1.600.000đ</span>
                        </div>
                        <button class="btn btn-add-cart w-100">
                            <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card product-card">
                    <img src="https://via.placeholder.com/300x250/f39c12/ffffff?text=Vans+Old+Skool" class="product-img" alt="Vans">
                    <div class="card-body">
                        <h5 class="product-title">Vans Old Skool</h5>
                        <p class="text-muted mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            (154)
                        </p>
                        <div class="mb-3">
                            <span class="product-price">1.400.000đ</span>
                            <span class="old-price">1.800.000đ</span>
                        </div>
                        <button class="btn btn-add-cart w-100">
                            <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card product-card">
                    <span class="product-badge">NEW</span>
                    <img src="https://via.placeholder.com/300x250/16a085/ffffff?text=New+Balance" class="product-img" alt="New Balance">
                    <div class="card-body">
                        <h5 class="product-title">New Balance 574</h5>
                        <p class="text-muted mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star-half-alt text-warning"></i>
                            (89)
                        </p>
                        <div class="mb-3">
                            <span class="product-price">1.900.000đ</span>
                            <span class="old-price">2.400.000đ</span>
                        </div>
                        <button class="btn btn-add-cart w-100">
                            <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card product-card">
                    <span class="product-badge">-25%</span>
                    <img src="https://via.placeholder.com/300x250/34495e/ffffff?text=Reebok+Classic" class="product-img" alt="Reebok">
                    <div class="card-body">
                        <h5 class="product-title">Reebok Classic Leather</h5>
                        <p class="text-muted mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="far fa-star text-warning"></i>
                            (112)
                        </p>
                        <div class="mb-3">
                            <span class="product-price">1.350.000đ</span>
                            <span class="old-price">1.800.000đ</span>
                        </div>
                        <button class="btn btn-add-cart w-100">
                            <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="card product-card">
                    <span class="product-badge">HOT</span>
                    <img src="https://via.placeholder.com/300x250/e67e22/ffffff?text=Jordan+Retro" class="product-img" alt="Jordan">
                    <div class="card-body">
                        <h5 class="product-title">Air Jordan 1 Retro</h5>
                        <p class="text-muted mb-2">
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            <i class="fas fa-star text-warning"></i>
                            (256)
                        </p>
                        <div class="mb-3">
                            <span class="product-price">3.200.000đ</span>
                            <span class="old-price">4.000.000đ</span>
                        </div>
                        <button class="btn btn-add-cart w-100">
                            <i class="fas fa-cart-plus"></i> Thêm vào giỏ
                        </button>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div class="text-center mt-5">
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

@push('scripts')
<script>
    // Add to cart animation
    document.querySelectorAll('.btn-add-cart').forEach(button => {
        button.addEventListener('click', function() {
            const badge = document.querySelector('.cart-badge');
            let currentCount = parseInt(badge.textContent);
            badge.textContent = currentCount + 1;

            // Button animation
            this.innerHTML = '<i class="fas fa-check"></i> Đã thêm';
            this.style.backgroundColor = '#27ae60';

            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-cart-plus"></i> Thêm vào giỏ';
                this.style.backgroundColor = '';
            }, 2000);
        });
    });

    // Category card click animation
    document.querySelectorAll('.category-card').forEach(card => {
        card.addEventListener('click', function() {
            this.style.transform = 'scale(0.95)';
            setTimeout(() => {
                this.style.transform = '';
            }, 200);
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
</script>
@endpush