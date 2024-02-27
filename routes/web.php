<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\frontend\CartController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\frontend\ProductController;
use App\Http\Controllers\frontend\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/check-email', function () {
    return view('frontend.emails.password-reset',[
        'name' => 'John Smith',
        'token' => 'lorem ipsum dolor sit amet, consectetur adip'
    ]);
})->name('home');
Route::get('/', function () {
    return view('frontend.home');
})->name('home');
Route::get('/search', function () {
    return view('frontend.search');
})->name('search');
Route::get('/product/{id}/{slug}', [ProductController::class, 'show'])->name('productDetails');
Route::get('/contactus', function () {
    return view('frontend.contactUs');
})->name('contactus');

// WISHLIST ROUTES
Route::get('/wishlist',[WishlistController::class,'index'])->middleware('auth')->name('wishlist');
Route::post('/wishlist/add',[WishlistController::class,'store'])->middleware('auth')->name('wishlist.add');
Route::delete('/wishlist/delete/{id}',[WishlistController::class,'destroy'])->middleware('auth')->name('wishlist.delete');

// CART
Route::get('/cart',[CartController::class,'index'])->middleware('auth')->name('cart.index');
Route::post('/cart/add',[CartController::class,'store'])->middleware('auth')->name('cart.add');
Route::delete('/cart/delete/{id}',[CartController::class,'destroy'])->middleware('auth')->name('cart.delete');



Route::get('/checkout', function () {
    return view('frontend.checkout');
})->name('checkout');
Route::get('/order-success', function () {
    return view('frontend.orderSuccess');
})->name('orederSuccess');
Route::get('/order-tracking', function () {
    return view('frontend.orderTracking');
})->name('orederTracking');
Route::get('/compare', function () {
    return view('frontend.compare');
})->name('compare');
Route::get('/aboutus', function () {
    return view('frontend.aboutus');
})->name('aboutus');
Route::get('/notfound', function () {
    return view('frontend.404');
})->name('notfound');
Route::get('/faq', function () {
    return view('frontend.faq');
})->name('faq');

// SELLER
Route::get('/be-a-seller', function () {
    return view('frontend.seller.sellerBecome');
})->name('sellerBecome');
Route::get('/all-seller', function () {
    return view('frontend.seller.allseller');
})->name('allseller');
Route::get('/vendor/name', function () {
    return view('frontend.seller.vendorDetails');
})->name('vendorDetails');

// USER
Route::get('/dashboard', function () {
    return view('frontend.dashboard.dashboard');
})->name('userDashboard');

// ADMIN
Route::get('/admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/user/update-password', [ProfileController::class, 'update_password'])->name('user.update-password');
});

Route::get('set-language', [DashboardController::class, 'setLanguage'])->name('set-language');

Route::post('apply-coupon', [PaymentController::class, 'apply_coupon'])->name('apply-coupon');

/**payment related route start */

Route::get('payment', [PaymentController::class, 'payment'])->name('payment');
Route::post('pay-via-stripe', [PaymentController::class, 'pay_via_stripe'])->name('pay-via-stripe');

Route::get('pay-via-paypal', [PaymentController::class, 'pay_via_paypal'])->name('pay-via-paypal');

Route::post('pay-via-bank', [PaymentController::class, 'pay_via_bank'])->name('pay-via-bank');

Route::post('pay-via-razorpay', [PaymentController::class, 'pay_via_razorpay'])->name('pay-via-razorpay');

Route::get('pay-via-mollie', [PaymentController::class, 'pay_via_mollie'])->name('pay-via-mollie');
Route::get('pay-via-instamojo', [PaymentController::class, 'pay_via_instamojo'])->name('pay-via-instamojo');

Route::get('/payment-addon-success', [PaymentController::class, 'payment_addon_success'])->name('payment-addon-success');
Route::get('/payment-addon-faild', [PaymentController::class, 'payment_addon_faild'])->name('payment-addon-faild');

/**payment related route end */

require __DIR__ . '/auth.php';

require __DIR__ . '/admin.php';
