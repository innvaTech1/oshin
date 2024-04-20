<?php

use Illuminate\Support\Facades\Route;
use Modules\Product\app\Http\Controllers\BrandController;
use Modules\Product\app\Http\Controllers\ProductAttributeController;
use Modules\Product\app\Http\Controllers\ProductCategoryController;
use Modules\Product\app\Http\Controllers\ProductController;

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

Route::group(['as' => 'admin.', 'prefix' => 'admin', 'middleware' => ['auth:admin','translation']], function () {

    // Products
    Route::resource('product', ProductController::class);
    Route::get('product/product-gallery/{id}', [ProductController::class, 'product_gallery'])->name('product-gallery');

    // view
    Route::get('product/related-product/{id}', [ProductController::class, 'related_product'])->name('related-products');
    // store
    Route::post('product/related-product/{id}', [ProductController::class, 'related_product_store'])->name('store-related-products');

    Route::get('product/related-variant/{id}', [ProductController::class, 'product_variant'])->name('product-variant');

    Route::get('product/related-variant/{id}/create', [ProductController::class, 'product_variant_create'])->name('product-variant.create');

    Route::post('product/related-variant/{id}', [ProductController::class, 'product_variant_store'])->name('product-variant.store');
    Route::get('product/related-variant/edit/{variant_id}', [ProductController::class, 'product_variant_edit'])->name('product-variant.edit');
    Route::put('product/related-variant/{variant_id}', [ProductController::class, 'product_variant_update'])->name('product-variant.update');

    Route::delete('product/related-variant/{variant_id}', [ProductController::class, 'product_variant_delete'])->name('product-variant.delete');

    Route::group(['prefix' => 'products'], function () {
        Route::resource('category', ProductCategoryController::class);
        Route::resource('brand', BrandController::class);

        Route::resource('attribute', ProductAttributeController::class);
        Route::post('attribute/get-value/', [ProductAttributeController::class, 'getValue'])->name('attribute.get.value');
        Route::post('attribute/value/delete', [ProductAttributeController::class, 'deleteValue'])->name('attribute.value.delete');
        Route::post('/attribute/has-value', [ProductAttributeController::class, 'checkHasValue'])->name('attribute.has-value');
    });
});
