<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Mail\OrderMailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str; // Import thêm thư viện tạo chuỗi ngẫu nhiên

class PaymentController extends Controller
{
    public function pay(Request $request)
    {
        // 1. Kiểm tra đăng nhập
        if (!Auth::guard('cus')->check()) {
            return redirect()->route('customer.login')
                ->with('error', 'Vui lòng đăng nhập để tiến hành thanh toán!');
        }

        // 2. Xử lý khi bấm nút Đặt hàng (POST)
        if ($request->isMethod("post")) {

            $cart = session("cart", []);
            $user = Auth::guard("cus")->user();
            $transport_method = $request->transport_method ?? 'ghtc';

            if (empty($cart)) {
                return redirect()->back()->with('error', 'Giỏ hàng trống!');
            }

            // --- [THÊM MỚI] Cập nhật số lượng từ form nếu người dùng thay đổi ---
            if ($request->has('quantities')) {
                foreach ($request->quantities as $id => $qty) {
                    if (isset($cart[$id])) {
                        if (isset($cart[$id]['quantity'])) {
                            $cart[$id]['quantity'] = $qty;
                        } elseif (isset($cart[$id]['QTY'])) {
                            $cart[$id]['QTY'] = $qty;
                        }
                    }
                }
                // Lưu lại giỏ hàng mới vào session để tính toán chính xác
                session()->put('cart', $cart);
            }

            // --- [THÊM MỚI] Tính phí vận chuyển ---
            $shippingFee = 0;
            if ($transport_method == 'ghn') {
                $shippingFee = 50000;
            } elseif ($transport_method == 'ghtc') {
                $shippingFee = 30000;
            }

            // Tính tổng tiền (Sản phẩm)
            $total = 0;
            foreach ($cart as $item) {
                $qty = $item['quantity'] ?? $item['QTY'] ?? 0;
                $price = $item['price'] ?? $item['GIA'] ?? $item['GIABAN'] ?? 0;
                $total += $qty * $price;
            }

            // --- [THÊM MỚI] Cộng phí ship vào Tổng tiền cuối cùng ---
            $total += $shippingFee;

            // Chuẩn bị dữ liệu
            $orderData = [
                "MAKH" => $user->MAKH,
                "MANV" => "FSE00001",
                "TRIGIA" => $total, // Giá này giờ đã bao gồm phí ship
                "PTVC" => $transport_method,
                "NGHD" => now(),
                "token" => Str::random(20),
            ];

            // Kiểm tra xem bảng orders có cột TRANGTHAI không
            if (Schema::hasColumn('orders', 'TRANGTHAI')) {
                $orderData["TRANGTHAI"] = "cho-xac-nhan";
            }

            DB::beginTransaction();
            try {
                // 1. LƯU ĐƠN HÀNG
                $order = Order::create($orderData);

                // 2. LƯU CHI TIẾT
                foreach ($cart as $productId => $item) {
                    $qty = $item['quantity'] ?? $item['QTY'] ?? 0;
                    $price = $item['price'] ?? $item['GIA'] ?? $item['GIABAN'] ?? 0;

                    OrderDetail::create([
                        "SOHD" => $order->SOHD,
                        "MASP" => $productId,
                        "SL" => $qty,
                        "GIAGOC" => $price,
                        "GIABAN" => $price
                    ]);
                }

                DB::commit(); // Lưu thành công

            } catch (\Exception $e) {
                DB::rollBack();
                // Hiện lỗi chi tiết ra màn hình đen
                dd("LỖI KHI LƯU DATABASE: " . $e->getMessage());
            }

            // --- XỬ LÝ SAU KHI LƯU ---

            // Gửi mail
            try {
                Mail::to($user->EMAIL)->send(new OrderMailable($order));
            } catch (\Exception $e) {
                Log::error("Lỗi gửi mail: " . $e->getMessage());
            }

            // Xóa giỏ hàng
            session()->forget('cart');
            session()->save();

            // Chuyển hướng
            return redirect()->route('payment.success')->with('success_order_id', $order->SOHD);
        }

        return view("payment.index");
    }

    public function success()
    {
        $orderId = session('success_order_id');
        if (!$orderId) return redirect()->route('home.index');

        $order = Order::where('SOHD', $orderId)->first();
        return view("payment.success", compact('order'));
    }
}
