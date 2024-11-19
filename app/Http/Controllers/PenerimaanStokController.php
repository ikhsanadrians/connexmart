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


    public function createStok()
    {
        $dataProducts = Product::all();

        return view('mart.stockinput.add', compact('dataProducts'));
    }


    public function storeData(Request $request)
    {
        try {
            if ($request->ajax()) {
                $validatedData = $request->validate([
                    'typeOfStock' => 'required|string|in:new,additional',
                    'productId' => 'required|exists:products,id',
                    'quantityIn' => 'required|integer|min:1',
                ]);

                $typeOfStock = $validatedData['typeOfStock'];
                $previousStock = StokProduk::where("product_id", $validatedData['productId'])->latest()->value('stok_akhir') ?? 0;
                $initialStock = ($typeOfStock === 'new') ? 0 : $previousStock;
                $finalStock = $initialStock + $validatedData['quantityIn'];
                $newStockEntry = StokProduk::create([
                    'statusenabled' => true,
                    'product_id' => $validatedData['productId'],
                    'keterangan' => generate_keterangan_stok($typeOfStock === 'new' ? 'init' : 'addition_stock'),
                    'stokawal' => $initialStock,
                    'qtyin' => $validatedData['quantityIn'],
                    'qtyout' => 0,
                    'stok_akhir' => $finalStock,
                ]);

                $product = Product::findOrFail($validatedData['productId']);
                $product->stock = $finalStock;
                $product->save();

                return response()->json([
                    "message" => "Success, stock data recorded!",
                    "code" => "success",
                    "data" => $newStockEntry
                ], 200);
            }

            return response()->json(["message" => "Invalid Request Type"], 400);

        } catch (\Exception $e) {
            \Log::error("Error in storeData: " . $e->getMessage());
            return response()->json(["message" => "An error occurred!", "payload" => $e->getMessage()], 500);
        }
    }


    public function showStok(string $id)
    {
        try {
            $currentStok = StokProduk::with('product')
                ->where('product_id', $id)
                ->orderBy('created_at', 'desc')
                ->with('product')
                ->first();

            if (!$currentStok) {
                return response()->json([
                    "message" => "Stok not found",
                ], 404);
            }

            return response()->json([
                "message" => "success, get data!",
                "data" => $currentStok
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                "message" => "An error occurred",
                "error" => $e->getMessage()
            ], 500);
        }
    }


}