<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ShoesVN - Shop Giày Chính Hãng')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">

    {{-- CÁC STYLE RIÊNG CỦA TỪNG TRANG SẼ ĐƯỢC ĐẨY VÀO ĐÂY --}}
</head>

<body>
    <div class="top-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <i class="fas fa-phone"></i> Hotline: 1900 1234
                    <i class="fas fa-envelope ms-3"></i> contact@shoesvn.com
                </div>
                <div class="col-md-6 text-end">
                    <a href="{{ route('customer.login') }}" class="text-white text-decoration-none me-3"><i class="fas fa-user"></i> Đăng nhập</a>
                    <a href="#" class="text-white text-decoration-none"><i class="fas fa-user-plus"></i> Đăng ký</a>
                </div>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="/">
                <i class="fas fa-shoe-prints"></i> ShoesVN
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/products">Sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/about">Giới thiệu</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/contact">Liên hệ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link cart-icon" href="/cart">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="cart-badge">0</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <main>
        {{-- NỘI DUNG CỦA CÁC TRANG CON SẼ ĐƯỢC TẢI VÀO ĐÂY --}}
        @yield('content')
    </main>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5><i class="fas fa-shoe-prints"></i> ShoesVN</h5>
                    <p>Chuyên cung cấp giày thể thao, giày công sở chính hãng với giá tốt nhất thị trường. Cam kết 100% hàng chính hãng.</p>
                    <div class="social-icons">
                        <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
                        <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://tiktok.com" target="_blank"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Sản phẩm</h5>
                    <a href="/products/category/sport">Giày thể thao</a>
                    <a href="/products/category/office">Giày công sở</a>
                    <a href="/products/category/outdoor">Giày outdoor</a>
                    <a href="/products/category/fashion">Giày thời trang</a>
                </div>
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5>Hỗ trợ</h5>
                    <a href="/support/shipping">Chính sách giao hàng</a>
                    <a href="/support/return">Đổi trả hàng</a>
                    <a href="/support/payment">Hướng dẫn thanh toán</a>
                    <a href="/support/faq">Câu hỏi thường gặp</a>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <h5>Liên hệ</h5>
                    <p><i class="fas fa-map-marker-alt"></i> 123 Nguyễn Huệ, Q.1, TP.HCM</p>
                    <p><i class="fas fa-phone"></i> Hotline: 1900 1234</p>
                    <p><i class="fas fa-envelope"></i> contact@shoesvn.com</p>
                    <p><i class="fas fa-clock"></i> 8:00 - 22:00 (Tất cả các ngày)</p>
                </div>
            </div>
            <hr style="border-color: rgba(255,255,255,0.1);">
            <div class="text-center">
                <p class="mb-0">&copy; 2024 ShoesVN. All rights reserved. Designed with <i class="fas fa-heart text-danger"></i></p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- CÁC SCRIPT RIÊNG CỦA TỪNG TRANG SẼ ĐƯỢC ĐẨY VÀO ĐÂY --}}
    @stack('scripts')
</body>

</html>