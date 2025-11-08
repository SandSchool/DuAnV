<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Chỉ định trường dùng để xác thực (email thay vì username)
     * Dùng cho custom guard 'cus'
     */
    public function username()
    {
        return 'EMAIL';
    }

    // ============================================
    // AUTHENTICATION METHODS
    // ============================================

    /**
     * Hiển thị form đăng nhập
     */
    public function showLoginForm()
    {
        // Nếu đã đăng nhập rồi thì redirect về trang chủ
        if (Auth::guard('cus')->check()) {
            return redirect()->route('home.index');
        }

        return view('customer.login');
    }

    /**
     * Xử lý đăng nhập
     */
    public function handleLogin(Request $request)
    {
        // Validate input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
        ]);

        // Chuẩn bị credentials cho guard 'cus'
        $credentials = [
            'EMAIL' => $request->email,      // Trường trong DB là EMAIL (viết hoa)
            'password' => $request->password // Laravel tự động hash compare
        ];

        $remember = $request->has('remember');

        // Thử đăng nhập với guard 'cus'
        if (Auth::guard('cus')->attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect()->intended(route('home.index'))
                ->with('success', 'Đăng nhập thành công! Chào mừng bạn quay lại.');
        }

        // Nếu thất bại
        return back()
            ->withErrors(['email' => 'Email hoặc mật khẩu không chính xác.'])
            ->withInput($request->only('email'))
            ->with('error', 'Đăng nhập thất bại.');
    }

    /**
     * Hiển thị form đăng ký
     */
    public function showRegisterForm()
    {
        // Nếu đã đăng nhập rồi thì redirect về trang chủ
        if (Auth::guard('cus')->check()) {
            return redirect()->route('home.index');
        }

        return view('customer.register');
    }

    /**
     * Xử lý đăng ký
     */
    public function handleRegister(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:40',
            'email' => 'required|email|unique:customers,EMAIL|max:100',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'birthday' => 'required|date|before:today',
            'password' => 'required|string|min:6|max:12|confirmed',
        ], [
            'name.required' => 'Vui lòng nhập họ tên.',
            'name.max' => 'Họ tên không được vượt quá 40 ký tự.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email này đã được sử dụng.',
            'phone.required' => 'Vui lòng nhập số điện thoại.',
            'address.required' => 'Vui lòng nhập địa chỉ.',
            'birthday.required' => 'Vui lòng nhập ngày sinh.',
            'birthday.date' => 'Ngày sinh không hợp lệ.',
            'birthday.before' => 'Ngày sinh phải là ngày trong quá khứ.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự.',
            'password.max' => 'Mật khẩu không được vượt quá 12 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);

        try {
            // Tạo mã khách hàng tự động: FSC00001, FSC00002, ...
            $lastCustomer = Customer::latest('MAKH')->first();
            $nextNumber = 1;

            if ($lastCustomer && preg_match('/FSC(\d+)/', $lastCustomer->MAKH, $matches)) {
                $nextNumber = intval($matches[1]) + 1;
            }

            $customerCode = 'FSC' . sprintf("%05d", $nextNumber);

            // Tạo customer mới
            $customer = Customer::create([
                'MAKH' => $customerCode,
                'HOTEN' => $request->name,
                'EMAIL' => $request->email,
                'SODT' => $request->phone,
                'DCHI' => $request->address,
                'MATKHAU' => Hash::make($request->password), // Hoặc bcrypt()
                'NGSINH' => $request->birthday,
            ]);

            // Tự động đăng nhập sau khi đăng ký
            Auth::guard('cus')->login($customer);

            return redirect()->route('home.index')
                ->with('success', 'Đăng ký thành công! Chào mừng bạn đến với ShoesVN.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Đăng ký không thành công. Vui lòng thử lại.');
        }
    }

    /**
     * Xử lý đăng xuất
     */
    public function handleLogout(Request $request)
    {
        Auth::guard('cus')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home.index')
            ->with('success', 'Đăng xuất thành công. Hẹn gặp lại!');
    }

    // ============================================
    // PROFILE METHODS
    // ============================================

    /**
     * Hiển thị trang profile
     */
    public function showProfile()
    {
        $customer = Auth::guard('cus')->user();

        if (!$customer) {
            return redirect()->route('customer.login')
                ->with('error', 'Vui lòng đăng nhập để xem thông tin cá nhân.');
        }

        return view('customer.profile', compact('customer'));
    }

    /**
     * Cập nhật thông tin profile
     */
    public function updateProfile(Request $request)
    {
        $customer = Auth::guard('cus')->user();

        if (!$customer) {
            return redirect()->route('customer.login')
                ->with('error', 'Vui lòng đăng nhập để cập nhật thông tin.');
        }

        $request->validate([
            'name' => 'required|string|max:40',
            'email' => 'required|email|max:100|unique:customers,EMAIL,' . $customer->MAKH . ',MAKH',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'birthday' => 'required|date|before:today',
            'current_password' => 'nullable|required_with:new_password',
            'new_password' => 'nullable|min:6|max:12|confirmed',
        ], [
            'name.required' => 'Vui lòng nhập họ tên.',
            'email.required' => 'Vui lòng nhập email.',
            'email.unique' => 'Email này đã được sử dụng bởi tài khoản khác.',
            'birthday.before' => 'Ngày sinh phải là ngày trong quá khứ.',
            'current_password.required_with' => 'Vui lòng nhập mật khẩu hiện tại để đổi mật khẩu mới.',
            'new_password.min' => 'Mật khẩu mới phải có ít nhất 6 ký tự.',
            'new_password.confirmed' => 'Xác nhận mật khẩu mới không khớp.',
        ]);

        try {
            // Cập nhật thông tin cơ bản
            $customer->HOTEN = $request->name;
            $customer->EMAIL = $request->email;
            $customer->SODT = $request->phone;
            $customer->DCHI = $request->address;
            $customer->NGSINH = $request->birthday;

            // Xử lý đổi mật khẩu (nếu có)
            if ($request->filled('current_password')) {
                // Kiểm tra mật khẩu hiện tại
                if (!Hash::check($request->current_password, $customer->MATKHAU)) {
                    return back()
                        ->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng.'])
                        ->withInput();
                }

                // Cập nhật mật khẩu mới
                $customer->MATKHAU = Hash::make($request->new_password);
            }

            $customer->save();

            return back()->with('success', 'Cập nhật thông tin thành công!');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'Cập nhật thất bại. Vui lòng thử lại.');
        }
    }
}


