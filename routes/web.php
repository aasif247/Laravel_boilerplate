<?php

use App\Http\Controllers\ApplicationSettingController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Redirect dashboard
Route::get('/', function () {
    return redirect('dashboard');
});

Auth::routes();

Route::group(['middleware' => ['auth:sanctum']], function () {

    // Default Dashboard
    Route::get('dashboard', [HomeController::class, 'index'])->name('dashboard');

    // Application Settings
    Route::get('application/settings', [ApplicationSettingController::class, 'index'])->name('application.settings');
    Route::post('application/settings/update', [ApplicationSettingController::class, 'update'])->name('application.settings');

    // Products
    Route::resource('products', '\App\Http\Controllers\ProductController');
    Route::post('product/status_change', [ProductController::class, 'status'])->name('product.status');

    // Profile
    Route::get('profile', [UserController::class, 'profile'])->name('profile');

    //users
    Route::resource('users', '\App\Http\Controllers\UserController');

});
