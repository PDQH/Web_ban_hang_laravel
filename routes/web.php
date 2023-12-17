<?php

use App\Http\Controllers\DeliveryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CouponController;


// Tạo định tuyến đến trang đích qua class Controller

/* CLIEND */
Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/trang-chu', [HomeController::class, 'index'])->name('trang-chu');
Route::post('/tim-kiem', [HomeController::class, 'search']);

//Danh mục sản phẩm & thương hiệu sản phẩm trang chủ
Route::get('/danh-muc-san-pham/{category_id}', [CategoryProduct::class, 'show_category_home']);
Route::get('/thuong-hieu-san-pham/{brand_id}', [BrandProduct::class, 'show_brand_home']);
Route::get('/chi-tiet-san-pham/{product_id}', [ProductController::class, 'detail_product']);

//Cart
Route::get('/show-cart', [CartController::class, 'show_cart']);
Route::get('/delete-to-cart/{rowId}', [CartController::class, 'delete_to_cart']);
Route::get('/show-cart-ajax', [CartController::class, 'show_cart_ajax']);
Route::get('/delete-pro-to-cart/{session_id}', [CartController::class, 'delete_pro_to_cart']);
Route::get('/delete-all-cart', [CartController::class, 'delete_all_cart']);
Route::post('/save-cart', [CartController::class, 'save_cart']);
Route::post('/update-cart-quantity', [CartController::class, 'update_cart_quantity']);
Route::post('/update-cart', [CartController::class, 'update_cart']);
Route::post('/add-cart-ajax', [CartController::class, 'add_cart_ajax']);

//Chechkout
Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']);
Route::get('/checkout', [CheckoutController::class, 'checkout']);
Route::get('/payment', [CheckoutController::class, 'payment']);
Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout']);
Route::get('/delete-fee', [CheckoutController::class, 'delete_fee']);
Route::post('/add-customer', [CheckoutController::class, 'add_customer']);
Route::post('/save-checkout-customer', [CheckoutController::class, 'save_checkout_customer']);
Route::post('/login-customer', [CheckoutController::class, 'login_customer']);
Route::post('/order-place', [CheckoutController::class, 'order_place']);
Route::post('/select-delivery-home', [CheckoutController::class, 'select_delivery_home']);
Route::post('/calculate-feeship', [CheckoutController::class, 'calculate_feeship']);
Route::post('/confirm-order', [CheckoutController::class, 'confirm_order']);

//Coupon
Route::post('/check-coupon', [CartController::class, 'check_coupon']);

Route::get('/unset-coupon', [CouponController::class, 'unset_coupon']);
Route::get('/create-coupon', [CouponController::class, 'create_coupon']);
Route::get('/list-coupon', [CouponController::class, 'list_coupon']);
Route::get('/delete-coupon/{coupon_id}', [CouponController::class, 'delete_coupon']);
Route::post('/add-coupon-code', [CouponController::class, 'add_coupon_code']);



/* ADMIN */
Route::get('/admin', [AdminController::class, 'index']); /* khi URL đến /admin thì gọi hàm index ở AdminController */
Route::get('/dashboard', [AdminController::class, 'show_dashboard']); /* khi URL đến /dashboard thì gọi hàm show_dashboard ở AdminController */
Route::get('/logout', [AdminController::class, 'logout']); /* khi URL đến /logout thì gọi hàm logout ở AdminController */
Route::post('/admin-dashboard', [AdminController::class, 'dashboard']); /* khi có một POST request được gửi đến đường dẫn '/admin-dashboard', Laravel sẽ gọi hàm dashboard trong AdminController. */

// Category product
Route::get('/add-category-product', [CategoryProduct::class, 'add_category_product']);
Route::get('/edit-category-product/{category_product_id}', [CategoryProduct::class, 'edit_category_product']);
Route::get('/delete-category-product/{category_product_id}', [CategoryProduct::class, 'delete_category_product']);
Route::get('/list-category-product', [CategoryProduct::class, 'list_category_product']);

Route::get('/unactive-category-product/{category_product_id}', [CategoryProduct::class, 'unactive_category_product']);
Route::get('/active-category-product/{category_product_id}', [CategoryProduct::class, 'active_category_product']);

Route::post('/save-category-product', [CategoryProduct::class, 'save_category_product']);
Route::post('/update-category-product/{category_product_id}', [CategoryProduct::class, 'update_category_product']);

Route::post('/export-csv', [CategoryProduct::class, 'export_csv']);
Route::post('/import-csv', [CategoryProduct::class, 'import_csv']);


//BrandProduct
Route::get('/add-brand-product', [BrandProduct::class, 'add_brand_product']);
Route::get('/edit-brand-product/{brand_product_id}', [BrandProduct::class, 'edit_brand_product']);
Route::get('/delete-brand-product/{brand_product_id}', [BrandProduct::class, 'delete_brand_product']);
Route::get('/list-brand-product', [BrandProduct::class, 'list_brand_product']);

Route::get('/unactive-brand-product/{brand_product_id}', [BrandProduct::class, 'unactive_brand_product']);
Route::get('/active-brand-product/{brand_product_id}', [BrandProduct::class, 'active_brand_product']);

Route::post('/save-brand-product', [BrandProduct::class, 'save_brand_product']);
Route::post('/update-brand-product/{brand_product_id}', [BrandProduct::class, 'update_brand_product']);

//Products
Route::get('/add-product', [ProductController::class, 'add_product']);
Route::get('/edit-product/{product_id}', [ProductController::class, 'edit_product']);
Route::get('/delete-product/{product_id}', [ProductController::class, 'delete_product']);
Route::get('/list-product', [ProductController::class, 'list_product']);

Route::get('/unactive-product/{product_id}', [ProductController::class, 'unactive_product']);
Route::get('/active-product/{product_id}', [ProductController::class, 'active_product']);

Route::post('/save-product', [ProductController::class, 'save_product']);
Route::post('/update-product/{product_id}', [ProductController::class, 'update_product']);

//Order
Route::get('/manager-order', [OrderController::class, 'manager_order']);
Route::get('/view-order/{order_code}', [OrderController::class, 'view_order']);
Route::get('/print-order/{checkout_code}', [OrderController::class, 'print_order']);


//Delivery
Route::get('/delivery', [DeliveryController::class, 'delivery']);
Route::post('/select-delivery', [DeliveryController::class, 'select_delivery']);
Route::post('/add-delivery', [DeliveryController::class, 'add_delivery']);
Route::post('/select-feeship', [DeliveryController::class, 'select_feeship']);
Route::post('/update-feeship', [DeliveryController::class, 'update_feeship']);



