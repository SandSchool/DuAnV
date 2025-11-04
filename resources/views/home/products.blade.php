@extends('layouts.app')

@section('title', 'Sản phẩm - ShoesVN')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 style="font-size: 42px; font-weight: 800; background: linear-gradient(135deg, #667eea, #764ba2); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
            🔥 Sản Phẩm Hot Nhất
        </h2>
        <p style="color: #718096; font-size: 18px;">Khám phá những mẫu giày độc đáo với công nghệ tiên tiến</p>
    </div>

    <!-- 3D FLIP CARDS SECTION -->
    <h3 class="mb-4" style="color: #2d3748; font-weight: 700;">✨ 3D Flip Cards</h3>
    <div class="row">
        @foreach($products->take(3) as $product)
        <div class="col-md-4">
            <!-- Insert 3D Flip Card code here -->
        </div>
        @endforeach
    </div>

    <!-- GLASSMORPHISM CARDS SECTION -->
    <h3 class="mb-4 mt-5" style="color: #2d3748; font-weight: 700;">💎 Glassmorphism Style</h3>
    <div class="row">
        @foreach($products->skip(3)->take(3) as $product)
        <div class="col-md-4">
            <!-- Insert Glassmorphism Card code here -->
        </div>
        @endforeach
    </div>

    <!-- NEON GLOW CARDS SECTION -->
    <h3 class="mb-4 mt-5" style="color: #2d3748; font-weight: 700;">⚡ Neon Glow Style</h3>
    <div class="row">
        @foreach($products->skip(6)->take(3) as $product)
        <div class="col-md-4">
            <!-- Insert Neon Glow Card code here -->
        </div>
        @endforeach
    </div>
</div>
@endsection

@push('scripts')
<script>
    function addToCart(productId) {
        // Thêm logic add to cart của bạn ở đây
        console.log('Added product ' + productId + ' to cart');

        // Cập nhật cart badge
        let currentCount = parseInt(document.querySelector('.cart-badge').textContent);
        updateCartBadge(currentCount + 1);

        // Có thể thêm notification
        alert('Đã thêm sản phẩm vào giỏ hàng!');
    }
</script>