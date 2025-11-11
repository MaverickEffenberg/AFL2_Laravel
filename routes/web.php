<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\SaleController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/admin', [PlantController::class, 'index'])->name('admin'); //homepage
Route::get('/', [PlantController::class, 'home'])->name('home'); //homepage
Route::get('/about', [PageController::class, 'about'])->name('about'); //about us page
Route::get('/store', [PlantController::class, 'shop'])->name('store'); //store page
Route::get('/guide', [GuideController::class, 'index'])->name('guide'); //guide page



Route::resource('categories', CategoryController::class);
Route::resource('plants', PlantController::class);
Route::resource('users', UserController::class);

Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');