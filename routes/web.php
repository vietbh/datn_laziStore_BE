<?php

use App\Http\Controllers\ChartController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommentNewsController;
use App\Http\Controllers\CommentProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\FrontEnd\NewsController as FrontEndNewsController;
use App\Http\Controllers\Product\CategoriesProductController;
use App\Http\Controllers\Product\BrandController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\News\CategoriesNewsController;
use App\Http\Controllers\News\TagNewsController;
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProductHotController;
use App\Http\Controllers\ProductSpecificationController;
use App\Http\Controllers\ProductVariationController;
use App\Http\Controllers\RoleAdminController;
use App\Http\Controllers\SlideAdsController;
use App\Http\Controllers\UserGuestController;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Route;

// Tin tuc
Route::get('/lazi-store.html', function () {
    return redirect('http://localhost:5173/lazi-store/');
});

Route::get('/tin-tuc.html',[FrontEndNewsController::class,'index'])->name('newsFront.index');
Route::get('/{slug}.html',[FrontEndNewsController::class,'show'])->name('newsFront.show');
// Route::resource('/categories',CategoryController::class)->only(['show']);
// Route::resource('/comment',CommentController::class)->only(['store']);
// Route::get('/tin/search',[TinController::class,'search'])->name('tin.search');
// Route::get('/admin/search',[TinController::class,'search'])->name('admin.search');
// Route::get('/admin/category/search',[CategoryController::class,'search'])->name('category.search');
// 


