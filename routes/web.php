<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\admin\IndexController;
use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\user\AuthController as UserAuthController;
use App\Http\Controllers\user\IndexController as UserIndexController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function(){
    Route::group(['middleware' => 'admin'], function(){
        Route::get('/', [IndexController::class, 'index'])->name('admin.index');
        Route::resource('/categories', CategoriesController::class, ['as'=>'admin']);
        Route::resource('/products', ProductsController::class, ['as'=>'admin']);
        Route::get('/products/images/{id}', [ProductsController::class, 'getProductsImages']);
    });

    Route::view('/login', 'admin.auth.login')->name('admin.loginView');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});


Route::get('/', [UserIndexController::class, 'index'])->name('index');

Route::get('/products/{id}', [UserIndexController::class, 'productDetail'])->name('productDetail');
Route::post('/add_to_cart', [UserIndexController::class, 'addToCart'])->name('addToCart');
// [Auth] User side account section
Route::view('/login','user.account.login')->name('loginView');
Route::post('/login', [UserAuthController::class, 'login'])->name('login');
Route::view('/register','user.account.register')->name('registerView');
Route::post('/register', [UserAuthController::class, 'register'])->name('register');
Route::get('/verify/{code}', [UserAuthController::class, 'verify'])->name('verify');


// [Auth] Forget password
Route::view('/auth/forget', 'user.account.forget')->name('forgetView');
Route::post('/auth/forget/check', [UserAuthController::class, 'checkUser'])->name('checkUser');
Route::get('/auth/reset_password/{code}', [UserAuthController::class, 'resetPassword'])->name('resetPassword');
Route::post('/auth/confirm_reset_password', [UserAuthController::class, 'confirmResetPassword'])->name('confirmResetPassword');


// [OAuth] Socialite Fallback URL
Route::get('/auth/{provider}', [UserAuthController::class, 'OAuthRedirect'])->name('oauth');
Route::get('/auth/{provider}/callback', [UserAuthController::class, 'OAuthFallback']);




Route::group(['prefix'=>'test'], function(){
    Route::view('/storage', 'test.storage');
    Route::post('/storage', [TestController::class, 'storage'])->name('storage.upload');

    Route::get('/mail', [TestController::class, 'mail']);
    Route::get('/session', [TestController::class, 'session']);
});