<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Đảm bảo bạn đã import Product Model
use App\Models\Order;;

use App\Models\OrderDetail;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMailable;

class CartController extends Controller
{
    /**
     * Hiển thị trang giỏ hàng.
     */
    public function show()
    {
        // Lấy giỏ hàng từ session
        $cart = session()->get('cart', []);

        // Tính tổng tiền
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Trả về view của giỏ hàng (Bạn sẽ cần tạo file view này)
        return view('product.cart', [
            'cartItems' => $cart,
            'total' => $total
        ]);
    }

    /**
     * Thêm sản phẩm vào giỏ hàng (từ trang Index - GET request).
     * Tương thích với: <a href="{{ url('cart/add') }}/{{ $product->MASP }}">
     */
    public function add($id)
    {
        $product = Product::find($id); // Lấy MASP từ model của bạn

        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại!');
        }

        // Lấy giỏ hàng hiện tại từ session
        $cart = session()->get('cart', []);

        // Kiểm tra xem sản phẩm đã có trong giỏ hàng chưa
        if (isset($cart[$id])) {
            // Nếu có, tăng số lượng lên 1
            $cart[$id]['quantity']++;
        } else {
            // Nếu chưa, thêm mới với số lượng là 1
            $cart[$id] = [
                "name" => $product->TENSP,
                "quantity" => 1,
                "price" => $product->GIA,
                "image" => $product->HINHANH
            ];
        }

        // Lưu giỏ hàng mới vào session
        session()->put('cart', $cart);

        // Chuyển hướng về trang trước đó với thông báo thành công
        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    /**
     * Thêm sản phẩm vào giỏ hàng (từ trang Detail - POST request).
     * Tương thích với form trong file detail.txt của bạn.
     */
    public function addFromDetail(Request $request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->back()->with('error', 'Sản phẩm không tồn tại!');
        }

        // Validate số lượng
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        $quantity = (int)$request->input('quantity', 1);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            // Nếu có, cộng thêm số lượng
            $cart[$id]['quantity'] += $quantity;
        } else {
            // Nếu chưa, thêm mới
            $cart[$id] = [
                "name" => $product->TENSP,
                "quantity" => $quantity,
                "price" => $product->GIA,
                "image" => $product->HINHANH
            ];
        }

        session()->put('cart', $cart);

        // Chuyển hướng đến trang giỏ hàng
        return redirect()->route('cart.show')->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    /**
     * Cập nhật số lượng sản phẩm trong giỏ hàng (AJAX hoặc Form).
     */
    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');

            if (isset($cart[$request->id])) {
                if ($request->quantity > 0) {
                    $cart[$request->id]["quantity"] = $request->quantity;
                    session()->put('cart', $cart);
                    return redirect()->back()->with('success', 'Đã cập nhật giỏ hàng!');
                } else {
                    // Nếu số lượng <= 0, xóa luôn
                    unset($cart[$request->id]);
                    session()->put('cart', $cart);
                    return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
                }
            }
        }
        return redirect()->back()->with('error', 'Cập nhật thất bại!');
    }

    /**
     * Xóa một sản phẩm khỏi giỏ hàng.
     */
    public function remove($id)
    {
        $cart = session()->get('cart');

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng!');
        }

        return redirect()->back()->with('error', 'Xóa thất bại!');
    }
    public function pay()
    {
        // xu ly dat hang
        if (request()->isMethod("post")) {
            $cart = session("cart");
            $user = auth()->guard("cus")->user();
            $transport_method = request()->transport_method;

            // them vao bang order
            $total = 0;
            foreach ($cart as $product) {
                $total += $product["QTY"] * $product["GIA"];
            }
            $order = Order::create([
                "MAKH" => $user->MAKH,
                "MANV" => "FSE00001", // mac dinh la admin, admin co the phan quyen quan ly don hang cho nhan vien cu the
                "TRIGIA" => $total,
                "PTVC" => $transport_method
            ]);
            //            $order = DB::table("orders")->insert([
            //            $order = DB::table("orders")->insertGetId([
            //                "MAKH" => $user->MAKH,
            //                "MANV" => "FSE00001", // mac dinh la admin, admin co the phan quyen quan ly don hang cho nhan vien cu the
            //                "TRIGIA" => $total,
            //                "PTVC" => $transport_method
            //            ]);

            // them vao bang order details
            foreach ($cart as $product) {
                $order_detail = new OrderDetail();
                $order_detail->SOHD = $order->id;
                $order_detail->MASP = $product["MASP"];
                $order_detail->SL = $product["QTY"];
                $order_detail->GIAGOC = $product["GIA"]; // gia khi nhap san pham
                $order_detail->GIABAN = $product["GIA"]; // gia ban san pham hien tai
                $order_detail->save();
            }

            // gui mail xac nhan don hang
            Mail::to($user->EMAIL)->send(new OrderMailable($order));
        }
        // hien thi giao dien trang thanh toan
        return view("payment.index");
    }
}
