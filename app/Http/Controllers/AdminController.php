<?php

namespace App\Http\Controllers;

use App\Models\Roles;
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

    public function userindex(){
        $roles = Roles::all();
        $users = User::with('roles')->get();
        return view('admin.adduser',compact('roles','users'));
    }

    public function useradd(Request $request){
      $validation = $request->validate([
        "name" => "required",
        "password" => "required",
        "role_id" => "required"
       ]);


       $user = User::create($validation);

       return redirect()->back();

    }

    public function entrytransaction(){
        return view('admin.entrytransaction');
    }

    public function settings(){
        return view('admin.settings');
    }

    public function notifications(){
        return view('admin.notifications');
    }

}
