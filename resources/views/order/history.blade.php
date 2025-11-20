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
                            <th class="text-right">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td><span class="order-id">#ORD-{{ $order->id }}</span></td>
                            <td>
                                <div class="date">{{ $order->created_at->format('d/m/Y') }}</div>
                                <div class="time">{{ $order->created_at->format('H:i A') }}</div>
                            </td>
                            <td>
                                <div class="price">{{ number_format($order->total_money ?? 0) }} ₫</div>
                                <div class="count">{{ $order->details->count() }} sản phẩm</div>
                            </td>
                            <td>
                                @if($order->status == 0)
                                <span class="badge badge-warning">Chờ xác nhận</span>
                                @elseif($order->status == 1)
                                <span class="badge badge-info">Đang vận chuyển</span>
                                @elseif($order->status == 2)
                                <span class="badge badge-success">Đã giao hàng</span>
                                @elseif($order->status == 3)
                                <span class="badge badge-danger">Đã hủy</span>
                                @else
                                <span class="badge badge-secondary">Không xác định</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <a href="{{ route('order.detail', $order->id) }}" class="btn-detail">Xem chi tiết</a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="empty-state">
                                <i class="fas fa-box-open"></i>
                                <p>Bạn chưa có đơn hàng nào.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile List (Chỉ hiện trên mobile) -->
            <div class="mobile-list">
                @foreach($orders as $order)
                <div class="mobile-item">
                    <div class="mobile-header">
                        <span class="order-id">#ORD-{{ $order->id }}</span>
                        <!-- Copy lại logic badge trạng thái ở trên xuống đây -->
                        @if($order->status == 0) <span class="badge badge-warning">Chờ xử lý</span>
                        @elseif($order->status == 2) <span class="badge badge-success">Hoàn thành</span>
                        @else <span class="badge badge-secondary">...</span> @endif
                    </div>
                    <div class="mobile-row"><i class="far fa-calendar-alt"></i> {{ $order->created_at->format('d/m/Y') }}</div>
                    <div class="mobile-row"><i class="fas fa-money-bill-wave"></i> Tổng: <strong>{{ number_format($order->total_money) }} ₫</strong></div>
                    <a href="{{ route('order.detail', $order->id) }}" class="btn-detail-mobile">Xem chi tiết</a>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>

<!-- CSS STYLE -->
<style>
    /* Layout Chung */
    .order-history-wrapper {
        background-color: #f9fafb;
        min-height: 100vh;
        padding: 40px 0;
        font-family: sans-serif;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Header */
    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .header-content h2 {
        font-size: 24px;
        font-weight: bold;
        color: #111827;
        margin: 0;
    }

    .header-content p {
        margin: 5px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    .btn-back {
        text-decoration: none;
        color: #374151;
        background: white;
        border: 1px solid #d1d5db;
        padding: 8px 16px;
        border-radius: 6px;
        font-weight: 500;
        transition: 0.2s;
    }

    .btn-back:hover {
        background: #f3f4f6;
    }

    /* Order Box & Table */
    .order-box {
        background: white;
        border-radius: 8px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }

    .order-table {
        width: 100%;
        border-collapse: collapse;
    }

    .order-table th {
        background: #f9fafb;
        text-align: left;
        padding: 12px 24px;
        font-size: 12px;
        text-transform: uppercase;
        color: #6b7280;
        font-weight: 600;
        letter-spacing: 0.05em;
    }

    .order-table td {
        padding: 16px 24px;
        border-top: 1px solid #e5e7eb;
        vertical-align: middle;
    }

    /* Elements */
    .order-id {
        color: #4f46e5;
        font-weight: 600;
        font-size: 14px;
    }

    .date {
        color: #111827;
        font-size: 14px;
    }

    .time,
    .count {
        color: #6b7280;
        font-size: 12px;
    }

    .price {
        font-weight: bold;
        color: #111827;
        font-size: 14px;
    }

    .btn-detail {
        color: #4f46e5;
        background: #eef2ff;
        padding: 6px 12px;
        border-radius: 4px;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: 0.2s;
    }

    .btn-detail:hover {
        background: #e0e7ff;
        color: #3730a3;
    }

    /* Badges Trạng thái */
    .badge {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 600;
    }

    .badge-warning {
        background: #fef3c7;
        color: #92400e;
    }

    /* Vàng */
    .badge-info {
        background: #dbeafe;
        color: #1e40af;
    }

    /* Xanh dương */
    .badge-success {
        background: #d1fae5;
        color: #065f46;
    }

    /* Xanh lá */
    .badge-danger {
        background: #fee2e2;
        color: #991b1b;
    }

    /* Đỏ */
    .badge-secondary {
        background: #f3f4f6;
        color: #1f2937;
    }

    /* Xám */

    /* Empty State */
    .empty-state {
        text-align: center;
        padding: 40px !important;
        color: #9ca3af;
    }

    .empty-state i {
        font-size: 40px;
        margin-bottom: 10px;
        display: block;
        color: #e5e7eb;
    }

    /* Mobile Styles */
    .mobile-list {
        display: none;
    }

    .mobile-item {
        padding: 15px;
        border-bottom: 1px solid #e5e7eb;
    }

    .mobile-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .mobile-row {
        font-size: 14px;
        color: #4b5563;
        margin-bottom: 5px;
    }

    .btn-detail-mobile {
        display: block;
        text-align: center;
        border: 1px solid #4f46e5;
        color: #4f46e5;
        padding: 8px;
        border-radius: 6px;
        text-decoration: none;
        font-size: 14px;
        margin-top: 10px;
        font-weight: 600;
    }

    /* Responsive Logic */
    @media (max-width: 768px) {
        .table-responsive {
            display: none;
        }

        .mobile-list {
            display: block;
        }

        .page-header {
            display: block;
            text-align: center;
        }

        .btn-back {
            display: inline-block;
            margin-top: 15px;
        }
    }

    .pagination-wrapper {
        padding: 15px 20px;
        border-top: 1px solid #e5e7eb;
    }
</style>
@endsection