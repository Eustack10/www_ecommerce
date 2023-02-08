<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\CategoriesController;
use App\Http\Controllers\admin\IndexController;
use App\Http\Controllers\admin\ProductsController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function(){
    Route::group(['middleware' => 'admin'], function(){
        Route::get('/', [IndexController::class, 'index'])->name('admin.index');
        Route::resource('/categories', CategoriesController::class, ['as'=>'admin']);
        Route::resource('/products', ProductsController::class, ['as'=>'admin']);
    });

    Route::view('/login', 'admin.auth.login')->name('admin.loginView');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});


Route::get('/', function(){
    echo "user side";
});

Route::group(['prefix'=>'test'], function(){
    Route::view('/storage', 'test.storage');
    Route::post('/storage', [TestController::class, 'storage'])->name('storage.upload');
});