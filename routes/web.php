<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\TransactionController;
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
Route::get('/topup',[TransactionController::class,'topUp'])->name('topup.index');
Route::post('/topup',[TransactionController::class,'topUpProceed'])->name('topup.proceed');
Route::post('topup/receipt',[TransactionController::class,'receipt'])->name('receipt');
Route::post('/logout',[IndexController::class,'logout'])->name('logout');
