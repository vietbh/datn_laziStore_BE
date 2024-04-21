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
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Http\Controllers\UserGuestController;
use App\Models\Role;
use App\Providers\RouteServiceProvider;
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
    // dd('role:'.Role::whereNot('role_name','guest')->pluck('role_name')->join(','));
    return view('layouts.abort.401');
})->middleware(['auth'])->name('401');

Route::middleware(['auth','role:'.Role::whereNot('role_name','guest')->pluck('role_name')->join('::')])->prefix(RouteServiceProvider::HOME)->group(function () {
    // Dashboard
    Route::get('/',[DashBoardController::class, 'index'])->name('home');
    // Thống kê
    Route::get('/thong-ke',[ChartController::class, 'index'])->name('chart.index');
    // Khách hàng
    Route::prefix('khach-hang')->group(function(){
        Route::get('/',[UserGuestController::class, 'index'])->name('guest.index');
        Route::get('/detail/{id}',[UserGuestController::class, 'edit'])->name('guest.edit');
    })->name('guest');
    // Đơn hàng
    Route::prefix('don-hang')->group(function(){
        Route::get('/',[PaymentController::class, 'index'])->name('payment.index');
        Route::get('/detail/{id}',[PaymentController::class, 'edit'])->name('payment.edit');
    });    
    // Mã giảm giá
    Route::prefix('ma-giam-gia')->group(function(){
        Route::get('/',[DiscountController::class, 'index'])->name('discount.index');
        Route::post('/them',[DiscountController::class, 'store'])->name('discount.store');
        Route::get('/edit/{id}',[DiscountController::class, 'edit'])->name('discount.edit');
        Route::put('/edit/{id}',[DiscountController::class, 'update'])->name('discount.update');
        Route::delete('/xoa/{id}',[DiscountController::class, 'destroy'])->name('discount.delete');
    });
    // Sản phẩm hot
    Route::get('/san-pham-hot',[ProductHotController::class, 'index'])->name('hot.index');
    //Đơn hàng Vận chuyển
    Route::get('/van-chuyen',[DeliveryController::class, 'index'])->name('delivery.index');
    //Nhà Vận chuyển
    Route::prefix('nha-van-chuyen')->group(function(){
        Route::get('/',[ShippingProvidersController::class, 'index'])->name('shipping.index');
        Route::post('/them',[ShippingProvidersController::class, 'store'])->name('shipping.store');
        Route::get('/edit/{id}',[ShippingProvidersController::class, 'edit'])->name('shipping.edit');
        Route::put('/edit/{id}',[ShippingProvidersController::class, 'update'])->name('shipping.update');
        Route::delete('/xoa/{id}',[ShippingProvidersController::class, 'destroy'])->name('shipping.delete');
    });
    
    // Bình luận sản phẩm
    Route::prefix('nha-van-chuyen')->group(function(){
        Route::get('/binh-luan-san-pham',[CommentProductController::class, 'index'])->name('comment.product.index');
        Route::put('/binh-luan-san-pham/edit/{id}',[CommentProductController::class, 'update'])->name('comment.product.update');
    });
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
    Route::prefix('slide-quang-cao')->group(function(){
        Route::get('/',[SlideAdsController::class, 'index'])->name('slide.index');
        Route::post('/them',[SlideAdsController::class, 'store'])->name('slide.store');
        Route::get('/edit/{id}',[SlideAdsController::class, 'edit'])->name('slide.edit');
        Route::put('/edit/{id}',[SlideAdsController::class, 'update'])->name('slide.update');
        Route::delete('/xoa/{id}',[SlideAdsController::class, 'destroy'])->name('slide.delete');
    });
    
    //Sản phẩm
    Route::prefix('san-pham')->group(function(){
        Route::get('/',[ProductController::class, 'index'])->name('product.index');
        Route::get('/bo-loc',[ProductController::class, 'filter'])->name('product.filter');
        Route::get('/them',[ProductController::class, 'create'])->name('product.create');
        Route::post('/them',[ProductController::class, 'store'])->name('product.store');
        Route::post('/hinh-anh-mo-ta',[ProductController::class, 'uploadCk'])->name('ckeditor.product.upload');
        Route::get('/edit/{id}',[ProductController::class, 'edit'])->name('product.edit');
        Route::put('/edit/{id}',[ProductController::class, 'update'])->name('product.update');
        Route::delete('/xoa/{id}',[ProductController::class, 'destroy'])->name('product.delete');
        // Varia
        Route::prefix('variation')->group(function(){
            Route::get('/them/{id}',[ProductVariationController::class, 'create'])->name('varia.create');
            Route::post('/them-variation',[ProductVariationController::class, 'store'])->name('varia.store');
            Route::get('/edit-variation/{id}',[ProductVariationController::class, 'edit'])->name('varia.edit');
            Route::put('/edit-variation/{id}',[ProductVariationController::class, 'update'])->name('varia.update');
            Route::delete('/delete-variation/{id}',[ProductVariationController::class, 'destroy'])->name('varia.delete');

        });
        // Speci product
        Route::prefix('speci-product')->group(function(){
            Route::get('/them/{id}',[ProductSpecificationController::class, 'create'])->name('specifi.create');
            Route::post('/them',[ProductSpecificationController::class, 'store'])->name('specifi.store');
            Route::get('/edit/{id}',[ProductSpecificationController::class, 'edit'])->name('specifi.edit');
            Route::put('/edit/{id}',[ProductSpecificationController::class, 'update'])->name('specifi.update');
            Route::delete('/delete/{id}',[ProductSpecificationController::class, 'destroy'])->name('specifi.delete');
            // Speci 
            Route::post('/them-speci',[SpecificationController::class, 'store'])->name('speci.store');
            Route::get('/edit-speci/{productId}/{id}',[SpecificationController::class, 'edit'])->name('speci.edit');
            Route::put('/edit-speci/{id}',[SpecificationController::class, 'update'])->name('speci.update');
            Route::delete('/delete-speci/{id}',[SpecificationController::class, 'destroy'])->name('speci.delete');
        });
        
    });
   
    
    // Thương hiệu
    Route::prefix('thuong-hieu')->group(function(){
        Route::get('/',[BrandController::class, 'index'])->name('brand.index');
        Route::post('/them',[BrandController::class, 'store'])->name('brand.store');
        Route::get('/edit/{id}',[BrandController::class, 'edit'])->name('brand.edit');
        Route::put('/edit/{id}',[BrandController::class, 'update'])->name('brand.update');
        Route::delete('/xoa/{id}',[BrandController::class, 'destroy'])->name('brand.delete');

    });
    // Danh mục sản phẩm
    Route::prefix('danh-muc-san-pham')->group(function(){
        Route::get('/',[CategoriesProductController::class, 'index'])->name('product.cat.index');
        Route::post('/them',[CategoriesProductController::class, 'store'])->name('product.cat.store');
        Route::get('/edit/{id}',[CategoriesProductController::class, 'edit'])->name('product.cat.edit');
        Route::put('/edit/{id}',[CategoriesProductController::class, 'update'])->name('product.cat.update');
        Route::delete('/xoa/{id}',[CategoriesProductController::class, 'destroy'])->name('product.cat.delete');
    });
    
    //Iin tức
    Route::prefix('tin-tuc')->group(function(){
        Route::get('/',[NewsController::class, 'index'])->name('news.index');
        Route::get('/bo-loc',[NewsController::class, 'filter'])->name('news.filter');
        Route::get('/them',[NewsController::class, 'create'])->name('news.create');
        Route::post('/them',[NewsController::class, 'store'])->name('news.store');
        Route::post('/hinh-anh-mo-ta',[NewsController::class, 'uploadCk'])->name('ckeditor.news.upload');
        Route::get('/edit/{id}',[NewsController::class, 'edit'])->name('news.edit');
        Route::put('/edit/{id}',[NewsController::class, 'update'])->name('news.update');
        Route::delete('/xoa-tag/{id}/{tagId}',[NewsController::class, 'deleteTagRelaNews'])->name('news.remove');
        Route::delete('/xoa/{id}',[NewsController::class, 'destroy'])->name('news.delete');

    });
    //Tag tin tức
    Route::prefix('tag-tin-tuc')->group(function(){
        Route::get('/',[TagController::class, 'index'])->name('news.tag.index');
        Route::post('/them',[TagController::class, 'store'])->name('news.tag.store');
        Route::get('/edit/{id}',[TagController::class, 'edit'])->name('news.tag.edit');
        Route::put('/edit/{id}',[TagController::class, 'update'])->name('news.tag.update');
        Route::get('/xoa/{id}',[TagController::class, 'show'])->name('news.tag.show');
        Route::delete('/xoa/{id}',[TagController::class, 'destroy'])->name('news.tag.delete');

    });
    //Danh mục tin tức
    Route::prefix('danh-muc-tin-tuc')->group(function(){
        Route::get('/',[CategoriesNewsController::class, 'index'])->name('news.cat.index');
        Route::post('/them',[CategoriesNewsController::class, 'store'])->name('news.cat.store');
        Route::get('/edit/{id}',[CategoriesNewsController::class, 'edit'])->name('news.cat.edit');
        Route::put('/edit/{id}',[CategoriesNewsController::class, 'update'])->name('news.cat.update');
        Route::get('/xoa/{id}',[CategoriesNewsController::class, 'show'])->name('news.cat.show');
        Route::delete('/xoa/{id}',[CategoriesNewsController::class, 'destroy'])->name('news.cat.delete');

    });

    // Admin Login
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Vai trò quản trị
    Route::prefix('quan-tri')->group(function(){
        Route::get('/',[RoleAdminController::class, 'index'])->name('role.index');
        Route::get('/create',[RoleAdminController::class, 'create'])->name('role.create');
        Route::post('/create',[RoleAdminController::class, 'store'])->name('role.store');
        Route::get('/edit/{id}',[RoleAdminController::class, 'edit'])->name('role.edit');
        Route::patch('/edit/{id}',[RoleAdminController::class, 'update'])->name('role.update');
        Route::delete('/',[RoleAdminController::class, 'destroy'])->name('role.delete');
        // Manager
        Route::get('/manager-create',[RoleAdminController::class, 'createManager'])->name('admin.create');
        Route::post('/manager-create',[RoleAdminController::class, 'storeManager'])->name('admin.store');
        Route::get('/manager-edit/{id}',[RoleAdminController::class, 'editManager'])->name('admin.edit');
        Route::patch('/manager-edit',[RoleAdminController::class, 'updateManager'])->name('admin.update');
    });


    // User
    Route::get('/profile-guest', [UserProfileController::class, 'edit'])->name('profileGuest.edit');
    Route::put('/profile-guest', [UserProfileController::class, 'update'])->name('profileGuest.update');
});

// Tới cửa hàng
Route::get('/https://vietbh.github.io/lazi-store',function(){
    return redirect('https://vietbh.github.io/lazi-store');
})->name('lazi.index');

require __DIR__.'/auth.php';
