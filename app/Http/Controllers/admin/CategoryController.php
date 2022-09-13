<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Auth;
// use Illuminate\Support\Facades\Http;
use App\Models\Category;

class CategoryController extends Controller{


	function index(){
        $result = Category :: get();
		return view('admin/category/index',compact('result'));
    }



    function add(Request $request){
      if($request->input()){
        $validated = $request->validate([
          'name' => 'required',
          'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);
        $category = new category();
        $category->name=$request->name;
        $Image = $_FILES['image'];
        if($Image['name']){
            $image_name= time().$Image['name'];
            $tmp_name= $Image['tmp_name'];
            move_uploaded_file($tmp_name , "public/category_img/$image_name");
        }
        $category->image=$image_name;
        $result = $category->save();
        if($result){
          session()->flash('success', 'Category has been added');
          return redirect('admin/category/');
        }
      }else{
        return view('admin/category/add');
      }
      
      }



      function edit( Request $request, $id){
        if($request->input()){
          $validated = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
          ]);
          $category =  category::find($id); 
          $category->name=$request->name;
          $Image = $_FILES['image'];
          if($Image['name']){
            $image_path = 'public/category_img/'.$category->image;
            File::delete($image_path);
            $image_name= time().$Image['name'];
            $tmp_name= $Image['tmp_name'];
            move_uploaded_file($tmp_name , "public/category_img/$image_name");
            $category->image=$image_name;
          }else{
      
          }
          $result = $category->save();
          if($result){
            session()->flash('success', 'Category has been updated');
            return redirect('admin/category/');
          }
            
        }else{
          $category = category::find($id);
          return view('admin/category/edit',compact('category'));
        }
          }

          
    
	function delete($id){
		$category =  category::find($id);
		$image_path = 'public/category_img/'.$category->image;
		File::delete($image_path);
		category::destroy($id);
		session()->flash('warning', 'Category has been deleted');
		return redirect('admin/category/');
    }


    
		function status($id,$status){
			$category =  category::find($id); 
			if($status=='N'){
				$category->status='N';
			}elseif($status=='Y'){
				$category->status='Y';
			}
			$result = $category->save();
			if($result){
        $category = Category::find($id);
        if($category->status=='Y'){
          $category = session()->flash('success', 'Category status has been activated');
          return redirect('admin/category/');
        }
        elseif($category->status=='N'){
          $category = session()->flash('error', 'Category status has been deactivated');
          return redirect('admin/category/');
        }else{
  
        }
			}
		}


		function trending($id,$is_trending){
			$category =  category::find($id); 
			if($is_trending=='N'){
				$category->is_trending='N';
			}elseif($is_trending=='Y'){
				$category->is_trending='Y';
			}
			$result = $category->save();
			if($result){
        $category = Category::find($id);
        if($category->is_trending=='Y'){
          $category = session()->flash('success', 'Category is now trending');
          return redirect('admin/category/');
        }
        elseif($category->is_trending=='N'){
          $category = session()->flash('error', 'Category is removed from trending');
          return redirect('admin/category/');
        }else{
  
        }
			}
		}
}