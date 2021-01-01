<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sale;
use App\Models\Order;
use DB;

class SalesController extends Controller
{
    public function index(){

        $sales=DB::table('clients')
        ->Join('orders','orders.client_id','clients.id')
        ->select([
            DB::raw('count(orders.client_id) as quantity'),
            'clients.created_at as final_price',
            'clients.id',
            'clients.name',
            'clients.phone',
            'clients.address'
        ])
        ->groupBy(['orders.client_id','clients.id','clients.name','clients.phone','clients.address','clients.created_at'])
        ->get()
        ->toArray();

        foreach($sales as $sale){
            $price=0;
            $orders=Order::where('client_id',$sale->id)->get();
            foreach($orders as $ord)
                $price+=(int)$ord->price;
            $sale->created_at=$price;
        }

        return view('sales',compact('sales'));
    }
}
