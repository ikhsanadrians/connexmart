<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function index(){
        return view("admin.index");
    }

    public function auth(){
        return view("admin.login");
    }

    public function auth_proceed(Request $request){
        $credentials = [
            "name" => $request->username,
            "password" => $request->password
        ];

        $checkRoles =  User::where('name',$credentials['name'])->first();

        if($checkRoles->role_id != 1) return redirect()->back();

        if(Auth::attempt($credentials)) return redirect()->route('admin.index');

        return redirect()->back();
     }

}
