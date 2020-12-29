<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WelcomeController extends Controller
{
    public function index(){
        return view('login');
    }

    public function login(Request $request){
        $user=User::where('email',$request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                session()->put('id',$user->id);
                session()->put('name',$user->name);
                return redirect('/orders');
            }
        }
        return redirect('/');
    }

    public function reg(){
        return view('register');
    }

    public function register(Request $request){
        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=Hash::make($request->password);
        $user->save();
        return redirect('/');
    }

    public function logout(){
        session()->forget('name');
        session()->forget('id');
        return redirect('/');
    }
}
