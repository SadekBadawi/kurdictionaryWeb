<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class UserController extends Controller
{
    public function index(){
        $pageConfigs = ['showMenu' => false];
        $breadcrumbs = [
           ['name'=>"All Words"]
        ];
        return view('/content/index', [ 'breadcrumbs' => $breadcrumbs,'pageConfigs'=>$pageConfigs]);
      }


   public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email'  => 'required|string|unique:users',
            'password'  => 'required',
        ]);

        $password = Hash::make( $validatedData['password'] );
        $data = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $password
        ]);

        return json('success' , ['add user successfully'] , ['user' => $data]);
   }
    // /===============================================================================/ //
   public function getAllUsers(){
        $user =User::query()->get();
       return json('success' , [] , $user);

   }
}
