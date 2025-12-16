<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// ---------------------
// ADMIN PAGE (FIXED)
// ---------------------
Route::get('/admin', function () {
    $user = Auth::user();

    if ($user && $user->role === 'admin') {
        return app(PlantController::class)->index();
    }

    return redirect()->route('home');
})->middleware('auth')->name('admin');


// ---------------------
// AUTH ROUTES
// ---------------------
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/signup', function () {
    return view('auth.signup', ['title' => 'Signup']);
});
Route::post('/signup', [AuthController::class, 'signupStore']);


// ---------------------
// PUBLIC PAGES
// ---------------------
Route::get('/', [PlantController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');

// Blog CRUD routes (admin-only for write actions)
Route::middleware(['auth', \App\Http\Middleware\CheckIfAdmin::class])->group(function () {
    Route::post('/blog', [\App\Http\Controllers\BlogController::class, 'store'])->name('blogs.store');
    Route::put('/blog/{blog}', [\App\Http\Controllers\BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/blog/{blog}', [\App\Http\Controllers\BlogController::class, 'destroy'])->name('blogs.destroy');
});
Route::get('/profile', [PageController::class, 'profile'])->name('profile');
Route::get('/store', [PlantController::class, 'shop'])->name('store');
Route::get('/guide', [GuideController::class, 'index'])->name('guide');


// ---------------------
// RESOURCES
// ---------------------
Route::resource('categories', CategoryController::class);
Route::resource('plants', PlantController::class);
Route::resource('users', UserController::class);

Route::get('/sales', [SaleController::class, 'index'])->name('sales.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [\App\Http\Controllers\ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/profile', [\App\Http\Controllers\ProfileController::class, 'update'])
        ->name('profile.update');

    Route::put('/profile/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])
        ->name('profile.password.update');

    Route::delete('/profile', [\App\Http\Controllers\ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});
