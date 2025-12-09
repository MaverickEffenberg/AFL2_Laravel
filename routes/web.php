<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\SaleController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

Route::middleware('auth')->group(function () {
    Route::get('/admin', function () {
        // Check if the logged-in user has 'admin' role
        if (auth()->user()->role === 'admin') {
            return app(PlantController::class)->index();
        }
        
        // If the user is not an admin, redirect them to the home page
        return redirect()->route('home');
    })->name('admin');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/', [PlantController::class, 'home'])->name('home'); //homepage
Route::get('/about', [PageController::class, 'about'])->name('about'); //about us page
Route::get('/profile', [PageController::class, 'profile'])->name('profile'); //user profile page
Route::get('/store', [PlantController::class, 'shop'])->name('store'); //store page
Route::get('/guide', [GuideController::class, 'index'])->name('guide'); //guide page



Route::resource('categories', CategoryController::class);
Route::resource('plants', PlantController::class);
Route::resource('users', UserController::class);

Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');