<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;


class ApiMartController extends Controller
{
    public function index(){
        $products = Product::all();
        
        return response()->json([
            "message" => "Success, Get Data!",
            "data" => $products
        ],200);
    }

    public function store(Request $request){
        $product = Product::create([
           "name" => $request->name,
           "slug" => $request->slug,
           "price" => $request->price,
           "stock" => $request->stock,
           "photo"=> $request->photo,   
           "desc" => $request->desc, 
           "category_id" => $request->category_id,
           "stand" => $request->stand    
        ]);

        return response()->json([
            "message" => "Success, Create New Data!",
            "data" => $product
        ]);
    
    }


    public function show(int $id){
       $product = Product::find($id);

       if(!$product){
         return response()->json([
            "message"=> "Error, Data Not Found!"
         ],404);
       }

       return response()->json([
          "message"=> "Success, Get Data!",
          "data" => $product
       ],200);
    }

    public function update(Request $request, int $id){
        $product = Product::find($id);

        if(!$product) return response([
            "message" => "Error, Data Not Found!"
        ],404);

        $product->update([
            "name" => $request->name,
            "slug" => $request->slug,
            "price" => $request->price,
            "stock" => $request->stock,
            "photo"=> $request->photo,   
            "desc" => $request->desc, 
            "category_id" => $request->category_id,
            "stand" => $request->stand    
        ]);

        return response()->json([
            "message"=> "Success, Update Data!",
            "data" => $product
         ],200);
    }

    public function destroy(int $id){
        $product = Product::find($id);

        if(!$product) return response([
            "message" => "Error, Data Not Found!"
        ],404);


        $product->delete();
   
        return response()->json([
            "message"=> "Success, Delete Data!",
            "data" => $product
         ],200);
    }

}
