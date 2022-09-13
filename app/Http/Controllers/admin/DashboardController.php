<?php
namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Http;
use App\Models\User;
use App\Models\Product;
use App\Models\Enquiry;
use App\Models\Order;
use Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller{
	
	function index(){
		$product = Product::count();
		$enquiry = Enquiry::count();
		$order = Order::count();
		$customer = User::where('role_id','2')->count();
		return view('admin/dashboard/index',compact('product','enquiry','order','customer'));
	}




}