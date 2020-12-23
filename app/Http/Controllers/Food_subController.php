<?php

namespace App\Http\Controllers;

use App\Models\Food_sub;
use Illuminate\Http\Request;

class Food_subController extends Controller
{
    public function index(){
        $food_subs=Food_sub::all();
        return view('subscriptions.food_sub',compact('food_subs'));
    }

    public function create(Request $request){
        $food_sub=new Food_sub;
        $food_sub->address=$request->address;
        $food_sub->bread_num=$request->bread_num;
        $food_sub->price=$request->price;
        $food_sub->save();
        return back()->with('message','تم اضافة الاشتراك بنجاح');
    }

    public function update(Request $request){
        $food_sub=Food_sub::find($request->id);
        $food_sub->address=$request->address;
        $food_sub->bread_num=$request->bread_num;
        $food_sub->price=$request->price;
        $food_sub->save();
        return back()->with('message','تم تعديل بيانات الاشتراك بنجاح');
    }

    public function destroy($id){
        Food_sub::find($id)->delete();
        return back();
    }

    public function massDestroy(){
        Food_sub::whereIn('id', request('ids'))->delete();
        return response(null, 204);
    }
}
