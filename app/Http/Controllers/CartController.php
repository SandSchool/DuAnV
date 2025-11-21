<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // << Đảm bảo bạn đã import Model Product
use Illuminate\Support\Facades\Session; // << Thêm Session facade
use Illuminate\Validation\Rule;

class CartController extends Controller
{
    /**
     * Hiển thị trang giỏ hàng (Hàm chuẩn)
     */
    public function index()
    {
        $cartItems = session('cart', []);
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        // Trả về view 'cart.blade.php'
        return view('cart.index', compact('cartItems', 'total'));
    }

    // ================================================================
    /**
     * SỬA LỖI "SHOW DOES NOT EXIST"
     * Đây là hàm mới, được thêm vào để "chiều" theo bộ đệm (cache)
     * Nó làm y hệt hàm index()
     */
    public function show()
    {
        // Chỉ cần gọi hàm index() ở trên
        return $this->index();
    }
    // ================================================================


    /**
     * Thêm một sản phẩm vào giỏ hàng (dùng cho AJAX)
     */
    public function add(Request $request)
    {
        // 1. Validate request
        $request->validate([
            // SỬA LỖI VALIDATE:
            'product_id' => [
                'required',
                'exists:products,MASP' // << ĐÃ SỬA: Chỉ định rõ bảng và cột
            ],
            'quantity' => 'required|integer|min:1'
        ]);

        $productId = $request->product_id;
        $quantity = $request->quantity;

        // SỬA: Đảm bảo Model Product của bạn dùng MASP làm Primary Key
        // Nếu $product = Product::findOrFail($productId); bị lỗi
        // thì hãy thay nó bằng:
        $product = Product::where('MASP', $productId)->firstOrFail();

        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            // Nếu đã có, cộng dồn số lượng
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Nếu chưa có, thêm mới với thông tin từ $product
            // SỬA: Đảm bảo dùng đúng tên cột (TENSP, GIA, HINHANH)
            $cart[$productId] = [
                "name" => $product->TENSP,
                "quantity" => $quantity,
                "price" => $product->GIA,
                "image" => $product->HINHANH
            ];
        }

        session()->put('cart', $cart);

        // 6. Tính tổng số lượng sản phẩm trong giỏ để trả về
        $totalQuantity = 0;
        foreach ($cart as $item) {
            $totalQuantity += $item['quantity'];
        }
        if ($request->has('redirect_back')) {
            return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
        }
        // 7. Trả về response JSON
        return response()->json([
            'message' => 'Sản phẩm đã được thêm vào giỏ hàng!',
            'total_quantity' => $totalQuantity
        ]);
    }

    /**
     * Cập nhật số lượng (từ trang cart)
     */
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required',
            'quantity' => 'required|integer|min:1'
        ]);

        $cart = session()->get('cart');

        if (isset($cart[$request->id])) {
            $cart[$request->id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Giỏ hàng đã được cập nhật!');
    }

    /**
     * Xóa sản phẩm khỏi giỏ hàng (từ trang cart)
     */
    // SỬA LỖI CÚ PHÁP: Đổi 'pre_remove' thành 'remove'
    public function remove($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Sản phẩm đã được xóa khỏi giỏ hàng!');
    }
}
