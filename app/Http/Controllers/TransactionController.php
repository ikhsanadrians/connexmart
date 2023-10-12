<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;


class TransactionController extends Controller
{  
    public function index(){
        return view('cart');
    }

    public function sentToCart(Request $request){
        
        $transactionByUserId = Transaction::where('user_id', Auth::user()->id)->where('status','not_paid')->get();
      
        if($transactionByUserId){ 
            $updateProductContain = [$transactionByUserId->product_contain];
        }
        
        $product = Product::find($request->product_id);
        $productPrice = $product->price;
        $productSummaryPrice  = ($productPrice * $request->quantity);
        $productContain = [$product->id];
        
        
        Transaction::create([
           "user_id" => Auth::user()->id,
           "product_contain" => json_encode($productContain),
           "status" => "not_paid",
           "order_id" => "INV-" . Auth::user()->id . now()->format('dmYHis'),
           "price" =>  $productSummaryPrice
        ]);
        
        return redirect()->back();

      
    }
}
