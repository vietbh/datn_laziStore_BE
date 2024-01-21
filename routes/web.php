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
Route::get('/', function () {
    return redirect()->route('home');
});

// Route::get('/product',[ProductController::class,'index']);

Route::get('/dashboard', function () {
    return redirect()->route('home');
    // return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // 
    Route::get('/admin',[DashBoardController::class, 'index'])->name('home');
    //Sản phẩm
    Route::get('/admin/san-pham',[ProductController::class, 'index'])->name('product.index');
    Route::post('/admin/san-pham/them',[ProductController::class, 'store'])->name('product.store');
    Route::get('/admin/san-pham/edit/{id}',[ProductController::class, 'edit'])->name('product.edit');
    Route::put('/admin/san-pham/edit/{id}',[ProductController::class, 'update'])->name('product.update');
    Route::delete('/admin/san-pham/xoa/{id}',[ProductController::class, 'destroy'])->name('product.delete');
    // Thương hiệu
    Route::get('/admin/san-pham/thuong-hieu',[BrandController::class, 'index'])->name('brand.index');
    Route::post('/admin/thuong-hieu/them',[BrandController::class, 'store'])->name('brand.store');
    Route::get('/admin/thuong-hieu/edit/{id}',[BrandController::class, 'edit'])->name('brand.edit');
    Route::put('/admin/thuong-hieu/edit/{id}',[BrandController::class, 'update'])->name('brand.update');
    Route::delete('/admin/thuong-hieu/xoa/{id}',[BrandController::class, 'destroy'])->name('brand.delete');
    // Danh mục sản phẩm
    Route::get('/admin/danh-muc-san-pham',[CategoriesProductController::class, 'index'])->name('product.cat.index');
    Route::post('/admin/danh-muc-san-pham/them',[CategoriesProductController::class, 'store'])->name('product.cat.store');
    Route::get('/admin/danh-muc-san-pham/edit/{id}',[CategoriesProductController::class, 'edit'])->name('product.cat.edit');
    Route::put('/admin/danh-muc-san-pham/edit/{id}',[CategoriesProductController::class, 'update'])->name('product.cat.update');
    Route::delete('/admin/danh-muc-san-pham/xoa/{id}',[CategoriesProductController::class, 'destroy'])->name('product.cat.delete');

    
    // 
    // 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
