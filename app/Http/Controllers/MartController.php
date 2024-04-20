<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class MartController extends Controller
{
  public function index()
  {
    $products = Product::all();
    $categories = Category::all();

    return view('mart.index', compact('products', 'categories'));
  }


  public function goodsindex()
  {
    $products = Product::all();
    $productcategories = Category::all();

    return view('mart.goods', compact('products', 'productcategories'));
  }

  public function goodpost(Request $request)
  {
    $imageThumbnail = "";

    if($request->hasFile('image')){
      $imageThumbnail = $request->file('image')->move("images/", $request->file('image')->getClientOriginalName());
    }

    $thumbnailPath =  $imageThumbnail->getPathname();


    $goods = Product::create([
      'name' => $request->name,
      'price' => $request->price,
      'stock' => $request->stock,
      'photo' => $thumbnailPath,
      'desc' => $request->description,
      'category_id' => $request->category_id,
      'stand' => 2,
    ]);

    alert()->success('Success', 'Success Add New Product!');

    return redirect()->route('mart.goods');

  }

  public function goodsupdate(Request $request)
  {

      $imageThumbnail = "";
      $goodsToUpdate = Product::find($request->product_id);

      if ($request->hasFile('image')) {
          $imageThumbnail = $request->file('image')->move("images/", $request->file('image')->getClientOriginalName());

          if (file_exists(public_path($goodsToUpdate->photo))) {
              if (!unlink(public_path($goodsToUpdate->photo))) {
                  Storage::delete($goodsToUpdate->photo);
              } else {
                  Storage::delete($goodsToUpdate->photo);
              }
          }
      }

      $updateData = [
          "name" => $request->name,
          "price" => $request->price,
          "stock" => $request->stock,
          "desc" => $request->description,
          "category_id" => $request->category_id,
          "stand" => 2
      ];


      if (!empty($imageThumbnail)) {
          $updateData["photo"] = $imageThumbnail->getPathname();
      }

      $goodsToUpdate->update($updateData);

      alert()->success("Success", "Success Update Product");

      return redirect()->back();
  }

  public function goodsdelete(Request $request)
  {

      $deletedProduct = Product::find($request->product_id);

      $deletedProduct->delete();

      alert()->success("Success", "Success Delete Product");

      return redirect()->back();


  }

  public function addcategory()
  {
    $categories = Category::all();

    return view('mart.category', compact("categories"));
  }

  public function addcategorypost(Request $request){
     $request->validate([
        "name" => "required"
     ]);

     Category::create([
         "name" => $request->name
     ]);

     alert()->success("Success", "Success Create Category");

     return redirect()->back();
  }

  public function deletegoodscategory(Request $request)
  {

      $deletedCategory = Category::find($request->category_id);

      $deletedCategory->delete();

      alert()->success("Success", "Success Delete Category");

      return redirect()->back();


  }


  public function updategoodscategory(Request $request){

    $category = Category::find($request->category_id);

    $request->validate([
        "name" => "required"
    ]);

    $category->update([
         "name" => $request->name
    ]);

      alert()->success("Success", "Success Update Category");

      return redirect()->back();

  }


  public function auth()
  {
    return view("mart.login");
  }

  public function auth_proceed(Request $request)
  {
    $credentials = [
      "name" => $request->username,
      "password" => $request->password
    ];

    $checkRoles = User::where('name', $credentials['name'])->first();

    if (Auth::attempt($credentials))
      return redirect()->route('mart.index');

    return redirect()->back();
  }

  public function cashier(Request $request){
    $products = "";
    $categories = Category::all();

    if($request->category){
        $products = Product::where("category_id", $request->category)->get();
    } else {
        $products = Product::all();
    }

    return view("mart.cashier", compact("products", "categories"));
  }

  public function martlogout()
  {
    Auth::logout();

    request()->session()->invalidate();

    return redirect()->route('mart.auth');
  }


}