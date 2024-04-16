<?php

use App\Http\Controllers\API\AddressController;
use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\ProductCategoryController;
use App\Http\Controllers\API\ProductController;
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

// Authentication
Route::post('register', [UserAuthController::class, 'register']);
Route::post('login', [UserAuthController::class, 'login']);
Route::post('logout', [UserAuthController::class, 'logout'])->middleware('auth:sanctum');

// Reset password
Route::post('password/email', [UserAuthController::class, 'forgotPassword']);
Route::post('password/reset', [UserAuthController::class, 'resetPassword']);

// Get user profile (requires authentication)
Route::get('profile', [UserAuthController::class, 'profile'])->middleware('auth:sanctum');

// Update user profile (requires authentication)
Route::put('profile', [UserAuthController::class, 'updateProfile'])->middleware('auth:sanctum');

// get category list
Route::get('/categories', [ProductCategoryController::class, 'index']);
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

// get wishlists
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/wishlists', [WishlistController::class, 'index']);
    // add wishlist
    Route::post('/wishlists', [WishlistController::class, 'store']);
    // remove wishlist
    Route::delete('/wishlists/{id}', [WishlistController::class, 'destroy']);

    // Create Address
    Route::post('addresses', [AddressController::class, 'createAddress']);

    // Get Addresses
    Route::get('addresses', [AddressController::class, 'getAddresses']);

    // Update Address
    Route::put('addresses/{id}', [AddressController::class, 'updateAddress']);

    // Delete Address
    Route::delete('addresses/{id}', [AddressController::class, 'deleteAddress']);
});
