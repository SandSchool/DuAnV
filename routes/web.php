<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PaymentController;


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

// Trang chu
Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about', [HomeController::class, 'about'])->name('home.about');

// login customer
Route::prefix('customer')->group(function () {

    // Routes cho Guest (chưa đăng nhập)
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

    // Routes cho User đã đăng nhập
    Route::middleware('auth:cus')->group(function () {
        // Logout
        Route::post('logout', [CustomerController::class, 'handleLogout'])
            ->name('customer.logout');

        // Profile
        Route::get('profile', [CustomerController::class, 'showProfile'])
            ->name('customer.profile');

        Route::post('profile/update', [CustomerController::class, 'updateProfile'])
            ->name('customer.profile.update');

        // Order history
        Route::prefix('order')->name('order.')->group(function () {
            Route::get('/', [OrderController::class, 'index'])->name('history');
        });
    });
});

// product routes
Route::get('/product/index', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/detail/{product}', [ProductController::class, 'detail'])->name('product.detail');

// cart routes
Route::prefix('cart')->name('cart.')->group(function () {

    // Thêm ->middleware('auth:cus') để chặn khách chưa đăng nhập vào trang xác nhận thanh toán
    Route::get('/index', [CartController::class, 'index'])
        ->name('index')
        ->middleware('auth:cus');

    // Các route xem giỏ hàng, thêm, sửa, xóa vẫn cho phép xem bình thường (tùy logic của bạn)
    Route::get('/show', [CartController::class, 'show'])->name('show');
    Route::post('/add', [CartController::class, 'add'])->name('add');
    Route::post('/update', [CartController::class, 'update'])->name('update');
    Route::get('/remove/{id}', [CartController::class, 'remove'])->name('remove');
});


// payment page
// Nhóm các route thanh toán lại và yêu cầu đăng nhập
Route::middleware(['auth:cus'])->group(function () {
    Route::get("payment", [PaymentController::class, "pay"])->name("payment.index");
    Route::post("payment", [PaymentController::class, "pay"]);
    Route::get("payment/success", [PaymentController::class, "success"])->name("payment.success");
});


// admin page
Route::get("admin/login", [AdminHomeController::class, "login"])->name("admin.login");
Route::post("admin/login", [AdminHomeController::class, "login"]);
Route::post('/logout', [AdminHomeController::class, 'logout'])->name('logout');

Route::group(["prefix" => "admin", "middleware" => "admin"], function () {
    Route::get("/", [AdminHomeController::class, "index"])->name("admin.home.index");
    Route::get("product", [AdminProductController::class, "index"])->name("admin.product.index");
    Route::get("product/edit/{product?}", [AdminProductController::class, "edit"])->name("admin.product.edit");
    Route::post("product/edit", [AdminProductController::class, "edit"]);
    Route::get("product/delete/{product}", [AdminProductController::class, "delete"]);
    Route::get("category", [AdminCategoryController::class, "index"])->name("admin.category.index");
    Route::get("category/edit/{category?}", [AdminCategoryController::class, "edit"])->name("admin.category.edit");
    Route::post("category/edit", [AdminCategoryController::class, "edit"]);
    Route::get("category/delete/{category}", [AdminCategoryController::class, "delete"]);
});
