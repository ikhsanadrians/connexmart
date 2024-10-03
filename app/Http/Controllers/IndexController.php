<?php

namespace App\Http\Controllers;

use App\Models\CashierShift;
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

    public function transaction(Request $request){
      $transactions = UserCheckout::query();

      if($request->has("status")){
        switch($request->status){
            case "all":
                $transactions->where("user_id", Auth::user()->id);
                break;
            case "onconfirm":
                $transactions->where("user_id", Auth::user()->id)->where("status", "not_paid");
                break;
            case "onproceed":
                $transactions->where("user_id", Auth::user()->id)->where("status", "pending");
                break;
            case "ended":
                $transactions->where("user_id", Auth::user()->id)->where("status", "ordered");
                break;
            case "picked-up":
                $transactions->where("user_id", Auth::user()->id)->where("status", "taken");
                break;
            case "cancel":
                $transactions->where("user_id", Auth::user()->id)->where("status", "canceled");
                break;
            default:
                break;
        }
      }

      $transactions = $transactions->get();

      return view('transaction', compact('transactions'));
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
        $cashier_shifts = CashierShift::where("status", "current")->first();
        $otherProducts = Product::paginate(4);
        return view("detailproduct",compact("product","otherProducts","cashier_shifts"));
    }


    public function profile(){
       $transactions =  Transaction::with('product')->where('user_id', Auth::user()->id)->where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();

       return view('profile',compact('transactions'));
    }


    public function search(){
        $populerSearchs = Product::inRandomOrder()->take(5)->get();


        return view("search", compact("populerSearchs"));
    }

    public function searchPost(Request $request){
        if($request->ajax()){
           $currentSearchValues = Product::where("name", "LIKE", '%' . $request->searchValue . '%')->get();

           if(count($currentSearchValues)  < 1){
             return response()->json([
                "message" => "Product Not Found!",
                "data" => "empty"
             ]);
           } else if ($request->searchValue == ""){
             return response()->json([
                "message" => "Search Input Empty!",
                "data" => "search_input_null"
             ]);
           }

           return response()->json([
               "message" => "Product Found",
               "data" => $currentSearchValues
           ]);

        }
    }
    
    public function searchQuery(string $query){
          $searchValues = Product::where("name", 'LIKE', '%' . $query . '%')->get();
          return view("searchquery",compact("searchValues", "query"));
    }    
 
    public function logout(){
        Auth::logout();

        request()->session()->invalidate();

        return redirect()->back();
    }

}