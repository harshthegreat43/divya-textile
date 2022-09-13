<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Auth;
// use Illuminate\Support\Facades\Http;
use App\Models\State;

class StateController extends Controller{


	function index(){
        $result = State :: get();
		return view('admin/state/index',compact('result'));
    }



    function add(Request $request){
      if($request->input()){
        $validated = $request->validate([
          'name' => 'required',
        ]);
        $state = new State();
        $state->name=$request->name;
        $result = $state->save();
        if($result){
          session()->flash('success', 'State has been added');
          return redirect('admin/state/');
        }
      }else{
        return view('admin/state/add');
      }
      
      }



      function edit( Request $request, $id){
        if($request->input()){
          $validated = $request->validate([
            'name' => 'required',
          ]);
          $state =  State::find($id); 
          $state->name=$request->name;
          $result = $state->save();
          if($result){
            session()->flash('success', 'State has been updated');
            return redirect('admin/state/');
          }
            
        }else{
          $state = State::find($id);
          return view('admin/state/edit',compact('state'));
        }
          }

          
    
	function delete($id){
		$state =  State::find($id);
		State::destroy($id);
		session()->flash('warning', 'State has been deleted');
		return redirect('admin/state/');
    }


    
		function status($id,$status){
			$state =  State::find($id); 
			if($status=='N'){
				$state->status='N';
			}elseif($status=='Y'){
				$state->status='Y';
			}
			$result = $state->save();
			if($result){
        $state = State::find($id);
        if($state->status=='Y'){
          session()->flash('success', 'State status has been activated');
          return redirect('admin/state/');
        }
        elseif($state->status=='N'){
          session()->flash('error', 'State status has been deactivated');
          return redirect('admin/state/');
        }else{

        }
			}
		}
}