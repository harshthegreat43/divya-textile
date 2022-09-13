<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Coupan;
use App\Models\Product;
use App\Models\Productimage;
use Illuminate\Http\Request;

class CoupanController extends Controller
{
    function index(){
        $result = Coupan::get();
        return view('admin/coupan/index',compact('result'));
    }



    function add(Request $request){
        if($request->input()){
            $request->validate ([ 
                'category_id'=>'required',
                'coupan_code'=>'required',
                'min_amount'=>'required|min:50|numeric',
                'discount'=>'required',
                'description'=>'required',
                'discount_type' => 'required',
                'start_date' => 'required',
                'end_date' => 'required|max:start_date'
            ]);
            $category_name = Category::where('id',$request->category_id)->get()->first();
            $data = new Coupan();
            $data->category = $category_name->name;
            $data->coupan_code = $request->coupan_code;
            $data->min_amount = $request->min_amount;
            $data->discount = $request->discount;
            $data->description = $request->description;
            $data->type = $request->discount_type;
            $data->startdate=$request->start_date;
            $data->enddate=$request->end_date;
            $data->save();
            $request->session()->flash('success', 'Coupan added successfully');
            return redirect('admin/coupan');
        } else{
            $category = Category::get();
            return view('admin/coupan/add',compact('category'));
        }
    }

    
    function delete($id){
        Coupan::destroy($id);
        session()->flash('error', 'Coupan deleted successfully');
        return redirect('admin/coupan');
    }


    
    function status($id,$status){
        $coupan =  Coupan::find($id); 
        if($status=='N'){
            $coupan->status='N';
        }elseif($status=='Y'){
            $coupan->status='Y';
        }
        $result = $coupan->save();
        if($result){
            $coupan = Coupan::find($id);
            if($coupan->status=='Y'){
            session()->flash('success', 'Coupan status has been activated');
            return redirect('admin/coupan/');
            }elseif($coupan->status=='N'){
            session()->flash('error', 'Coupan status has been deactivated');
            return redirect('admin/coupan/');
            }else{

            }
        }
    }



    function edit(Request $request, $id){
        if($request->input()){
            $request->validate ([ 
                'category_id'=>'required',
                'coupan_code'=>'required',
                'min_amount'=>'required|min:50|numeric',
                'discount'=>'required',
                'description'=>'required',
                'discount_type' => 'required',
                'start_date' => 'required',
                'end_date' => 'required|max:start_date'
            ]);
            $category_name = Category::where('id',$request->category_id)->get()->first();
            $data = Coupan::find($id);
            $data->category = $category_name->name;
            $data->coupan_code = $request->coupan_code;
            $data->min_amount = $request->min_amount;
            $data->discount = $request->discount;
            $data->description = $request->description;
            $data->type = $request->discount_type;
            $data->startdate=$request->start_date;
            $data->enddate=$request->end_date;
            $data->save();
            $request->session()->flash('success', 'Coupan edited successfully');
            return redirect('admin/coupan');
        } else{
            $data =  Coupan::find($id);
            $category = Category::get();
            return view('admin/coupan/edit', compact('data','category'));
        }
    }




}
