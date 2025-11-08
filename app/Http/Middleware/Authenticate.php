<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo(Request $request): ?string
    {
        // Kiểm tra xem yêu cầu có phải là JSON không (dùng cho API)
        if ($request->expectsJson()) {
            return null;
        }

        // THAY ĐỔI DUY NHẤT LÀ Ở ĐÂY:
        // Thay vì trả về route('login') mặc định,
        // chúng ta trả về route('customer.login') mà bạn đã định nghĩa.
        return route('customer.login');
    }
}
