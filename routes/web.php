<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\Product\CategoriesProductController;
use App\Http\Controllers\Product\BrandController;
use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/product',[ProductController::class,'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // 
    Route::get('/',[DashBoardController::class,'index'])->name('home');
    //Sản phẩm
    Route::get('/thuong-hieu',[BrandController::class,'index'])->name('brand');
    Route::get('/danh-muc-san-pham',[CategoriesProductController::class,'index'])->name('categories-product');
    Route::get('/them-danh-muc-san-pham',[CategoriesProductController::class,'create'])->name('add-categories-product');
    Route::get('/toan-bo-san-pham',[ProductController::class,'index'])->name('product');
    
    // 
    // 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
