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
Route::get('/cart',[TransactionController::class,'index'])->name('cart.index');
Route::post('/cart',[TransactionController::class,'sentToCart'])->name('cart.proceed');
Route::post('/logout',[IndexController::class,'logout'])->name('logout');
