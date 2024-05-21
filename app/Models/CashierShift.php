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
        "starting_shift",
        "current_cash",
        "refund_cash",
        "sold_items",
        "status"
    ];

}
