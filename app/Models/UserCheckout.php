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
        "total_price"
    ];

}