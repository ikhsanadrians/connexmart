<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ApiUserController extends Controller
{
    public function index(){
        $users = User::all();
        
        return response()->json([
            "message" => "Success, Get Data!",
            "data" => $users
        ],200);
    }

    public function store(Request $request){
        $user = User::create([
           "name" => $request->name,
           "role_id" => $request->role_id,
           "password" => bcrypt($request->password)
        ]);

        return response()->json([
            "message" => "Success, Create New Data!",
            "data" => $user
        ]);
    
    }


    public function show(int $id){
       $user = User::find($id);

       if(!$user){
         return response()->json([
            "message"=> "Error, Data Not Found!"
         ],404);
       }

       return response()->json([
          "message"=> "Success, Get Data!",
          "data" => $user
       ],200);
    }

    public function update(Request $request, int $id){
        $user = User::find($id);

        if(!$user) return response([
            "message" => "Error, Data Not Found!"
        ],404);

        $user->update([
            "name"=> $request->name,
            "password" => bcrypt($request->password),
            "role_id" => $request->role_id 
        ]);

        return response()->json([
            "message"=> "Success, Update Data!",
            "data" => $user
         ],200);
    }

    public function destroy(int $id){
        $user = User::find($id);

        if(!$user) return response([
            "message" => "Error, Data Not Found!"
        ],404);


        $user->delete();
   
        return response()->json([
            "message"=> "Success, Delete Data!",
            "data" => $user
         ],200);
    }

}
