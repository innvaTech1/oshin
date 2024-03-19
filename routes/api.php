<?php

use App\Http\Controllers\API\BrandController;
use App\Http\Controllers\API\ProductCategoryController;
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


// get category list
Route::get('/categories', [ProductCategoryController::class,'index']);
// get category by id
Route::get('/categories/{slug}', [ProductCategoryController::class,'show']);
// get products by category
Route::get('/categories/{slug}/products', [ProductCategoryController::class,'products']);

// get brands lists
Route::get('/brands', [BrandController::class,'brands']);
// get products by brand
Route::get('/brands/{slug}/products', [BrandController::class,'products']);



// get wishlists
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/wishlists', [WishlistController::class,'index']);
    // add wishlist
    Route::post('/wishlists', [WishlistController::class,'store']);
    // remove wishlist
    Route::delete('/wishlists/{id}', [WishlistController::class,'destroy']);
});
