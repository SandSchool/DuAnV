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
        Route::prefix('order')->name('order.')->group(function () {

            // Để đường dẫn là '/' (rỗng) thì URL sẽ dừng lại ở .../customer/order
            // Đặt tên name là 'history' -> kết hợp với prefix thành: 'order.history'
            Route::get('/', [OrderController::class, 'index'])->name('history');

            // Các route con khác
            Route::get('/detail/{order}', [OrderController::class, 'show'])->name('detail');
        });
    });
});
// product routes
Route::get('/product/index', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/detail/{product}', [ProductController::class, 'detail'])->name('product.detail');

// cart routes
Route::prefix('cart')->name('cart.')->group(function () {

    // Tương đương: Route::get('/cart/index', ...)->name('cart.index');
    Route::get('/index', [CartController::class, 'index'])->name('index');

    // Tương đương: Route::get('/cart/show', ...)->name('cart.show');
    Route::get('/show', [CartController::class, 'show'])->name('show');

    // Tương đương: Route::post('/cart/add', ...)->name('cart.add');
    Route::post('/add', [CartController::class, 'add'])->name('add');

    //

    // Tương đương: Route::post('/cart/update', ...)->name('cart.update');
    Route::post('/update', [CartController::class, 'update'])->name('update');

    // Tương đương: Route::get('/cart/remove/{id}', ...)->name('cart.remove');
    Route::get('/remove/{id}', [CartController::class, 'remove'])->name('remove');
});

// payment page
Route::get("payment", [PaymentController::class, "pay"])->name("payment.index");
Route::post("payment", [PaymentController::class, "pay"]);



// admin page
Route::get("admin/login", [AdminHomeController::class, "login"])->name("admin.login");
Route::post("admin/login", [AdminHomeController::class, "login"]);
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
