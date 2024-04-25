<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\Slider\app\Http\Controllers\API\SliderController;

/*
    |--------------------------------------------------------------------------
    | API Routes
    |--------------------------------------------------------------------------
    |
    | Here is where you can register API routes for your application. These
    | routes are loaded by the RouteServiceProvider within a group which
    | is assigned the "api" middleware group. Enjoy building your API!
    |
*/

Route::middleware(['auth:sanctum'])->name('api.')->group(function () {
Route::get('slider', [SliderController::class, 'index']);
});
