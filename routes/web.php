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
use App\Http\Controllers\News\NewsController;
use App\Http\Controllers\News\TagController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\ProductHotController;
use App\Http\Controllers\ProductSpecificationController;
use App\Http\Controllers\ProductVariationController;
use App\Http\Controllers\RoleAdminController;
use App\Http\Controllers\ShippingProvidersController;
use App\Http\Controllers\SlideAdsController;
use App\Http\Controllers\SpecificationController;
use App\Http\Controllers\UserGuestController;
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

Route::prefix('lazi-store-admin')->middleware(['auth','role:0'])->group(function () {
    // Dashboard
    Route::get('/',[DashBoardController::class, 'index'])->name('home');
    // Thống kê
    Route::get('/thong-ke',[ChartController::class, 'index'])->name('chart.index');
    // Khách hàng
    Route::get('/khach-hang',[UserGuestController::class, 'index'])->name('guest.index');
    Route::get('/khach-hang-detail/{id}',[UserGuestController::class, 'edit'])->name('guest.edit');
    // Đơn hàng
    Route::get('/don-hang',[PaymentController::class, 'index'])->name('payment.index');
    Route::get('/don-hang-detail/{id}',[PaymentController::class, 'edit'])->name('payment.edit');
    // Mã giảm giá
    Route::get('/ma-giam-gia',[DiscountController::class, 'index'])->name('discount.index');
    Route::post('/ma-giam-gia-them',[DiscountController::class, 'store'])->name('discount.store');
    Route::get('/ma-giam-gia-edit/{id}',[DiscountController::class, 'edit'])->name('discount.edit');
    Route::put('/ma-giam-gia-edit/{id}',[DiscountController::class, 'update'])->name('discount.update');
    Route::delete('/ma-giam-gia-xoa/{id}',[DiscountController::class, 'destroy'])->name('discount.delete');
    // Sản phẩm hot
    Route::get('/san-pham-hot',[ProductHotController::class, 'index'])->name('hot.index');
    //Đơn hàng Vận chuyển
    Route::get('/van-chuyen',[DeliveryController::class, 'index'])->name('delivery.index');
    //Nhà Vận chuyển
    Route::get('/nha-van-chuyen',[ShippingProvidersController::class, 'index'])->name('shipping.index');
    Route::post('/them-nha-van-chuyen',[ShippingProvidersController::class, 'store'])->name('shipping.store');
    Route::get('/edit-nha-van-chuyen/{id}',[ShippingProvidersController::class, 'edit'])->name('shipping.edit');
    Route::put('/edit-nha-van-chuyen/{id}',[ShippingProvidersController::class, 'update'])->name('shipping.update');
    Route::delete('/xoa-nha-van-chuyen/{id}',[ShippingProvidersController::class, 'destroy'])->name('shipping.delete');
    
    // Bình luận sản phẩm
    Route::get('/binh-luan-san-pham',[CommentProductController::class, 'index'])->name('comment.product.index');
    Route::put('/binh-luan-san-pham/edit/{id}',[CommentProductController::class, 'update'])->name('comment.product.update');
    // Bình luận tin tức
    Route::get('/binh-luan-tin-tuc',[CommentNewsController::class, 'index'])->name('comment.news.index');
    // Tư vấn
    Route::get('/tu-van',[ContactController::class, 'index'])->name('contact.index');
    // Chính sách
    Route::prefix('chinh-sach')->group(function(){
        Route::get('/',[PolicyController::class, 'index'])->name('policy.index');
        Route::post('/them',[PolicyController::class, 'store'])->name('policy.store');
        Route::get('/edit/{id}',[PolicyController::class, 'edit'])->name('policy.edit');
        Route::put('/edit/{id}',[PolicyController::class, 'update'])->name('policy.update');
        Route::delete('/xoa/{id}',[PolicyController::class, 'destroy'])->name('policy.delete');
    });
    // Slide quảng cáo
    Route::get('/slide-quang-cao',[SlideAdsController::class, 'index'])->name('slide.index');
    Route::post('/slide-quang-cao-them',[SlideAdsController::class, 'store'])->name('slide.store');
    Route::get('/slide-quang-cao-edit/{id}',[SlideAdsController::class, 'edit'])->name('slide.edit');
    Route::put('/slide-quang-cao-edit/{id}',[SlideAdsController::class, 'update'])->name('slide.update');
    Route::delete('/slide-quang-cao-xoa/{id}',[SlideAdsController::class, 'destroy'])->name('slide.delete');
    // Vai trò quản trị
    Route::get('/vai-tro-quan-tri',[RoleAdminController::class, 'index'])->name('role.index');
    Route::get('/quan-tri-vien',[UserGuestController::class, 'index'])->name('guest.index');

    
    //Sản phẩm
    Route::get('/san-pham',[ProductController::class, 'index'])->name('product.index');
    Route::get('/them-san-pham',[ProductController::class, 'create'])->name('product.create');
    Route::post('/them-san-pham',[ProductController::class, 'store'])->name('product.store');
    Route::post('/san-pham/hinh-anh-mo-ta',[ProductController::class, 'uploadCk'])->name('ckeditor.product.upload');
    Route::get('/edit-san-pham/{id}',[ProductController::class, 'edit'])->name('product.edit');
    Route::put('/edit-san-pham/{id}',[ProductController::class, 'update'])->name('product.update');
    Route::delete('/xoa-san-pham/{id}',[ProductController::class, 'destroy'])->name('product.delete');
   
    Route::prefix('san-pham')->group(function(){
        // Varia
        Route::get('/them-variation/{id}',[ProductVariationController::class, 'create'])->name('varia.create');
        Route::post('/them-variation',[ProductVariationController::class, 'store'])->name('varia.store');
        Route::get('/edit-variation/{id}',[ProductVariationController::class, 'edit'])->name('varia.edit');
        Route::put('/edit-variation/{id}',[ProductVariationController::class, 'update'])->name('varia.update');
        Route::delete('/delete-variation/{id}',[ProductVariationController::class, 'destroy'])->name('varia.delete');
        // Speci 
        // Route::get('/them-speci/{id}',[SpecificationController::class, 'create'])->name('specifi.create');
        Route::post('/them-speci',[SpecificationController::class, 'store'])->name('speci.store');
        Route::get('/edit-speci/{productId}/{id}',[SpecificationController::class, 'edit'])->name('speci.edit');
        Route::put('/edit-speci/{id}',[SpecificationController::class, 'update'])->name('speci.update');
        Route::delete('/delete-speci/{id}',[SpecificationController::class, 'destroy'])->name('speci.delete');
        // Speci product
        Route::get('/them-specification/{id}',[ProductSpecificationController::class, 'create'])->name('specifi.create');
        Route::post('/them-specification',[ProductSpecificationController::class, 'store'])->name('specifi.store');
        Route::get('/edit-specification/{id}',[ProductSpecificationController::class, 'edit'])->name('specifi.edit');
        Route::put('/edit-specification/{id}',[ProductSpecificationController::class, 'update'])->name('specifi.update');
        Route::delete('/delete-specification/{id}',[ProductSpecificationController::class, 'destroy'])->name('specifi.delete');
    });
    
    // Thương hiệu
    Route::get('/san-pham/thuong-hieu',[BrandController::class, 'index'])->name('brand.index');
    Route::post('/thuong-hieu/them',[BrandController::class, 'store'])->name('brand.store');
    Route::get('/thuong-hieu/edit/{id}',[BrandController::class, 'edit'])->name('brand.edit');
    Route::put('/thuong-hieu/edit/{id}',[BrandController::class, 'update'])->name('brand.update');
    Route::delete('/thuong-hieu/xoa/{id}',[BrandController::class, 'destroy'])->name('brand.delete');
    // Danh mục sản phẩm
    Route::get('/danh-muc-san-pham',[CategoriesProductController::class, 'index'])->name('product.cat.index');
    Route::post('/danh-muc-san-pham/them',[CategoriesProductController::class, 'store'])->name('product.cat.store');
    Route::get('/danh-muc-san-pham/edit/{id}',[CategoriesProductController::class, 'edit'])->name('product.cat.edit');
    Route::put('/danh-muc-san-pham/edit/{id}',[CategoriesProductController::class, 'update'])->name('product.cat.update');
    Route::delete('/danh-muc-san-pham/xoa/{id}',[CategoriesProductController::class, 'destroy'])->name('product.cat.delete');
    //Iin tức
    Route::get('/tin-tuc',[NewsController::class, 'index'])->name('news.index');
    Route::get('/tin-tuc-them',[NewsController::class, 'create'])->name('news.create');
    Route::post('/tin-tuc-them',[NewsController::class, 'store'])->name('news.store');
    Route::post('/tin-tuc/hinh-anh-mo-ta',[NewsController::class, 'uploadCk'])->name('ckeditor.news.upload');
    Route::get('/tin-tuc-edit/{id}',[NewsController::class, 'edit'])->name('news.edit');
    Route::put('/tin-tuc-edit/{id}',[NewsController::class, 'update'])->name('news.update');
    Route::delete('/tin-tuc-xoa-tag/{id}/{tagId}',[NewsController::class, 'deleteTagRelaNews'])->name('news.remove');
    Route::delete('/tin-tuc-xoa/{id}',[NewsController::class, 'destroy'])->name('news.delete');
    //Tag tin tức
    Route::get('/tag-tin-tuc',[TagController::class, 'index'])->name('news.tag.index');
    Route::post('/tag-tin-tuc-them',[TagController::class, 'store'])->name('news.tag.store');
    Route::get('/tag-tin-tuc-edit/{id}',[TagController::class, 'edit'])->name('news.tag.edit');
    Route::put('/tag-tin-tuc-edit/{id}',[TagController::class, 'update'])->name('news.tag.update');
    Route::get('/tag-tin-tuc-xoa/{id}',[TagController::class, 'show'])->name('news.tag.show');
    Route::delete('/tag-tin-tuc-xoa/{id}',[TagController::class, 'destroy'])->name('news.tag.delete');
    //Danh mục tin tức
    Route::get('/danh-muc-tin-tuc',[CategoriesNewsController::class, 'index'])->name('news.cat.index');
    Route::post('/danh-muc-tin-tuc/them',[CategoriesNewsController::class, 'store'])->name('news.cat.store');
    Route::get('/danh-muc-tin-tuc/edit/{id}',[CategoriesNewsController::class, 'edit'])->name('news.cat.edit');
    Route::put('/danh-muc-tin-tuc/edit/{id}',[CategoriesNewsController::class, 'update'])->name('news.cat.update');
    Route::get('/danh-muc-tin-tuc/xoa/{id}',[CategoriesNewsController::class, 'show'])->name('news.cat.show');
    Route::delete('/danh-muc-tin-tuc/xoa/{id}',[CategoriesNewsController::class, 'destroy'])->name('news.cat.delete');

    // 
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
// Tới cửa hàng
Route::get('/https://vietbh.github.io/lazi-store',function(){
    return redirect('https://vietbh.github.io/lazi-store');
})->name('lazi.index');

require __DIR__.'/auth.php';