<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{

       

    function order(){
     $order = Order::with('detail')->get();
     return view('admin/order/index',compact('order'));
    }

	
    function orderstatus(Request $request){
        $id =  $request->id;
        $status = $request->status;
        $order = Order::find($id);
        $order->status = $status;
        $order->save();
        return response()->json(['success' => true, 'isreload' => 1]);
        
           
    }
    
    
    function search(Request $request){
        $mobile =  $request->mobile;
        $order = Order::where('mobile',$mobile)->get();
        $html = view('admin/order/search')->with(compact('order'))->render();
        return response()->json(['success' => true, 'html' => $html]);  
    }

        
	function detailmodel($id){
		$order =  Order::find($id);
        return view('admin/order/detailmodel',compact('order'));
    }



}
