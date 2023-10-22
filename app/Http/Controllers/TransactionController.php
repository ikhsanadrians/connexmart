<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Wallet;
use App\Models\TopUp;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TransactionController extends Controller
{
    public function index()
    {
        $product_count = 0;
        $total_prices = 0;
        $carts = Transaction::with('product')->where('user_id', Auth::user()->id)->where('status', 'not_paid')->orderBy('created_at', 'desc')->get();

        foreach ($carts as $product_cart) {
            $product_count += $product_cart->quantity;
        }

        foreach ($carts as $product_cart) {
            $total_prices += $product_cart->price;
        }

        return view('cart', compact('carts', 'product_count', 'total_prices'));
    }

    public function payCart(Request $request)
    {
        $total_prices = 0;
        $wallets = Wallet::where('user_id', Auth::user()->id)->first();
        $current_debit = $wallets->debit;
        $current_credit = $wallets->credit;

        $carts = Transaction::with('product')->where('user_id', Auth::user()->id)->where('status', 'not_paid')->orderBy('created_at', 'desc')->get();

        foreach ($carts as $product_cart) {
            $total_prices += $product_cart->price;
        }

        foreach ($carts as $cr) {
            $cr->update([
                "status" => "paid"
            ]);
        }

        $wallets->update([
            "debit" => ($current_debit += $total_prices),
            "credit" => ($current_credit -= $total_prices)
        ]);


        return redirect()->route('cart.receipt');
    }

    public function sentToCart(Request $request)
    {

        if ($request->ajax()) {
            $product = Product::find($request->product_id);
            $productPrice = $product->price;
            $productSummaryPrice  = ($productPrice * $request->quantity);

            $sameTransaction =  Transaction::where('product_id', $request->product_id)
            ->where('user_id', Auth::user()->id)
            ->where('status', 'not_paid')
            ->first();

            if ($sameTransaction) {
                $sumQuantity =  $sameTransaction->quantity += $request->quantity;
                $sumPrice = $sumQuantity * $sameTransaction->price;
                $sameTransaction->update([
                    'quantity' => $sumQuantity,
                    'price' => $sumPrice
                ]);
            } else {
                Transaction::create([
                    "user_id" => Auth::user()->id,
                    "product_id" => $product->id,
                    "status" => "not_paid",
                    "order_id" => "INV-" . Auth::user()->id . now()->format('dmYHis'),
                    "quantity" => $request->quantity,
                    "price" =>  $productSummaryPrice
                ]);
            }



            return response()->json([
                "message" => "success",
                "data" => $product
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

    public function receipt(Request $request)
    {
        $currentTopUp = TopUp::where('unique_code', $request->unique_code)->first();

        $data = QrCode::size(200)->generate(
            $currentTopUp->unique_code,
        );

        $currentTopUp->qr_code = $data;

        return view('receipt', compact('currentTopUp'));
    }

    public function cart_receipt(Request $request)
    {
        $total_prices = 0;
        $currentTransactions = Transaction::where('status', 'paid')->where('user_id', Auth::user()->id)->get();

        $qrcode = $currentTransactions[0];

        foreach ($currentTransactions as $transaction) {
            $total_prices += $transaction->price;
        }

        $data = QrCode::size(100)->generate(
            $qrcode->order_id,
        );

        $currentTransactions->qr_code = $data;
        $currentTransactions->total_prices = $total_prices;

        return view('receiptcart', compact('currentTransactions'));
    }

    public function cart_take(Request $request)
    {
        $currentTransactions = Transaction::where('status', 'paid')->where('user_id', Auth::user()->id)->get();

        foreach ($currentTransactions as $transaction) {
            $transaction->update([
                'status' => 'taken'
            ]);
        }

        return redirect()->route('home');
    }
}
