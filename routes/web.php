<?php

use App\Http\Controllers\accountController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\users;
use App\Http\Controllers\categoriesController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\inventoryController;
use App\Http\Controllers\productController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\FrontendProductController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\customerLoginController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\checkoutController;
use App\Http\Controllers\couponController;
use App\Http\Controllers\orderController;
use App\Http\Controllers\roleManagerController;
use App\Http\Controllers\shopController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\socialLoginController;
use App\Http\Controllers\wishlistController;

Auth::routes();


// Frontend Routes Start
Route::get('/', [FrontendController::class, 'frontend'])->name('frontend');
Route::get('/about-us', [FrontendController::class, 'about_us'])->name('about_us');
Route::get('/contact-us', [FrontendController::class, 'contact_us'])->name('contact_us');
Route::get('/404/Error', [FrontendController::class, 'error_404'])->name('404');
// Frontend Routes End

// Frontend Product Details Routes Start
Route::get('/product/details/{product_slug}', [FrontendProductController::class, 'product_details'])->name('product_details');
Route::post('/get/size', [FrontendProductController::class, 'get_size'])->name('get_size');
Route::post('/review', [FrontendProductController::class, 'review_store'])->name('review_store');
// Frontend Product Details Routes End

// Frontend Customer Routes Start
Route::get('/customer/register/signin', [customerController::class, 'register_login'])->name('register_login');
Route::post('/customer/register', [customerController::class, 'customer_register'])->name('customer_register');
// Login
Route::post('/customer/login', [customerLoginController::class, 'customer_login'])->name('customer_login');
Route::get('/customer/logout', [customerLoginController::class, 'customer_logout'])->name('customer_logout');
// Frontend Customer Routes End

// Frontend Cart Routes Start
Route::post('/add/product/cart', [cartController::class, 'cart_store'])->name('cart_store');
Route::get('/remove/cart/{cart_id}', [cartController::class, 'cart_remove'])->name('cart_remove');
Route::get('/cart', [cartController::class, 'view_cart'])->name('cart.html');
Route::post('/quanity/update', [cartController::class, 'quanity_update'])->name('quanity_update');
// Frontend Cart Routes End

// Frontend checkout Routes Start
Route::get('/checkout', [checkoutController::class, 'checkout'])->name('checkout');
Route::post('/getcityid', [checkoutController::class, 'get_city_id']);
// Frontend checkout Routes End

// Frontend Order Routes End
Route::post('/order/store', [orderController::class, 'order_store'])->name('order_store');
Route::get('/order/success', [orderController::class, 'order_success'])->name('order_success');
// Frontend Order Routes End

// Frontend Account Routes Start
Route::get('/customer/account', [accountController::class, 'account'])->name('account');
Route::get('/customer/account/invoice/download/{order_id}', [accountController::class, 'invoice_download'])->name('invoice_download');
// Forget Password
Route::get('/customer/forget/password', [accountController::class, 'forget_pass'])->name('forget_pass');
Route::post('/customer/forget/password/data/store', [accountController::class, 'reset_pass_data_store'])->name('reset_pass_data_store');
Route::get('/customer/add/new/password/{token}', [accountController::class, 'new_password'])->name('new_password');
Route::post('/customer/update/password', [accountController::class, 'update_new_password'])->name('update_new_password');
// Email Verifacation
Route::get('/email/verification/send/again', [accountController::class, 'email_verfiy_again'])->name('email_verfiy_again');
Route::get('/email/verification/{token}', [accountController::class, 'email_verfiy']);
// Frontend Account Routes End

// SOCIAL LOGIN ROUTES START
// GITHUB
Route::get('/github/redirect', [socialLoginController::class, 'github_redirect'])->name('github_redirect');
Route::get('/github/callback', [socialLoginController::class, 'github_callback'])->name('github_callback');
// GOOGLE
Route::get('/google/redirect', [socialLoginController::class, 'google_redirect'])->name('google_redirect');
Route::get('/google/callback', [socialLoginController::class, 'google_callback'])->name('google_callback');
// SOCIAL LOGIN ROUTES END

// Frontend Shop Routes Start
Route::get('/shop', [shopController::class, 'shop'])->name('shop');
// Frontend Shop Routes End

// Frontend WishList Routes Start
Route::get('/wishlist', [wishlistController::class, 'wishlist'])->name('wishlist');
Route::get('/wishlist/favourit/{product_id}', [wishlistController::class, 'favourit'])->name('favourit');
Route::get('/wishlist/remove/{wishlist_id}', [wishlistController::class, 'remove_wishes'])->name('remove_wishes');
// Frontend WishList Routes End

// ############################################
// ############################################

// Dashboard Routes Start
Route::get('/home', [HomeController::class, 'index'])->name('home');
// Dashboard Routes End

