<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\StokProduk;

class PenerimaanStokController extends Controller
{

    public function index(){
        return view('mart.stockinput.index');
    }


    public function createStok(){
        $dataProducts = Product::all();

        return view('mart.stockinput.add', compact('dataProducts'));
    }

    public function showStok(string $id){
        try {
            $currentStok = StokProduk::find($id);
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