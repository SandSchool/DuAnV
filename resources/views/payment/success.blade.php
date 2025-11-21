@extends('layout.default')

@section('content')
<div class="container" style="padding: 80px 0;">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <!-- Icon thành công -->
            <div style="margin-bottom: 30px;">
                <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
            </div>

            <h2 class="mb-4" style="font-weight: 700; color: #333;">ĐẶT HÀNG THÀNH CÔNG!</h2>

            <p class="lead mb-5">
                Cảm ơn bạn đã mua hàng tại ShoesVN. <br>
                Mã đơn hàng của bạn là: <strong class="text-primary">#ORD-{{ $order->SOHD }}</strong>
            </p>

            <!-- Tóm tắt đơn hàng -->
            <div class="card mb-5 text-left shadow-sm" style="border: none; background: #f8f9fa;">
                <div class="card-body p-4">
                    <h5 class="card-title border-bottom pb-3 mb-3">Thông tin đơn hàng</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Người nhận:</strong> {{ $order->customer->HOTEN ?? 'Khách lẻ' }}</p>
                            <p class="mb-1"><strong>Ngày đặt:</strong> {{ \Carbon\Carbon::parse($order->NGHD)->format('d/m/Y H:i') }}</p>
                        </div>
                        <div class="col-md-6 text-md-right">
                            <p class="mb-1"><strong>Phương thức:</strong> {{ strtoupper($order->PTVC) }}</p>
                            <p class="mb-1"><strong>Tổng tiền:</strong> <span class="text-danger font-weight-bold" style="font-size: 1.2rem;">{{ number_format($order->TRIGIA) }}đ</span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Các nút điều hướng -->
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('product.index') }}" class="btn btn-outline-primary btn-lg mr-3">
                    <i class="fas fa-shopping-bag"></i> Tiếp tục mua sắm
                </a>
                <a href="{{ route('order.history') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-file-invoice"></i> Xem lịch sử đơn hàng
                </a>
            </div>

            <p class="mt-4 text-muted small">
                Một email xác nhận đã được gửi đến {{ $order->customer->EMAIL ?? 'hòm thư của bạn' }}.<br>
                Vui lòng kiểm tra cả hộp thư Spam nếu không thấy.
            </p>
        </div>
    </div>
</div>
@endsection