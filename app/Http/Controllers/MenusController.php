<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Menu;
use DB;
use DataTables;

class MenusController extends Controller
{
    public function index(Request $request){

        if(request()->ajax())
        {
            if($request->restaurant_id)
            {
                $data = DB::table('menus')
                    ->join('restaurants', 'restaurants.id', '=', 'menus.restaurant_id')
                    ->select('menus.id', 'menus.food', 'restaurants.name', 'menus.price')
                    ->where('menus.restaurant_id', $request->restaurant_id);
            }else
            {
                $data = DB::table('menus')
                    ->join('restaurants', 'restaurants.id', '=', 'menus.restaurant_id')
                    ->select('menus.id', 'menus.food', 'restaurants.name', 'menus.price');
            }
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" class="btn btn-primary btn-sm">View</a>
                <a href="/menus_delete/" class="btn btn-danger btn-sm">delete</a>';
                return $btn;
         })
        ->rawColumns(['action'])
        ->make(true);
        }
        $restaurants=Restaurant::all();
        $menus=DB::table('menus')
        ->join('restaurants','restaurants.id','menus.restaurant_id')
        ->select('menus.*','restaurants.name')
        ->get();
        return view('menus.index', compact('restaurants','menus'));
    }

    // public function get_menus($id){
    //     $menus = Menu::where('restaurant_id',$id)->get();
    //     return json_encode($menus);
    // }

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
