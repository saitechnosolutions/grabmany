<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PHPMailerController;
use App\Http\Controllers\productController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/products', [productController::class, 'showallproducts']);
Route::get('/products/{id}', [productController::class, 'showproducts']);
Route::view('/about', 'pages.about');
Route::view('/cart', 'pages.cart');
Route::view('/wishlist', 'pages.wishlist');
Route::view('contact', 'pages.contact');


Route::view('/login', 'auth.login');
Route::view('/register', 'auth.register');

Route::get('/single_product/{id}', [productController::class, 'showsingleproducts']);
Route::get('/product-details/{id}', [productController::class, 'showsingleproducts']);

Route::post('/login', [LoginController::class, 'login']);
Route::post('/register', [LoginController::class, 'register']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::POST('/edituser', [LoginController::class, 'edituser']);
Route::post('/check-email', [LoginController::class, 'checkmail']);
Route::post('/verify-otp', [LoginController::class, 'verifyOtp']);
Route::post('/reset-password', [LoginController::class, 'resetPassword']);

// cart
Route::post('/add-cart', [CartController::class, 'addtocart']);
Route::post('/update-cart', [CartController::class, 'updateCart']);
Route::post('/removecart', [CartController::class, 'remove']);
Route::get('/checkout', function () {
    return view('pages.checkout');
});
Route::post('/checkout', [CheckoutController::class, 'checkout']);
Route::post('/check-out', [CheckoutController::class, 'checkoutnew']);
Route::get('/single_check/{id}', [CheckoutController::class, 'singlecheckout']);

Route::view('/profile', 'pages.user_profile');
Route::view('/orderhistory', 'pages.orderhistory');


Route::get('stateCity/{state_id}', [CheckoutController::class, 'getStateCities']);
Route::get('stateShipCity/{stateid1}', [CheckoutController::class, 'getStateShipCities']);
Route::get('/cities/{state_id}', [LoginController::class, 'getCities']);
Route::post('/checkoutproducts', [CheckoutController::class, 'check']);

Route::POST('/product/fetchcolordetails', [productController::class, 'fetchColorDetails']);

Route::POST('/wishlist/store', [productController::class, 'storewishlistprod']);


Route::POST('/cart/store', [productController::class, 'storecartprod']);

Route::POST('/product/getvarientdetails', [productController::class, 'getvarientdetails']);
Route::POST('/product/pricefilter', [productController::class, 'filterbyprice']);
Route::POST('/product/categoryfilter', [productController::class, 'filterbycategory']);
Route::post('/product/categorysort', [ProductController::class, 'filterbycatsort']);

Route::POST('/product/sortfilter', [productController::class, 'filterbysort']);

Route::POST('/checkout/createrazor', [CheckoutController::class, 'createRazorpayOrder']);
Route::POST('/checkoutmm', [CheckoutController::class, 'checkoutmm']);

Route::POST('/order/fetchordersummary', [productController::class, 'fetchordersummary']);

Route::POST('/checkout/create-razor', [CheckoutController::class, 'createSingleRazorpayOrder']);
Route::POST('/checkout/create-order', [CheckoutController::class, 'createneworder']);

Route::GET('/auth/forgot-password', [LoginController::class, 'forgotPasswordindex']);
Route::POST('/auth/forget-check', [LoginController::class, 'forgotPasswordcheck']);
Route::POST('/auth/reset-password', [LoginController::class, 'forgotPasswordreset']);

//
Route::post('/contactmail', [PHPMailerController::class, 'contact']);
