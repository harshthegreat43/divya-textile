<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Auth;
// use Illuminate\Support\Facades\Http;
use App\Models\Video;

class VideoController extends Controller{


	function index(){
        $result = Video :: get();
		return view('admin/video/index',compact('result'));
    }



    function add(Request $request){
      if($request->input()){
        $validated = $request->validate([
          'name' => 'required',
          'video_link' => 'required|url',
        ]);
        $video = new Video();
        $video->name=$request->name;
        $video->video_link=$request->video_link;
        $result = $video->save();
        if($result){
          session()->flash('success', 'Video has been added');
          return redirect('admin/video/');
        }
      }else{
        return view('admin/video/add');
      }
      
      }



      function edit( Request $request, $id){
        if($request->input()){
          $validated = $request->validate([
            'name' => 'required',
            'video_link' => 'url',
          ]);
          $video =  Video::find($id); 
          $video->name=$request->name;
          if($request->video_link!=null){
            $video->video_link=$request->video_link;
          }else{
      
          }
          $result = $video->save();
          if($result){
            session()->flash('success', 'Video has been updated');
            return redirect('admin/video/');
          }
            
        }else{
          $video = Video::find($id);
          return view('admin/video/edit',compact('video'));
        }
          }

          
    
	function delete($id){
		$video =  Video::find($id);
		Video::destroy($id);
		session()->flash('warning', 'Video has been deleted');
		return redirect('admin/video/');
    }


    
		function status($id,$status){
			$video =  Video::find($id); 
			if($status=='N'){
				$video->status='N';
			}elseif($status=='Y'){
				$video->status='Y';
			}
			$result = $video->save();
			if($result){
        $video = Video::find($id);
        if($video->status=='Y'){
          session()->flash('success', 'Video status has been activated');
          return redirect('admin/video/');
        }elseif($video->status=='N'){
          session()->flash('error', 'Video status has been deactivated');
          return redirect('admin/video/');
        }else{
          
        }
			}
		}
}