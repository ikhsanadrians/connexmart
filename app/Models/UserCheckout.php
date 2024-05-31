<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class UserCheckout extends Model
{
    use HasFactory;

    protected $fillable = [
        "checkout_code",
        "user_id",
        "product_list",
        "total_quantity",
        "total_price",
        "status",
        "payment_method",
        "cash_total",
        "refund_cash",
        "address_order",
        "cashier_shifts_id",
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function cashierShift(){
        return $this->belongsTo(CashierShift::class);
    }

}