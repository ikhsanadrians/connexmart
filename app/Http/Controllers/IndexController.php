<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\UserCheckout;
use Illuminate\Support\Facades\File;

class IndexController extends Controller
{
    public function index(){
        $products = Product::get();
        return view('index', compact('products'));
    }


    public function wishlist(){
      return view('wishlist');
    }

    public function transaction(){
      return view('transaction');
    }


    public function login(){
        if(Auth::check()) return redirect()->route("home");

        return view('login');
    }

    public function auth(Request $request){
           if($request->ajax()){

            $data = [
                "name" => $request->username,
                "password" => $request->password
             ];

             $isUserRemember = $request->isUserRemember;

             $attempt = Auth::attempt($data, $isUserRemember);

             if(!$attempt) return response()->json([
                "status" => "unauthenticated",
             ]);

             return response()->json([
                "status" => "success"
             ]);

           }


    }

    public function showproduct(string $slug){
        $product = Product::where('slug', $slug)->first();
        $otherProducts = Product::paginate(4);
        return view("detailproduct",compact("product","otherProducts"));
    }


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
            $transaction = UserCheckout::where("checkout_code", $request->checkout_code)->first();
            $updatedTransaction = $transaction->update([
                "status" => "ordered"
            ]);

            return response()->json([
                "message" => "Success, confirm transactions",
                "data" => $updatedTransaction
            ]);
        }
    }



    public function profile(){
       $transactions =  Transaction::with('product')->where('user_id', Auth::user()->id)->where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();

       return view('profile',compact('transactions'));
    }

    public function logout(){
        Auth::logout();

        request()->session()->invalidate();

        return redirect()->back();
    }

}