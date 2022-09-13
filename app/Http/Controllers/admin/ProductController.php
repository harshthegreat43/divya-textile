<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Auth;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Size;
use App\Models\Color;

class ProductController extends Controller{


	function index(){
		$value = Category::get();
        $result = product :: get();
		return view('admin/product/index',compact('result','value'));
    }

	
	function add(Request $request){
		if($request->input()){
			dd($request);
			$validated = $request->validate([
				'name' => 'required',
				'category_id' => 'required',
				'price' => 'required|numeric',
				'category_id' => 'required',
				'color' => 'required|array',
				'size' => 'required|array',
				'delivery_charges' => 'required|numeric',
				'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
				'short_discription' => 'required',
				'discription' => 'required',
			]);
			$product = new product();
			$product->category_id=$request->category_id;
			$product->name=$request->name;
			$product->price=$request->price;
			$product->size=implode(",",$request->size);
			$product->color=implode(",",$request->color);
			$product->delivery_charges=$request->delivery_charges;
			$product->short_discription=$request->short_discription;
			$product->discription=$request->discription;
			$Image = $_FILES['image'];
            if($Image['name']){
                $image_name= time().$Image['name'];
                $tmp_name= $Image['tmp_name'];
                move_uploaded_file($tmp_name , "public/product_img/$image_name");
            }else{
            }
			$product->image=$image_name;
			$result = $product->save();
			$sku = Product::latest()->first()->id;
			$product->sku= '#'.'P'.$sku;
			$result = $product->update();
			if($result){
				if($request->file('images')){
					foreach($request->file('images') as $images){
						$productimage = new ProductImage();
						$name = rand().time().$images->getClientOriginalName();
						$productimage->images =  $name;
						$productimage->product_id = Product::latest()->first()->id;
						move_uploaded_file($images , "public/product_images/$name");
						$img = $productimage->save();
					}
					session()->flash('success', 'Product has been added');
					return redirect('admin/product/');
				}
			}
		}else{
			$category = Category::get();
			session()->put('category',$category);
			$size = Size::where('status','Y')->get();
			$color = Color::where('status','Y')->get();
			return view('admin/product/add',compact('size','color'));
		}
		
    }

	

	function edit( Request $request, $id){
		if($request->input()){
			$validated = $request->validate([
				'name' => 'required',
				'category_id' => 'required',
				'price' => 'required|numeric',
				'color' => 'array',
				'size' => 'array',
				'delivery_charges' => 'required|numeric',
				'image' => 'image|mimes:jpg,jpeg,png,gif,svg|max:2048',
				'short_discription' => 'required',
				'discription' => 'required',
			]);
			$product =  product::find($id); 
			$product->category_id=$request->category_id;
			$product->name=$request->name;
			$product->sku= '#'.'P'.$id;
			$product->price=$request->price;
			if($request->color!=null){
				$product->color=implode(",",$request->color);
			}
			if($request->size!=null){
				$product->size=implode(",",$request->size);
			}
			$product->delivery_charges=$request->delivery_charges;
			$product->short_discription=$request->short_discription;
			$product->discription=$request->discription;
			$Image = $_FILES['image'];
			if($Image['name']){
				$image_path = 'public/product_img/'.$product->image;
				File::delete($image_path);
				$image_name= time().$Image['name'];
				$tmp_name= $Image['tmp_name'];
				move_uploaded_file($tmp_name , "public/product_img/$image_name");
				$product->image=$image_name;
			}else{
	
			}
			$result = $product->save();
			if($result){
				if($request->file('images')){
					foreach($request->file('images') as $images){
						$productimage = new ProductImage();
						$name = rand().time().$images->getClientOriginalName();
						$productimage->images =  $name;
						$productimage->product_id = $id;
						move_uploaded_file($images , "public/product_images/$name");
						$img = $productimage->save();
					}
					session()->flash('success', 'Product has been updated');
					return redirect('admin/product/');
				}
				session()->flash('success', 'Product has been updated');
				return redirect('admin/product/');
			}
		    
		}else{
			$category = Category::get();
			session()->put('category',$category);
			$product =product::find($id);
			$images = ProductImage::where('product_id',$id)->get();
			$size = Size::where('status','Y')->get();
			$color = Color::where('status','Y')->get();
			return view('admin/product/edit',compact('product','images','size','color'));
		}
	    }

		
		function delete($id){
			$product =  product::find($id);
			$image_path = 'public/product_img/'.$product->image;
			File::delete($image_path);
			$images = ProductImage::where('product_id',$id)->get();
			if($images){
				foreach($images as $img){
				$image_path = 'public/product_images/'.$img->images;
				File::delete($image_path);
				ProductImage::destroy($img->id);
				}
			}
			product::destroy($id);
			session()->flash('warning', 'Product has been deleted');
			return redirect('admin/product/');
		}

		
		function delete_img(Request $request){
			$id = $request->id;
			$images = ProductImage::find($id);
			$image_path = 'public/product_images/'.$images->images;
			File::delete($image_path);
			ProductImage::destroy($id);
			session()->flash('info', 'Product image has been deleted');
			return response()->json(['success' => true, 'isreload' => 1]);
		}

	
	function status($id,$status){
		$product =  product::find($id); 
		if($status=='N'){
			$product->status='N';
		}elseif($status=='Y'){
			$product->status='Y';
		}
		$result = $product->save();
		if($result){
			$product = Product::find($id);
			if($product->status=='Y'){
				session()->flash('success', 'Product status has been activated');
				return redirect('admin/product/');
			}
			elseif($product->status=='N'){
				session()->flash('error', 'Product status has been deactivated');
				return redirect('admin/product/');
			}else{

			}
		}
	}
    
    
    function search(Request $request){
        $id =  $request->category_id;
        $result = Product::where('category_id',$id)->get()->all();
        $html = view('admin/product/search')->with(compact('result'))->render();
        return response()->json(['success' => true, 'html' => $html]);  
    }

}