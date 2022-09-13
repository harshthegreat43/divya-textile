<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Auth;
// use Illuminate\Support\Facades\Http;
use App\Models\Slider;

class SliderController extends Controller{


	function index(){
        $result = Slider :: get();
		return view('admin/slider/index',compact('result'));
    }



    function add(Request $request){
      if($request->input()){
        $validated = $request->validate([
          'name' => 'required',
          'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);
        $slider = new Slider();
        $slider->name=$request->name;
        $Image = $_FILES['image'];
        if($Image['name']){
            $image_name= time().$Image['name'];
            $tmp_name= $Image['tmp_name'];
            move_uploaded_file($tmp_name , "public/slider_img/$image_name");
        }
        $slider->image=$image_name;
        $result = $slider->save();
        if($result){
          session()->flash('success', 'Slider has been added');
          return redirect('admin/slider/');
        }
      }else{
        return view('admin/slider/add');
      }
      
      }



      function edit( Request $request, $id){
        if($request->input()){
          $validated = $request->validate([
            'name' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png,gif,svg|max:2048'
          ]);
          $slider =  Slider::find($id); 
          $slider->name=$request->name;
          $Image = $_FILES['image'];
          if($Image['name']){
            $image_path = 'public/slider_img/'.$slider->image;
            File::delete($image_path);
            $image_name= time().$Image['name'];
            $tmp_name= $Image['tmp_name'];
            move_uploaded_file($tmp_name , "public/slider_img/$image_name");
            $slider->image=$image_name;
          }else{
      
          }
          $result = $slider->save();
          if($result){
            session()->flash('success', 'Slider has been updated');
            return redirect('admin/slider/');
          }
            
        }else{
          $slider = Slider::find($id);
          return view('admin/slider/edit',compact('slider'));
        }
          }

          
    
	function delete($id){
		$slider =  Slider::find($id);
		$image_path = 'public/slider_img/'.$slider->image;
		File::delete($image_path);
		Slider::destroy($id);
		session()->flash('warning', 'Slider has been deleted');
		return redirect('admin/slider/');
  }


    
		function status($id,$status){
			$slider =  Slider::find($id); 
			if($status=='N'){
				$slider->status='N';
			}elseif($status=='Y'){
				$slider->status='Y';
			}
			$result = $slider->save();
			if($result){
        $slider = Slider::find($id);
        if($slider->status=='Y'){
          session()->flash('success', 'Slider status has been activated');
          return redirect('admin/slider/');
        }
        elseif($slider->status=='N'){
          session()->flash('error', 'Slider status has been deactivated');
          return redirect('admin/slider/');
        }else{

        }
			}
		}
}