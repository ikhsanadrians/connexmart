<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Wallet;
use App\Models\TopUp;

class ApiBankController extends Controller
{
    public function index(){
        $transactions = Transaction::all();
        
        return response()->json([
            "message" => "Success, Get Data!",
            "data" => $transactions
        ],200);
    }

    public function topupconfirm(Request $request){
        $topUp = TopUp::where('unique_code',$request->unique_code)->first();
        $userWallet = Wallet::where('user_id',$request->user_id)->first();
        $sumTopUp = $userWallet->credit += $request->nominals;

        if(!$topUp || !$userWallet) return response()->json([
            "message" => "Top Up Or Wallet Not Found!"
        ],404);

        $userWallet->update([
            "credit" => $sumTopUp
        ]);

        $topUp->update([
            "status" => "confirmed"
        ]);

        return response()->json([
           "message" => "Success!, Confirm TopUp"
        ],200);

    }


    public function topupreject(Request $request){
        $topUp = TopUp::where('unique_code',$request->unique_code);
        
        if(!$topUp) return response()->json([
            "message" => "Top Up Not Found!"
        ],404);

        $topUp->update([
            "status" => "rejected"
        ]);

        return response()->json([
            "message" => "Success!, Reject TopUp"
         ],200);
    }

    public function show(int $id){
       $transaction = Transaction::find($id);

       if(!$transaction){
         return response()->json([
            "message"=> "Error, Data Not Found!"
         ],404);
       }

       return response()->json([
          "message"=> "Success, Get Data!",
          "data" => $transaction
       ],200);
    }


    public function wallets(){
        $wallets = Wallet::all();

        return response()->json([
            "message" => "Success, Get Data!",
            "data" => $wallets
        ]);

    }

    public function walletshow(int $id){
        $wallet = Wallet::find($id);
 
        if(!$wallet){
          return response()->json([
             "message"=> "Error, Data Not Found!"
          ],404);
        }
 
        return response()->json([
           "message"=> "Success, Get Data!",
           "data" => $wallet
        ],200);
     }
}


