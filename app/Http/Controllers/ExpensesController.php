<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpensesController extends Controller
{
    public function index(){
        $expenses=Expense::all();
        return view('expenses',compact('expenses'));
    }

    public function create(Request $request){
        $expense=new Expense;
        $expense->name=$request->name;
        $expense->price=$request->price;
        $expense->save();
        return back()->with('message','تم اضافة المصروفات بنجاح');
    }

    public function update(Request $request){
        $expense=Expense::find($request->id);
        $expense->name=$request->name;
        $expense->price=$request->price;
        $expense->save();
        return back()->with('message','تم تعديل بيانات المصروفات بنجاح');
    }

    public function destroy($id){
        Expense::find($id)->delete();
        return back();
    }

    public function massDestroy(){
        Expense::whereIn('id', request('ids'))->delete();
        return response(null, 204);
    }
}
