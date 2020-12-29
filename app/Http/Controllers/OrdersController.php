<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Delivery;
use App\Models\Order;
use App\Models\Restaurant;
use App\Models\Menu;
use DB;
use DataTables;

class OrdersController extends Controller
{
    public function index(Request $request){

        $clients=Client::all();
        $restaurants=Restaurant::all();
        $deliveries=Delivery::all();
        $orders=DB::table('orders')
        ->join('clients','clients.id','=','orders.client_id')
        ->join('restaurants','restaurants.id','=','orders.restaurant_id')
        ->select('orders.*','restaurants.name as res_name','clients.name','clients.phone')
        ->get();

            if($request->restaurant_id)
            {
                $menus = DB::table('menus')
                    ->join('restaurants', 'restaurants.id', '=', 'menus.restaurant_id')
                    ->select('menus.id', 'menus.food', 'restaurants.name', 'menus.price')
                    ->where('menus.restaurant_id', $request->restaurant_id)
                    ->get();
            }else
            {
                $menus = DB::table('menus')
                    ->join('restaurants', 'restaurants.id', '=', 'menus.restaurant_id')
                    ->select('menus.id', 'menus.food', 'restaurants.name', 'menus.price')
                    ->get();
            }

        return view('orders.index',compact('orders','restaurants','clients','deliveries','menus'));
    }

    public function create(Request $request){
        $input = $request->all();
        $input['food'] = json_encode($input['selctIds']);
        Order::create($input);
        // $menus=new Order;
        // $menus->restaurant=$request->restaurant;
        // $menus->name=$request->name;
        // $menus->phone=$request->phone;
        // $menus->address=$request->address;
        // $menus->food=$request->selctIds;
        // $menus->save();
        return back()->with('message','تم اضافة الطلب بنجاح');
    }

    public function update(Request $request){
        $menus=Order::find($request->id);
        $menus->restaurant_id=$request->restaurant_id;
        $menus->client_id=$request->client_id;
        $menus->delivery_id=$request->delivery_id;
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
