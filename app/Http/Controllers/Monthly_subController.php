<?php

namespace App\Http\Controllers;

use App\Models\Monthly_sub;
use Illuminate\Http\Request;

class Monthly_subController extends Controller
{
    public function index(){
        $monthly_subs=Monthly_sub::all();
        return view('subscriptions.monthly_sub',compact('monthly_subs'));
    }

    public function create(Request $request){
        $monthly_sub=new Monthly_sub;
        $monthly_sub->subscription=$request->name;
        $monthly_sub->price=$request->price;
        $monthly_sub->save();
        return back()->with('message','تم اضافة الاشتراك بنجاح');
    }

    public function update(Request $request){
        $monthly_sub=Monthly_sub::find($request->id);
         $monthly_sub->subscription=$request->name;
        $monthly_sub->price=$request->price;
        $monthly_sub->save();
        return back()->with('message','تم تعديل بيانات الاشتراك بنجاح');
    }

    public function destroy($id){
        Monthly_sub::find($id)->delete();
        return back();
    }

    public function massDestroy(){
        Monthly_sub::whereIn('id', request('ids'))->delete();
        return response(null, 204);
    }
}
