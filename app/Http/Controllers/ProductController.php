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

    public function detail()
    {
        $product = request()->product; // lay ma san pham tren url
        //        $product_data = Product::find($product)->where("XOA", "=", 0); // truy van du lieu tu ma san pham
        $product_data = Product::isDeleted()->where("MASP", "=", $product)->first();
        return view("product.detail", ["product_data" => $product_data]);
    }
}
