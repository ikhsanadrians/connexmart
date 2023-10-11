<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class IndexController extends Controller
{
    public function index(){
       return view('index');
    }

    public function auth(Request $request){
         if($request->ajax()){

            $data = [
               "name" => $request->username,
               "password" => $request->password
            ];

            $attempt = Auth::attempt($data);

            if(!$attempt) return response()->json([
                "message" => "auth-err",
            ]);

            return response()->json([
                "message" => "auth-succ"
            ]);


         }

    }

    public function logout(){
        Auth::logout();

        request()->session()->invalidate();

        return redirect()->back();
    }

}
