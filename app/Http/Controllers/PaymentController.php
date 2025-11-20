<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Mail\OrderMailable;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{

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
