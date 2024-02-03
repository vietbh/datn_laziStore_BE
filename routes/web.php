<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\Product\CategoriesProductController;
use App\Http\Controllers\Product\BrandController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\News\CategoriesNewsController;
use App\Http\Controllers\News\TagNewsController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProductHotController;
use App\Http\Controllers\RoleAdminController;
use App\Http\Controllers\SlideAdsController;
use App\Http\Controllers\UserGuestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('home');
});

// Đăng nhập
Route::get('/admin/dang-nhap-quan-tri-vien',function(){
    return view('layouts.admin.login');
})->name('admin.login');


Route::get('/dashboard', function () {
    // return view('dashboard');
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/authorize', function () {
    return view('layouts.abort.401');
})->middleware(['auth', 'verified'])->name('401');

Route::middleware(['auth','role:0'])->group(function () {
    // Dashboard
    Route::get('/admin',[DashBoardController::class, 'index'])->name('home');
    // Thống kê
    Route::get('/admin/thong-ke',[ChartController::class, 'index'])->name('chart.index');
    // Khách hàng
    Route::get('/admin/khach-hang',[UserGuestController::class, 'index'])->name('guest.index');
    // Đơn hàng
    Route::get('/admin/don-hang',[PaymentController::class, 'index'])->name('payment.index');
    // Mã giảm giá
    Route::get('/admin/ma-giam-gia',[DiscountController::class, 'index'])->name('discount.index');
    // Sản phẩm hot
    Route::get('/admin/san-pham-hot',[ProductHotController::class, 'index'])->name('hot.index');
    // Vận chuyển
    Route::get('/admin/van-chuyen',[DeliveryController::class, 'index'])->name('delivery.index');
    // Bình luận
    Route::get('/admin/binh-luan',[CommentController::class, 'index'])->name('comment.index');
    // Tư vấn
    Route::get('/admin/tu-van',[ContactController::class, 'index'])->name('contact.index');
    // Chính sách
    Route::get('/admin/chinh-sach',[PolicyController::class, 'index'])->name('policy.index');
    // Slide quảng cáo
    Route::get('/admin/slide-quang-cao',[SlideAdsController::class, 'index'])->name('slide.index');
    // Vai trò quản trị
    Route::get('/admin/vai-tro-quan-tri',[RoleAdminController::class, 'index'])->name('role.index');
    // Tới cửa hàng
    Route::get('/https://vietbh.github.io/lazi-store',function(){
        return redirect('https://vietbh.github.io/lazi-store');
    })->name('lazi.index');
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
    //Iin tức
    Route::get('/admin/tin-tuc',[NewsController::class, 'index'])->name('news.index');
    Route::post('/admin/tin-tuc/them',[NewsController::class, 'store'])->name('news.store');
    Route::get('/admin/tin-tuc/edit/{id}',[NewsController::class, 'edit'])->name('news.edit');
    Route::put('/admin/tin-tuc/edit/{id}',[NewsController::class, 'update'])->name('news.update');
    Route::delete('/admin/tin-tuc/xoa/{id}',[NewsController::class, 'destroy'])->name('news.delete');
    //Tag tin tức
    Route::get('/admin/tag-tin-tuc',[TagNewsController::class, 'index'])->name('news.tag.index');
    Route::post('/admin/tag-tin-tuc/them',[TagNewsController::class, 'store'])->name('news.tag.store');
    Route::get('/admin/tag-tin-tuc/edit/{id}',[TagNewsController::class, 'edit'])->name('news.tag.edit');
    Route::put('/admin/tag-tin-tuc/edit/{id}',[TagNewsController::class, 'update'])->name('news.tag.update');
    Route::delete('/admin/tag-tin-tuc/xoa/{id}',[TagNewsController::class, 'destroy'])->name('news.tag.delete');
    //Danh mục tin tức
    Route::get('/admin/danh-muc-tin-tuc',[CategoriesNewsController::class, 'index'])->name('news.cat.index');
    Route::post('/admin/danh-muc-tin-tuc/them',[CategoriesNewsController::class, 'store'])->name('news.cat.store');
    Route::get('/admin/danh-muc-tin-tuc/edit/{id}',[CategoriesNewsController::class, 'edit'])->name('news.cat.edit');
    Route::put('/admin/danh-muc-tin-tuc/edit/{id}',[CategoriesNewsController::class, 'update'])->name('news.cat.update');
    Route::delete('/admin/danh-muc-tin-tuc/xoa/{id}',[CategoriesNewsController::class, 'destroy'])->name('news.cat.delete');

    // 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
