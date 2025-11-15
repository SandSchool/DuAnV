@extends("layout.default")
@section("content")

<!-- Breadcrumb -->
<section class="breadcrumb-section">
    <div class="container">
        <ol class="breadcrumb-custom">
            <li>
                <a href="{{ route('home.index') }}">
                    <i class="fas fa-home"></i> Trang chủ
                </a>
                <i class="fas fa-chevron-right"></i>
            </li>
            <li>
                <a href="{{ route('product.index') }}">Sản phẩm</a>
                <i class="fas fa-chevron-right"></i>
            </li>
            <li class="active">{{ $product_data->TENSP }}</li>
        </ol>
    </div>
</section>

<!-- Product Detail -->
<section class="py-5">
    <div class="container">
        <div class="product-detail-container">
            <div class="row">
                <!-- Image Gallery -->
                <div class="col-lg-6">
                    <div class="product-image-gallery">
                        <div class="main-image">
                            <img id="mainImage" src="{{ $product_data->HINHANH }}" alt="{{ $product_data->TENSP }}">
                        </div>
                        <div class="thumbnail-images">
                            <div class="thumbnail active" onclick="changeImage('{{ $product_data->HINHANH }}', this)">
                                
                            </div>
                            <div class="thumbnail" onclick="changeImage('{{ $product_data->HINHANH }}', this)">
                                
                            </div>
                            <div class="thumbnail" onclick="changeImage('{{ $product_data->HINHANH }}', this)">
                                
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Info -->
                <div class="col-lg-6">
                    <div class="product-detail-info">
                        <h1>{{ $product_data->TENSP }}</h1>
                        <div class="product-price">{{ number_format($product_data->GIA, 0, ',', '.') }}đ</div>

                        <div class="product-description">
                            <strong><i class="fas fa-info-circle me-2"></i>Mô tả sản phẩm:</strong><br>
                            {{ $product_data->MOTA ?? 'Giày thể thao cao cấp, thiết kế hiện đại, chất liệu bền bỉ. Phù hợp cho nhiều hoạt động thể thao và dạo phố hàng ngày.' }}
                        </div>

                        <div class="product-meta">
                            <div class="product-meta-item">
                                <i class="fas fa-barcode"></i>
                                <strong>SKU:</strong>&nbsp;{{ $product_data->MASP }}
                            </div>
                            <div class="product-meta-item">
                                <i class="fas fa-check-circle"></i>
                                <strong>Tình trạng:</strong>&nbsp;<span style="color: #28a745;">Còn hàng</span>
                            </div>
                            <div class="product-meta-item">
                                <i class="fas fa-tags"></i>
                                <strong>Thương hiệu:</strong>&nbsp;ShoesVN Premium
                            </div>
                        </div>

                        <!-- Size Selection -->
                        <div class="option-group">
                            <label class="option-label">
                                <i class="fas fa-ruler me-2"></i>Chọn size:
                            </label>
                            <div class="option-buttons">
                                <button class="option-btn" onclick="selectOption(this)">38</button>
                                <button class="option-btn active" onclick="selectOption(this)">39</button>
                                <button class="option-btn" onclick="selectOption(this)">40</button>
                                <button class="option-btn" onclick="selectOption(this)">41</button>
                                <button class="option-btn" onclick="selectOption(this)">42</button>
                                <button class="option-btn" onclick="selectOption(this)">43</button>
                            </div>
                        </div>

                        <!-- Color Selection -->
                        <div class="option-group">
                            <label class="option-label">
                                <i class="fas fa-palette me-2"></i>Chọn màu:
                            </label>
                            <div class="option-buttons">
                                <button class="option-btn active" onclick="selectOption(this)">Đen</button>
                                <button class="option-btn" onclick="selectOption(this)">Trắng</button>
                                <button class="option-btn" onclick="selectOption(this)">Xanh</button>
                                <button class="option-btn" onclick="selectOption(this)">Đỏ</button>
                            </div>
                           </div>

                        <form action="{{ route('cart.addFromDetail', $product_data->MASP) }}" method="POST">
    @csrf

    <!-- Quantity -->
    <div class="quantity-selector">
        <span class="quantity-label">Số lượng:</span>
        <div class="quantity-input">
            <button type="button" class="quantity-btn" onclick="decreaseQuantity()">
                <i class="fas fa-minus"></i>
            </button>
            <input type="number" id="quantity" name="quantity" class="quantity-value" value="1" min="1" readonly>
            <button type="button" class="quantity-btn" onclick="increaseQuantity()">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="action-buttons">
        <button type="submit" class="btn-add-cart">
            <i class="fas fa-shopping-cart"></i>
            Thêm vào giỏ hàng
        </button>
        <button class="btn-wishlist" title="Thêm vào yêu thích">
            <i class="fas fa-heart"></i>
        </button>
    </div>
