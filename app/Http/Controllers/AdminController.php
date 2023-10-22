<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;


class AdminController extends Controller
{
    public function index(){
        $users = User::paginate('5');
        $allusers = User::all();
        return view("admin.index", compact("users","allusers"));
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

       alert()->success('Success','Success Add New User!');

       return redirect()->route('user.index');

    }

    public function userupdate(Request $request){
        if($request->ajax()){
           $userToUpdate = User::find($request->user_id);

           $userToUpdate->update([
               "name" => $request->username,
               "role_id => $request->role"
           ]);

           if(!$userToUpdate) return response()->json([
             "message" => "cannot update data"
           ]);

           return response()->json([
             "message" => "success",
             "data" => $userToUpdate
           ]);
        }
    }

    public function userdelete(Request $request){
        if($request->ajax()){
           $userToDelete = User::find($request->id_to_delete);

           $userToDelete->delete();

           if(!$userToDelete) return response()->json([
             "message" => "cannot delete data"
           ]);

           return response()->json([
             "message" => "success",
             "data" => $userToDelete
           ]);
        }
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
