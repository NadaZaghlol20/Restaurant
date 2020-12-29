<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Order;
use DB;

class SalesController extends Controller
{
    public function index(){
        $count = Order::where('client_id','=','1')->count();
        $sales=DB::table('clients')
        ->leftJoin('orders','orders.client_id','clients.id')
        // ->where()
        ->select('clients.name as client_name','orders.id as id','clients.phone as client_phone','clients.address as client_address')
        // ->orderBy('clients.id')
        ->get();
        return view('sales',compact('sales','count'));
    }
}
