<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{

    // thay doi truong du lieu xac thuc email
    public function username()
    {
        return 'EMAIL';
    }

    public static function login(){
        if(request()->isMethod("post")){
            $login_data = [
                "email" => request()->email,
                "password" => request()->password
            ];
            $check_login = auth()->guard("cus")->attempt($login_data);
//            dd($check_login);
            if($check_login)
                return redirect()->route("home.index")->with("success", "Đăng nhập thành công");
            else
                return redirect()->back()->with("error", "Đăng nhập thất bại");
        }
        else {
            if(auth()->guard("cus")->check()){
                return redirect()->route("home.index");
            }
            return view("customer.login");
        }
    }

    // public static function register(Request $request){
    //     if(request()->isMethod("post")){ // kiem tra submit form
    //         // validate dữ liệu trên form
    //         $rules = [
    //             'name' => 'required|max:40',
    //             'email' => 'required|unique:customers|max:100',
    //             'phone' => 'required|max:20',
    //             'address' => 'required|max:50',
    //             'birthday' => 'required|max:200',
    //             'password' => 'required|min:6|max:12',
    //             'password_confirmation' => 'required|same:password',
    //         ];
    //         $message = [
    //             // 'name.required' => 'Vui lòng nhập họ tên'
    //         ];
    //         $request->validate($rules,$message);
    //         // Lưu thông in vào bảng customer
    //         $add = Customer::create([
    //             'MAKH' => 'FSC'.sprintf("%05d", Customer::all()->count()+1), // FSC00001
    //             'HOTEN' => $request->name,
    //             'EMAIL' => $request->email,
    //             'SODT' => $request->phone,
    //             'DCHI' => $request->address,
    //             'MATKHAU' => bcrypt($request->password),
    //             'NGSINH' => $request->birthday
    //         ]);
    //         // kiểm tra thêm mới thành công hay không
    //         if($add){
    //             return redirect()->back()->with('error','Đăng ký không thành công vui lòng thử lại');
    //         }
    //         return redirect()->route('customer.login');
    //     }
    //     else{
    //         return view("customer.register");
    //     }
    // }
}
