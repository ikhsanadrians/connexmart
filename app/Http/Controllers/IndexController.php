<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Transaction;

class IndexController extends Controller
{
    public function index(){
       $products  = Product::all();
       return view('index',compact('products'));
    }


    public function wishlist(){
      return view('wishlist');
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

             $attempt = Auth::attempt($data);

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
        $otherProducts = Product::paginate(5);

        return view("detailproduct",compact("product","otherProducts"));
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