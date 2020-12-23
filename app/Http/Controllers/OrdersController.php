<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Order;
use App\Models\Restaurant;
use DB;

class OrdersController extends Controller
{
    public function index(){
        $clients=Client::all();
        $restaurants=Restaurant::all();
        $orders=DB::table('orders')
        ->join('clients','clients.id','=','orders.client_id')
        ->join('restaurants','restaurants.id','=','orders.restaurant_id')
        ->select('orders.*','restaurants.name as res_name','clients.name')
        ->get();
        return view('orders.index',compact('orders','restaurants','clients'));
    }

    public function create(Request $request){
        $menus=new Order;
        $menus->restaurant_id=$request->restaurant_id;
        $menus->client_id=$request->client_id;
        $menus->price=$request->price;
        $menus->save();
        return back()->with('message','تم اضافة قائمة الطلب بنجاح');
    }

    public function update(Request $request){
        $menus=Order::find($request->id);
        $menus->restaurant_id=$request->restaurant_id;
        $menus->client_id=$request->client_id;
        $menus->price=$request->price;
        $menus->save();
        return back()->with('message','تم تعديل بيانات قائمة الطلب بنجاح');
    }

    public function destroy($id){
        Order::find($id)->delete();
        return back();
    }

    public function massDestroy(){
        Order::whereIn('id', request('ids'))->delete();
        return response(null, 204);
    }
}
