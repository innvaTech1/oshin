<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
/*  Start Admin panel Controller  */
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SellerController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UnitTypeController;
use Illuminate\Support\Facades\Route;

/*  End Admin panel Controller  */

Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
    /* Start admin auth route */
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('store-login', [AuthenticatedSessionController::class, 'store'])->name('store-login');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('/forget-password', [PasswordResetLinkController::class, 'custom_forget_password'])->name('forget-password');
    Route::get('reset-password/{token}', [NewPasswordController::class, 'custom_reset_password_page'])->name('password.reset');
    Route::post('/reset-password-store/{token}', [NewPasswordController::class, 'custom_reset_password_store'])->name('password.reset-store');
    /* End admin auth route */

    Route::middleware(['auth:admin'])->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard']);
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

        // Product routes
        Route::group(['as.' => 'product', 'prefix' => 'products'], function () {
            Route::get('/', [ProductController::class, 'index'])->name('product.index');
            Route::get('/create', [ProductController::class, 'create'])->name('product.create');
            Route::post('/', [ProductController::class, 'store'])->name('product.store');
            Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('edit');
            Route::get('/{id}/clone', [ProductController::class, 'clone'])->name('clone');
            Route::get('bulk-product-upload', [ProductController::class, 'bulk_product_upload_page'])->name('bulk_product_upload_page');
            Route::post('bulk-product-upload-store', [ProductController::class, 'bulk_product_store'])->name('bulk_product_store');

            // Categories Routes

            Route::resource('category', CategoryController::class);
            Route::get('bulk-category-upload', [CategoryController::class, 'bulk_category_upload_page'])->name('bulk_category_upload_page');
            Route::get('download-category-list-csv', [CategoryController::class, 'csv_category_download'])->name('csv_category_download');
            Route::post('bulk-category-upload-store', [CategoryController::class, 'bulk_category_store'])->name('bulk_category_store');
            Route::get('/category-info', [CategoryController::class, 'info'])->name('categories.index_info');
            Route::get('/categories/get-data', [CategoryController::class, 'getData'])->name('categories.get-data');
            Route::post('/request-product/approved', [ProductController::class, 'approved'])->name('request.approved');

            // Brands
            Route::resource('brand', BrandController::class);
            Route::resource('attribute', AttributeController::class);
            Route::post('attribute/values', [AttributeController::class, 'attributeValues'])->name('attribute.values');
            Route::resource('unit', UnitTypeController::class);

        });

        Route::controller(AdminProfileController::class)->group(function () {
            Route::get('edit-profile', 'edit_profile')->name('edit-profile');
            Route::put('profile-update', 'profile_update')->name('profile-update');
            Route::put('update-password', 'update_password')->name('update-password');
        });


        // sellers routes
        Route::resource('sellers', SellerController::class);

        Route::get('role/assign', [RolesController::class, 'assignRoleView'])->name('role.assign');
        Route::post('role/assign/{id}', [RolesController::class, 'getAdminRoles'])->name('role.assign.admin');
        Route::put('role/assign', [RolesController::class, 'assignRoleUpdate'])->name('role.assign.update');
        Route::resource('/role', RolesController::class);
        Route::resource('/role', RolesController::class);
    });
    Route::resource('admin', AdminController::class)->except('show');
    Route::put('admin-status/{id}', [AdminController::class, 'changeStatus'])->name('admin.status');
    // Settings routes
    Route::get('settings', [SettingController::class, 'settings'])->name('settings');
});
