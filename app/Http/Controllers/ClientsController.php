<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function index(){
        return view('clients.index');
    }
    public function massDestroy(){
        //return view('clients.index');
    }
}
