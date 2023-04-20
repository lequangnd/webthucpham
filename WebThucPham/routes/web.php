<?php

use App\Http\Controllers\Admin_userController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HeartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SanPhamController;
use App\Http\Controllers\Shop_gridController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UnitsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//product
Route::get('admin/product/index', [SanPhamController::class, 'index'])->name('products');
Route::get('admin/product/add', [SanPhamController::class, 'add'])->name('add');
Route::post('admin/product/add', [SanPhamController::class, 'addProduct'])->name('add-products');
Route::get('admin/product/update/{id}', [SanPhamController::class, 'update'])->name('update');
Route::post('admin/product/update/{id}', [SanPhamController::class, 'updateProduct'])->name('update-products');
Route::get('admin/product/details/{id}', [SanPhamController::class, 'details_product'])->name('details_product');
Route::get('admin/product/details', [SanPhamController::class, 'add_details_product'])->name('add-details-product');
Route::get('admin/product/dettails_udpate', [SanPhamController::class, 'update_details_product'])->name('update-details-product');
Route::get('admin/product/dettails_delete', [SanPhamController::class, 'delete_details_product'])->name('delete-details-product');

//order
Route::get('admin/orders', [OrderController::class, 'index'])->name('orders');
Route::get('admin/orders/details/{id}', [OrderController::class, 'details'])->name('orders-details');
Route::get('admin/orders/status', [OrderController::class, 'status'])->name('status');
Route::get('admin/invoice', [OrderController::class, 'invoice'])->name('invoice');
Route::get('admin/invoice-details/{id}', [OrderController::class, 'details_invoice'])->name('details-invoice');

//category-admin
Route::get('admin/category', [CategoryController::class, 'index'])->name('admin-category');
Route::get('admin/category/add', [CategoryController::class, 'add'])->name('add-category');
Route::get('admin/category/update', [CategoryController::class, 'update'])->name('update-category');
Route::get('admin/category/delete', [CategoryController::class, 'delete'])->name('delete-category');

//units-admin
Route::get('admin/units', [UnitsController::class, 'index'])->name('admin-units');
Route::get('admin/units/add', [UnitsController::class, 'add'])->name('add-units');
Route::get('admin/units/update', [UnitsController::class, 'update'])->name('update-units');
Route::get('admin/units/delete', [UnitsController::class, 'delete'])->name('delete-units');

//supplier-admin
Route::get('admin/supplier', [SupplierController::class, 'index'])->name('admin-supplier');
Route::get('admin/supplier/add', [SupplierController::class, 'add'])->name('add-supplier');
Route::get('admin/supplier/update', [SupplierController::class, 'update'])->name('update-supplier');
Route::get('admin/supplier/delete', [SupplierController::class, 'delete'])->name('delete-supplier');

//country-admin
Route::get('admin/country', [CountryController::class, 'index'])->name('admin-country');
Route::get('admin/country/add', [CountryController::class, 'add'])->name('add-country');
Route::get('admin/country/update', [CountryController::class, 'update'])->name('update-country');
Route::get('admin/country/delete', [CountryController::class, 'delete'])->name('delete-country');

//dashboard
Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin-dashboard');
Route::get('admin/dashboard/day', [DashboardController::class, 'day'])->name('day');
Route::get('admin/dashboard/month', [DashboardController::class, 'month'])->name('month');
Route::get('admin/dashboard/year', [DashboardController::class, 'year'])->name('year');

//admin-user
Route::get('admin/user', [Admin_userController::class, 'index'])->name('admin-user');

//index
Route::get('/index', [BackendController::class, 'index'])->name('index');
Route::get('/search', [BackendController::class, 'search'])->name('search');
Route::get('/details/{id}', [BackendController::class, 'details'])->name('details');
Route::get('/category/{id}', [BackendController::class, 'category'])->name('category');

//cart
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/cart/add', [CartController::class, 'addCart'])->name('add-cart');
Route::post('/cart/update', [CartController::class, 'updateCart'])->name('update-cart');
Route::get('/cart/delete', [CartController::class, 'deleteCart'])->name('delete-cart');
Route::get('/user/order/{id}', [CartController::class, 'user_order'])->name('user-order');
Route::get('/user/order/details/{id}', [CartController::class, 'user_order_details'])->name('user_order_details');
Route::get('/user/order/details/delete/{id}', [CartController::class, 'delete_order_details'])->name('delete_order_details');
Route::get('/cart/item', [CartController::class, 'add_cart'])->name('add_cart');

//user
Route::get('/register', [UserController::class, 'register'])->name('register');
Route::post('/register', [UserController::class, 'addRegister'])->name('add-register');
Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'postLogin'])->name('post-login');
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/forget', [UserController::class, 'forget'])->name('forget');
Route::post('/forget', [UserController::class, 'postForget'])->name('post-forget');
Route::get('/password/{id}/{token}', [UserController::class, 'password'])->name('password');
Route::post('/password/{id}/{token}', [UserController::class, 'postPassword'])->name('post-password');
Route::get('/pdf/{id}', [OrderController::class, 'pdf'])->name('pdf');

//checkout
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::post('/order', [CartController::class, 'order'])->name('order');

//comments
Route::get('/comments/{id}', [BackendController::class, 'comments'])->name('comments');
Route::get('/comments/add/{id}', [BackendController::class, 'add'])->name('add-comments');

//heart
Route::get('/heart', [HeartController::class, 'heart'])->name('heart');
Route::get('/heart/add', [HeartController::class, 'add'])->name('add-heart');
Route::get('/heart/delete', [HeartController::class, 'delete'])->name('delete-heart');

//shop-grid
Route::get('/shop-grid', [Shop_gridController::class, 'index'])->name('shop-grid');
Route::get('/shop-grid/price', [Shop_gridController::class, 'price'])->name('price');

