<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Models\Transaction;
use App\Models\UserCheckout;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Symfony\Component\HttpFoundation\StreamedResponse;


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

      $goodsToUpdate = Product::find($request->product_id);

      if ($request->hasFile('image')) {
          $imageThumbnail = $request->file('image')->move("images/", $request->file('image')->getClientOriginalName());
          if ($goodsToUpdate->photo) {
              Storage::disk('public')->delete($goodsToUpdate->photo);
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


      if (isset($imageThumbnail)) {
          $updateData["photo"] = $imageThumbnail;
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
    $categories = Category::all();
    $products = Product::query();
    $transactions =  Transaction::with('product')->where('user_id', 4)->where('status', 'outcart')->orderBy('created_at', 'asc')->get();

    if($request->category){
        $category = Category::where("slug", $request->category)->first();
        $products->where("category_id", $category->id);
    }

    $products = $request->show == "all" ? $products->get() : $products->paginate($request->show ?? 50);

    $count_products = $products->count();

    return view("mart.cashier", compact("products", "categories", "count_products", "transactions"));
  }

  public function cashierAddToOrderList(Request $request){
    if ($request->ajax()) {
        $product = Product::find($request->product_id);
        $productPrice = $product->price;
        $transaction_id = "";
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

                $transaction_id = $sameTransaction->id;
            } else {
                $transaction = Transaction::create([
                    "user_id" => Auth::user()->id,
                    "product_id" => $product->id,
                    "status" => "outcart",
                    "order_id" => "INV-" . Auth::user()->id . now()->format('dmYHis'),
                    "quantity" => $request->quantity,
                    "price" => $productSummaryPrice,
                ]);

                $transaction_id = $transaction->id;
            }


            return response()->json([
                "message" => "success",
                "data" => $transaction_id,
            ]);


        }

    }
  }

  public function cashierQuantityUpdate(Request $request){

      if ($request->ajax()) {
        $quantityToUpdate = Transaction::where('id', $request->transaction_id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if($request->quantity >= $quantityToUpdate->product->stock){
            return response()->json(["message" => "Tidak Dapat Menambahkan, Stok Habis!"], 401);
        }

        if($request->type == "delete"){
            $quantityToUpdate->delete();
            $message = "Berhasil Menghapus Produk!";
        } else {
            $quantityToUpdate->update(['quantity' => $request->quantity]);
            $message = "Berhasil Memperbarui Produk!";
        }

        return response()->json(["message" => $message, "data" => $quantityToUpdate]);
    }
  }


  public function search(Request $request){
      $products = "";

      if($request->category != null){
        $category = Category::where("slug", $request->category)->first();
        $products = Product::where("category_id", $category->id)->where("name", "LIKE" , "%" . $request->searchValue . "%")->get();
      } else {
          $products = Product::where("name", "LIKE" , "%" . $request->searchValue . "%")->get();
      }


      if(count($products) == 0){
         return response()->json([
            "message" => "cannot found product",
            "data" => "empty"
         ]);
      }

      return response()->json([
         "message" => "success, get data",
         "data" => $products
      ]);

  }


  public function clearOrder(Request $request){
    $transactions = Transaction::where('user_id', 4)->where("status", "outcart")->get();

    foreach ($transactions as $transaction) {
        $transaction->delete();
    }

    return response()->json(["message" => "All transactions have been cleared."]);

  }

  public function cashierProceed(Request $request){
        if($request->ajax()){
             $checkout_code = now()->format("dmYHis") . Auth::user()->id . substr(uniqid(), 0, 3);
             $data = UserCheckout::create([
                  "checkout_code" => $checkout_code,
                  "user_id" => Auth::user()->id,
                  "product_list" => json_encode($request->product_list),
                  "total_quantity" => $request->total_quantity,
                  "total_price" => $request->total_price,
                  "status" => "pending"
             ]);

             $qrCodeData = QrCode::format('png')->margin(1)->size(512)->generate($checkout_code);
             $formatedBase64QrCode = base64_encode($qrCodeData);


             return response()->json([
                "qrCodeData" => $formatedBase64QrCode,
                "checkoutCode" => $checkout_code
              ]);

        }
  }



  public function cashierProceedIndex(string $checkout_code){
      $checkouts = UserCheckout::where("checkout_code", $checkout_code)->first();
      if(!$checkouts || $checkouts->status == "ordered") return view("errors.404");
      $product_list = json_decode($checkouts->product_list);

      $transactions = Transaction::whereIn("id", $product_list)->with('product')->where("user_id", Auth::user()->id)->get();

      foreach($transactions as $transaction){
          $transaction->totalPricePerTransaction = ($transaction->product->price * $transaction->quantity);
      }


      return view("mart.cashierproceed", compact("transactions", "checkouts"));

  }


  public function streamedResponseExample(string $checkout_code) {
    $checkout = UserCheckout::where("checkout_code", $checkout_code)->first();

    $response = new StreamedResponse(function() use ($checkout) {
        echo "data: " . json_encode($checkout) . "\n\n";
        ob_flush();
        flush();
    });

    $response->headers->set('Content-Type', 'text/event-stream');
    $response->headers->set('Cache-Control', 'no-cache');
    $response->headers->set('Connection', 'keep-alive');

    return $response;
}

  public function martlogout()
  {
    Auth::logout();

    request()->session()->invalidate();

    return redirect()->route('mart.auth');
  }


}
