<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Menu;

class RestaurantsController extends Controller
{
    public function index(){
        $restaurants=Restaurant::all();
        return view('restaurants.index',compact('restaurants'));
    }

    public function create(Request $request){
        $clients=new Restaurant;
        $clients->name=$request->name;
        $clients->phone=$request->phone;
        $clients->address=$request->address;
        $clients->save();
        return back()->with('message','تم اضافة المطعم بنجاح');
    }

    public function update(Request $request){
        $clients=Restaurant::find($request->id);
        $clients->name=$request->name;
        $clients->phone=$request->phone;
        $clients->address=$request->address;
        $clients->save();
        return back()->with('message','تم تعديل بيانات المطعم بنجاح');
    }

    public function destroy($id){
        Restaurant::find($id)->delete();
        return back();
    }

    public function massDestroy(){
        Restaurant::whereIn('id', request('ids'))->delete();
        return response(null, 204);
    }

}
