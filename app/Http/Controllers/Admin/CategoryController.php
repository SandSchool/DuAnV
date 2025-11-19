<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public static function index(){
        $categories = Category::all()->where("XOA", "=", 0); // truy van cac bang ghi cua bang categories
        return view("admin.category.index", ["categories" => $categories]); // gui du lieu qua view
    }

    public static function edit(){
        if(request()->isMethod("post")){
            if(isset(request()->category)) { // cap nhat
                $validate = true;

                if(request()->name != request()->categoryName){ // nguoi dung cap nhat ten moi
                    $validate = request()->validate( // them moi
                        [
                            "categoryName" => "required|unique:categories,TENLOAI|max:40",
                        ]
                    );
                }

                if(isset(request()->categoryImage)){ // nguoi dung cap nhat hinh anh moi
                    $validate = request()->validate( // them moi
                        [
                            "categoryImage" => "required|mimes:jpg,jpeg,png,gif",
                        ]
                    );
                }
            }
            else{
                $validate = request()->validate( // them moi
                    [
                        "categoryName" => "required|unique:categories,TENLOAI|max:40",
                        "categoryImage" => "required|mimes:jpg,jpeg,png,gif",
                    ]
                );
            }
            if($validate){ // neu xac thuc thanh cong
                // di chuyen file upload vao thu muc public/uploads
                if(isset(request()->categoryImage)){
                    $file_obj = request()->categoryImage;
                    $file_ext = $file_obj->extension();
                    $file_name = md5(
                            date("Y-m-d H:i:s")
                            .$file_obj->getClientOriginalName()
                        ).".".$file_ext;
                    $file_url = asset("public/uploads")."/".$file_name;
                    $file_obj->move(public_path("uploads"), $file_name);
                }

                if(isset(request()->category)){ // cap nhat
                    if(!isset(request()->categoryImage)){
                        $file_url = request()->image;
                    }

                    $query = Category::find(request()->category)->update([
                        "TENLOAI" => request()->categoryName,
                        "HINHANH" => $file_url,
                        "MOTA" => request()->categoryDescription
                    ]);

                    if($query){
                        return redirect()->back()->with("success", "Cập nhật thành công");
                    }
                    else{
                        return redirect()->back()->with("success", "Cập nhật thất bại");
                    }
                }
                else{ // them moi
                    $query = DB::table("categories")->insert([
                        "MALOAI" => "FST".sprintf("%05d", Category::all()->count()+1), // FST00001
                        "TENLOAI" => request()->categoryName,
                        "HINHANH" => $file_url, // duong dan toi file upload
                        "MOTA" => request()->categoryDescription
                    ]);

                    if($query){
                        return redirect()->back()->with("success", "Thêm mới thành công");
                    }
                    else{
                        return redirect()->back()->with("success", "Thêm mới thất bại");
                    }
                }
            }
        }
        else{
            if(isset(request()->category)){
                $category = request()->category;
                $category_data = Category::find($category);
                return view("admin.category.edit", ["category_data" => $category_data]);
            }
            return view("admin.category.edit");
        }
    }

    public static function delete(){
        $category = request()->category;
        $cat = Category::find($category);
        if($cat){
            $cat->XOA = 1;
            $result = $cat->save();
            if($result){
                return redirect()->back()->with("success", "Xóa thành công");
            }
            else{
                return redirect()->back()->with("error", "Xóa thất bại");
            }
        }
        else{
            return redirect()->back()->with("error", "Không tìm thấy mã danh mục");
        }

    }
}
