<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Auth;
// use Illuminate\Support\Facades\Http;
use App\Models\Stat;

class StatController extends Controller{


	function index(){
        $result = Stat :: get();
		return view('admin/stat/index',compact('result'));
    }



    function add(Request $request){
      if($request->input()){
        $validated = $request->validate([
          'name' => 'required',
          'content' => 'required',
        ]);
        $stat = new Stat();
        $stat->name=$request->name;
        $stat->content=$request->content;
        $result = $stat->save();
        if($result){
          session()->flash('success', 'Stat has been added');
          return redirect('admin/stat/');
        }
      }else{
        return view('admin/stat/add');
      }
      
      }



      function edit( Request $request, $id){
        $validated = $request->validate([
          'name' => 'required',
      ]);
        if($request->input()){
          $stat =  Stat::find($id); 
          $stat->name=$request->name;
          $stat->content=$request->content;
          $result = $stat->save();
          if($result){
            session()->flash('success', 'Stat has been updated');
            return redirect('admin/stat/');
          }
            
        }else{
          $stat = Stat::find($id);
          return view('admin/stat/edit',compact('stat'));
        }
          }

          
    
	function delete($id){
		$stat =  Stat::find($id);
		$image_path = 'public/stat_img/'.$stat->image;
		File::delete($image_path);
		Stat::destroy($id);
		session()->flash('warning', 'Stat has been deleted');
		return redirect('admin/stat/');
    }


    
		function status($id,$status){
			$stat =  Stat::find($id); 
			if($status=='N'){
				$stat->status='N';
			}elseif($status=='Y'){
				$stat->status='Y';
			}
			$result = $stat->save();
			if($result){
        $stat = Stat::find($id);
        if($stat->status=='Y'){
          session()->flash('success', 'Stat status has been activated');
          return redirect('admin/stat/');
        }elseif($stat->status=='N'){
          session()->flash('error', 'Stat status has been deactivated');
          return redirect('admin/stat/');
        }else{
          
        }
			}
		}
}