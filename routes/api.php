<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\CategoryProController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\EmailVerificationPromptController as ApiEmailVerificationPromptController;
use App\Http\Controllers\Api\PaymentController;
use App\Http\Controllers\Api\ProductController;

use App\Http\Controllers\Api\VerifyEmailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::middleware('auth:sanctum')->group(function(){
// });
Route::get('/san-pham/{slug}',[ProductController::class,'show']);
Route::get('/san-pham-moi',[ProductController::class,'new']);
Route::get('/san-pham-hot',[ProductController::class,'hot']);
Route::get('/san-pham-tablet',[ProductController::class,'tablet']);
Route::get('/san-pham-laptop',[ProductController::class,'laptop']);
Route::get('/san-pham-pc',[ProductController::class,'pc']);
Route::get('/san-pham-dong-ho',[ProductController::class,'watch']);
Route::get('/san-pham-am-thanh',[ProductController::class,'audio']);
Route::get('/slide-ads',[ProductController::class,'banner']);
// Danh muc
Route::get('/danh-muc-san-pham',[CategoryProController::class,'index']);
Route::get('/danh-muc-san-pham/{slug}',[CategoryProController::class,'show']);

Route::post('/chinh-sach',[ContactController::class,'store']);
Route::post('/lien-he',[ContactController::class,'store']);

//Auth 
Route::post('/login', [AuthController::class, 'login']);
Route::post('/dang-ky', [AuthController::class, 'store']);

Route::get('/quen-mat-khau', [AuthController::class, 'forgotPasswordCreate']);
Route::post('/quen-mat-khau', [AuthController::class, 'forgotPasswordStore']);
Route::get('/dat-lai-mat-khau/{token}', [AuthController::class, 'resetPasswordCreate']);
Route::post('/dat-lai-mat-khau', [AuthController::class, 'resetPasswordStore']);
// // Gio hang

Route::get('/gio-hang/{id}',[CartController::class,'index']);
Route::post('/gio-hang/them-san-pham',[CartController::class,'store']);
Route::post('/gio-hang/cap-nhat-san-pham',[CartController::class,'update']);
Route::post('/gio-hang/xoa-san-pham',[CartController::class,'destroy']);
// Thanh toan
// Route::post('/don-hang',[PaymentController::class,'store']);
Route::post('/thanh-toan',[PaymentController::class,'store']);

Route::group(['prefix' => 'api'], function () {


    Route::get('verify-email', ApiEmailVerificationPromptController::class);

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('verification.verify');

    // Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
    //             ->middleware('throttle:6,1')
    //             ->name('verification.send');

    // Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
    //             ->name('password.confirm');

    // Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    // Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    // Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
    //             ->name('logout');
});