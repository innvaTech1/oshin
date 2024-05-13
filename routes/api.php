<?php

use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\CouponController;
use App\Http\Controllers\API\LocationController;
use App\Http\Controllers\API\OrderController;
use App\Http\Controllers\API\ProductCategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ShippingMethodController;
use App\Http\Controllers\API\UserAuthController;
use App\Http\Controllers\API\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
 */

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'cors'], function () {
    // Authentication
    Route::post('register', [UserAuthController::class, 'register']);
    Route::post('login', [UserAuthController::class, 'login']);
    Route::post('logout', [UserAuthController::class, 'logout']);
    Route::post('refresh', [UserAuthController::class, 'refresh']);


    // Reset password
    Route::post('password/email', [UserAuthController::class, 'forgotPassword']);
    Route::post('password/reset', [UserAuthController::class, 'resetPassword']);


    // get all districts
    Route::get('/districts', [LocationController::class, 'getDistricts']);
    // get all thanas
    Route::get('/thanas/{district_id}', [LocationController::class, 'getThanas']);

    // get category list
    Route::get('/categories', [ProductCategoryController::class, 'index']);
    Route::get('/categories/top', [ProductCategoryController::class, 'topCategories']);
    // get category by id
    Route::get('/categories/{slug}', [ProductCategoryController::class, 'show']);
    // get products by category
    Route::get('/categories/{slug}/products', [ProductCategoryController::class, 'products']);

    // get brands lists
    Route::get('/brands', [BrandController::class, 'brands']);
    Route::get('/brands/{slug}', [BrandController::class, 'show']);
    // get products by brand
    Route::get('/brands/{slug}/products', [BrandController::class, 'products']);

    // get products
    Route::get('/products', [ProductController::class, 'products']);
    Route::get('/products/featured', [ProductController::class, 'featuredProducts']);
    Route::get('/products/best-seller', [ProductController::class, 'bestSellerProducts']);
    Route::get('/products/homepage', [ProductController::class, 'homepageProducts']);
    Route::get('/products/{slug}', [ProductController::class, 'show']);


    // shipping methods routes
    Route::get('/shipping-methods', [ShippingMethodController::class, 'index']);
    Route::get('/shipping-methods/{id}', [ShippingMethodController::class, 'show']);

    // Order
    Route::post('/order/guest/create', [OrderController::class, 'createGuest']);
    // coupon
    Route::get('/coupon', [CouponController::class, 'index']);

    // get wishlists
    Route::middleware('auth:api')->group(function () {
        Route::post('/order/create', [OrderController::class, 'create']);
        Route::post('/wishlist/store', [WishlistController::class, 'store']);

        Route::get('/order/{id}', [OrderController::class, 'show']);
        Route::get('/wishlists', [WishlistController::class, 'index']);
        // add wishlist
        // remove wishlist
        Route::post('/wishlists/{id}', [WishlistController::class, 'destroy']);

        // Create Address
        Route::post('addresses', [AddressController::class, 'createAddress']);

        // Get Addresses
        Route::get('addresses', [AddressController::class, 'getAddresses']);

        // Update Address
        Route::put('addresses/{id}', [AddressController::class, 'updateAddress']);

        // Delete Address
        Route::delete('addresses/{id}', [AddressController::class, 'deleteAddress']);

        // Get user profile (requires authentication)
        Route::get('profile', [UserAuthController::class, 'profile']);

        // Update user profile (requires authentication)
        Route::put('profile', [UserAuthController::class, 'updateProfile']);

        // get user orders

        Route::get('orders', [OrderController::class, 'index']);
    });
});
// create order
