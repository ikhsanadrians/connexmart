<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\MartController;
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

Route::get('/',[IndexController::class,'index'])->name('home');
Route::post('/',[IndexController::class,'auth'])->name('auth');
Route::get('/profile',[IndexController::class,'profile'])->name('profile');
Route::get('/cart',[TransactionController::class,'index'])->name('cart.index');
Route::post('/cart',[TransactionController::class,'sentToCart'])->name('cart.proceed');
Route::put('/cart',[TransactionController::class,'payCart'])->name('cart.pay');
Route::get('/cart/receipt',[TransactionController::class,'cart_receipt'])->name('cart.receipt');
Route::get('/topup',[TransactionController::class,'topUp'])->name('topup.index');
Route::post('/topup',[TransactionController::class,'topUpProceed'])->name('topup.proceed');
Route::post('topup/receipt',[TransactionController::class,'receipt'])->name('receipt');
Route::post('/logout',[IndexController::class,'logout'])->name('logout');

Route::prefix('admin')->group(function () {

   Route::middleware('admin')->group(function(){
    Route::get('/',[AdminController::class,'index'])->name('admin.index');
    Route::get('/user',[AdminController::class,'userindex'])->name('user.index');
    Route::post('/user',[AdminController::class,'useradd'])->name('user.addpost');
    Route::put('/user',[AdminController::class,'userupdate'])->name('user.update');
    Route::delete('/user',[AdminController::class,'userdelete'])->name('user.delete');
    Route::get('/entrytransaction',[AdminController::class,'entrytransaction'])->name('entry.index');
    Route::get('/settings',[AdminController::class,'settings'])->name('setting.index');
    Route::get('/notifications',[AdminController::class,'notifications'])->name('notification.index');
   });

    Route::get('/logout',[AdminController::class,'adminlogout'])->name('admin.logout');
    Route::get('/login',[AdminController::class,'auth'])->name('admin.auth');
    Route::post('/login',[AdminController::class,'auth_proceed'])->name('admin.auth.proceed');

});

Route::prefix('bank')->group(function () {

    Route::middleware('bank')->group(function(){
        Route::get('/',[BankController::class,'index'])->name('bank.index');
        Route::get('/topup',[BankController::class,'topup'])->name('bank.topup');
        Route::put('/topup',[BankController::class,'topupconfirm'])->name('bank.topupconfirm');
        Route::patch('/topup',[BankController::class,'topupreject'])->name('bank.topupreject');
        Route::get('/client',[BankController::class,'clientindex'])->name('bank.client');
    });

    Route::get('/login',[BankController::class,'auth'])->name('bank.auth');
    Route::post('/login',[BankController::class,'auth_proceed'])->name('bank.auth.proceed');
    Route::get('/logout',[BankController::class,'banklogout'])->name('bank.logout');
});


Route::prefix('mart')->group(function () {

    Route::middleware('mart')->group(function(){
        Route::get('/',[MartController::class,'index'])->name('mart.index');
        Route::get('/goodscategory',[MartController::class,'goodscategory'])->name('mart.goods.category');
        Route::get('/goods',[MartController::class,'goodsindex'])->name('mart.goods');
        Route::post('/goods',[MartController::class,'goodpost'])->name('mart.addgoods');
        Route::get('/entrytransaction',[MartController::class,'entrytransaction'])->name('mart.entrytransaction');

    });

    Route::get('/login',[MartController::class,'auth'])->name('mart.auth');
    Route::post('/login',[MartController::class,'auth_proceed'])->name('mart.auth.proceed');
    Route::get('/logout',[MartController::class,'martlogout'])->name('mart.logout');
});
