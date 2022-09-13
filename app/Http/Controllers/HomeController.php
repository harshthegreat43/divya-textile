<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;
use App\Models\Enquiry;
use App\Models\Slider;
use App\Models\Video;
use App\Models\State;
use App\Models\City;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Address;
use App\Models\Coupan;
use App\Models\ProductImage;
use Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller{

    function index(){
        $slider = Slider::where('status','Y')->get();
        $category = Category::where([['status','Y'],['is_trending','Y']])->get();
        $video = Video::where('status','Y')->get();
        return view('index',compact('slider','category','video'));
    }



       function aboutus(){
        $user = User::where('role_id','1')->get()->first();
        $free_delivery = $user->min_amt;
        return view('web/aboutus',compact('free_delivery'));
       }



       function collection(){
        $category = Category::where('status','Y')->get();
        $user = User::where('role_id','1')->get()->first();
        $free_delivery = $user->min_amt;
        return view('web/collection',compact('category','free_delivery'));
       }



       function product($id){
        $product = Product::where([['category_id',$id],['status','Y']])->get();
        return view('web/product',compact('product'));
       }


       
       function product_detail($id){
        $images = ProductImage::where('product_id',$id)->get();
        $product = Product::where('id',$id)->get()->first();
        $user = User::where('role_id','1')->get()->first();
        $free_delivery = $user->min_amt;
        return view('web/product_detail',compact('product','images','free_delivery'));
       }



       function terms(){
        return view('web/terms&condition');
       }



       function privacypolicy(){
        return view('web/privacypolicy');
       }



       function contactus(Request $request){
        if($request->input()){
            $validated = $request->validate([
              'name' => 'required',
              'email' => 'required|email',
              'mobile' => 'required|digits:10|numeric',
              'sku' => 'required',
            ]);
            $enquiry = new Enquiry();
            $enquiry->name=$request->name;
            $enquiry->email=$request->email;
            $enquiry->product=$request->sku;
            $enquiry->mobile=$request->mobile;
            $enquiry->message=$request->message;
            $result = $enquiry->save();
            if($result){
                return redirect('/');
            }
        }else{
            return view('web/contactus');
        }
       }

       

       function placeorder($id,$customer){
        $product = Product::where('id',$id)->get()->first();
        $state = State::where('status','Y')->get();
        $coupan = Coupan::where([['enddate','>=',date('Y-m-d')],['category',$product->category->name],['status','Y']])->get();
        $city = City::where('status','Y')->get();
        $user = User::where('role_id','1')->get()->first();
        $customer_id = User::where('id',$customer)->first()->id;
        $free_delivery = $user->min_amt;
        if($product->price < $free_delivery){
            $delivery = $product->delivery_charges;
        }else{
            $delivery = 0;
        }
        return view('web/order',compact('product','state','city','coupan','delivery','free_delivery','customer_id'));
       }


        function saveorder(Request $request){
            if($request->input()){
                $validated = $request->validate([
                    'product_id' => 'required',
                    'customer_id' => 'required',
                    'name' => 'required',
                    'email' => 'required|email',
                    'state' => 'required',
                    'city' => 'required',
                    'pincode' => 'required|digits:6|numeric',
                    'mobile' => 'required|digits:10|numeric',
                    'address' => 'required',
                    'quantity' => 'required',
                    'coupan_code' => 'required',
                ]);  
                    $user = User::where('role_id','1')->get()->first();
                    $free_delivery = $user->min_amt;
                        $product = Product::where('id',$request->product_id)->get()->first();
                        $order = new Order();
                        $price = $product->price;
                        $quantity = $request->quantity;
                        $gt = $price*$quantity;
                        $order->customer_id=$request->customer_id;
                        $order->product_price=$price;
                        $order->quantity=$quantity;
                        $order->city_id=$request->city;
                        $order->state_id=$request->state;
                        $order->product_id=$request->product_id;
                        $coupan_id = $request->coupan_code;
                        if($coupan_id!='0'){
                            $coupan = Coupan::where('id', $coupan_id)->get()->first();
                            if ($gt >= $coupan->min_amount) {
                                $discounts = $coupan->discount;
                                if (isset($coupan) && $coupan->type == 'fixed') {
                                    $discount = $discounts;
                                } elseif (isset($coupan) && $coupan->type == '%') {
                                    $discount = ($gt*$discounts)/100;
                                }
                            }else{
                                $discount = 0;
                            }
                        }else{
                            $discount = 0;
                        }
                        $order->discount=$discount;
                        $amount = $gt - $discount;
                        if($amount > $free_delivery){
                            $order->total_amount = $amount;
                        }else{
                            $order->total_amount = $amount+($product->delivery_charges);
                        }
                        $result = $order->save();
                        if($result){
                            $id = Order::latest()->first()->id;
                            $order = Order::where('id',$id)->get()->first();
                            $address = new Address();
                            $address->order_id = $id;
                            $address->name = strtolower($request->name);
                            $address->mobile=$request->mobile;
                            $address->pincode=$request->pincode;
                            $address->address=$request->address;
                            $address->city = $order->city->name;
                            $address->state = $order->city->state->name;
                            $result = $address->save();
                            if($result){
                                session()->flash('success', 'YOUR ORDER HAS BEEN PLACED.');
                                return redirect(\URL::previous());
                            }
                        }

                }
            }



            function myorders($id){
                $result = Order::where('customer_id',$id)->get()->all();
                if($result!=null){
                    return view('web/myorders',compact('result'));
                }else{
                    session()->flash('error', 'NO ORDERS HAVE BEEN PLACED YET.');
                    return view('web/myorders',compact('result'));
                }
            }

	
            function orderstatus(Request $request){
                $id =  $request->id;
                $status = $request->status;
                $order = Order::find($id);
                $order->status = $status;
                $order->save();
                return response()->json(['success' => true, 'isreload' => 1]);
                
                   
            }


        function statecity(Request $request){
            $stateid = $request->stateid;
            $city = City::where('state_id',$stateid)->get();
            $html = view('web/statecity')->with(compact('city'))->render();
            return response()->json(['success' => true, 'html' => $html]);

        }


        public function applycoupan(Request $request){
            //dd($request);
            $product   = Product::where('id', $request->product_id)->get()->first();
            $coupan_id = $request->coupan_id;
            $quantity = $request->quantity;
            // dd($coupan_id);
           
           // dd($discount);
            $gt = ($product->price * $quantity);
            $user = User::where('role_id','1')->get()->first();
            $free_delivery = $user->min_amt;
            if(!empty($coupan_id)){
                $coupan = Coupan::where('id', $coupan_id)->get()->first();
                if ($gt >= $coupan->min_amount) {
                    $discount = $coupan->discount;
                    if (isset($coupan) && $coupan->type == 'fixed') {
                        $discounted_amount = $discount;
                        $total_price = $gt-$discount;
                    } elseif (isset($coupan) && $coupan->type == '%') {
                        //DD($coupan->type);
                        $discounted_amount = ($gt*$discount)/100;
                        $total_price = ($gt)- (($gt * $discount)/100);
                    }
                }
            }else{
                $discounted_amount = 0;
                $total_price = $gt;
            }
            if($total_price < $free_delivery){
                $delivery = $product->delivery_charges;
            }else{
                $delivery = 0;
            }
            $html = view('web/applycoupan')->with(compact('total_price','delivery','product','quantity' ,'discounted_amount' ))->render();
            return response()->json(['success' => true, 'html' => $html]);
        }
}