<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function username()
    {
        return "EMAIL";
    }

    public function index()
    {
        // --- 1. SỐ LIỆU TỔNG QUAN (Giữ nguyên) ---
        $products_sold = DB::table('order_details')->sum('SL');
        $revenue = DB::table('orders')->sum('TRIGIA');
        $customers = DB::table('customers')->count();
        $total_orders = DB::table('orders')->count();

        // --- 2. XỬ LÝ BIỂU ĐỒ (30 NGÀY GẦN NHẤT) ---
        $list_date = [];
        $list_money = [];

        // Lấy dữ liệu 30 ngày trở lại đây để đảm bảo hiển thị được ngày 11/11
        for ($i = 7; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);

            $format_date = $date->format('Y-m-d'); // Định dạng so sánh DB
            $display_date = $date->format('d/m');  // Định dạng hiển thị (VD: 11/11)

            // Tính tổng tiền theo ngày
            $money = DB::table('orders')
                ->whereDate('NGHD', $format_date)
                ->sum('TRIGIA');

            $list_date[] = $display_date;
            $list_money[] = $money;
        }

        return view('admin.home.index', compact(
            'products_sold',
            'revenue',
            'customers',
            'total_orders',
            'list_date',
            'list_money'
        ));
    }

    public static function login()
    {
        if (request()->isMethod("post")) {
            $data = [
                "email" => request()->email,
                "password" => request()->password,
            ];
            $check = auth()->guard("admin")->attempt($data);
            if ($check)
                return redirect()->route("admin.home.index")->with("success", "Đăng nhập thành công");
            else
                return redirect()->back()->with("error", "Đăng nhập thất bại");
        } else {
            if (auth()->guard("admin")->check())
                return redirect()->route("admin.home.index");
            return view("admin.login");
        }
    }
    public function logout(Request $request)
    {
        // 1. Đăng xuất người dùng hiện tại
        \Illuminate\Support\Facades\Auth::logout();

        // 2. Hủy session hiện tại để bảo mật
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // 3. Chuyển hướng về trang Đăng nhập (hoặc trang chủ '/')
        // Bạn hãy sửa '/login' thành đường dẫn bạn muốn
        return view('admin.login');
    }
}
