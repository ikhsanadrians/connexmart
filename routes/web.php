<?php

use App\Http\Controllers\IndexController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\MartController;
use App\Http\Controllers\ScannerController;
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




Route::get('/login',[IndexController::class, 'login'])->name('login');
Route::post('/login',[IndexController::class, 'auth'])->name('auth');



Route::middleware('user')->group(function(){
    Route::get('/', [IndexController::class, 'index'])->name('home');
    Route::get('/product/{slug}',[IndexController::class,'showproduct'])->name('show.product');
    Route::get('/profile', [IndexController::class, 'profile'])->name('profile');
    Route::get('/transaction', [IndexController::class, 'transaction'])->name('transaction');
    Route::get('/wishlist', [IndexController::class, 'wishlist'])->name('wishlist');
    Route::get('/scan',[ScannerController::class, 'scanner'])->name('scanner');
    Route::post('/scan/send',[ScannerController::class,'scannerSend'])->name('scanner.send');
    Route::put('/scan/confirm',[ScannerController::class,'scannerConfirm'])->name('scanner.confirm');

    Route::prefix('cart')->group(function () {
        Route::get('/', [TransactionController::class, 'index'])->name('cart.index');
        Route::post('/', [TransactionController::class, 'sentToCart'])->name('cart.proceed');
        Route::delete('/',[TransactionController::class,'cart_delete'])->name('cart.product.delete');
        Route::put("/addwishlist",[TransactionController::class, 'addWishlist'])->name("add.wishlist");
        Route::put('/quantityupdate', [TransactionController::class, 'updateQuantity'])->name('cart.quantity.update');
        Route::get("/checkout/{checkout_code}", [TransactionController::class,'checkout'])->name("checkout");
        Route::put("/checkout/getpaymentmethod", [TransactionController::class, "getUserLatestPaymentMethod"])->name("checkout.paymentmethod");
        Route::put("/checkout", [TransactionController::class, "handleCheckout"])->name("checkout.handle");
        Route::put("/checkout/updateaddress", [TransactionController::class,"addAdressUser"])->name("checkout.update.address");
        Route::put("/checkout/updatepaymentmethod", [TransactionController::class, "addPaymentMethod"])->name("checkout.update.paymentmethod");
        Route::put("/checkout/pay", [TransactionController::class, "checkoutEntry"])->name("checkout.pay");
        Route::get("/checkout/{checkout_code}/success", [TransactionController::class, "checkoutSuccess"])->name("checkout.success");

    });

});



Route::prefix('topup')->group(function () {
    Route::get('/', [TransactionController::class, 'topUp'])->name('topup.index');
    Route::post('/', [TransactionController::class, 'topUpProceed'])->name('topup.proceed');
    Route::post('/receipt', [TransactionController::class, 'receipt'])->name('receipt');
});

Route::post('/logout', [IndexController::class, 'logout'])->name('logout');

Route::prefix('admin')->group(function () {

    Route::middleware('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/user', [AdminController::class, 'userindex'])->name('user.index');
        Route::post('/user', [AdminController::class, 'useradd'])->name('user.addpost');
        Route::put('/user', [AdminController::class, 'userupdate'])->name('user.update');
        Route::delete('/user', [AdminController::class, 'userdelete'])->name('user.delete');
        Route::get('/entrytransaction', [AdminController::class, 'entrytransaction'])->name('entry.index');
        Route::get('/settings', [AdminController::class, 'settings'])->name('setting.index');
        Route::get('/notifications', [AdminController::class, 'notifications'])->name('notification.index');
        Route::get('/logout', [AdminController::class, 'adminlogout'])->name('admin.logout');

    });

    Route::middleware('loggedin')->group(function() {
        Route::get('/login', [AdminController::class, 'auth'])->name('admin.auth');
        Route::post('/login', [AdminController::class, 'auth_proceed'])->name('admin.auth.proceed');
    });
});

Route::prefix('bank')->group(function () {

    Route::middleware('bank')->group(function () {
        Route::get('/', [BankController::class, 'index'])->name('bank.index');
        Route::get('/topup', [BankController::class, 'topup'])->name('bank.topup');
        Route::put('/topup', [BankController::class, 'topupconfirm'])->name('bank.topupconfirm');
        Route::patch('/topup', [BankController::class, 'topupreject'])->name('bank.topupreject');
        Route::get('/client', [BankController::class, 'clientindex'])->name('bank.client');
        Route::get('/transaction', [BankController::class, 'transaction'])->name('bank.transaction');
        Route::get('/logout', [BankController::class, 'banklogout'])->name('bank.logout');
    });

    Route::middleware('loggedin')->group(function() {
        Route::get('/login', [BankController::class, 'auth'])->name('bank.auth');
        Route::post('/login', [BankController::class, 'auth_proceed'])->name('bank.auth.proceed');
    });
});


Route::prefix('mart')->group(function () {

    Route::middleware('mart')->group(function () {
        Route::get('/', [MartController::class, 'index'])->name('mart.index');
        Route::get('/goodscategory', [MartController::class, 'addcategory'])->name('mart.goods.category');
        Route::post('/addgoodscategory',[MartController::class, 'addcategorypost'])->name("mart.goods.category.post");
        Route::delete('/goodscategory', [MartController::class, 'deletegoodscategory'])->name("mart.goods.category.delete");
        Route::put('/goodscategory',[MartController::class, 'updategoodscategory'])->name("mart.goods.category.update");
        Route::get('/goods', [MartController::class, 'goodsindex'])->name('mart.goods');
        Route::post('/goods', [MartController::class, 'goodpost'])->name('mart.addgoods');
        Route::put('/goods/update', [MartController::class, 'goodsupdate'])->name('mart.updategoods');
        Route::delete('/goods', [MartController::class, 'goodsdelete'])->name('mart.deletegoods');
        Route::get('/transactions', [MartController::class, 'transactions'])->name('mart.transactions');
        Route::get('/transaction/{checkout_code}',[MartController::class,'transaction_detail'])->name('mart.transaction.detail');
        Route::post('/transaction/search',[MartController::class,'transactions_search'])->name("mart.transactions.search");
        Route::prefix("/cashier")->group(function(){
            Route::get('/',[MartController::class,'cashier'])->name("mart.cashier");
            Route::post('/addorder',[MartController::class, 'cashierAddToOrderList'])->name("mart.cashier.addorder");
            Route::put('/quantityupdate', [MartController::class, 'cashierQuantityUpdate'])->name("mart.cashier.quantityupdate");
            Route::post('/search',[MartController::class,'search'])->name("mart.cashier.search");
            Route::post('/clearorder',[MartController::class,'clearorder'])->name("mart.cashier.clearorder");
            Route::post('/proceed',[MartController::class,'cashierProceed'])->name("mart.cashier.proceed");
            Route::get('/stream/{checkout_code}', [MartController::class, 'streamResponseCheckout'])->name('mart.stream.checkout');
            Route::get('/{checkout_code}/success',[MartController::class, 'cashierSuccessDetail'])->name('mart.cashier.proceedSuccess');
        });
        Route::get('/logout', [MartController::class, 'martlogout'])->name('mart.logout');
    });

    Route::middleware('loggedin')->group(function() {
        Route::get('/login', [MartController::class, 'auth'])->name('mart.auth');
        Route::post('/login', [MartController::class, 'auth_proceed'])->name('mart.auth.proceed');
    });

});