Route::get('/dashboard', function () {
    // return view('dashboard');
    return redirect()->route('home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/authorize', function () {
    return view('layouts.abort.401');
})->middleware(['auth', 'verified'])->name('401');

Route::middleware(['auth','role:0'])->group(function () {
    // Dashboard
    Route::get('/lazi-store-admin',[DashBoardController::class, 'index'])->name('home');
    // Thống kê
    Route::get('/lazi-store-admin/thong-ke',[ChartController::class, 'index'])->name('chart.index');
    // Khách hàng
    Route::get('/lazi-store-admin/khach-hang',[UserGuestController::class, 'index'])->name('guest.index');
    // Đơn hàng
    Route::get('/lazi-store-admin/don-hang',[PaymentController::class, 'index'])->name('payment.index');
    // Mã giảm giá
    Route::get('/lazi-store-admin/ma-giam-gia',[DiscountController::class, 'index'])->name('discount.index');
    // Sản phẩm hot
    Route::get('/lazi-store-admin/san-pham-hot',[ProductHotController::class, 'index'])->name('hot.index');
    // Vận chuyển
    Route::get('/lazi-store-admin/van-chuyen',[DeliveryController::class, 'index'])->name('delivery.index');
    // Bình luận sản phẩm
    Route::get('/lazi-store-admin/binh-luan-san-pham',[CommentProductController::class, 'index'])->name('comment.product.index');
    // Bình luận tin tức
    Route::get('/lazi-store-admin/binh-luan-tin-tuc',[CommentNewsController::class, 'index'])->name('comment.news.index');
    // Tư vấn
    Route::get('/lazi-store-admin/tu-van',[ContactController::class, 'index'])->name('contact.index');
    // Chính sách
    Route::get('/lazi-store-admin/chinh-sach',[PolicyController::class, 'index'])->name('policy.index');
    // Slide quảng cáo
    Route::get('/lazi-store-admin/slide-quang-cao',[SlideAdsController::class, 'index'])->name('slide.index');
    // Vai trò quản trị
    Route::get('/lazi-store-admin/vai-tro-quan-tri',[RoleAdminController::class, 'index'])->name('role.index');
    // Tới cửa hàng
    Route::get('/https://vietbh.github.io/lazi-store',function(){
        return redirect('https://vietbh.github.io/lazi-store');
    })->name('lazi.index');
    //Sản phẩm
    Route::get('/lazi-store-admin/san-pham',[ProductController::class, 'index'])->name('product.index');
    Route::get('/lazi-store-admin/san-pham/them',[ProductController::class, 'create'])->name('product.create');
    Route::post('/lazi-store-admin/san-pham/them',[ProductController::class, 'store'])->name('product.store');
    Route::post('/lazi-store-admin/san-pham/hinh-anh-mo-ta',[ProductController::class, 'upload'])->name('ckeditor.product.upload');
    Route::get('/lazi-store-admin/san-pham/edit/{id}',[ProductController::class, 'edit'])->name('product.edit');
    Route::put('/lazi-store-admin/san-pham/edit/{id}',[ProductController::class, 'update'])->name('product.update');
    Route::delete('/lazi-store-admin/san-pham/xoa/{id}',[ProductController::class, 'destroy'])->name('product.delete');
    // Varia
    Route::post('/lazi-store-admin/them-variation',[ProductVariationController::class, 'store'])->name('varia.store');
    Route::get('/lazi-store-admin/edit-variation/{id}',[ProductVariationController::class, 'edit'])->name('varia.edit');
    Route::put('/lazi-store-admin/edit-variation/{id}',[ProductVariationController::class, 'update'])->name('varia.update');
    Route::delete('/lazi-store-admin/delete-variation/{id}',[ProductVariationController::class, 'destroy'])->name('varia.delete');
    // Speci
    Route::post('/lazi-store-admin/san-pham/them-specification',[ProductSpecificationController::class, 'store'])->name('specifi.store');
    Route::get('/lazi-store-admin/edit-specification/{id}',[ProductSpecificationController::class, 'edit'])->name('specifi.edit');
    Route::put('/lazi-store-admin/edit-specification/{id}',[ProductSpecificationController::class, 'update'])->name('specifi.update');
    Route::delete('/lazi-store-admin/delete-specification/{id}',[ProductSpecificationController::class, 'destroy'])->name('specifi.delete');
    // Thương hiệu
    Route::get('/lazi-store-admin/san-pham/thuong-hieu',[BrandController::class, 'index'])->name('brand.index');
    Route::post('/lazi-store-admin/thuong-hieu/them',[BrandController::class, 'store'])->name('brand.store');
    Route::get('/lazi-store-admin/thuong-hieu/edit/{id}',[BrandController::class, 'edit'])->name('brand.edit');
    Route::put('/lazi-store-admin/thuong-hieu/edit/{id}',[BrandController::class, 'update'])->name('brand.update');
    Route::delete('/lazi-store-admin/thuong-hieu/xoa/{id}',[BrandController::class, 'destroy'])->name('brand.delete');
    // Danh mục sản phẩm
    Route::get('/lazi-store-admin/danh-muc-san-pham',[CategoriesProductController::class, 'index'])->name('product.cat.index');
    Route::post('/lazi-store-admin/danh-muc-san-pham/them',[CategoriesProductController::class, 'store'])->name('product.cat.store');
    Route::get('/lazi-store-admin/danh-muc-san-pham/edit/{id}',[CategoriesProductController::class, 'edit'])->name('product.cat.edit');
    Route::put('/lazi-store-admin/danh-muc-san-pham/edit/{id}',[CategoriesProductController::class, 'update'])->name('product.cat.update');
    Route::delete('/lazi-store-admin/danh-muc-san-pham/xoa/{id}',[CategoriesProductController::class, 'destroy'])->name('product.cat.delete');
    //Iin tức
    Route::get('/lazi-store-admin/tin-tuc',[NewsController::class, 'index'])->name('news.index');
    Route::post('/lazi-store-admin/tin-tuc/them',[NewsController::class, 'store'])->name('news.store');
    Route::post('/lazi-store-admin/tin-tuc/hinh-anh-mo-ta',[NewsController::class, 'upload'])->name('ckeditor.news.upload');
    Route::get('/lazi-store-admin/tin-tuc/edit/{id}',[NewsController::class, 'edit'])->name('news.edit');
    Route::put('/lazi-store-admin/tin-tuc/edit/{id}',[NewsController::class, 'update'])->name('news.update');
    Route::delete('/lazi-store-admin/tin-tuc/xoa/{id}',[NewsController::class, 'destroy'])->name('news.delete');
    //Tag tin tức
    Route::get('/lazi-store-admin/tag-tin-tuc',[TagNewsController::class, 'index'])->name('news.tag.index');
    Route::post('/lazi-store-admin/tag-tin-tuc/them',[TagNewsController::class, 'store'])->name('news.tag.store');
    Route::get('/lazi-store-admin/tag-tin-tuc/edit/{id}',[TagNewsController::class, 'edit'])->name('news.tag.edit');
    Route::put('/lazi-store-admin/tag-tin-tuc/edit/{id}',[TagNewsController::class, 'update'])->name('news.tag.update');
    Route::get('/lazi-store-admin/tag-tin-tuc/xoa/{id}',[TagNewsController::class, 'show'])->name('news.tag.show');
    Route::delete('/lazi-store-admin/tag-tin-tuc/xoa/{id}',[TagNewsController::class, 'destroy'])->name('news.tag.delete');
    //Danh mục tin tức
    Route::get('/lazi-store-admin/danh-muc-tin-tuc',[CategoriesNewsController::class, 'index'])->name('news.cat.index');
    Route::post('/lazi-store-admin/danh-muc-tin-tuc/them',[CategoriesNewsController::class, 'store'])->name('news.cat.store');
    Route::get('/lazi-store-admin/danh-muc-tin-tuc/edit/{id}',[CategoriesNewsController::class, 'edit'])->name('news.cat.edit');
    Route::put('/lazi-store-admin/danh-muc-tin-tuc/edit/{id}',[CategoriesNewsController::class, 'update'])->name('news.cat.update');
    Route::get('/lazi-store-admin/danh-muc-tin-tuc/xoa/{id}',[CategoriesNewsController::class, 'show'])->name('news.cat.show');
    Route::delete('/lazi-store-admin/danh-muc-tin-tuc/xoa/{id}',[CategoriesNewsController::class, 'destroy'])->name('news.cat.delete');

    // 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
