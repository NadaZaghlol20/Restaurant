<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\Sale;
use App\Models\Restaurant;
use DB;

class SalesController extends Controller
{
    public function index(){
        return view('orders.index');
    }

    // public function create(Request $request){
    //     $menus=new Order;
    //     $menus->restaurant_id=$request->restaurant_id;
    //     $menus->client_id=$request->client_id;
    //     $menus->delivery_id=$request->delivery_id;
    //     $menus->price=$request->price;
    //     $menus->save();
    //     return back()->with('message','تم اضافة قائمة الطلب بنجاح');
    // }

    // public function update(Request $request){
    //     $menus=Order::find($request->id);
    //     $menus->restaurant_id=$request->restaurant_id;
    //     $menus->client_id=$request->client_id;
    //     $menus->delivery_id=$request->delivery_id;
    //     $menus->price=$request->price;
    //     $menus->save();
    //     return back()->with('message','تم تعديل بيانات قائمة الطلب بنجاح');
    // }

    public function destroy($id){
        Sale::find($id)->delete();
        return back();
    }

    public function massDestroy(){
        Sale::whereIn('id', request('ids'))->delete();
        return response(null, 204);
    }
}
