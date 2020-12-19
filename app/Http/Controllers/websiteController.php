<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class websiteController extends Controller
{
    public function login(){
        return view('login');
    }

    public function loged(LoginRequest $request){
        $user=User::where('email',$request->email)->first();
        if($user){
            if(Hash::check($request->password, $user->password)){
                session()->put('user',$user);
                return redirect('users');
            }
        }
        return redirect('/');
    }

    public function index($lang){
        app()->setLocale($lang);
        session()->put('lang',$lang);
        return redirect()->back();
    }

    public function logout(){
        session()->forget('user');
        return redirect('/');
    }
}
