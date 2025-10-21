<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ShoesVN - Shop Giày Chính Hãng')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #e74c3c;
            --accent-color: #3498db;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        /* Header */
        .top-bar {
            background-color: var(--primary-color);
            color: white;
            padding: 10px 0;
            font-size: 14px;
        }

        .navbar {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 24px;
            color: var(--secondary-color) !important;
        }

        .nav-link {
            color: var(--primary-color) !important;
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: var(--secondary-color) !important;
        }

        /* Search Bar */
        .search-container {
            max-width: 500px;
        }

        .search-input {
            border-radius: 25px 0 0 25px;
            border-right: none;
        }

        .search-btn {
            border-radius: 0 25px 25px 0;
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }

        .search-btn:hover {
            background-color: #c0392b;
            border-color: #c0392b;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-color) 100%);
            color: white;
            padding: 80px 0;
            text-align: center;
        }

        .hero-title {
            font-size: 48px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        /* Product Card */
        .product-card {
            border: none;
            border-radius: 15px;
            overflow: hidden;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        }

        .product-img {
            height: 250px;
            object-fit: cover;
            width: 100%;
        }

        .product-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: var(--secondary-color);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }

        .product-title {
            font-size: 18px;
            font-weight: 600;
            margin: 15px 0 10px;
            color: var(--primary-color);
        }

        .product-price {
            font-size: 22px;
            font-weight: bold;
            color: var(--secondary-color);
        }

        .old-price {
            text-decoration: line-through;
            color: #999;
            font-size: 16px;
            margin-left: 10px;
        }

        .btn-add-cart {
            background-color: var(--accent-color);
            color: white;
            border: none;
            border-radius: 25px;
            padding: 10px 30px;
            font-weight: 500;
            transition: background-color 0.3s;
        }

        .btn-add-cart:hover {
            background-color: #2980b9;
            color: white;
        }

        /* Category Section */
        .category-section {
            background-color: #f8f9fa;
            padding: 60px 0;
        }

        .category-card {
            background: white;
            border-radius: 10px;
            padding: 30px;
            text-align: center;
            transition: transform 0.3s;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .category-card:hover {
            transform: scale(1.05);
        }

        .category-icon {
            font-size: 48px;
            color: var(--accent-color);
            margin-bottom: 15px;
        }

        /* Footer */
        .footer {
            background-color: var(--primary-color);
            color: white;
            padding: 50px 0 20px;
        }

        .footer h5 {
            color: var(--secondary-color);
            margin-bottom: 20px;
            font-weight: bold;
        }

        .footer a {
            color: #ecf0f1;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
            transition: color 0.3s;
        }

        .footer a:hover {
            color: var(--secondary-color);
        }

        .social-icons a {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            border-radius: 50%;
            background-color: rgba(255,255,255,0.1);
            margin-right: 10px;
            transition: background-color 0.3s;
        }

        .social-icons a:hover {
            background-color: var(--secondary-color);
        }

        .section-title {
            font-size: 36px;
            font-weight: bold;
            text-align: center;
            margin-bottom: 50px;
            color: var(--primary-color);
        }

        .cart-icon {
            position: relative;
        }

        .cart-badge {
            position: absolute;
            top: -5px;
            right: -10px;
            background-color: var(--secondary-color);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
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
                        <a class="nav-link" href="/">Trang chủ</a>
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