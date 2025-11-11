<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
// Trang chu
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');
// login customer
Route::prefix('customer')->group(function () {

    // Routes cho Guest (chưa đăng nhập) - SỬA THÀNH 'guest:cus'
    Route::middleware('guest:cus')->group(function () {
        // Login
        Route::get('login', [CustomerController::class, 'showLoginForm'])
            ->name('customer.login');
        Route::post('login', [CustomerController::class, 'handleLogin']);

        // Register
        Route::get('register', [CustomerController::class, 'showRegisterForm'])
            ->name('customer.register');
        Route::post('register', [CustomerController::class, 'handleRegister']);
    });

    // Routes cho User đã đăng nhập - SỬA THÀNH 'auth:cus'
    Route::middleware('auth:cus')->group(function () {
        // Logout
        Route::post('logout', [CustomerController::class, 'handleLogout'])
            ->name('customer.logout');

        // Profile
        Route::get('profile', [CustomerController::class, 'showProfile'])
            ->name('customer.profile');

        // XÓA ROUTE POST BỊ TRÙNG
        // Route::post('profile', [CustomerController::class, 'showProfile'])
        //     ->name('customer.profile'); 

        Route::post('profile/update', [CustomerController::class, 'updateProfile'])
            ->name('customer.profile.update');

        // Order history
        Route::get('orders', [CustomerController::class, 'showOrders'])
            ->name('customer.orders');
    });
});
// product routes
Route::get('/product/index', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/detail/{product}', [ProductController::class, 'detail'])->name('product.detail');

// cart routes
Route::prefix('cart')->name('cart.')->group(function () {

    // Trang hiển thị giỏ hàng
    Route::get('/', [CartController::class, 'show'])->name('show');

    // Thêm từ trang index (GET) - Tương thích với code của bạn
    Route::get('/add/{id}', [CartController::class, 'add'])->name('add');

    // Thêm từ trang chi tiết (POST)
    Route::post('/add-detail/{id}', [CartController::class, 'addFromDetail'])->name('add.detail');

    // Cập nhật giỏ hàng (dùng cho trang giỏ hàng)
    Route::post('/update', [CartController::class, 'update'])->name('update');

    // Xóa khỏi giỏ hàng (dùng cho trang giỏ hàng)
    Route::get('/remove/{id}', [CartController::class, 'remove'])->name('remove');
});
