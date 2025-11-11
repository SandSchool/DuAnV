@extends("layout.default")
@section("content")

<style>
    .cart-page-section {
        padding: 60px 0;
        background: #f8f9fa;
        min-height: 70vh;
    }

    .cart-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .section-title-cart {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        text-align: center;
        margin-bottom: 40px;
    }

    .cart-item {
        display: flex;
        align-items: center;
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.07);
        padding: 20px;
        margin-bottom: 20px;
        gap: 20px;
    }

    .cart-item-img {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #eee;
    }

    .cart-item-details {
        flex-grow: 1;
    }

    .item-name {
        font-size: 1.2rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
        text-decoration: none;
    }

    .item-name:hover {
        color: #667eea;
    }

    .item-price {
        font-size: 1.1rem;
        color: #555;
    }

    .quantity-form {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .quantity-input-cart {
        width: 60px;
        text-align: center;
        border: 2px solid #e0e0e0;
        border-radius: 8px;
        padding: 8px;
        font-weight: 600;
    }

    .update-btn {
        padding: 8px 12px;
        border: none;
        border-radius: 8px;
        background: #667eea;
        color: white;
        font-size: 0.9rem;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.3s;
    }

    .update-btn:hover {
        background: #5a6fcf;
    }

    .item-total-price {
        font-size: 1.2rem;
        font-weight: 700;
        color: #333;
        width: 120px;
        text-align: right;
    }

    .remove-btn {
        color: #e57373;
        font-size: 1.3rem;
        text-decoration: none;
        padding: 10px;
        transition: color 0.3s;
    }

    .remove-btn:hover {
        color: #d32f2f;
    }

    .cart-summary {
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.07);
        padding: 30px;
        margin-top: 30px;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 25px;
    }

    .summary-total span {
        color: #555;
    }

    .summary-total strong {
        color: #667eea;
    }

    .checkout-btn {
        display: block;
        width: 100%;
        padding: 15px;
        border: none;
        border-radius: 8px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-size: 1.2rem;
        font-weight: 600;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .checkout-btn:hover {
        opacity: 0.9;
        box-shadow: 0 7px 20px rgba(102, 126, 234, 0.3);
        transform: translateY(-2px);
    }

    .empty-cart {
        background: white;
        border-radius: 15px;
        padding: 60px;
        text-align: center;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.07);
    }

    .empty-cart i {
        font-size: 5rem;
        color: #e0e0e0;
        margin-bottom: 25px;
    }

    .empty-cart h3 {
        font-size: 1.5rem;
        color: #555;
        margin-bottom: 25px;
    }

    .btn-shop-now {
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-size: 1.1rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-shop-now:hover {
        opacity: 0.9;
        box-shadow: 0 7px 20px rgba(102, 126, 234, 0.3);
    }
</style>

<section class="cart-page-section">
    <div class="container cart-container">
        <h1 class="section-title-cart">Giỏ Hàng Của Bạn</h1>

        {{-- Kiểm tra xem giỏ hàng có rỗng không --}}
        @if(!empty($cartItems))
        <div class="cart-items-list">

            {{-- Lặp qua các sản phẩm trong giỏ hàng (từ $cartItems) --}}
            @foreach($cartItems as $id => $item)
            <div class="cart-item">
                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="cart-item-img">

                <div class="cart-item-details">
                    <a href="#" class="item-name">{{ $item['name'] }}</a>
                    <div class="item-price">{{ number_format($item['price'], 0, ',', '.') }}đ</div>
                </div>

                <!-- Form cập nhật số lượng -->
                <!-- Trỏ đến route 'cart.update' -->
                <form action="{{ route('cart.update') }}" method="POST" class="quantity-form">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}">
                    <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="quantity-input-cart">
                    <button type="submit" class="update-btn">Cập nhật</button>
                </form>

                <div class="item-total-price">
                    {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}đ
                </div>

                <!-- Nút Xóa -->
                <!-- Trỏ đến route 'cart.remove' -->
                <a href="{{ route('cart.remove', $id) }}" class="remove-btn" title="Xóa sản phẩm">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </div>
            @endforeach
        </div>

        <!-- Tổng kết giỏ hàng -->
        <div class="cart-summary">
            <div class="summary-total">
                <span>Tổng tiền:</span>
                <!-- Biến $total từ CartController -->
                <strong>{{ number_format($total, 0, ',', '.') }}đ</strong>
            </div>
            <a href="#" class="checkout-btn">Tiến hành thanh toán</a>
        </div>

        @else
        <!-- Khi giỏ hàng rỗng -->
        <div class="empty-cart">
            <i class="fas fa-shopping-cart"></i>
            <h3>Giỏ hàng của bạn đang trống</h3>
            <a href="{{ route('product.index') }}" class="btn-shop-now">Tiếp tục mua sắm</a>
        </div>
        @endif

    </div>
</section>

@endsection