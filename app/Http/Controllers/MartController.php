<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class MartController extends Controller
{
   public function index(){
     $products = Product::all();
     return view('mart.index', compact('products'));
   }

   public function goodsindex(){
     $products = Product::all();
     $productcategories = Category::all();
     return view('mart.goods',compact('products','productcategories'));
   }

   public function goodpost(Request $request){
     
       $goods = Product::create([
         'name' => $request->name,
         'price' => $request->price,
         'stock' => $request->stock,
         'photo' => 'photo',
         'desc' => $request->description,
         'category_id' => $request->category_id,
         'stand' => 2,
       ]);

       alert()->success('Success','Success Add New Product!');

       return redirect()->route('mart.goods');

   }

   public function goodsupdate(Request $request){
        if($request->ajax()){
          $goodsToUpdate = Product::find($request->product_id);
          
          $goodsToUpdate->update([
            "name" => $request->product_name,
            "price" => $request->product_price,
            "stock" => $request->product_stock,
            "photo" => "photo",
            "desc" => $request->product_description,
            "category_id" => $request->product_categoryid,
            "stand" => 2
          ]);

          alert()->success("Success","Success Update Product");
          
          return response()->json([
             "message" => "Success Update Data!",
             "data" => $goodsToUpdate
          ]);

        }
   }

   public function goodsdelete(Request $request){
if($request->ajax()) {
  $deletedProduct = Product::find($request->id_to_delete);
 
  alert()->success("Success","Success Delete Product");
          
  return response()->json([
    "message" => "Success Delete Data!",
    "data" => $deletedProduct
  ]);

      }
   }

   public function addcategory(){
     return view('mart.category');
   }


   public function auth(){
    return view("mart.login");
}

public function auth_proceed(Request $request){
    $credentials = [
        "name" => $request->username,
        "password" => $request->password
    ];

    $checkRoles =  User::where('name',$credentials['name'])->first();

    if(Auth::attempt($credentials)) return redirect()->route('mart.index');

    return redirect()->back();
}

public function martlogout(){
    Auth::logout();

    request()->session()->invalidate();

    return redirect()->route('mart.auth');
}

}
