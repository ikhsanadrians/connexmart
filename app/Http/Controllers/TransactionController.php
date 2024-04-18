<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Wallet;
use App\Models\TopUp;
use App\Models\User;
use Illuminate\Support\Str;
use App\Models\UserCheckout;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TransactionController extends Controller
{
    public function index()
    {
        $product_count = 0;
        $total_prices = 0;
        $carts = Transaction::with('product')->where('user_id', Auth::user()->id)->where('status', 'outcart')->orderBy('created_at', 'desc')->get();

        foreach ($carts as $product_cart) {
            $product_count += $product_cart->quantity;
        }

        foreach ($carts as $product_cart) {
            $total_prices += $product_cart->price;
        }

        return view('cart', compact('carts', 'product_count', 'total_prices'));
    }


    public function sentToCart(Request $request)
    {

        if ($request->ajax()) {
            $product = Product::find($request->product_id);
            $productPrice = $product->price;
            $productSummaryPrice = ($productPrice * $request->quantity);

            $sameTransaction = Transaction::where('product_id', $request->product_id)
                ->where('user_id', Auth::user()->id)
                ->where('status', 'outcart')
                ->first();

            if($product->stock < $request->quantity){
                return response()->json([
                    "message" => "failed, product stock is not enough"
                ], 401);
            } else {
                if ($sameTransaction) {
                    $sumQuantity = $sameTransaction->quantity += $request->quantity;
                    $sumPrice = $sumQuantity * $product->price;
                    $sameTransaction->update([
                        'quantity' => $sumQuantity,
                        'price' => $sumPrice
                    ]);
                } else {
                    Transaction::create([
                        "user_id" => Auth::user()->id,
                        "product_id" => $product->id,
                        "status" => "outcart",
                        "order_id" => "INV-" . Auth::user()->id . now()->format('dmYHis'),
                        "quantity" => $request->quantity,
                        "price" => $productSummaryPrice
                    ]);
                }

                return response()->json([
                    "message" => "success",
                    "data" => $product
                ]);
            }

        }
    }

    public function cart_delete(Request $request)
    {
        if ($request->ajax()) {
            $TransactionToDelete = Transaction::find($request->product_id);

            $delete = $TransactionToDelete->delete();

            return response()->json([
                "message" => "success delete transaction",
            ]);
        }
    }

    public function updateQuantity(Request $request)
    {

        if ($request->ajax()) {

            $quantityToUpdate = Transaction::where('id', $request->transaction_id)->where('user_id', Auth::user()->id)->first();

            if($request->quantity >= $quantityToUpdate->product->stock){
                return response()->json([
                    "message" => "error, stock outdated!",
                ],401);
            }

            $quantityToUpdate->update([
                'quantity' => $request->quantity
            ]);

            return response()->json([
                "message" => "success, update quantity",
                "data" => $quantityToUpdate
            ]);
        }

    }


    public function topUp()
    {
        return view('topup');
    }

    public function topUpProceed(Request $request)
    {
        if ($request->ajax()) {
            $data = TopUp::create([
                "user_id" => Auth::user()->id,
                "nominals" => $request->nominals,
                "status" => "unconfirmed",
                "unique_code" => "TU-" . Auth::user()->id . now()->format('dmYHis')
            ]);

            $data->user = User::find(Auth::user()->id);

            return response()->json([
                "message" => "Success! Add Top Up",
                "data" => $data
            ]);
        }
    }



    public function checkout(string $checkout_code){

        $checkouts = UserCheckout::where("checkout_code", $checkout_code)->first();
        if(!$checkouts || $checkouts->status == "ordered") return view("errors.404");
        $product_list = json_decode($checkouts->product_list);
        $transactions = Transaction::whereIn("id", $product_list)->where("user_id", Auth::user()->id)->get();

        foreach($transactions as $transaction){
            $transaction->totalPricePerTransaction = ($transaction->price * $transaction->quantity);
        }


        return view("checkout", compact("transactions", "checkouts"));
    }


    public function handleCheckout(Request $request){
        if($request->ajax()){

            $checkout_code = now()->format('dmYHis') . Auth::user()->id . substr(uniqid(), 0, 3);
            $data = UserCheckout::create([
                "checkout_code" => $checkout_code,
                "user_id" => Auth::user()->id,
                "product_list" => json_encode($request->product_list),
                "total_quantity" => $request->total_quantity,
                "total_price" => $request->total_price,
                "status" => "pending"
            ]);

            return response()->json([
                "message" => "success, checkout user",
                "checkout_code" => $data->checkout_code
            ]);
        }
    }

    public function addAdressUser(Request $request){
        if($request->ajax()){
           $user = User::where("id", Auth::user()->id)->first();
           $updated_user = $user->update([
              "recipient_name" => $request->recipient,
              "phone_number" => $request->recipient_phonenumber,
              "address" => $request->address
           ]);

           return response()->json([
               "message" => "success, update address user",
           ]);

        }
    }

    public function addPaymentMethod(Request $request){
        if($request->ajax()){
            $user = User::where("id", Auth::user()->id)->first();
            $updated_user = $user->update([
                "latest_paymentmethod" => $request->paymentMethod
            ]);

            return response()->json([
               "message" => "success. update payment",
               "user" => $updated_user,
            ]);
        }
    }

    public function checkoutEntry(Request $request){
        if($request->ajax()){
            $latest_payment_method = Auth::user()->latest_paymentmethod;
            $address = Auth::user()->address;

             if($request->payment_method == "tb-1" || $request->payment_method == "tb-2"){
                $user_wallet = Auth::user()->wallet;
                $user_checkout = UserCheckout::where("checkout_code", $request->checkout_code)->where("user_id", Auth::user()->id)->first();
                $total_price = $user_checkout->total_price;

                if($user_wallet < $total_price){
                   return response()->json([
                       "message" => "failed, wallet not enough"
                   ],401);
                }

                $transaction_list = json_decode($user_checkout->product_list);
                $transactions = Transaction::whereIn("id", $transaction_list)->where("user_id", Auth::user()->id)->get();

                foreach($transactions as $transaction){
                    $transaction->update([
                         "status" => "checkedout"
                    ]);
                }

                foreach($transactions as $transaction){
                    $relatedProduct = $transaction->product;
                    $newStockUpdate = $relatedProduct->stock -= $transaction->quantity;

                    $relatedProduct->update([
                        "stock" =>  $newStockUpdate
                    ]);
                }

                $user_checkout->update([
                    "status" => "ordered",
                    "payment_method" => $latest_payment_method,
                    "address_order" => $address
                ]);

                $updatedBalanceCredit = $user_wallet->credit -= $total_price;
                $updatedBalanceDebit = $user_wallet->debit += $total_price;

                $user_wallet->update([
                    "credit" => $updatedBalanceCredit,
                    "debit" => $updatedBalanceDebit
                ]);

                return response()->json([
                    "message" => "success, checkout",
                ]);

             }


             //payment_not_tb
             $user_checkout = UserCheckout::where("checkout_code", $request->checkout_code)->where("user_id", Auth::user()->id)->first();
             $transaction_list = json_decode($user_checkout->product_list);
             $transactions = Transaction::whereIn("id", $transaction_list)->where("user_id", Auth::user()->id)->get();

             foreach($transactions as $transaction){
                 $transaction->update([
                      "status" => "checkedout"
                 ]);
             }

             foreach($transactions as $transaction){
                $relatedProduct = $transaction->product;
                $newStockUpdate = $relatedProduct->stock -= $transaction->quantity;

                $relatedProduct->update([
                    "stock" =>  $newStockUpdate
                ]);
            }


             $user_checkout->update([
                 "status" => "ordered",
                 "payment_method" => $latest_payment_method,
                 "address_order" => $address
             ]);

             return response()->json([
                "message" => "success, checkout",

             ]);

        }
    }

    public function getUserLatestPaymentMethod(Request $request){
        if($request->ajax()){
            $user = User::where("id", Auth::user()->id)->first();

            return response()->json([
                "message" => "success, get latest payment",
                "payment_method" => $user->latest_paymentmethod
            ]);
        }
    }

    public function checkoutSuccess(Request $request){
        $checkouts = UserCheckout::where("checkout_code", $request->checkout_code)->where("user_id", Auth::user()->id)->first();

        if(!$checkouts) return view("errors.404");


        if($request->detail == "show"){
            $product_list = json_decode($checkouts->product_list);
            $transactions = Transaction::whereIn("id", $product_list)->get();

            foreach($transactions as $transaction){
                $transaction->totalPricePerTransaction = ($transaction->price * $transaction->quantity);
            }

            return view('detailcheckout', compact('checkouts','transactions'));
        }

        return view("successcheckout", compact("checkouts"));
    }
    public function addWishlist(Request $request){
        $user = User::find(Auth::user()->id);
        $wishlistArray = json_decode($user->wishlist);

        if (!in_array($request->product_id, $wishlistArray)) {
            array_push($wishlistArray, $request->product_id);
            $user->wishlist = json_encode($wishlistArray);
            $user->save();
        }

        return response()->json([
            "message" => "success, added to wishlist",
            "wishlist" => $wishlistArray
        ]);
    }
}