<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Auth;
// use Illuminate\Support\Facades\Http;
use App\Models\City;
use App\Models\State;

class CityController extends Controller{


	function index(){
        $result = City :: get();
		return view('admin/city/index',compact('result'));
    }



    function add(Request $request){
      if($request->input()){
        $validated = $request->validate([
            'name' => 'required',
            'state' => 'required',
        ]);
        $city = new City();
        $city->name=$request->name;
        $city->state_id=$request->state;
        $result = $city->save();
        if($result){
          session()->flash('success', 'City has been added');
          return redirect('admin/city/');
        }
      }else{
        $state = State::get();
        return view('admin/city/add',compact('state'));
      }
      
      }



      function edit( Request $request, $id){
        if($request->input()){
          $validated = $request->validate([
            'name' => 'required',
            'state' => 'required',
          ]);
          $city =  City::find($id); 
          $city->name=$request->name;
          $city->state_id=$request->state;
          $result = $city->save();
          if($result){
            session()->flash('success', 'City has been updated');
            return redirect('admin/city/');
          }
            
        }else{
          $city = City::find($id);
          $state = State::get();
          return view('admin/city/edit',compact('city','state'));
        }
          }

          
    
	function delete($id){
		$city =  City::find($id);
		City::destroy($id);
		session()->flash('warning', 'City has been deleted');
		return redirect('admin/city/');
    }


    
		function status($id,$status){
			$city =  City::find($id); 
			if($status=='N'){
				$city->status='N';
			}elseif($status=='Y'){
				$city->status='Y';
			}
			$result = $city->save();
			if($result){
        $city = City::find($id);
        if($city->status=='Y'){
          session()->flash('success', 'City status has been activated');
          return redirect('admin/city/');
        }
        elseif($city->status=='N'){
          session()->flash('error', 'City status has been deactivated');
          return redirect('admin/city/');
        }else{

        }
			}
		}
}