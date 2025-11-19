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

    /* ======================================== */
    /* CSS MỚI CHO KHỐI GIAO HÀNG */
    /* ======================================== */

    .shipping-options {
        background: white;
        border-radius: 15px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.07);
        padding: 30px;
        margin-top: 30px;
        /* Thêm khoảng cách với các item bên trên */
    }

    .shipping-title {
        font-size: 1.4rem;
        /* Giảm cỡ chữ 1 chút */
        font-weight: 600;
        color: #333;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 1px solid #f0f0f0;
        /* Thêm đường kẻ mờ */
    }

    .shipping-option {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 10px;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        margin-bottom: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    /* Khi rê chuột vào một lựa chọn */
    .shipping-option:hover {
        border-color: #667eea;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.15);
    }

    /* Khi radio được chọn, làm nổi bật lựa chọn đó */
    .shipping-option input[type="radio"]:checked+label strong {
        color: #667eea;
    }

    .shipping-option label {
        display: flex;
        flex-direction: column;
        /* Cho 2 dòng text xếp dọc */
        cursor: pointer;
        flex-grow: 1;
        margin-left: 15px;
    }

    .shipping-option label strong {
        font-weight: 600;
        color: #444;
        transition: color 0.3s;
    }

    .shipping-option label span {
        font-size: 0.9rem;
        color: #777;
    }

    .shipping-cost {
        font-size: 1.1rem;
        font-weight: 700;
        color: #333;
    }

    /* Style cho nút "Cập nhật Phí" (giống nút "Cập nhật" ở trên) */
    #update-shipping-btn {
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

    #update-shipping-btn:hover {
        background: #5a6fcf;
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
                <a href="{{ route('cart.remove', $id) }}" class="remove-btn" title="Xóa sản phẩm">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </div>
            @endforeach
        </div> <!-- Kết thúc .cart-items-list -->

        <!-- ======================================== -->
        <!-- BẮT ĐẦU PHẦN MỚI: HÌNH THỨC GIAO HÀNG -->
        <!-- ======================================== -->
        <div class="shipping-options">
            <h3 class="shipping-title">Chọn hình thức giao hàng</h3>

            <div class="shipping-option">
                <input type="radio" id="shipping-standard" name="shipping_method" value="standard" data-cost="30000" checked>
                <label for="shipping-standard">
                    <strong>Giao hàng Tiêu chuẩn</strong>
                    <span>(Nhận sau 2-3 ngày)</span>
                </label>
                <strong class="shipping-cost">30.000đ</strong>
            </div>

            <div class="shipping-option">
                <input type="radio" id="shipping-express" name="shipping_method" value="express" data-cost="50000">
                <label for="shipping-express">
                    <strong>Giao hàng Nhanh</strong>
                    <span>(Nhận trong 24h)</span>
                </label>
                <strong class="shipping-cost">50.000đ</strong>
            </div>

            <!-- Nút cập nhật phí vận chuyển (thêm vào) -->
            <button id="update-shipping-btn" style="display: none; margin-top: 15px;">Cập nhật Phí</button>
        </div>
        <!-- ======================================== -->
        <!-- KẾT THÚC PHẦN MỚI -->
        <!-- ======================================== -->

        <!-- Tổng kết giỏ hàng -->
        <!-- SỬA: Thêm data-subtotal chứa giá trị số của $total -->
        <div class="cart-summary" data-subtotal="{{ $total }}">
            <div class="summary-row">
                <span>Tạm tính (sản phẩm):</span>
                <!-- Biến $total (tổng tiền hàng) từ CartController -->
                <strong id="cart-subtotal">{{ number_format($total, 0, ',', '.') }}đ</strong>
            </div>

            <div class="summary-row">
                <span>Phí vận chuyển:</span>
                <strong id="shipping-fee-display">30.000đ</strong> <!-- Sẽ được JS cập nhật -->
            </div>

            <div class="summary-total">
                <span>Tổng cộng:</span>
                <strong id="cart-total">{{ number_format($total + 30000, 0, ',', '.') }}đ</strong> <!-- Sẽ được JS cập nhật -->
            </div>

            <a href="#" class="checkout-btn" style="margin-top: 25px;">Tiến hành thanh toán</a>
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

<!-- ======================================== -->
<!-- BẮT ĐẦU PHẦN SCRIPT MỚI -->
<!-- ======================================== -->
<script>
    // Chờ cho tất cả HTML được tải xong
    document.addEventListener('DOMContentLoaded', function() {

        // Định dạng số (Ví dụ: 100000 -> 100.000đ)
        const numberFormatter = new Intl.NumberFormat('vi-VN', {
            style: 'currency',
            currency: 'VND',
            minimumFractionDigits: 0
        });

        // Tìm khu vực tổng kết giỏ hàng
        const cartSummary = document.querySelector('.cart-summary');

        // Nếu không tìm thấy (ví dụ: giỏ hàng rỗng), thì không làm gì cả
        if (!cartSummary) {
            return;
        }

        // SỬA: Lấy tổng tiền hàng (subtotal) từ thuộc tính 'data-subtotal'
        const subtotal = parseFloat(cartSummary.dataset.subtotal) || 0;

        // Lấy các element trên trang
        const shippingRadios = document.querySelectorAll('input[name="shipping_method"]');
        const shippingFeeDisplay = document.getElementById('shipping-fee-display');
        const cartTotalDisplay = document.getElementById('cart-total');

        // ✅ BẮT ĐẦU THAY ĐỔI: Lấy nút cập nhật
        const updateShippingBtn = document.getElementById('update-shipping-btn');
        // ✅ KẾT THÚC THAY ĐỔI

        // --- HÀM CẬP NHẬT TỔNG TIỀN ---
        function updateCartTotal() {
            let shippingCost = 0;

            const checkedRadio = document.querySelector('input[name="shipping_method"]:checked');

            if (checkedRadio) {
                shippingCost = parseInt(checkedRadio.dataset.cost, 10);
            }

            const finalTotal = subtotal + shippingCost;

            if (shippingFeeDisplay) {
                shippingFeeDisplay.textContent = numberFormatter.format(shippingCost);
            }
            if (cartTotalDisplay) {
                cartTotalDisplay.textContent = numberFormatter.format(finalTotal);
            }
            // Cập nhật luôn cả tổng tiền hàng (tạm tính)
            const subtotalDisplay = document.getElementById('cart-subtotal');
            if (subtotalDisplay) {
                subtotalDisplay.textContent = numberFormatter.format(subtotal);
            }
        }

        // --- THÊM EVENT LISTENERS ---

        // ✅ BẮT ĐẦU THAY ĐỔI: Sửa logic của listeners

        // 1. Listener cho cả .shipping-option (để click vào đâu cũng chọn)
        document.querySelectorAll('.shipping-option').forEach(option => {
            option.addEventListener('click', function() {
                const radio = this.querySelector('input[type="radio"]');
                if (radio && !radio.checked) { // Chỉ chạy nếu radio chưa được chọn
                    radio.checked = true;
                    // Hiển thị nút cập nhật, KHÔNG gọi updateCartTotal()
                    if (updateShippingBtn) {
                        updateShippingBtn.style.display = 'block';
                    }
                } else if (radio) {
                    radio.checked = true; // Đảm bảo radio được check khi click
                }
            });
        });

        // 2. Listener cho các radio (đề phòng user click thẳng vào radio)
        shippingRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                // Hiển thị nút cập nhật, KHÔNG gọi updateCartTotal()
                if (updateShippingBtn) {
                    updateShippingBtn.style.display = 'block';
                }
            });
        });

        // 3. Listener MỚI cho nút Cập nhật
        if (updateShippingBtn) {
            updateShippingBtn.addEventListener('click', function() {
                updateCartTotal(); // Gọi hàm cập nhật
                this.style.display = 'none'; // Ẩn nút đi sau khi cập nhật
            });
        }

        // ✅ KẾT THÚC THAY ĐỔI

        // Chạy 1 lần khi tải trang để tính toán chi phí ban đầu
        updateCartTotal();
    });
</script>
<!-- ======================================== -->
<!-- KẾT THÚC PHẦN SCRIPT MỚI -->
<!-- ======================================== -->

@endsection