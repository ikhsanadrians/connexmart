<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CashierShift extends Model
{
    use HasFactory;

    protected $fillable = [
        "cashier_name",
        "starting_cash",
        "starting_cash_added",
        "starting_shift",
        "end_shift",
        "current_cash",
        "refund_cash",
        "sold_items",
        "status"
    ];


    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function userCheckouts(){
        return $this->hasMany(UserCheckout::class);
    }

}
