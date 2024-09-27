<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenerimaanStokController extends Controller
{

    public function index(){
        return view('mart.stockinput.index');
    }


    public function inputPenerimaanStokIndex(){

    }

    public function inputPenerimaanStokPost(Request $request){
        $stokData = [];
    }

    public function inputPenerimaanStokEdit(Request $request){
        
    }

    


}