</form>


                        <!-- Accordion Info -->
                        <div class="accordion" id="productAccordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#description">
                                        <i class="fas fa-file-alt me-2"></i>Mô tả chi tiết
                                    </button>
                                </h2>
                                <div id="description" class="accordion-collapse collapse show" data-bs-parent="#productAccordion">
                                    <div class="accordion-body">
                                        Giày thể thao cao cấp với công nghệ đệm khí tiên tiến, mang lại sự thoải mái tối đa cho đôi chân.
                                        Thiết kế hiện đại, phù hợp với mọi phong cách thời trang. Chất liệu da tổng hợp cao cấp,
                                        bền bỉ theo thời gian.
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#shipping">
                                        <i class="fas fa-shipping-fast me-2"></i>Chính sách giao hàng
                                    </button>
                                </h2>
                                <div id="shipping" class="accordion-collapse collapse" data-bs-parent="#productAccordion">
                                    <div class="accordion-body">
                                        - Miễn phí giao hàng cho đơn hàng trên 500.000đ<br>
                                        - Giao hàng trong 2-3 ngày làm việc<br>
                                        - Đổi trả trong vòng 7 ngày nếu sản phẩm bị lỗi<br>
                                        - Kiểm tra hàng trước khi thanh toán
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#warranty">
                                        <i class="fas fa-shield-alt me-2"></i>Bảo hành
                                    </button>
                                </h2>
                                <div id="warranty" class="accordion-collapse collapse" data-bs-parent="#productAccordion">
                                    <div class="accordion-body">
                                        - Bảo hành 6 tháng đối với lỗi từ nhà sản xuất<br>
                                        - Hỗ trợ đổi size trong 30 ngày đầu tiên<br>
                                        - Vệ sinh giày miễn phí trong thời gian bảo hành<br>
                                        - Cam kết 100% hàng chính hãng
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Products -->
<section class="related-products">
    <div class="container">
        <div class="section-title">
            <h2><i class="fas fa-star me-2"></i>Sản phẩm liên quan</h2>
            <p style="color: #666;">Các sản phẩm tương tự bạn có thể quan tâm</p>
        </div>
        <div class="row">
            @foreach($related_products as $item)
<div class="col-lg-3 col-md-6 mb-4">
    <div class="product-card" style="background: white; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 20px rgba(0,0,0,0.08);">
        
        <div style="padding-top: 100%; position: relative; overflow: hidden;">
            <img src="{{ $item->HINHANH }}" alt="{{ $item->TENSP }}"
                style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; object-fit: cover;">
        </div>

        <div style="padding: 20px;">
            <h6 style="font-weight: 600; margin-bottom: 10px;">{{ $item->TENSP }}</h6>

            <div style="font-size: 18px; font-weight: 700; color: #667eea; margin-bottom: 15px;">
                {{ number_format($item->GIA, 0, ',', '.') }}đ
            </div>

           <a href="{{ route('product.detail', ['product' => $item->MASP]) }}"class="btn btn-sm w-100"
                style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; border: none; border-radius: 8px; padding: 10px;">
                Xem chi tiết
            </a>
        </div>

    </div>
</div>
@endforeach

    </div>
    </div>
</section>

<script>
    function changeImage(src, element) {
        document.getElementById('mainImage').src = src;
        document.querySelectorAll('.thumbnail').forEach(t => t.classList.remove('active'));
        element.classList.add('active');
    }

    function selectOption(element) {
        element.parentElement.querySelectorAll('.option-btn').forEach(btn => btn.classList.remove('active'));
        element.classList.add('active');
    }

    function decreaseQuantity() {
        const input = document.getElementById('quantity');
        if (input.value > 1) input.value = parseInt(input.value) - 1;
    }

    function increaseQuantity() {
        const input = document.getElementById('quantity');
        input.value = parseInt(input.value) + 1;
    }
</script>
@endsection