<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order; // Import Model Order
use App\Models\OrderDetail; // Import Model OrderDetail

class OrderController extends Controller
{
    /**
     * Hiển thị danh sách lịch sử đơn hàng
     */
    public function index()
    {
        // 1. Lấy ID khách hàng đang đăng nhập
        // Lưu ý: Phải dùng guard('cus') như bạn đã làm trước đó
        $user = Auth::guard('cus')->user();

        // dd([
        //     '1. ID của user đang đăng nhập ($user->id)' => $user->id,
        //     '2. Mã KH của user ($user->MAKH)' => $user->MAKH ?? 'Không có cột MAKH',
        //     '3. Dữ liệu mẫu trong bảng Orders' => \App\Models\Order::first()->toArray()
        // ]);

        if (!$user) {
            return redirect()->route('customer.login');
        }

        // 2. Lấy danh sách đơn hàng của khách đó
        // orderBy('created_at', 'DESC'): Đơn mới nhất hiện lên đầu
        // paginate(10): Phân trang, mỗi trang 10 đơn
        $orders = \App\Models\Order::where('MAKH', $user->MAKH)
            ->orderBy('NGHD', 'DESC')
            ->paginate(10);

        return view('order.history', compact('orders'));
    }

    /**
     * Xem chi tiết một đơn hàng cụ thể
     */
    public function detail($id)
    {
        // 1. Tìm đơn hàng theo ID
        $order = Order::find($id);

        // 2. Kiểm tra bảo mật (Quan trọng!)
        // Nếu không tìm thấy đơn HOẶC đơn này không phải của người đang đăng nhập
        if (!$order || $order->user_id != Auth::guard('cus')->id()) {
            return redirect()->route('order.history')->with('error', 'Bạn không có quyền xem đơn hàng này');
        }

        // 3. Lấy chi tiết sản phẩm trong đơn hàng đó
        // Giả sử bạn đã thiết lập quan hệ trong Model (xem phần dưới)
        $details = $order->details;

        return view('order.detail', compact('order', 'details'));
    }
}
