<?php

namespace App\Http\Controllers;
use App\Models\Client;
use Illuminate\Http\Request;
use App\Http\Requests\MassDestroyClientRequest;

class ClientsController extends Controller
{
    public function index(){
        $clients=Client::all();
        return view('clients.index',compact('clients'));
    }

    public function create(Request $request){
        $clients=new Client;
        $clients->name=$request->name;
        $clients->phone=$request->phone;
        $clients->address=$request->address;
        $clients->save();
        return back();
    }

    public function update(Request $request,$id){
        $clients=Client::where('id',$id)->find($id);
        $clients->name=$request->name;
        $clients->phone=$request->phone;
        $clients->address=$request->address;
        $clients->save();
        return back();
    }

    public function destroy($id){
        $client=Client::where('id',$id)->delete();
        return back();
    }

    public function massDestroy(){
        Client::whereIn('id', request('ids'))->delete();
        return response(null, 204);
    }
}
