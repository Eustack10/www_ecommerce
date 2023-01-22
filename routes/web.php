<?php

use App\Http\Controllers\admin\AuthController;
use App\Http\Controllers\admin\IndexController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin'], function(){
    Route::group(['middleware' => 'admin'], function(){
        Route::get('/', [IndexController::class, 'index'])->name('admin.index');
        //
    });

    Route::view('/login', 'admin.auth.login')->name('admin.loginView');
    Route::post('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
});


// categories =>

// collection

// // Items
// id   name
// 1     earphone
// 2     powerbank
// // Variants
// id items_id   variant_name
// 1     1         color
// 2     1         length

// id   vairnats_id  value  price
// 1         1        red      1000
// 2         1        blue      3000

// 3         2       red      1000
// 4         2        blue      3000

