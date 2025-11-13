<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index()
    {
        //        if(auth()->guard("admin")->check() && auth()->guard("admin")->user()->isAdmin()){
        //            dd("You are admin");
        //        }
        //        else{
        //            dd("You are not admin");
        //        }

        $products = Product::all()->where("XOA", "=", 0);
        return view("admin.product.index", ["products" => $products]);
    }

    public static function edit()
    {
        if (request()->isMethod("post")) {
            // --- Xử lý khi submit form ---
            if (isset(request()->product)) { // Cập nhật
                $validate = true;

                if (request()->name != request()->productName) { // Đổi tên mới
                    $validate = request()->validate([
                        "productName" => "required|unique:products,TENSP|max:40",
                    ]);
                }

                if (isset(request()->productImage)) { // Có hình mới
                    $validate = request()->validate([
                        "productImage" => "required|mimes:jpg,jpeg,png,gif",
                    ]);
                }
            } else { // Thêm mới
                $validate = request()->validate([
                    "productName" => "required|unique:products,TENSP|max:40",
                    "productImage" => "required|mimes:jpg,jpeg,png,gif",
                ]);
            }

            if ($validate) {
                // Upload hình
                if (isset(request()->productImage)) {
                    $file_obj = request()->productImage;
                    $file_ext = $file_obj->extension();
                    $file_name = md5(date("Y-m-d H:i:s") . $file_obj->getClientOriginalName()) . "." . $file_ext;
                    $file_obj->move(public_path("uploads"), $file_name);
                    $file_url = asset("public/uploads") . "/" . $file_name;
                }

                if (isset(request()->product)) { // Cập nhật
                    if (!isset(request()->productImage)) {
                        $file_url = request()->image;
                    }

                    $query = Product::find(request()->product)->update([
                        "TENSP" => request()->productName,
                        "HINHANH" => $file_url,
                        "DVT" => request()->productUnit,
                        "NUOCSX" => request()->productMFNation,
                        "GIA" => request()->productPrice,
                        "MOTA" => request()->productDescription,
                        "LOAI" => request()->productCategory
                    ]);

                    return $query
                        ? redirect()->back()->with("success", "Cập nhật thành công")
                        : redirect()->back()->with("error", "Cập nhật thất bại");
                } else { // Thêm mới
                    $query = DB::table("products")->insert([
                        "MASP" => "FSP" . sprintf("%05d", Product::all()->count() + 1),
                        "TENSP" => request()->productName,
                        "HINHANH" => $file_url,
                        "DVT" => request()->productUnit,
                        "NUOCSX" => request()->productMFNation,
                        "GIA" => request()->productPrice,
                        "MOTA" => request()->productDescription,
                        "LOAI" => request()->productCategory
                    ]);

                    return $query
                        ? redirect()->back()->with("success", "Thêm mới thành công")
                        : redirect()->back()->with("error", "Thêm mới thất bại");
                }
            }
        } else {
            // --- Hiển thị form (GET) ---
            $category_data = Category::where("XOA", 0)->get();

            if (isset(request()->product)) {
                $product = request()->product;
                $product_data = Product::find($product);
            } else {
                $product_data = null;
            }

            return view("admin.product.edit", [
                "product_data" => $product_data,
                "category_data" => $category_data
            ]);
        }
    }

    public static function delete()
    {
        $product = request()->product;
        $pro = Product::find($product);
        if ($pro) {
            $pro->XOA = 1;
            $result = $pro->save();
            if ($result) {
                return redirect()->back()->with("success", "Xóa thành công");
            } else {
                return redirect()->back()->with("error", "Xóa thất bại");
            }
        } else {
            return redirect()->back()->with("error", "Không tìm thấy mã sản phẩm");
        }
    }
}
