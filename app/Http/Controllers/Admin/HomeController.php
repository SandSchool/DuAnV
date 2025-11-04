<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function username(){
        return "EMAIL";
    }

    public function index(){
        return view("admin.home.index");
    }

    public static function login(){
        if(request()->isMethod("post")){
            $data = [
                "email" => request()->email,
                "password" => request()->password,
            ];
            $check = auth()->guard("admin")->attempt($data);
            if($check)
                return redirect()->route("admin.home.index")->with("success", "Đăng nhập thành công");
            else
                return redirect()->back()->with("error", "Đăng nhập thất bại");
        }
        else{
            if(auth()->guard("admin")->check())
                return redirect()->route("admin.home.index");
            return view("admin.login");
        }
    }
}
