<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\StokProduk;
use Carbon\Carbon;


class PenerimaanStokController extends Controller
{

    public function index(Request $request){
        $productStocks = StokProduk::query();

        if ($request->stock_type) {
            if($request->stock_type == "transaction"){
                $productStocks->where('stoktype','transaction');
            } else if ($request->stock_type == "newstock"){
                $productStocks->where('stoktype','newstock');
            } else if ($request->stock_type == 'stockupdate'){
                $productStocks->where('stoktype','stockupdate');
            }
        }


        if ($request->has('date')) {
            $formattedDate = Carbon::createFromFormat('d_m_Y', $request->date)->format('Y-m-d');
            $productStocks->whereDate('created_at', $formattedDate);
        }

        if ($request->sort) {
            $sortOrder = $request->sort === "oldfirst" ? "asc" : "desc";
        } else {
            $sortOrder = "desc";
        }

        if ($request->show === "all") {
            $productStocks = $productStocks->orderBy("created_at", $sortOrder)->get();
        } else {
            $productStocks = $productStocks->orderBy("created_at", $sortOrder)->paginate($request->show ?? 50);
        }


        $count_products = StokProduk::count();



        $stokProductDates = StokProduk::selectRaw('DATE_FORMAT(updated_at, "%d %M %Y") as formatted_date')
            ->groupBy('formatted_date')
            ->get();


        return view('mart.stockinput.index', compact('productStocks', 'count_products', 'stokProductDates'));
    }


    public function createStok(){
        $dataProducts = Product::all();

        return view('mart.stockinput.add', compact('dataProducts'));
    }

    public function storeData(Request $request){
        try {
          if($request->ajax()){

            $typeOfStock = $request->typeOfStock;
            $currentStockProduct = StokProduk::create([
                'statusenabled' => true,
                'product_id' => $request->productId,
                'keterangan' => generate_keterangan_stok($typeOfStock == "new" ? "init" : "addition_stock"),
                'stokawal' => $typeOfStock == "new" ? 0 : StokProduk::where("product_id", $request->productId)->latest()->value('stok_akhir'),
                'qtyin' => $request->quantityIn,
                'qtyout' => 0,
                'stok_akhir' => $typeOfStock == "new" ? $request->quantityIn : StokProduk::where("product_id", $request->productId)->latest()->value('stok_akhir') + $request->quantityIn,
            ]);


            $productQtyUpdate = Product::where("id", $request->productId)->first();
            $lastStock = $currentStockProduct->stok_akhir;

            $productQtyUpdate->stock = $lastStock;
            $productQtyUpdate->save();


            return response()->json([
                "message" => "success, get data!",
                "code" => "success",
                "data" => $currentStockProduct
            ],200);

          }
        } catch (\Exception $e) {
         return response()->json([
            "message" => "An Error occurred!"
         ]);
        }
    }

    public function showStok(string $id){
        try {
            // Ambil stok terbaru untuk produk berdasarkan ID
            $currentStok = StokProduk::with('product')
                            ->where('product_id', $id)
                            ->orderBy('created_at', 'desc')
                            ->with('product')
                            ->first(); // Mengambil stok terbaru

            // Jika stok tidak ditemukan
            if (!$currentStok) {
                return response()->json([
                    "message" => "Stok not found",
                ], 404);
            }

            // Jika stok ditemukan, kirimkan data stok
            return response()->json([
                "message" => "success, get data!",
                "data" => $currentStok
            ], 200);

        } catch (\Exception $e) {
            // Tangani kesalahan yang tidak terduga
            return response()->json([
                "message" => "An error occurred",
                "error" => $e->getMessage()
            ], 500);
        }
    }


}
