<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\StokProduk;
use Carbon\Carbon;


class PenerimaanStokController extends Controller
{

    public function index()
    {
        return view('mart.stockinput.index');
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
                    'typeOfStock' => 'required|string|in:new,addition',
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
            return response()->json(["message" => "An error occurred!"], 500);
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
