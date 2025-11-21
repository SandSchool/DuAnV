<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ShoesVN - Shop Giày Chính Hãng')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/register.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/profile.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/indexproduct.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/detail.css') }}">
    <link rel="stylesheet" href="{{ asset('resources/css/orderhistory.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- CÁC STYLE RIÊNG CỦA TỪNG TRANG SẼ ĐƯỢC ĐẨY VÀO ĐÂY --}}
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home.index') }}">
                <i class="fas fa-shoe-prints"></i> ShoesVN
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.index') }}">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('product.index') }}">Sản phẩm</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home.about') }}">Giới thiệu</a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <!-- SỬA 1: Trỏ đến route 'cart.index' (như trong routes/web.php) -->
                        <a class="nav-link cart-icon" href="{{ route('cart.show') }}" title="Giỏ hàng">
                            <i class="fas fa-shopping-cart"></i>
                            <!-- SỬA 2: Hiển thị biến $cartCount từ AppServiceProvider -->
                            <span class="cart-badge">{{ $cartCount ?? 0 }}</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown ms-2">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false" title="Tài khoản">
                            <i class="fas fa-user fa-lg"></i>
                            @auth('cus')
                            <span class="ms-2 d-none d-lg-inline">{{ Auth::guard('cus')->user()->HOTEN }}</span>
                            @endauth
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            @auth('cus')
                            <li class="px-3 py-2 border-bottom">
                                <small class="text-muted">Xin chào,</small><br>
                                <strong>{{ Auth::guard('cus')->user()->HOTEN }}</strong>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('customer.profile') }}">
                                    <i class="fas fa-user-circle fa-fw me-2 text-info"></i> Thông tin cá nhân
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('cart.show') }}">
                                    <i class="fas fa-shopping-bag fa-fw me-2 text-success"></i> Đơn hàng của tôi
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('order.history') }}">
                                    <i class="fas fa-history fa-fw me-2 text-success"></i> Lịch sử mua hàng
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <form action="{{ route('customer.logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger border-0 bg-transparent w-100 text-start">
                                        <i class="fas fa-sign-out-alt fa-fw me-2"></i> Đăng xuất
                                    </button>
                                </form>
                            </li>
                            @else
                            <li>
                                <a class="dropdown-item" href="{{ route('customer.login') }}">
                                    <i class="fas fa-sign-in-alt fa-fw me-2 text-primary"></i> Đăng nhập
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('customer.register') }}">
                                    <i class="fas fa-user-plus fa-fw me-2 text-success"></i> Đăng ký
                                </a>
                            </li>
                            @endauth
                        </ul>
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

            <!-- PHẦN COPYRIGHT Ở DƯỚI CÙNG -->
            <div class="text-center">
                <p class="mb-0">&copy; 2024 ShoesVN. All rights reserved. Designed with <i class="fas fa-heart text-danger"></i></p>

                {{-- =========================================================== --}}
                {{-- LINK ẨN VÀO ADMIN (Secret Door) --}}
                {{-- Chỉ hiển thị một dấu chấm (.) rất mờ --}}
                {{-- =========================================================== --}}
                <a href="{{ url('/admin') }}"
                    title="Admin Panel"
                    style="color: inherit; text-decoration: none; font-size: 10px; opacity: 0.05; display: inline-block; margin-top: 5px;">.</a>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- CÁC SCRIPT RIÊNG CỦA TỪNG TRANG SẼ ĐƯỢC ĐẨY VÀO ĐÂY --}}
    @stack('scripts')
</body>

</html>