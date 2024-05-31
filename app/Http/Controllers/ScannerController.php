<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCheckout;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\Wallet;


class ScannerController extends Controller
{
    public function scanner(){
        return view("scanner");
}

public function scannerSend(Request $request){
    if($request->ajax()){
         $transaction = UserCheckout::where("checkout_code", $request->checkout_code)->first();

       return response()->json([
           "message" => "Success, get transactions",
           "data" => $transaction
        ]);
   }
}

public function scannerConfirm(Request $request){
    if($request->ajax()){
        $checkout = UserCheckout::where("checkout_code", $request->checkout_code)->first();
        $user_wallet = Wallet::where("user_id", Auth::user()->id)->first();
        $total_price = $checkout->total_price;

        $checkTransactions = Transaction::whereIn('id', $checkout->product_list)->get();

        $checkTotalPrice = $checkTransactions->sum("price");
        $checkTotalQty = $checkTransactions->sum("quantity");

        if($checkTotalPrice != $request->total_price || $checkTotalQty != $request->total_quantity){
            return response()->json([
                  "message" => "Total harga atau Jumlah tidak Valid!"
            ], 422);
        }

        if($user_wallet->credit < $total_price){
            return response()->json([
                "message" => "Maaf, Saldo anda tidak mencukupi untuk melakukan transaksi ini",
            ],401);
        }

        $updatedCheckout = $checkout->update([
            "status" => "ordered",
            "payment_method" => "tb-2"
        ]);



        $transaction_list = json_decode($checkout->product_list);
        $transactions = Transaction::whereIn("id", $transaction_list)->where("user_id", Auth::user()->id)->get();

        foreach($transactions as $transaction){
            $transaction->update([
                "status" => "taken",
                "order_id" => $checkout->checkout_code
            ]);
        }

        foreach($transactions as $transaction){
            $relatedProduct = $transaction->product;
            $newStockUpdate = $relatedProduct->stock -= $transaction->quantity;
            $newSoldQuantity = $relatedProduct->quantity_sold += $transaction->quantity;

            $relatedProduct->update([
                "stock" =>  $newStockUpdate,
                "quantity_sold" => $newSoldQuantity,
            ]);
        }

        $updatedBalanceCredit = ($user_wallet->credit -= $total_price);
        $updatedBalanceDebit =  ($user_wallet->debit += $total_price);


        $user_wallet->update([
            "credit" => $updatedBalanceCredit,
            "debit" => $updatedBalanceDebit
        ]);

        return response()->json([
            "message" => "Success, confirm transactions",
            "data" => $updatedCheckout
        ]);
    }
}
}
