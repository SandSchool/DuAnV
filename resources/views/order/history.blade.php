@extends('layout.default')

@section('title', 'Lịch sử đơn hàng')

@section('content')
<div class="order-history-wrapper">
    <div class="container">

        <!-- Header -->
        <div class="page-header">
            <div class="header-content">
                <h2>Lịch sử đơn hàng của tôi</h2>
                <p>Theo dõi trạng thái và chi tiết các đơn hàng đã đặt.</p>
            </div>
            <a href="{{ route('product.index') }}" class="btn-back">
                <i class="fas fa-arrow-left"></i> Tiếp tục mua sắm
            </a>
        </div>

        <!-- Order Box -->
        <div class="order-box">
            <!-- Desktop Table -->
            <div class="table-responsive">
                <table class="order-table">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <!-- ĐÃ XÓA CỘT HÀNH ĐỘNG Ở ĐÂY -->
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <!-- 1. Mã đơn hàng (SOHD) -->
                            <td><span class="order-id">#ORD-{{ $order->SOHD }}</span></td>

                            <!-- 2. Ngày đặt (NGHD) -->
                            <td>
                                <div class="date">
                                    {{ \Carbon\Carbon::parse($order->NGHD)->format('d/m/Y') }}
                                </div>
                                <div class="time">
                                    {{ \Carbon\Carbon::parse($order->NGHD)->format('H:i A') }}
                                </div>
                            </td>

                            <!-- 3. Tổng tiền (TRIGIA) - Đã sửa từ total_money thành TRIGIA -->
                            <td>
                                <div class="price">{{ number_format($order->TRIGIA ?? 0, 0, ',', '.') }} ₫</div>
                                <div class="count">{{ $order->details->count() }} sản phẩm</div>
                            </td>

                            <!-- 4. Trạng thái (TRANGTHAI) - Đã sửa logic hiển thị theo chuỗi -->
                            <td>
                                @if($order->TRANGTHAI == 'cho-xac-nhan')
                                <span class="badge badge-warning">Chờ xác nhận</span>
                                @elseif($order->TRANGTHAI == 'dang-giao' || $order->TRANGTHAI == 'dang-van-chuyen')
                                <span class="badge badge-info">Đang vận chuyển</span>
                                @elseif($order->TRANGTHAI == 'da-giao')
                                <span class="badge badge-success">Đã giao hàng</span>
                                @elseif($order->TRANGTHAI == 'da-huy')
                                <span class="badge badge-danger">Đã hủy</span>
                                @else
                                <span class="badge badge-secondary">{{ $order->TRANGTHAI ?? 'Chờ xử lý' }}</span>
                                @endif
                            </td>

                            <!-- ĐÃ XÓA CỘT NÚT BẤM (Actions) Ở ĐÂY -->
                        </tr>
                        @empty
                        <tr>
                            <!-- Sửa colspan thành 4 vì đã xóa 1 cột -->
                            <td colspan="4" class="empty-state">
                                <i class="fas fa-box-open"></i>
                                <p>Bạn chưa có đơn hàng nào.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection