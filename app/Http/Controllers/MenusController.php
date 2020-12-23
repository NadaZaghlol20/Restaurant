<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Menu;
use DB;

class MenusController extends Controller
{
    public function index(){
        $restaurants=Restaurant::all();
        $menus=DB::table('menus')
        ->join('restaurants','restaurants.id','menus.restaurant_id')
        ->select('menus.*','restaurants.name')
        ->get();
        return view('menus.index',compact('restaurants','menus'));
    }

    public function create(Request $request){
        $menus=new Menu;
        $menus->restaurant_id=$request->restaurant_id;
        $menus->food=$request->food;
        $menus->price=$request->price;
        $menus->save();
        return back()->with('message','تم اضافة قائمة الطعام بنجاح');
    }

    public function update(Request $request){
        $menus=Menu::find($request->id);
        $menus->restaurant_id=$request->restaurant_id;
        $menus->food=$request->food;
        $menus->price=$request->price;
        $menus->save();
        return back()->with('message','تم تعديل بيانات قائمة الطعام بنجاح');
    }

    public function destroy($id){
        Menu::find($id)->delete();
        return back();
    }

    public function massDestroy(){
        Menu::whereIn('id', request('ids'))->delete();
        return response(null, 204);
    }
}
