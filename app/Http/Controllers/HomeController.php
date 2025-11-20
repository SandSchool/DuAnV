<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // 1. Lấy sản phẩm nổi bật cho trang chủ
        // Ví dụ: Lấy 8 sản phẩm mới nhất
        // SỬA: Đặt tên biến là '$products' để khớp với file home.index.blade.php gốc
        $products = Product::query()
            ->orderBy('MASP', 'DESC') // Sắp xếp theo MASP giảm dần (mới nhất)
            ->limit(8)       // Chỉ lấy 8 sản phẩm
            ->get();         // Lấy kết quả (không cần phân trang)

        // 2. GỬI CHỈ BIẾN '$products' SANG VIEW
        return view('home.index', compact('products'));
    }

    public function about()
    {
        return view('home.about');
    }
}
