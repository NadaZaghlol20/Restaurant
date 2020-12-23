<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveriesController extends Controller
{
    public function index(){
        $deliveries=Delivery::all();
        return view('deliveries.index',compact('deliveries'));
    }

    public function create(Request $request){
        $delivery=new Delivery;
        $delivery->name=$request->name;
        $delivery->phone=$request->phone;
        $delivery->delivery_price=$request->delivery_price;
        $delivery->save();
        return back()->with('message','تم اضافة الدليفرى بنجاح');
    }

    public function update(Request $request){
        $delivery=Delivery::find($request->id);
        $delivery->name=$request->name;
        $delivery->phone=$request->phone;
        $delivery->delivery_price=$request->delivery_price;
        $delivery->save();
        return back()->with('message','تم تعديل بيانات الدليفرى بنجاح');
    }

    public function destroy($id){
        Delivery::find($id)->delete();
        return back();
    }

    public function massDestroy(){
        Delivery::whereIn('id', request('ids'))->delete();
        return response(null, 204);
    }
}
