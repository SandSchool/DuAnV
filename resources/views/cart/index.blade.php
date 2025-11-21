@extends('layout.default')

@section('content')
<div class="container" style="padding: 50px 0;">
    <h2 class="text-center mb-4">Xác nhận thanh toán</h2>

    <!-- hiển thị thông báo lỗi nếu có -->
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Kiểm tra giỏ hàng có rỗng không -->
    @if(empty(session('cart')) || count(session('cart')) == 0)
    <div class="text-center py-5">
        <div class="mb-4">
            <i class="fas fa-shopping-cart text-muted" style="font-size: 80px; opacity: 0.3;"></i>
        </div>
        <h4 class="text-muted">Giỏ hàng của bạn đang trống!</h4>
        <p class="text-muted mb-4">Hãy chọn thêm vài sản phẩm ưng ý trước khi thanh toán nhé.</p>
        <a href="{{ route('product.index') }}" class="btn btn-primary btn-lg">
            <i class="fas fa-arrow-left"></i> Quay lại mua sắm
        </a>
    </div>
    @else
    <!-- [ĐÃ SỬA 1] Thêm onsubmit="return validateForm()" để kích hoạt cảnh báo -->
    <form action="{{ route('payment.index') }}" method="POST" id="checkout-form" onsubmit="return validateForm()">
        @csrf
        <div class="row">
            <!-- Cột bên trái: Thông tin giao hàng -->
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        Thông tin người nhận
                    </div>
                    <div class="card-body">
                        @if(Auth::guard('cus')->check())
                        <p><strong>Họ tên:</strong> {{ Auth::guard('cus')->user()->HOTEN }}</p>
                        <p><strong>Email:</strong> {{ Auth::guard('cus')->user()->EMAIL }}</p>
                        <p><strong>SĐT:</strong> {{ Auth::guard('cus')->user()->SODT }}</p>
                        <p><strong>Địa chỉ:</strong> {{ Auth::guard('cus')->user()->DCHI }}</p>
                        @else
                        <p>Bạn chưa đăng nhập.</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Cột bên phải: Tổng kết đơn hàng & Nút Đặt Hàng -->
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Đơn hàng của bạn
                    </div>
                    <div class="card-body">
                        <ul class="list-group mb-3" id="cart-items-list">
                            @php $total = 0; @endphp
                            @foreach(session('cart', []) as $id => $item)
                            @php
                            $qty = $item['quantity'] ?? $item['QTY'] ?? 0;
                            $price = $item['price'] ?? $item['GIA'] ?? $item['GIABAN'] ?? 0;
                            $subtotal = $qty * $price;
                            $total += $subtotal;
                            @endphp

                            <!-- Thêm class .cart-item để JS dễ tìm -->
                            <li class="list-group-item d-flex justify-content-between lh-condensed cart-item">
                                <div style="width: 60%;">
                                    <h6 class="my-0">{{ $item['name'] ?? $item['TENSP'] }}</h6>
                                    <small class="text-muted">Đơn giá: {{ number_format($price) }}đ</small>

                                    <!-- Input thay đổi số lượng -->
                                    <div class="input-group input-group-sm mt-2" style="width: 120px;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">SL</span>
                                        </div>
                                        <input type="number"
                                            class="form-control item-qty"
                                            value="{{ $qty }}"
                                            min="1"
                                            data-price="{{ $price }}"
                                            name="quantities[{{ $id }}]">
                                    </div>
                                </div>

                                <!-- Hiển thị thành tiền của từng món -->
                                <span class="text-muted item-subtotal-display">{{ number_format($subtotal) }}đ</span>
                            </li>
                            @endforeach

                            <!-- Hiển thị phí vận chuyển -->
                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <div class="text-success">
                                    <h6 class="my-0">Phí vận chuyển</h6>
                                </div>
                                <span class="text-success" id="shipping-fee-display">0đ</span>
                            </li>

                            <!-- Tổng tiền cuối cùng -->
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Tổng cộng (VND)</span>
                                <strong id="grand-total-display">{{ number_format($total) }}đ</strong>
                                <input type="hidden" name="total_amount" id="hidden_total_amount" value="{{ $total }}">
                            </li>
                        </ul>

                        <div class="form-group mb-3">
                            <label><strong>Phương thức vận chuyển:</strong></label>
                            <select name="transport_method" id="transport_method" class="form-control" onchange="updateTotal()">
                                <option value="" data-fee="0">-- Chọn phương thức --</option>
                                <option value="ghtc" data-fee="30000">Giao hàng tiêu chuẩn (30.000đ)</option>
                                <option value="ghn" data-fee="50000">Giao hàng nhanh (50.000đ)</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success btn-lg btn-block w-100">
                            XÁC NHẬN ĐẶT HÀNG
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    @endif
</div>

@endsection
@push('scripts')
<script src="{{ asset('resources/js/cart.js') }}"></script>
@endpush