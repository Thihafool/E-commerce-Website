<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\User\AjaxController;
use Illuminate\Support\Facades\Route;

Route::middleware(['admin_auth'])->group(function () {
    Route::redirect('/', 'loginPage');
    Route::get('loginPage', [AuthController::class, 'loginPage'])->name('auth#loginPage');
    Route::get('registerPage', [AuthController::class, 'registerPage'])->name('auth#registerPage');

});

Route::middleware(['auth'])->group(function () {

    //dashboard
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

    // Route::group(['middleware'=>'admin_auth'],function(){});
    //admin
    Route::middleware(['admin_auth'])->group(function () {

        //category
        Route::prefix('category')->group(function () {
            Route::get('list', [CategoryController::class, 'categoryList'])->name('category#List');
            Route::get('create/page', [CategoryController::class, 'createPage'])->name('category#createPage');
            Route::post('create', [CategoryController::class, 'create'])->name('category#create');
            Route::get('delete/{id}', [CategoryController::class, 'delete'])->name('category#delete');
            Route::get('edit/{id}', [CategoryController::class, 'editPage'])->name('category#edit');
            Route::post('update', [CategoryController::class, 'update'])->name('category#update');
        });

        //admin account
        Route::prefix('admin')->group(function () {

            //password
            Route::get('password/changePage', [AdminController::class, 'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('change/password', [AdminController::class, 'changePassword'])->name('admin#changePassword');

            //profile
            Route::get('details', [AdminController::class, 'details'])->name('admin#details');
            Route::get('edit', [AdminController::class, 'editPage'])->name('admin#edit');
            Route::post('update', [AdminController::class, 'update'])->name('admin#update');
            Route::get('list', [AdminController::class, 'listPage'])->name('admin#list');
            Route::get('change/role', [AjaxController::class, 'changeRole'])->name('admin#changeRole');

        });
        //product
        Route::prefix('product')->group(function () {

            Route::get('create', [ProductController::class, 'createPage'])->name('product#createPage');
            Route::post('create', [ProductController::class, 'create'])->name('product#create');
            Route::get('list', [ProductController::class, 'list'])->name('product#list');
            Route::get('delete/{id}', [ProductController::class, 'delete'])->name('product#delete');
            Route::get('edit/{id}', [ProductController::class, 'edit'])->name('product#edit');
            Route::post('update', [ProductController::class, 'update'])->name('product#update');

        });
        //orderList
        Route::prefix('order')->group(function () {
            Route::get('list', [OrderController::class, 'orderList'])->name('user#orderList');
            Route::get('ajax/change/status', [OrderController::class, 'changeStatus'])->name('user#changeStatus');
            Route::get('change/status', [OrderController::class, 'status'])->name('admin#changeStatus');
            Route::get('order/details/{orderCode}', [OrderController::class, 'orderDetail'])->name('admin#orderDetails');

        });
        Route::prefix('user')->group(function () {
            Route::get('list', [UserController::class, 'listPage'])->name('user#list');
            Route::get('change/role', [AjaxController::class, 'userRole']);
        });

    });

    Route::group(['prefix' => 'user', 'middleware' => 'user_auth'], function () {
        Route::get('homePage', [UserController::class, 'home'])->name('user#homePage');

        Route::prefix('profile')->group(function () {
            Route::get('info', [UserController::class, 'info'])->name('user#profile');
            Route::post('update', [UserController::class, 'updateInfo'])->name('user#updateInfo');
            Route::post('changePassword', [UserController::class, 'changePassword'])->name('user#changePassword');
        });

        Route::prefix('product')->group(function () {
            Route::get('addCart', [CartController::class, 'cartPage'])->name('user#cartPage');
            Route::get('history', [CartController::class, 'history'])->name('user#history');
            Route::get('details/{id}', [CartController::class, 'details'])->name('user#productDetails');
        });

        Route::prefix('ajax')->group(function () {
            Route::get('addToCart', [AjaxController::class, 'addToCart'])->name('ajax#cart');
            Route::get('order', [AjaxController::class, 'order'])->name('ajax#order');
            Route::get('clear/cart', [AjaxController::class, 'clearCart'])->name('ajax#clearCart');
            Route::get('clear/current/item', [AjaxController::class, 'clearCurrent'])->name('ajax#clearCurrentItem');
            Route::get('increase/view/count', [AjaxController::class, 'increaseviewCount'])->name('ajax#increaseViewCoutn');
        });
    });

});

Route::get('webTesting', function () {
    $data =
        ['message' => 'this is web testing message',
    ];
    return response()->json($data, 200);
});