<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }


    public function show(){
        $users = User::all();
        return view('adminPanel')->with(compact('users'));
    }


    public function register(Request $r){
        $credentials = ['name'=>$r->name, 'email'=>$r->email, 'password'=>$r->password];
        $credentials['password'] = Hash::make($credentials['password']);
        try {
            $user = User::create($credentials);
        } catch (Exception $e) {
            return Response::json(['error' => 'User already exists.'], \Illuminate\Http\Response::HTTP_CONFLICT);
        }

        return 'ok';
    }
}
