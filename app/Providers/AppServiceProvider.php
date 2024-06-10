<?php

namespace App\Providers;

use App\Models\CashierShift;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer(['components.headeradmin', 'components.header', 'components.mobilebottomnav'], function($view){
            $view
               ->with('cashier_shifts', CashierShift::where("status","current")->first())
               ->with('cart_quantity',  Transaction::where("status", "outcart")
                                                           ->where("user_id", Auth::id())
                                                           ->sum("quantity"));
            });
    }
}
