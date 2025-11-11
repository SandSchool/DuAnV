<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// THÊM 2 DÒNG NÀY VÀO:
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session; // Hoặc dùng helper session()

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // THÊM ĐOẠN CODE NÀY VÀO:
        // Sử dụng View Composer để chia sẻ $cartCount với layout 'layout.default'
        // Bạn có thể đổi 'layout.default' thành tên file layout chính của bạn
        View::composer(['layout.default'], function ($view) {

            // Lấy giỏ hàng từ session
            $cart = Session::get('cart', []);

            // Đếm số lượng sản phẩm *khác nhau* trong giỏ hàng
            $cartCount = count($cart);

            // Chia sẻ biến $cartCount với view
            $view->with('cartCount', $cartCount);
        });
    }
}