// Dashboard Users Routes Start
Route::get('/dashboard/users', [users::class, 'users_table'])->name('users_table');
Route::get('/dashboard/user/profile', [users::class, 'user_profile'])->name('user_profile');
Route::get('/dashboard/user/edit/{update_code}', [users::class, 'edit_user_photo'])->name('edit_user_photo');
Route::post('/dashboard/user/update', [users::class, 'update_user'])->name('update_user');
Route::get('/dashboard/users/delete/{user_id}', [users::class, 'delete_user'])->name('delete_user');
// Dashboard Users Routes End

// Dashboard Category Routes Start
Route::get('/dashboard/categories', [categoriesController::class, 'category'])->name('category');
Route::get('/dashboard/categories/list', [categoriesController::class, 'category_list'])->name('category_list');
Route::post('/dashboard/categories/store', [categoriesController::class, 'category_store'])->name('category.store');
Route::get('/dashboard/categories/Edit/{category_id}', [categoriesController::class, 'category_edit'])->name('category.edit');
Route::post('/dashboard/categories/update', [categoriesController::class, 'category_update'])->name('update.category');
Route::get('/dashboard/categories/Delete/{category_id}', [categoriesController::class, 'delete_category'])->name('category.delete');
Route::get('/dashboard/categories/restore/{category_id}', [categoriesController::class, 'restore_category'])->name('category.restore');
Route::get('/dashboard/categories/per_del/{category_id}', [categoriesController::class, 'per_del_category'])->name('category.per.del');
Route::post('/dashboard/categories/delete/marked', [categoriesController::class, 'category_delete_marked'])->name('delete.marked.category');
// Dashboard Category Routes End

// Dashboard Sub Category Routes Start
Route::get('/dashboard/subcategory',[SubcategoryController::class, 'index'])->name('subcategory');
Route::post('/dashboard/subcategory/store',[SubcategoryController::class, 'subcategory_store'])->name('subcategory.store');
// Dashboard Sub Category Routes End

// Dashboard Products Routes Start
Route::get('/dashboard/add/product',[productController::class, 'index'])->name('add_product');
Route::post('/getsubcategory',[productController::class, 'getsubcategory']);
Route::post('/insert/product',[productController::class, 'insert_product'])->name('insert_product');
Route::get('/dashboard/view_product',[productController::class, 'view_product'])->name('view_product');
// Dashboard Products Routes End


// Dashboard Inventory Routes Start
Route::get('/dashboard/product/inventory/{product_id}',[inventoryController::class, 'inventory'])->name('inventory');
Route::get('/dashboard/product/inventory/add/variation',[inventoryController::class, 'add_variation'])->name('add_variation');
Route::post('/dashboard/product/inventory/add/color',[inventoryController::class, 'add_color'])->name('add_color');
Route::post('/dashboard/product/inventory/add/size',[inventoryController::class, 'add_size'])->name('add_size');
Route::post('/dashboard/product/inventory/add/inentory',[inventoryController::class, 'add_inentory'])->name('add_inentory');
// Dashboard Inventory Routes End

// Dashboard Coupon Routes Start
Route::get('/dashboard/coupon/list',[couponController::class, 'view_coupon'])->name('view_coupon');
Route::get('/dashboard/add/coupon',[couponController::class, 'add_coupon'])->name('add_coupon');
Route::post('/dashboard/coupon/store',[couponController::class, 'coupon_store'])->name('coupon_store');
Route::get('/dashboard/coupon/status/{coupon_id}',[couponController::class, 'coupon_status'])->name('coupon_status');
Route::get('/dashboard/coupon/delete/{coupon_id}',[couponController::class, 'coupon_delete'])->name('coupon_delete');
// Dashboard Coupon Routes End

// Dashboard Role Manager Routes Start
Route::get('/dashboard/role/manager',[roleManagerController::class, 'role_manager'])->name('role_manager');
Route::post('/dashboard/role/manager/store/permission',[roleManagerController::class, 'permission_store'])->name('permission_store');
Route::post('/dashboard/role/manager/store/role',[roleManagerController::class, 'role_store'])->name('role_store');
Route::get('/dashboard/edit/role/{role_id}',[roleManagerController::class, 'edit_role'])->name('edit_role');
Route::post('/dashboard/role/manager/update/role',[roleManagerController::class, 'role_update'])->name('role_update');
Route::get('/dashboard/assgin/role/to/User',[roleManagerController::class, 'assgin_role'])->name('assgin_role');
Route::post('/dashboard/assgin/role/to/User/store',[roleManagerController::class, 'assgin_role_store'])->name('assgin_role_store');
// Dashboard Role Manager Routes End



// ######################## PAYMENT ROUTES START ###################

// SSLCOMMERZ Start
Route::get('/sslpay', [SslCommerzPaymentController::class, 'sslpay']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END

// STRIPE Start
Route::get('/stripe',[StripePaymentController::class,'stripe']);
Route::post('/stripe',[StripePaymentController::class,'stripePost'])->name('stripe.post');
// STRIPE End

// ######################## PAYMENT ROUTES END ###################