// ============================================
// NHỮNG THAY ĐỔI QUAN TRỌNG TỪ CODE CŨ
// ============================================

/*
✅ ĐÃ SỬA:

1. BỎ STATIC METHODS:
   ❌ public static function login()
   ✅ public function handleLogin()
   → Static methods không nên dùng trong Controller
   → Không inject được dependencies, khó test

2. TÁCH BIỆT GET VÀ POST:
   ❌ if (request()->isMethod("post")) { ... } else { ... }
   ✅ showLoginForm() riêng, handleLogin() riêng
   → Code rõ ràng hơn, dễ maintain

3. THÊM VALIDATION MESSAGES:
   ✅ Tất cả validate đều có message tiếng Việt
   → User experience tốt hơn

4. SỬA LỖI LOGIC ĐĂNG KÝ:
   ❌ if ($add) return back()->with('error', ...)
   → Sai logic! Nếu thêm THÀNH CÔNG lại báo lỗi
   ✅ Dùng try-catch, kiểm tra đúng

5. TẠO MÃ KHÁCH HÀNG AN TOÀN HƠN:
   ❌ Customer::all()->count() + 1
   → Nếu xóa record sẽ bị trùng mã
   ✅ latest('MAKH')->first() và parse số
   → An toàn hơn, không bị trùng

6. THÊM SESSION SECURITY:
   ✅ regenerate(), invalidate(), regenerateToken()
   → Bảo mật tốt hơn

7. THÊM ERROR HANDLING:
   ✅ Dùng try-catch
   ✅ Kiểm tra user tồn tại trước khi xử lý
   → Tránh crash app

8. THÊM CHỨC NĂNG PROFILE:
   ✅ showProfile(), updateProfile()
   → Đầy đủ CRUD cho customer

9. SỬ DỤNG FACADES ĐÚNG CÁCH:
   ✅ Auth::guard('cus') thay vì auth()->guard('cus')
   ✅ Hash::make() thay vì bcrypt() (tương đương nhưng rõ ràng hơn)

10. MAPPING FIELD NAMES:
    ✅ 'EMAIL' => $request->email (DB dùng chữ HOA)
    ✅ HOTEN, SODT, DCHI, MATKHAU, NGSINH
    → Đúng với cấu trúc DB của bạn
*/