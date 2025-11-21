<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $category_data = Category::isDeleted()->get();

        $category = isset(request()->category) ? request()->category : "";
        if ($category) {
            $product_data = Product::isDeleted()
                ->where("LOAI", "=", $category)
                ->paginate(3);
        } else {
            $search = isset(request()->search) ? request()->search : "";
            if ($search) $product_data = Product::isDeleted()
                ->where("TENSP", "like", "%{$search}%")
                ->paginate(3);
            else $product_data = Product::isDeleted()->paginate(3);
        }

        return view("product.index", [
            "category_data" => $category_data,
            "product_data" => $product_data
        ]);
    }

    public function detail($product)
    {
        $product_data = \App\Models\Product::where('MASP', $product)->firstOrFail();

        // Lấy các sản phẩm CÙNG LOẠI nhưng KHÁC MÃ sản phẩm hiện tại
        $related_products = \App\Models\Product::where('TENSP', $product_data->TENSP)
            ->where('MASP', '!=', $product_data->MASP) // <--- QUAN TRỌNG: Dòng này giúp loại bỏ sản phẩm đang xem
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('product.detail', compact('product_data', 'related_products'));
    }
}
