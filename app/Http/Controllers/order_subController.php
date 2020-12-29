<?php

namespace App\Http\Controllers;

use App\Models\Order_sub;
use App\Models\Monthly_sub;
use Illuminate\Http\Request;
use DB;

class order_subController extends Controller
{
    public function index(){
        $subscriptions=Monthly_sub::all();
        $order_subs=DB::table('order_subs')
        ->join('monthly_subs','monthly_subs.id','order_subs.sub_id')
        ->select('order_subs.*','monthly_subs.subscription as sub_type')
        ->get();
        return view('subscriptions.monthly_sub',compact('order_subs','subscriptions'));
    }

    public function create(Request $request){
        session()->put('client_name',$request->client_name);
        session()->put('phone',$request->phone);
        session()->put('address',$request->address);
        return redirect('/menus');
    }

    public function update(Request $request){
        $order_sub=Order_sub::find($request->id);
        $order_sub->name=$request->name;
        $order_sub->address=$request->address;
        $order_sub->phone=$request->phone;
        $order_sub->date=$request->start_date;
        $order_sub->notes=$request->notes;
        $order_sub->sub_id=$request->sub_id;
        $order_sub->save();
        return back()->with('message','تم تعديل بيانات طلب الاشتراك بنجاح');
    }

    public function destroy($id){
        Order_sub::find($id)->delete();
        return back();
    }

    public function massDestroy(){
        Order_sub::whereIn('id', request('ids'))->delete();
        return response(null, 204);
    }
}
